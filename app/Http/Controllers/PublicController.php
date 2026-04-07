<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Testimonial;
use App\Models\Partner;
use App\Models\Mentor;
use App\Models\Gallery;
use App\Models\Project;

class PublicController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::latest()->get();
        $partners = Partner::all(); // <--- Ambil semua partner

        // Kirim keduanya ke view
        return view('pages/beranda', compact('testimonials', 'partners'));
    }

    public function testimonials()
    {
        // Ambil data testimoni, 9 item per halaman
        $testimonials = Testimonial::latest()->paginate(9);

        return view('pages.testimonials', compact('testimonials'));
    }

    public function team()
    {
        $mentors = Mentor::all();
        // Ubah 'mentor' menjadi 'pages.mentor' agar sesuai dengan struktur folder view Anda
        return view('pages.mentor', compact('mentors'));
    }

    public function gallery(Request $request)
    {
        $query = Gallery::latest();

        // Jika parameter category ada DAN bukan 'all'
        if ($request->has('category') && $request->category != 'all') {
            $query->where('category', $request->category);
        }

        $galleries = $query->paginate(12); // atau 8, sesuaikan

        // 4. Kirim data ke view
        return view('pages.galeri', compact('galleries'));
    }

    public function modular()
    {
        // Ambil project yang kategorinya 'modular'
        $projects = Project::where('category', 'modular')->get();
        return view('pages.programs.modular', compact('projects'));
    }

    // Method untuk Halaman Electronika
    public function electronika()
    {
        $projects = Project::where('category', 'electronic')->get();
        return view('pages.programs.electronika', compact('projects'));
    }

    // Method untuk Halaman Programming
    public function programming()
    {
        $projects = Project::where('category', 'programming')->get();
        return view('pages.programs.programming', compact('projects'));
    }

    public function game()
    {
        $projects = Project::where('category', 'game')->get();
        return view('pages.programs.game', compact('projects'));
    }

    public function programs()
    {
        // Ini menghubungkan ke file: views/pages/programs.blade.php
        return view('pages.programs');
    }
}
