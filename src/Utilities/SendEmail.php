<?php

namespace OlaHub\Libraries;

use App\Mail\EmailFunction;
use Illuminate\Support\Facades\Mail;

class SendEmails {

    public
            $subject,
            $body,
            $to,
            $ccMail;

    function send() {
        $toFinal = [];
        if(is_array($this->to)){
            foreach ($this->to as $one){
                if(is_array($one)){
                    if(count($one) == 2){
                        $toFinal[] = [
                            'email' => $one[0],
                            'name' => $one[1],
                        ];
                    }else{
                        $toFinal[] = [
                            'email' => $one[0]
                        ];
                    }
                }else{
                    $toFinal = $this->to;
                }
            }
        }else{
            $toFinal = $this->to;
        }
        Mail::to($toFinal)->send(new EmailFunction($this->body, $this->subject,  $this->ccMail));
        return true;
    }

}
