<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactFormMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $email;
    public $phone;
    public $subject;
    public $message;

    public function __construct($name, $email, $phone, $subject, $message)
    {
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
        $this->subject = $subject;
        $this->message = $message;
    }

    public function build()
    {
        $subject = $this->subject;
        
    
        return $this->view('statics.sendemail.sendEmailContact', [
            'name' => $this->name,
             'email' => $this->email,
             'phone' => $this->phone,
              'message' => $this->message,
            'subject' => $subject,
        ])->subject($subject);
    }
    
}
