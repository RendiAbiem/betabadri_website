/**
 * ============================================================================
 * PUBLIC MAIN SCRIPT (BERANDA & HALAMAN UMUM)
 * ============================================================================
 * File ini mengatur interaksi slider (Swiper), video player custom,
 * modal dinamis (galeri & testimoni), serta filter kategori.
 */

document.addEventListener("DOMContentLoaded", function () {

    // =========================================
    // 1. HERO SWIPER (SLIDER UTAMA ATAS)
    // =========================================
    if (document.querySelector(".heroSwiper")) {
        new Swiper(".heroSwiper", {
            effect: "coverflow",
            grabCursor: true,
            centeredSlides: true,
            slidesPerView: "auto",
            spaceBetween: 30,
            loop: true,
            coverflowEffect: {
                rotate: 0,
                stretch: 0,
                depth: 100,
                modifier: 1,
                slideShadows: false,
            },
            autoplay: {
                delay: 4000,
                disableOnInteraction: false,
            },
            pagination: { el: ".swiper-pagination", clickable: true },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });
    }

    // =========================================
    // 2. TESTIMONIAL SWIPER (SLIDER ULASAN)
    // =========================================
    if (document.querySelector(".testimonialSwiper")) {
        new Swiper(".testimonialSwiper", {
            slidesPerView: 1,
            spaceBetween: 25,
            loop: true,
            speed: 1000,
            autoplay: {
                delay: 10000,
                disableOnInteraction: false,
                pauseOnMouseEnter: true,
            },
            navigation: {
                nextEl: ".testi-next",
                prevEl: ".testi-prev",
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
                dynamicBullets: true,
            },
            breakpoints: {
                768: { slidesPerView: 2, spaceBetween: 30, centeredSlides: false },
                1024: { slidesPerView: 3, spaceBetween: 40, centeredSlides: false },
            },
        });
    }

    // =========================================
    // 3. VIDEO SWIPER (SLIDER DOKUMENTASI)
    // =========================================
    if (document.querySelector(".videoSwiper")) {
        new Swiper(".videoSwiper", {
            slidesPerView: 1.2,
            spaceBetween: 20,
            centeredSlides: true,
            loop: true,
            grabCursor: true,
            navigation: {
                nextEl: ".video-next",
                prevEl: ".video-prev",
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
                dynamicBullets: true,
            },
            breakpoints: {
                768: { slidesPerView: 2, spaceBetween: 30, centeredSlides: false },
                1024: { slidesPerView: 2.5, spaceBetween: 40, centeredSlides: false },
            },
        });
    }

    // =========================================
    // 4. PARTNER SWIPER (SLIDER LOGO SEKOLAH)
    // =========================================
    if (document.querySelector(".partnerSwiper")) {
        // Disimpan dalam window agar bisa dipanggil oleh tombol "Lihat Semua"
        window.partnerSwiperInstance = new Swiper(".partnerSwiper", {
            slidesPerView: 2,
            spaceBetween: 20,
            loop: true,
            speed: 1200,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
            navigation: {
                nextEl: ".partner-next",
                prevEl: ".partner-prev",
            },
            breakpoints: {
                768: { slidesPerView: 3, spaceBetween: 30 },
                1024: { slidesPerView: 4, spaceBetween: 30 },
                1400: { slidesPerView: 5, spaceBetween: 25 },
            },
        });
    }

    // =========================================
    // 5. CUSTOM VIDEO PLAYER LOGIC
    // =========================================
    // Mengatur play/pause video saat card diklik, serta mengembalikan
    // opacity/filter CSS saat video aktif menggunakan class 'is-playing'.
    const videoCards = document.querySelectorAll(".video-card");

    videoCards.forEach((card) => {
        const video = card.querySelector(".v-player");
        const playBtn = card.querySelector(".play-btn");
        const overlay = card.querySelector(".video-overlay");

        if (video && playBtn && overlay) {

            const togglePlay = (e) => {
                e.preventDefault();

                if (video.paused) {
                    // PAUSE SEMUA VIDEO LAIN TERLEBIH DAHULU
                    document.querySelectorAll(".v-player").forEach((v) => {
                        v.pause();
                        v.classList.remove("is-playing"); // Hapus filter terang
                    });
                    document.querySelectorAll(".video-overlay").forEach((o) => (o.style.opacity = "1"));
                    document.querySelectorAll(".play-btn").forEach((b) => (b.innerHTML = '<i class="fas fa-play"></i>'));

                    // PLAY VIDEO YANG DIPILIH
                    video.play();
                    video.classList.add("is-playing"); // Tambah class CSS agar warna terang
                    overlay.style.opacity = "0";       // Sembunyikan judul/overlay hitam
                    playBtn.innerHTML = '<i class="fas fa-pause"></i>';
                } else {
                    // JIKA VIDEO SEDANG MAIN LALU DI-KLIK (PAUSE)
                    video.pause();
                    video.classList.remove("is-playing"); // Kembalikan ke redup (grayscale)
                    overlay.style.opacity = "1";
                    playBtn.innerHTML = '<i class="fas fa-play"></i>';
                }
            };

            // Event Trigger
            playBtn.addEventListener("click", togglePlay);
            card.addEventListener("click", function (e) {
                // Cegah double trigger jika yang diklik adalah tombol play
                if (e.target !== playBtn) togglePlay(e);
            });

            // Saat video selesai otomatis (berakhir), kembalikan tampilan ke awal
            video.addEventListener('ended', function() {
                video.classList.remove('is-playing');
                overlay.style.opacity = "1";
                playBtn.innerHTML = '<i class="fas fa-play"></i>';
            });
        }
    });

    // =========================================
    // 6. AUTO REVEAL TESTIMONIALS SAAT PAGINATION
    // =========================================
    // Jika halaman diload dengan query parameter '?page=', otomatis buka grid
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has("page")) {
        const allBtn = document.querySelector("button[onclick*='all']");
        if (allBtn) {
            filterTestimonials("all", allBtn);
        } else {
            const fallbackBtn = document.querySelector(".btn-filter-tech");
            if (fallbackBtn) filterTestimonials("all", fallbackBtn);
        }
    }

    // =========================================
    // 7. MODAL GALERI BOOTSTRAP (DINAMIS)
    // =========================================
    // Menukar src tag <img> di dalam modal sesuai dengan thumbnail yang diklik
    const imageGalleryModalEl = document.getElementById('imageGalleryModal');

    if (imageGalleryModalEl) {
        const modalImage = imageGalleryModalEl.querySelector('#modalDynamicImage');
        const modalTitle = imageGalleryModalEl.querySelector('#modalDynamicTitle');
        const spinner = imageGalleryModalEl.querySelector('#imageLoadingSpinner');

        // Event saat modal dipicu (mau terbuka)
        imageGalleryModalEl.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;

            // Ambil URL Gambar dan Judul dari atribut data-
            const imageUrl = button.getAttribute('data-image');
            const imageTitle = button.getAttribute('data-title');

            // Set Judul
            if(modalTitle) modalTitle.textContent = imageTitle;

            // Tampilkan gambar langsung (Paksa opacity jadi 1)
            if(modalImage) {
                modalImage.style.opacity = '1';
                modalImage.src = imageUrl;
            }

            // Sembunyikan spinner jika ada
            if(spinner) spinner.style.display = 'none';
        });

        // Event saat modal tertutup (Bersihkan cache image)
        imageGalleryModalEl.addEventListener('hidden.bs.modal', function () {
            if(modalImage) modalImage.src = '';
            if(modalTitle) modalTitle.textContent = '';
        });
    }
});


// ============================================================================
// GLOBAL FUNCTIONS (FUNGSI YANG DIPANGGIL VIA ONCLICK DI HTML)
// ============================================================================

/**
 * Toggle Sidebar Admin / User Dashboard Mobile
 */
function toggleSidebar() {
    const sidebar = document.getElementById("adminSidebar");
    const overlay = document.getElementById("sidebarOverlay");
    if (sidebar && overlay) {
        sidebar.classList.toggle("mobile-active");
        overlay.classList.toggle("active");

        // Kunci scrolling body saat menu mobile terbuka
        document.body.style.overflow = sidebar.classList.contains("mobile-active") ? "hidden" : "auto";
    }
}

/**
 * Filter Grid Testimonial Berdasarkan Kategori (Role)
 */
function filterTestimonials(category, btn) {
    const grid = document.getElementById("testimonials-grid");
    const placeholder = document.getElementById("filter-placeholder");
    const pagination = document.getElementById("pagination-wrapper");

    // 1. Munculkan Grid Jika Masih Tersembunyi
    if (grid && grid.classList.contains("d-none")) {
        grid.classList.remove("d-none");
        grid.classList.add("animate__animated", "animate__fadeInUp");

        if (placeholder) placeholder.style.setProperty("display", "none", "important");

        if (pagination) {
            pagination.classList.remove("d-none");
            pagination.classList.add("d-flex");
        }
    }

    // 2. Ganti Style Tombol Filter yang Aktif
    document.querySelectorAll(".btn-filter-tech").forEach((b) => b.classList.remove("active"));
    if (btn) btn.classList.add("active");

    // 3. Logika Filtering Card Testimonial
    const items = document.querySelectorAll(".testimonial-item");
    const target = category.toLowerCase();

    items.forEach((item) => {
        const rawRole = item.getAttribute("data-role");
        const role = rawRole ? rawRole.toLowerCase() : "";
        let isMatch = target === "all" || role.includes(target);

        // Alias Logic (Jika pilih 'Sekolah', tampilkan yang rolenya 'Guru' atau 'Mitra')
        if (!isMatch && target === "sekolah") {
            if (role.includes("guru") || role.includes("mitra")) isMatch = true;
        }

        // Tampilkan atau Sembunyikan item
        if (isMatch) {
            item.style.display = "block";
            item.classList.add("animate__animated", "animate__fadeIn");
        } else {
            item.style.display = "none";
            item.classList.remove("animate__animated", "animate__fadeIn");
        }
    });
}

/**
 * Membuka Modal Testimonial untuk Membaca Teks Panjang
 */
function openTestimonialModal(button) {
    // Ambil data dari tombol
    const name = button.getAttribute("data-name");
    const role = button.getAttribute("data-role");
    const pos = button.getAttribute("data-position");
    const text = button.getAttribute("data-text");

    // Suntikkan data ke dalam Modal
    document.getElementById("modalName").innerText = name;

    let roleDisplay = role;
    if (pos && pos !== "null" && pos !== "") {
        roleDisplay += " | " + pos;
    }

    document.getElementById("modalRole").innerText = roleDisplay;
    document.getElementById("modalText").innerText = `"${text}"`;

    // Panggil dan tampilkan modal bootstrap
    const modalEl = document.getElementById("testimonialModal");
    const myModal = new bootstrap.Modal(modalEl);
    myModal.show();
}

/**
 * Toggle Tampilan Partner (Antara Mode Slider dan Mode Grid 'Lihat Semua')
 */
function togglePartners(btn) {
    const sliderView = document.getElementById("partner-slider-view");
    const gridView = document.getElementById("partner-grid-view");
    const navBtns = document.getElementById("slider-nav-btns");
    const btnText = document.getElementById("btn-text");
    const icon = btn.querySelector("i");
    const sectionAnchor = document.getElementById("partners-section-anchor");

    if (gridView.classList.contains("d-none")) {
        // === MODE GRID AKTIF (Lihat Semua) ===
        sliderView.classList.add("d-none");
        gridView.classList.remove("d-none");
        if (navBtns) navBtns.classList.add("d-none");

        // Matikan autoplay slider agar hemat resource memory
        if (window.partnerSwiperInstance) window.partnerSwiperInstance.autoplay.stop();

        // Ganti UI Tombol
        btnText.innerText = "Tutup";
        icon.classList.remove("fa-th-large");
        icon.classList.add("fa-times");
        btn.classList.add("btn-light", "text-dark");
        btn.classList.remove("btn-outline-light");

        // Scroll otomatis ke atas section
        sectionAnchor.scrollIntoView({ behavior: "smooth", block: "start" });

    } else {
        // === MODE SLIDER AKTIF (Tutup Grid) ===
        gridView.classList.add("d-none");
        sliderView.classList.remove("d-none");
        if (navBtns) navBtns.classList.remove("d-none");

        // Ganti UI Tombol
        btnText.innerText = "Lihat Semua";
        icon.classList.remove("fa-times");
        icon.classList.add("fa-th-large");
        btn.classList.remove("btn-light", "text-dark");
        btn.classList.add("btn-outline-light");

        // Scroll otomatis ke atas section
        sectionAnchor.scrollIntoView({ behavior: "smooth", block: "start" });

        // Update dimensi Swiper dan nyalakan lagi autoplay
        if (window.partnerSwiperInstance) {
            window.partnerSwiperInstance.update();
            window.partnerSwiperInstance.autoplay.start();
            window.partnerSwiperInstance.navigation.update();
        }
    }
}
