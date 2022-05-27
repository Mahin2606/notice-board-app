<?php

namespace App\Mail;

use App\Models\Story;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ApproveStoryEmail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    private $story;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Story $story)
    {
        $this->story = $story;
    }

    private function getContent()
    {
        $content['story'] = $this->story;
        return $content;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
        ->view('email.approve-story-email', $this->getContent());
    }
}
