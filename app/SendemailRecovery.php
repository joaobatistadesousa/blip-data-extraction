<?php
namespace App;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendemailRecovery extends Mailable
{
    use Queueable, SerializesModels;
private $code ;
    public function __construct($code)
    {
        $this->code=$code;
    }

    public function build()
    {
        return $this->view('statics.sendemail.sendemail',['code'=>$this->code]);
    }
}
