<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Leave;


class LeaveStatusUpdated extends Notification
{
    use Queueable;

    public $leave;


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
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray($notifiable) {
        $status = $this->leave->status == 'approved' ? 'DISETUJUI' : 'DITOLAK';
        $color = $this->leave->status == 'approved' ? 'text-success' : 'text-danger';

        return [
            'title' => 'Update Status Cuti',
            'message' => 'Pengajuan cuti Anda telah ' . $status,
            'url' => route('admin.leaves.index'),
            'icon' => 'fas fa-info-circle ' . $color
        ];
    }
}
