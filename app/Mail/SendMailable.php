<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\User;
use App\Models\Order;

class SendMailable extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
      protected $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        //
          $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      $email = $this->user;
      $user = User::where('email',$email)->first();
      // $user_id = $user->id;
      $order = Order::where("user_id",$user->id)->first();
      return $this->view('web/emails/diet',['order'=>$order]);
    }
}
