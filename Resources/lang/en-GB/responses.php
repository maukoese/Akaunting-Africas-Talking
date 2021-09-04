<?php

return [
    "success_send" => 'Message was sent!',

    "throttled" => 'You are sending faster then your account allows you to send (by default 30 SMS/s; only 1 SMS/s/virtual number sender is allowed when sending to the US using a long virtual number)',

    "missing_parameters" => 'You are missing a parameter in your http request.',

    "invalid_credentials" => ' Your API Key or Secret are incorrectly specified',

    "unroutable" => 'We don\'t have reach to your destination. It may be a fixed line phone number or you didn\'t specify the country code, or you may have entered an invalid destination number.',

    "partner_account_barred" => 'Your account has been suspended. You will need to contact us at support@africas-talking.com.',

    "partner_quota_violation" => 'You do not have sufficient credit to complete your request. You will need to top up your account. Once you have, you should retry to send the message.',

    "invalid_sender" => 'INVALID SENDER - Frequently seen when trying to use non-authorized senderID in North America, where a AfricasTalking long virtual number or short code is required.',

    "non_white_list" => 'NON WHITE LIST - This will occur when your account is in a demo mode and you haven’t added the number to your whitelisted destination list. Note that you may remove this limitation by topping up your account.',


];
