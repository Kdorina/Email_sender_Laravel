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
    public function index()
    {
        $reservations = Reservation::all();
        return $reservations;
    }

    public function create(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            "first_name" => "required",
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


    public function update(Request $request,  string $id)
    {
        $input = $request->all();
        $validator = Validator::make( $input , [
            "first_name" => "required",
            "email" => "required",
            "phone_number" =>"required",
            "res_date" => "required",
            // "options"=>"required",
            "messages"=>"required",
        ]);
        if ($validator->fails() ){
         return $this->sendError( $validator->errors() );
      }
      $cat = Reservation::find($id);
      $cat->update($request->all());
      return $this->sendResponse( [], "Frissítve");


}



    public function destroy(string $id)
{
    Reservation::destroy($id);
    return $this->sendResponse( [], "Törölve");
}





    }

