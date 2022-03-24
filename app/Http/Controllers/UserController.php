<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

use App\Mail\SendMail;

class UserController extends Controller
{
    //

    public function email_form(){
        return view('email');
    }

    public function send_email(Request $request){
        $validator = Validator::make($request->all(), [
            'receiver' => 'required|email',
            'name' => 'required|string',
            'subject' => 'required|string',
            'position' => 'required|string',
        ]);
 
        if ($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        Mail::to($request->receiver)->send(new SendMail([
            'name' => $request->name,
            'subject' => $request->subject,
            'position' => $request->position,
        ]));

        return redirect()
            ->back()
            ->with('success', 'Your message has been sent successfully to ' . $request->receiver);
    }
}
