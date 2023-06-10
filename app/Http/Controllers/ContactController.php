<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\MailNotify;
use App\Mail\ContactMessage;
use Validator;
use App\Models\Contact;
class ContactController extends Controller
{
    public function send(Request $request){

        $validator = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject'=>'required',
            'message' => 'required'
         ]);

        $contactData = [
            'name' => $validator['name'],
            'email' => $validator['email'],
            'subject' => $validator['subject'],
            'message' => $validator['message'],
        ];

        Mail::to('backenddor@gmail.com')->send(new ContactMessage($validator));
        return response()->json(['success' => 'The email has been sent.']);

      /*   \Mail::send('emails.index', array(
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'subject' => $request->get('subject'),
            'bmessage' => $request->get('message'),
        ), function($message) use ($request){
            $message->from($request->email);
            $message->to('backenddor@gmail.com', 'Admin')->subject($request->get('subject'));
        });
        return response()->json(['success' => 'The email has been sent.']); */

/*
        $details = array(
            'name'=>$request->name,
            'subject'=>$request->subject,
            'message'=>$request->message,
        );
 */
       /*  return back()->with('success', 'Thanks for contacting us!'); */
       /*  $details = [
            "title" => "Test Email",
            "body" => "My first email"
        ];

        Mail::to( "backendDor@gmail.com" )->send( new MailNotify( $details ));

        echo "<h3>Sikeres küldés</h3>"; */

    }
}
