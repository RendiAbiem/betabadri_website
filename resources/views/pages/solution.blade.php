@extends('layouts.app')

@section('title', 'Beta Badri Education')

@section('content')

<section class="services-section">
    <div class="container">
        <div class="services-header">
            <h2>Memberdayakan Masa Depan Pendidikan dengan Teknologi Informasi</h2>
            <h3>Program Kami</h3>
        </div>

        <div class="services-list">

            <article class="service-card">
                <div class="service-icon icon-blue">
                    <div class="feature-icon">
                        <i class="fas fa-robot fa-2x text-white"></i>
                    </div>
                </div>
                <div class="service-content">
                    <h4>Robotic Modular</h4>
                    <p>
                    Program ini menerapkan metode STEM (Science, Technology, Engineering, Math) dengan kombinasi pelajaran teoritis dan praktikal.
                    </p>
                    <ul>
                        <li> Menggunakan robot Vex IQ & Sphero Bolt (Import US).</li>
                        <li> Memperkenalkan Block Coding sebagai dasar pemahaman.</li>
                        <li> Melanjutkan ke Python (Vex IQ) dan JavaScript (Sphero Bolt) untuk tantangan yang lebih kompleks.</li>
                    </ul>

                    <a href="{{ url('/page/programs/modular') }}" class="btn btn-cta">Project Yang Dilakukan</a>
                </div>

            </article>

            <article class="service-card">
                <div class="service-icon icon-red">
                    <div class="feature-icon">
                        <i class="fas fa-plug-circle-bolt fa-2x text-white"></i>
                    </div>
                </div>
                <div class="service-content">
                    <h4>Robotic Electronic</h4>
                    <p>
                        Robotic Electronic menerapkan sistem pembelajaran yang berfokus pada project yang harus diselesaikan. Pembelajaran ini menggabungkan konsep Elektronika dan Pemrograman.
                    </p>
                    <ul>
                        <li>Pembelajaran Elektronika mencakup komponen elektronik seperti Resistor, LED, Microcontroller, PCB, dan teknik penyolderan.</li>
                        <li>Pemrograman yang digunakan merupakan Bahasa Pemrograman Arduino dengan memakai basic Bahasa Pemrograman C dan C++.</li>
                        <li>Menggunakan Microcontroller Arduino, ESP32 dan ESP8266 sebagai otak dari project yang akan dibuat.</li>
                    </ul>

                    <a href="{{ url('/page/programs/electronika') }}" class="btn btn-cta">Project Yang Dilakukan</a>
                </div>
            </article>

            <article class="service-card">
                <div class="service-icon icon-blue">
                    <div class="feature-icon">
                        <i class="fas fa-globe fa-2x text-white"></i>
                    </div>
                </div>
                <div class="service-content">
                    <h4>Programming</h4>
                    <p>
                    Program ini bertujuan untuk memberikan pengetahuan kepada mentee mengenai pembuatan web dasar menggunakan HTML, CSS, dan JavaScript, dilanjutkan dengan pembuatan web lanjutan menggunakan framework Laravel dan database MYSQL, hingga pengembangan aplikasi mobile cross-platform dengan Flutter.
                    </p>
                    <ul>
                        <li>Belajar pondasi web dengan HTML, CSS, dan JavaScript.</li>
                        <li>Menguasai desain UI/UX web dan mobile menggunakan Figma.</li>
                        <li>Membangun web application dinamis dengan PHP dan Framework Laravel.</li>
                        <li>Mengembangkan aplikasi mobile untuk Android & iOS menggunakan Flutter.</li>
                    </ul>

                    <a href="{{ url('/page/programs/programming') }}" class="btn btn-cta">Project Yang Dilakukan</a>
                </div>
            </article>
        </div>
    </div>
</section>

<section class="benefits-section">
    <div class="container benefits-grid">

        <div class="benefits-image">
            <h2>We Integrate With Your Ecosystem</h2>
        </div>

        <div class="benefits-content">
            <p>
                I'm a paragraph. Click here to add your own text and edit
                me. It's easy. Just click “Edit Text” or double click me to
                add your own content and make changes to the font. I'm
                a great place for you to tell a story and let your users
                know a little more about you.
            </p>
        </div>

    </div>
</section>

@endsection
