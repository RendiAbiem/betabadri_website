<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Models\Leave;

class NewLeaveRequest extends Notification
{
    use Queueable;

    public $leave;

    /**
     * Create a new notification instance.
     */
    public function __construct(Leave $leave)
    {
        // PERBAIKAN: Isi variabel agar data bisa dibaca oleh method toArray()
        $this->leave = $leave;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray($notifiable)
    {
        return [
            'leave_id' => $this->leave->id,
            'title' => 'Pengajuan Cuti Baru',
            'message' => 'Staff ' . $this->leave->user->name . ' mengajukan cuti.',
            'url' => route('admin.leaves.show', $this->leave->id), // Diarahkan langsung ke detail
            'icon' => 'fas fa-calendar-plus text-primary'
        ];
    }
}
