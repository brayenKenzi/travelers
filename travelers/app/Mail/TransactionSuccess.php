<?php
///------- php artisan make:mail Transaction-success --- untuk membuat mailabel //
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TransactionSuccess extends Mailable
{
    use Queueable, SerializesModels;

    public $data;





    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->from('hi@albilalreload.id') //sumber utama email yang akan dikirimkan
            ->subject('Tiket Travel Anda')
            ->view('email.transaction-success'); //Untuk memanggil View transaction-success yang dibuat di view
    }
}
