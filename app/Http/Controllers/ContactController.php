<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\MailNotify;
use Validator;
class ContactController extends Controller
{

    public function index(){

    }

    public function send(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'subject'=>'required',
            'message'=>'required',
        ]);

        $details = array(
            'name'=>$request->name,
            'subject'=>$request->subject,
            'message'=>$request->message,
        );


        Mail::to('backenddor@gmail.com')->send(new MailNotify());
        return response()->json(["message" => "Email sent successfully."]);
        echo "HTML Email Sent. Check your inbox.";

       /*  return back()->with('success', 'Thanks for contacting us!'); */
       /*  $details = [
            "title" => "Test Email",
            "body" => "My first email"
        ];

        Mail::to( "backendDor@gmail.com" )->send( new MailNotify( $details ));

        echo "<h3>Sikeres küldés</h3>"; */

    }
}
