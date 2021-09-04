<?php

namespace Modules\AfricasTalking\Services\Contracts;


interface Status
{
    const UNKNOWN = 'unknown';

    const SENT = 'sent';

    const INSUFFICIENT_BALANCE = 'insufficient_balance';

    const CANCELED = 'canceled';

    const ON_QUEUE = 'on_queue';

    const ERROR = 'error';

    const SPAM = 'spam';

    const CREATING = 'creating';

    const NOT_CREATE_YET = 'not_create_yet';

}
