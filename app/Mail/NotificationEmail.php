<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NotificationEmail extends Mailable
{
  use Queueable, SerializesModels;
  public $data;

  /**
   * Create a new message instance.
   */
  public function __construct($data)
  {
    //
    $this->data = $data;
  }

  /**
   * Get the message envelope.
   */
  public function envelope(): Envelope
  {
    return new Envelope(subject: 'Notification Email');
  }

  /**
   * Get the message content definition.
   */
  public function content(): Content
  {
    $page_email = 'mail.email_notif_reset_password';
    return new Content(
      view: 'mail.template_email',
      with: [
        'page_email' => $page_email,
        'data' => $this->data,
      ]
    );
  }

  /**
   * Get the attachments for the message.
   *
   * @return array<int, \Illuminate\Mail\Mailables\Attachment>
   */
  public function attachments(): array
  {
    return [];
  }
}
