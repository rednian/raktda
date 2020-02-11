<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class smsController extends Controller
{

    private $SMS_SENDER = "John Doe";
    private $RESPONSE_TYPE = 'json';
    private $SMS_USERNAME = 'raktda';
    private $SMS_PASSWORD = 'Hpwfso0!';

    public function sendSms() {
        $phone_number = '+971558260694';
        $message = 'A sample SMS';

        $postData = array(
            'username' => $this->SMS_USERNAME,
            'password' => $this->SMS_PASSWORD,
            'message' => $message,
            'sender' => $this->SMS_SENDER,
            'mobile' => $phone_number,
            'response' => $RESPONSE_TYPE
        );

    }
}
