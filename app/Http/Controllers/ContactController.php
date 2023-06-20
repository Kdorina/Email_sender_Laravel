<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\MailNotify;
use App\Mail\ContactMessage;
use App\Mail\ReservationConfirmation;
use Validator;
use App\Models\Contact;
use App\Http\Resources\ReservationResource;
use App\Models\Reservation;
class ContactController extends BaseController
{
    // public function send(Request $request){

    //     $validator = $request->validate([
    //         'name' => 'required',
    //         'email' => 'required|email',
    //         'phone_number'=>'required',
    //         'res_date' => 'required',
    //         'messages' => 'required'
    //      ]);

    //      $contactData = [
    //         'name' => $validator['name'],
    //         'email' => $validator['email'],
    //         'phone_number' => $validator['phone_number'],
    //         'res_date' => $validator['res_date'],
    //         'messages' => $validator['messages'],
    //     ];

    //     $userEmail = $validator['email'];
    //     $myEmail = 'laravel.megyeri@gmail.com';

    //     Mail::to($userEmail)->send(new ContactMessage($validator));
    //     Mail::to($myEmail)->send(new ContactMessage($validator));

    //     return response()->json(['success' => 'Az e-mailt elküldtük.']);
   // }



    public function create(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            "name" => "required",
            "email" => "required",
            "phone_number" => "required",
            "res_date" => "required",
            "messages" => "required",
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors());
        }

        $reservation = Reservation::create($input);

        Mail::to($reservation->email)->send(new ContactMessage($reservation));
        Mail::to('laravel.megyeri@gmail.com')->send(new ContactMessage($reservation));

        return $this->sendResponse(new ReservationResource($reservation), "Sikeres foglalás");
    }



    }

