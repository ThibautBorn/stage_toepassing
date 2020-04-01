<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactCompany extends Mailable
{
    use Queueable, SerializesModels;
    public $company;
    public $internships;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($company,$internships)
    {
        //
        $this->company = $company;
        $this->internships = $internships;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.contact-company')->subject('Registratie stages ' .  $this ->company->name);
    }
}
