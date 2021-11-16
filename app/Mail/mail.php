<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class mail extends Mailable
{
    use Queueable, SerializesModels;
    public $details;
    public $order;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details,$order)
    {
        $this->details=$details;
        $this->order=$order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->Subject('Đặt hàng thành công !')->view('Userpage.email');
    }
}
