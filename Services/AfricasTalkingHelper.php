<?php

namespace Modules\AfricasTalking\Services;

class AfricasTalkingHelper
{
    /**
     * Get all statuses with transition
     *
     * @return array
     */
    public static function statuses()
    {
        $statuses = [
            'unknown',
            'sent',
            'insufficient_balance',
            'canceled',
            'on_queue',
            'error',
            'spam',
            'creating',
            'not_create_yet',
        ];

        return array_combine($statuses, array_values(trans('africas-talking::statuses')));
    }

}
