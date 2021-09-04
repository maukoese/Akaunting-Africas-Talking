<?php

namespace Modules\AfricasTalking\Listeners;

use Akaunting\Language\Language;
use App\Models\Common\Contact;
use App\Models\Document\Document;
use App\Notifications\Sale\Invoice;
use Illuminate\Notifications\Events\NotificationSent;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Modules\AfricasTalking\Events\SmsSent;
use Modules\AfricasTalking\Facades\AfricasTalking;
use Modules\AfricasTalking\Services\Contracts\Status;

class SendSmsWithInvoice
{
    /**
     * Create the event listener.
     *
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param NotificationSent $event
     * @return void
     */
    public function handle($event)
    {
        if ($this->shouldSend($event)) {
            try {

                $invoice = $event->notification->invoice;

                $phone = $invoice->contact->phone;

                $message = $this->message($invoice);

                $response = AfricasTalking::send($phone, $message, Str::upper(Language::country()));

                if ($response->success()) {
                    event(new SmsSent($response, $phone, $message));
                } else {
                    event(new SmsSent($response, $phone, $response->message(), Status::ERROR));
                }
            } catch (\Exception $exception) {
                Log::error('Message not sent in ' . __CLASS__, ['package' => 'africas-talking', 'exception_message' => $exception->getMessage()]);
            }
        }
    }

    protected function message(Document $invoice)
    {
        $money     = money($invoice->amount, $invoice->currency_code, true);
        $currency  = currency($invoice->currency_code);
        $precision = $currency->getPrecision();
        $decimals  = $currency->getDecimalMark();
        $thousands = $currency->getThousandsSeparator();
        $suffix    = $currency->getCurrency();
        $negative  = $money->isNegative();

        $value = number_format($money->getValue(), $precision, $decimals, $thousands);

        $amount = ($negative ? '-' : '') . $value . ' ' . $suffix;

        $default = trans('africas-talking::general.invoice_message');

        $message = setting('africas-talking.invoice_message', $default);

        return $this->replaceInMessage($message, [
            'amount'   => $amount,
            'customer' => $invoice->contact_name,
            'invoice'  => $invoice->id,
        ]);
    }

    /**
     * @param $message
     * @param array $replace
     * @return mixed|string
     */
    protected function replaceInMessage($message, array $replace)
    {
        $current = $message;

        foreach ($replace as $key => $value) {
            $current = str_replace(':' . $key, $value, $current);
        }

        return $current;
    }

    /**
     * @param NotificationSent $event
     * @return bool
     */
    protected function shouldSend($event)
    {
        return $event->notification instanceof Invoice
            && $event->notifiable instanceof Contact
            && $event->channel === 'mail'
            && (bool) setting('africas-talking.send_with_invoice', false)
            && $event->notification->invoice->contact
            && $event->notification->invoice->contact->phone;
    }
}
