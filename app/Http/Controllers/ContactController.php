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

        $userEmail = $validator['email'];
        $myEmail = 'laravel.megyeri@gmail.com';

        Mail::to($userEmail)->send(new ContactMessage($validator));
        Mail::to($myEmail)->send(new ContactMessage($validator));

        return response()->json(['success' => 'Az e-mailt elküldtük.']);
    }

    }

