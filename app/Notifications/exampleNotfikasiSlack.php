<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Slack\BlockKit\Blocks\ContextBlock;
use Illuminate\Notifications\Slack\BlockKit\Blocks\SectionBlock;
use Illuminate\Notifications\Slack\BlockKit\Composites\ConfirmObject;
use Illuminate\Notifications\Slack\SlackMessage;


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

    public function toSlack(object $notifiable): SlackMessage
    {
        return (new SlackMessage)
            ->text('New request')
            ->headerBlock('New request')
            ->sectionBlock(function (SectionBlock $block) {
                $block->field("*Type:*\nPaid Time Off")->markdown();
                $block->field("*Created by:*\n<example.com|Fred Enriquez>")->markdown();
            })
            ->sectionBlock(function (SectionBlock $block) {
                $block->field("*When:*\nAug 10 - Aug 13")->markdown();
                $block->field("*Type:*\nPaid time off")->markdown();
            })
            ->sectionBlock(function (SectionBlock $block) {
                $block->field("*Hours:*\n16.0 (2 days)")->markdown();
                $block->field("*Remaining balance:*\n32.0 hours (4 days)")->markdown();
            })
            ->sectionBlock(function (SectionBlock $block) {
                $block->text("<https://google.com|View request>")->markdown();
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
