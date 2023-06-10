<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\MailNotify;

class ContactController extends Controller
{
    public function sendEmail(Request $request){
       /*  $request->validate([
            'name'=>'required',
            'email'=>'required',
            'subject'=>'required',
            'message'=>'required',
        ]); */

        $details = [
            "title" => "Test Email",
            "body" => "My first email"
        ];

        Mail::to( "backendDor@gmail.com" )->send( new MailNotify( $details ));

        echo "<h3>Sikeres küldés</h3>";

    }
}
