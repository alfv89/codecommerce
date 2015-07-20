<?php

namespace CodeCommerce\Listeners;

use CodeCommerce\Events\CheckoutEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class SendEmailCheckout
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  CheckoutEvent  $event
     * @return void
     */
    public function handle(CheckoutEvent $event)
    {
        $data = [
            'name' => Auth::user()->name,
            'email' => Auth::user()->email
        ];

        Mail::send('emails.test', $data, function ($message) {
            $message->from('noreply@codecommerce.com', 'CodeCommerce');
            // $message->sender($address, $name = null);
            $message->to(Auth::user()->email, Auth::user()->name);
            // $message->cc($address, $name = null);
            // $message->bcc($address, $name = null);
            $message->replyTo('vasconcelos.arthur@gmail.com', 'Arthur Vasconcelos');
            $message->subject("E-mail de teste - CodeCommerce");
            // $message->priority($level);
            // $message->attach($pathToFile, array $options = []);

            // Attach a file from a raw $data string...
            // $message->attachData($data, $name, array $options = []);

            // Get the underlying SwiftMailer message instance...
            // $message->getSwiftMessage();
        });
    }
}
