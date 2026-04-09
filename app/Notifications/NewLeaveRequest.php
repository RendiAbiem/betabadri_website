<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Leave;

class NewLeaveRequest extends Notification
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
    public function via($notifiable) {
        return ['database'];
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
        return [
            'leave_id' => $this->leave->id, // Tambahkan baris ini
            'title' => 'Pengajuan Cuti Baru',
            'message' => 'Staff ' . $this->leave->user->name . ' mengajukan cuti.',
            'url' => route('admin.leaves.index'), // Link ke halaman approval
            'icon' => 'fas fa-calendar-plus text-primary'
        ];
    }
}
