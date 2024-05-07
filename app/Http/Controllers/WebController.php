<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class WebController extends Controller
{
    public function home()
    {
        return view('statics.welcome');
    }
    public function registerUser(){

        return view('statics.register.register');
    }
    function loginUser(){

        return view('statics.login.login');
    }
    function about(){

        return view('statics.about.about');
    }
    function contact()  {

        return view('statics.contact.contact');
    }
    function forgotPassword()  {

        return view('statics.forgotPassword.forgotPassword');
    }
    public function inputCode(){

        return view('statics.inputCode.inputCode');
    }
    public function sendEmailRecoveryPassword(Request $request){

        $email=$request->email;
        $code=rand(1000,9999);
        if(User::where('email', $email)->exists()){
            $user=User::where('email', $email)->first();
            $user->code=$code;
            $user->save();
            
        Mail::to($email)->send(new SendemailRecovery ($code));
        return view('statics.inputCode.inputCode');

        }else{
            return redirect()->back()->withErrors(['error' => 'email não encontrado, verifique e-mail e tente novamente.']);
        }
        
    }
    public function verifyCodeEmailRecovery(Request $request){

        $user = User::where('code', $request->codigo)->first();
        if ($user) {
            return view('statics.newPassword.newPassword',compact('user'));

        } else {
            return redirect()->route('forgot-password');
        }
    }
    public function registerNewPassword(Request $request){
        $user = User::where('id', $request->userId)->first();
        if ($user) {
            $user->password = Hash::make($request->password);
            $user->save();
            return redirect()->route('login');
        } else {
            return redirect()->route('forgot-password');
        }
    }
    

public function sendEmailContact(Request $request)
{
    $data = $request->validate([
        'name' => 'required',
        'email' => 'required|email',
        'phone' => 'nullable',
        'subject' => 'required',
        'message' => 'required',
    ]);

    Mail::to('seu@email.com')->send(new ContactFormMail(
       //$name, $email, $phone, $subject, $message

       $data['name'],
       $data['email'],
       $data['phone'],
       $data['subject'],
     $data['message']
    )

);
return redirect()->back()->with('success', 'E-mail enviado com sucesso!');

}


}
