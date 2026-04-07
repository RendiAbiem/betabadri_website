/* ===================================================================
 * FILE SCRIPT.JS GABUNGAN (REVISED)
 * ===================================================================*/

(function ($) {
    "use strict";

    // 1. Preloader
    $(window).on("load", function () {
        if ($("#preloader").length) {
            $("#preloader")
                .delay(100)
                .fadeOut("slow", function () {
                    $(this).remove();
                });
        }
    });

    // 2. Smooth Scroll & Header Scrolled state
    var headerHeight = $("#header").outerHeight() || 80;

    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $("#header").addClass("header-scrolled");
            $(".back-to-top").fadeIn("slow");
        } else {
            $("#header").removeClass("header-scrolled");
            $(".back-to-top").fadeOut("slow");
        }
    });

    // 3. Mobile Navigation Logic
    if ($(".nav-menu").length) {
        var $mobile_nav = $(".nav-menu").clone().prop({
            class: "mobile-nav d-lg-none",
        });
        $("body").append($mobile_nav);
        $("body").prepend(
            '<button type="button" class="mobile-nav-toggle d-lg-none"><i class="fas fa-bars"></i></button>'
        );
        $("body").append('<div class="mobile-nav-overly"></div>');

        $(document).on("click", ".mobile-nav-toggle", function () {
            $("body").toggleClass("mobile-nav-active");
            $(".mobile-nav-toggle i").toggleClass("fa-bars fa-times");
            $(".mobile-nav-overly").toggle();
        });

        $(document).on("click", ".mobile-nav-overly", function () {
            $("body").removeClass("mobile-nav-active");
            $(".mobile-nav-toggle i").toggleClass("fa-bars fa-times");
            $(this).fadeOut();
        });
    }

    // 4. Owl Carousels & Isotope (Portfolio)
    $(window).on("load", function () {
        // Portfolio Isotope
        var portfolioIsotope = $(".portfolio-container").isotope({
            itemSelector: ".portfolio-item",
        });

        $("#portfolio-flters li").on("click", function () {
            $("#portfolio-flters li").removeClass("filter-active");
            $(this).addClass("filter-active");
            portfolioIsotope.isotope({
                filter: $(this).data("filter"),
            });
        });

        // Initialize AOS
        if (typeof AOS !== "undefined") {
            AOS.init({
                duration: 1000,
                once: true,
            });
        }
    });
})(jQuery);

/* ---------------------------------
 * BAGIAN 2: KODE KUSTOM (Vanilla JS)
 * --------------------------------- */

document.addEventListener("DOMContentLoaded", () => {
    initStatsCounter();
    initPartnerScroller();
    initAllParallax();
    initFadeInAnimations();
    initActiveNav();
    initSplideCarousel();
});

// FUNGSI 1: STATS COUNTER
function initStatsCounter() {
    const counters = document.querySelectorAll(".stat-number");
    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    const counter = entry.target;
                    const target = +counter.dataset.target;
                    animateCounter(counter, target);
                    observer.unobserve(counter);
                }
            });
        },
        { threshold: 0.5 }
    );

    counters.forEach((c) => observer.observe(c));
}

function animateCounter(element, target) {
    let current = 0;
    const increment = target / 120; // Jalankan dalam ~2 detik (60fps)
    const timer = setInterval(() => {
        current += increment;
        if (current >= target) {
            element.innerText = target.toLocaleString();
            clearInterval(timer);
        } else {
            element.innerText = Math.floor(current).toLocaleString();
        }
    }, 16);
}

// FUNGSI 2: PARTNER SCROLLER (Infinite Loop)
function initPartnerScroller() {
    const scrollers = document.querySelectorAll(".logo-scroller");
    scrollers.forEach((scroller) => {
        if (scroller.getAttribute("data-animated")) return;
        scroller.setAttribute("data-animated", "true");
        const inner = scroller.querySelector(".logo-scroller-inner");
        if (!inner) return;
        const content = Array.from(inner.children);
        content.forEach((item) => {
            const duplicatedItem = item.cloneNode(true);
            duplicatedItem.setAttribute("aria-hidden", true);
            inner.appendChild(duplicatedItem);
        });
    });
}

// FUNGSI 3: PARALLAX EFECTS (Optimized)
function initAllParallax() {
    const parallaxItems = [
        { sel: ".services-section", var: "--bg-scroll-y" },
        { sel: ".vision-section", var: "--vision-scroll-y" },
        { sel: ".contact-section", var: "--contact-scroll-y" },
        // Tambahkan selector lain jika perlu
    ];

    window.addEventListener("scroll", () => {
        const scrolled = window.pageYOffset;
        parallaxItems.forEach((item) => {
            const el = document.querySelector(item.sel);
            if (el) {
                const limit = el.offsetTop + el.offsetHeight;
                if (
                    scrolled > el.offsetTop - window.innerHeight &&
                    scrolled < limit
                ) {
                    el.style.setProperty(
                        item.var,
                        (scrolled - el.offsetTop) * 0.15 + "px"
                    );
                }
            }
        });
    });
}

// FUNGSI 4: FADE-IN ANIMATIONS (Intersection Observer)
function initFadeInAnimations() {
    const elements = document.querySelectorAll(
        ".feature-card, .stat-item, .vision-item, .team-card, .service-card, .career-card"
    );
    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add("is-visible");
                    entry.target.style.opacity = "1";
                    entry.target.style.transform = "translateY(0)";
                }
            });
        },
        { threshold: 0.1 }
    );

    elements.forEach((el) => {
        el.style.opacity = "0";
        el.style.transform = "translateY(30px)";
        el.style.transition = "all 0.8s ease-out";
        observer.observe(el);
    });
}

// FUNGSI 5: SPLIDE CAROUSEL
function initSplideCarousel() {
    if (document.getElementById("testimonial-carousel")) {
        new Splide("#testimonial-carousel", {
            type: "loop",
            perPage: 3,
            perMove: 1,
            gap: "1.5rem",
            arrows: false,
            breakpoints: {
                992: { perPage: 2 },
                640: { perPage: 1 },
            },
        }).mount();
    }
}

// FUNGSI 6: MODAL LOGIC (Testimonial & Partners)
function openTestimonialModal(button) {
    document.getElementById("modal-text").textContent =
        button.getAttribute("data-text");
    document.getElementById("modal-name").textContent =
        button.getAttribute("data-name");
    document.getElementById("modal-role").textContent =
        button.getAttribute("data-role");

    const modal = document.getElementById("testimonial-modal");
    modal.classList.add("open");
    document.body.style.overflow = "hidden";
}

function closeTestimonialModal(event) {
    if (
        event.target.classList.contains("testi-modal-overlay") ||
        event.target.classList.contains("testi-modal-close")
    ) {
        document.getElementById("testimonial-modal").classList.remove("open");
        document.body.style.overflow = "auto";
    }
}

// SIDEBAR ADMIN TOGGLE
function toggleSidebar() {
    const sidebar = document.getElementById("adminSidebar");
    const overlay = document.getElementById("sidebarOverlay");
    if (sidebar && overlay) {
        sidebar.classList.toggle("mobile-active");
        overlay.classList.toggle("active");
    }
}

// ESC KEY LISTENER
document.addEventListener("keydown", (e) => {
    if (e.key === "Escape") {
        document.querySelectorAll(".open").forEach((modal) => {
            modal.classList.remove("open");
            document.body.style.overflow = "auto";
        });
    }
});
