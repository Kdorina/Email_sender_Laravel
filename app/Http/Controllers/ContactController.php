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
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'subject'=>'required',
            'message' => 'required'
         ]);

         if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }
        
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
