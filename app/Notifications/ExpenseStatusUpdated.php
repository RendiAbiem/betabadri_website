<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Models\Expense;

class ExpenseStatusUpdated extends Notification
{
    use Queueable;

    public $expense;

    /**
     * Create a new notification instance.
     */
    public function __construct(Expense $expense)
    {
        // Menyimpan data expense ke dalam property
        $this->expense = $expense;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via(object $notifiable): array
    {
        // Gunakan database agar muncul di lonceng navbar
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray(object $notifiable): array
    {
        $status = $this->expense->status == 'approved' ? 'DISETUJUI' : 'DITOLAK';
        $color = $this->expense->status == 'approved' ? 'text-success' : 'text-danger';

        return [
            'expense_id' => $this->expense->id,
            'title' => 'Update Status Expense',
            'message' => 'Pengajuan dana Anda sebesar Rp ' . number_format($this->expense->amount, 0, ',', '.') . ' telah ' . $status,
            'url' => route('admin.expenses.index'), // Sesuaikan rute ke riwayat pengeluaran user
            'icon' => 'fas fa-wallet ' . $color
        ];
    }
}
