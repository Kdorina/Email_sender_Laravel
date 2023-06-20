<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Reservation;

class ContactMessage extends Mailable
{
    use Queueable, SerializesModels;

    public $reservation;

    /**
     * Create a new message instance.
     *
     * @param  Reservation  $reservation
     * @return void
     */
    public function __construct(Reservation $reservation)
    {
        $this->reservation = $reservation;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.contact.message')
            ->subject('New Contact Message')
            ->with([
                'name' => $this->reservation->name,
                'email' => $this->reservation->email,
                'phone_number' => $this->reservation->phone_number,
                'res_date' => $this->reservation->res_date,
                'messages' => $this->reservation->messages,
            ]);
    }
}
