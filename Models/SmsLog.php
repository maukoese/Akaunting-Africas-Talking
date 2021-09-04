<?php

namespace Modules\AfricasTalking\Models;

use App\Abstracts\Model;
use App\Models\Auth\User;

class SmsLog extends Model
{
    protected $table = 'africas_talking_sms_logs';

    protected $fillable = [
        'company_id',
        'user_id',
        'process_id',
        'contact_id',
        'phone',
        'message',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault([
            'name' => '&mdash;'
        ]);
    }

    public function shouldCheckStatus()
    {
        return in_array($this->attributes['status'], [
            'unknown',
            'undefined',
            'on_queue',
            'creating',
            'not_create_yet'
        ]);
    }

    public function statusColor()
    {
        switch ($this->attributes['status']) {
            case 'canceled':
            case 'creating':
                return 'primary';
            case 'on_queue':
            case 'spam':
            case 'not_create_yet':
                return 'warning';
            case 'error':
            case 'insufficient_balance':
                return 'danger';
            case 'sent':
                return 'success';
            default:
                return 'info';
        }
    }
}
