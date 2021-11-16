<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class tangvoucher extends Mailable
{
    use Queueable, SerializesModels;
    public $details;
    public $name;
    public $username;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details,$name,$username)
    {
        $this->details=$details;
        $this->name=$name;
        $this->username=$username;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->Subject('Bạn được tặng 1 voucher giảm giá !')->view('admin.emailtangvoucher');
    }
}
