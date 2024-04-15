<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SmartContact;

session_start();


class AdminController extends Controller
{

    public function home(Request $request)
    {
        if (!$request->session()->has('user')) {
            return redirect(route('login'));
        }


        return view('admin.home');
    }
    public function registerClient(Request $request)
    {
        if (!$request->session()->has('user')) {
            return redirect(route('login'));
        }

        return view('admin.registerClient');
    }
    public function registerSmartContract(Request $request)
    {
        if (!$request->session()->has('user')) {
            return redirect(route('login'));
        }
        $clients=Client::all();

        return view('admin.registerSmartContract',compact('clients'));
    }
    public function saveSentMessage(Request $request)
    {
        if (!$request->session()->has('user')) {
            return redirect(route('login'));
        }
     return view('admin.saveSentMessage');
    }
    public function saveReceivedMessage(Request $request)
    {
        if(!$request->session()->has('user')) {
            return redirect(route('login'));

}
    $smartCntact=SmartContact::all();
     return view('admin.saveReceivedMessage',compact('smartCntact'));
    }
    public function saveEventDetails(Request $request)
    {
        if(!$request->session()->has('user')) {
            return redirect(route('login'));


}
$bots=SmartContact::all();
 return view('admin.saveEventDetails',compact('bots'));
    }
    function registerSuccess(Request $request)
    {
        if(!$request->session()->has('user')) {
            return redirect(route('login'));

}
        return view('admin.registerSuccess');
    }
}
