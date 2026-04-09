<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Models\Expense; // Pastikan model Expense di-import

class NewExpenseRequest extends Notification
{
    use Queueable;

    public $expense;

    /**
     * Create a new notification instance.
     */
    public function __construct(Expense $expense)
    {
        // Menyimpan data pengeluaran ke dalam property
        $this->expense = $expense;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via(object $notifiable): array
    {
        // Menggunakan database agar muncul di icon lonceng navbar
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray(object $notifiable): array
    {
        return [
            'expense_id' => $this->expense->id,
            'title' => 'Pengajuan Expense Baru',
            'message' => 'Ada pengajuan dana dari ' . ($this->expense->user->name ?? 'Staff') . ' sebesar Rp ' . number_format($this->expense->amount, 0, ',', '.'),
            'url' => route('admin.expenses.index'),
            'icon' => 'fas fa-file-invoice-dollar text-primary'
        ];
    }
}
