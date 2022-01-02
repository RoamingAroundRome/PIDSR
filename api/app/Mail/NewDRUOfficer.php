<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewDRUOfficer extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    protected $officer;
    protected $generatedPassword;
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($officer, $generatedPassword)
    {
        $this->officer = $officer;
        $this->generatedPassword = $generatedPassword;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.officer_generated_password')
            ->from('noreply.pidsr@gmail.com')
            ->with([
                'officer' => $this->officer,
                'generatedPassword' => $this->generatedPassword
            ]);
    }
}
