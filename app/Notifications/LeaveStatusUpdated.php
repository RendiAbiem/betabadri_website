<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Models\Leave;

class LeaveStatusUpdated extends Notification
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
    public function via(object $notifiable): array
    {
        // PERBAIKAN: Gunakan 'database' agar notifikasi tersimpan di tabel notifications
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray($notifiable) {
        $status = $this->leave->status == 'approved' ? 'DISETUJUI' : 'DITOLAK';
        $color = $this->leave->status == 'approved' ? 'text-success' : 'text-danger';

        return [
            'leave_id' => $this->leave->id,
            'title' => 'Update Status Cuti',
            'message' => 'Pengajuan cuti Anda telah ' . $status,
            'url' => route('admin.leaves.show', $this->leave->id),
            'icon' => 'fas fa-info-circle ' . $color
        ];
    }
}
