<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Support\Str;
use Illuminate\Notifications\Slack\BlockKit\Blocks\ContextBlock;
use Illuminate\Notifications\Slack\BlockKit\Blocks\SectionBlock;
use Illuminate\Notifications\Slack\BlockKit\Composites\ConfirmObject;


class exampleNotfikasiSlack extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['slack', 'mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail( $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }


    public function toSlack( $notifiable)
    {
        // This Simple Slack message
        // return (new SlackMessage)->content('seru sekali');
          ;
        // Use lebih banyak
        return (new SlackMessage)
        ->content('One of your invoices has been paid! - Invoice Paid')
        ->attachment(function ($attachment) {
            $attachment->title('Invoice Paid')
                ->fields([
                    'Invoice No' => '1000',
                    'Invoice Recipient' => 'taylor@laravel.com',
                    'Customer' => '#1234',
                ])
                ->content('An invoice has been paid. Congratulations!');
        });


    }
    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray( $notifiable): array
    {
        return [
            //
        ];
    }
}