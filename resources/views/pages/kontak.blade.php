@extends('layouts.app')

@section('title', 'Beta Badri Education')

@section('content')

<section class="program-hero position-relative d-flex align-items-center justify-content-center text-center"
         style="background-image: url('{{ asset('img/contact.jpg') }}');">

    <div class="program-bg-overlay"></div>

    <div class="container position-relative z-2">
        <span class="badge bg-cyan-soft text-cyan px-3 py-2 rounded-pill mb-3 fw-bold border border-info" data-aos="fade-down">24/7 Support</span>
        <h1 class="display-3 fw-bold text-white mb-3" data-aos="fade-up">Hubungi <span class="text-gradient-blue">Kami</span></h1>
        <p class="lead text-white-50 mx-auto" style="max-width: 700px;" data-aos="fade-up" data-aos-delay="100">
            Punya pertanyaan tentang kurikulum, biaya, atau jadwal kelas? Tim kami siap membantu Anda via WhatsApp atau Email.
        </p>
    </div>
</section>

<section class="py-5 bg-navy-dark position-relative overflow-hidden">
    <div class="glow-bg-right position-absolute top-0 end-0"></div>

    <div class="container py-5 position-relative z-2">
        <div class="row g-5">

            <div class="col-lg-5" data-aos="fade-right">
                <h3 class="text-white fw-bold mb-4">Informasi Kontak</h3>
                <p class="text-white-50 mb-5">
                    Jangan ragu untuk berkunjung ke center kami atau menghubungi kami melalui saluran digital berikut.
                </p>

                <div class="contact-box d-flex align-items-start gap-3 mb-4">
                    <div class="contact-icon bg-blue-soft">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div>
                        <h5 class="text-white fw-bold mb-1">Lokasi Center</h5>
                        <p class="text-white-50 small mb-0">
                            Jl. Dirgantara Timur, Sidumulyo Tim.,<br>
                            Kec. Marpoyan Damai, Kota Pekanbaru, Riau 28289
                        </p>
                    </div>
                </div>

                <div class="contact-box d-flex align-items-start gap-3 mb-4">
                    <div class="contact-icon bg-success-soft" style="background: rgba(16, 185, 129, 0.15); border-color: rgba(16, 185, 129, 0.3);">
                        <i class="fas fa-phone-alt text-success" style="color: #10b981 !important;"></i>
                    </div>
                    <div>
                        <h5 class="text-white fw-bold mb-1">WhatsApp / Telepon</h5>
                        <p class="text-white-50 small mb-0">+62 813-7618-0003</p>
                        <a href="https://wa.me/6281376180003" class="text-cyan small text-decoration-none">Chat Sekarang →</a>
                    </div>
                </div>

                <div class="contact-box d-flex align-items-start gap-3 mb-4">
                    <div class="contact-icon bg-purple-soft">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div>
                        <h5 class="text-white fw-bold mb-1">Email Resmi</h5>
                        <p class="text-white-50 small mb-0">Ymnm000@hotmail.com</p>
                    </div>
                </div>

                <div class="mt-5">
                    <h6 class="text-uppercase text-white-50 fw-bold small mb-3">Ikuti Kami</h6>
                    <div class="d-flex gap-3">
                        <a href="https://www.facebook.com/profile.php?id=61576559004159#" class="social-btn" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://www.tiktok.com/@betabadrieducation?lang=id-ID" class="social-btn" aria-label="Tiktok"><i class="fab fa-tiktok"></i></a>
                        <a href="https://www.linkedin.com/in/pt-beta-badri-education-72537a366/" class="social-btn" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                        <a href="https://www.instagram.com/betabadri_education/" class="social-btn" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>

            </div>

            <div class="col-lg-7" data-aos="fade-left">
                <div class="contact-form-wrapper p-4 p-lg-5">
                    <h3 class="text-white fw-bold mb-4">Kirim Pesan</h3>

                    <form action="{{ route('contact.send') }}" method="POST">
                        @csrf

                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first-name" class="text-white-50 small mb-2">First Name</label>
                                    <input type="text" id="first-name" name="first_name"
                                           class="form-control form-control-dark @error('first_name') is-invalid @enderror"
                                           value="{{ old('first_name') }}" required placeholder="Nama Depan">
                                    @error('first_name')
                                        <div class="invalid-feedback text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="last-name" class="text-white-50 small mb-2">Last Name</label>
                                    <input type="text" id="last-name" name="last_name"
                                           class="form-control form-control-dark"
                                           value="{{ old('last_name') }}" placeholder="Nama Belakang">
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="contact-email" class="text-white-50 small mb-2">Email Address *</label>
                                    <input type="email" id="contact-email" name="email"
                                           class="form-control form-control-dark @error('email') is-invalid @enderror"
                                           value="{{ old('email') }}" required placeholder="email@anda.com">
                                    @error('email')
                                        <div class="invalid-feedback text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="message" class="text-white-50 small mb-2">Message</label>
                                    <textarea id="message" name="message" rows="5"
                                              class="form-control form-control-dark @error('message') is-invalid @enderror"
                                              required placeholder="Tulis pesan Anda disini...">{{ old('message') }}</textarea>
                                    @error('message')
                                        <div class="invalid-feedback text-danger small">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 mt-4">
                                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                                    <span class="text-white-50 small fst-italic">We'll reply via WhatsApp!</span>
                                    <button type="submit" class="btn btn-cta-green px-4 py-3 fw-bold">
                                        Send to WhatsApp <i class="fab fa-whatsapp ms-2"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</section>

<section class="map-section">
    <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d997.419883208121!2d101.42201766952896!3d0.47790054102834295!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d5a8d7f8f5a561%3A0xe511e78f58192c12!2sJl.%20Dirgantara%20No.35%2C%20Sidomulyo%20Tim.%2C%20Kec.%20Marpoyan%20Damai%2C%20Kota%20Pekanbaru%2C%20Riau%2028289!5e0!3m2!1sid!2sid!4v1771559541162!5m2!1sid!2sid"
        width="100%"
        height="450"
        style="border:0;"
        allowfullscreen=""
        loading="lazy"
        referrerpolicy="no-referrer-when-downgrade">
    </iframe>
</section>

@endsection
