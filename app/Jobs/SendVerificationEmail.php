<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Http\Controllers\Mail\Mailer;
//use Illuminate\Mail\Mailer;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class SendVerificationEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

   // protected $user;
    /**
     * Create a new job instance.
     *
     * @return void
     */
   public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle($user)
    {
        $email_data = array(
          //   'recipient' => $user->user_email,
             'recipient' => $user->email,
             'subject' => 'Theinnovestors, Verify Your Email'
              );
                $act_code = str_random(60);
                $view_data = array(
                'actkey' => $act_code,
                'name' => $user->fullname,
                'token' => $user->verification_token,
                'username' => $user->username,
            );

              Mail::send('emails.verification-user', $view_data, function($message) use ($email_data) {
                  $message->to( $email_data['recipient'] )
                          ->subject( $email_data['subject'] );
              }); 
    }
}
