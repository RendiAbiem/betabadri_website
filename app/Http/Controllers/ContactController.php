<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name'  => 'nullable|string|max:50',
            'email'      => 'required|email',
            'message'    => 'required|string|max:500',
        ]);

        // 2. Nomor WhatsApp Admin (Ganti dengan nomor Anda)
        // Format: Kode Negara (62) + Nomor (tanpa 0 di depan)
        // Contoh: 6281376180003 (sesuai data di blade Anda)
        $adminPhone = '6281376180003';

        // 3. Format Pesan WhatsApp
        $name = $request->first_name . ' ' . $request->last_name;
        $email = $request->email;
        $userMessage = $request->message;

        // Menggunakan %0A untuk baris baru (enter) di URL
        $text = "Halo Admin Beta Badri Education, saya ingin bertanya:%0A%0A"
              . "*Nama:* $name%0A"
              . "*Email:* $email%0A"
              . "*Pesan:*%0A$userMessage";

        // 4. Redirect ke WhatsApp
        $whatsappUrl = "https://wa.me/$adminPhone?text=$text";

        return redirect()->away($whatsappUrl);
    }
}
