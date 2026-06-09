const cursor = document.querySelector('.cursor-light');

document.addEventListener('mousemove', (event) => {
    if (!cursor) return;
    cursor.style.left = `${event.clientX}px`;
    cursor.style.top = `${event.clientY}px`;
});

const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
        if (entry.isIntersecting) {
            entry.target.classList.add('show');
        }
    });
}, { threshold: 0.14 });

document.querySelectorAll('.reveal, .stagger').forEach((element) => observer.observe(element));

window.addEventListener('scroll', () => {
    document.querySelectorAll('.parallax').forEach((element) => {
        const speed = Number(element.dataset.speed || 0.08);
        element.style.transform = `translateY(${window.scrollY * speed}px)`;
    });
});

const navBtn = document.querySelector('[data-menu-btn]');
const menu = document.querySelector('.mobile-menu');

navBtn?.addEventListener('click', () => {
    menu?.classList.toggle('open');
});

const video = document.querySelector('#heroVideo');
const soundBtn = document.querySelector('[data-sound]');

soundBtn?.addEventListener('click', () => {
    if (!video) return;

    video.muted = !video.muted;
    soundBtn.textContent = video.muted ? 'Enable Sound' : 'Sound On';
    video.play().catch(() => { });
});

document.querySelectorAll('[data-package]').forEach((card) => {
    card.addEventListener('click', () => {
        document.querySelectorAll('[data-package]').forEach((item) => item.classList.remove('active'));
        card.classList.add('active');

        const input = document.querySelector('#selectedPackage');
        const requestType = document.querySelector('select[name="request_type"]');

        if (input) input.value = card.dataset.package || '';
        if (requestType && card.dataset.package) requestType.value = card.dataset.package;
    });
});

document.querySelectorAll('.accordion').forEach((accordion) => {
    const button = accordion.querySelector('button');

    button?.addEventListener('click', () => {
        accordion.classList.toggle('open');
    });
});

const booking = document.querySelector('#bookingForm');

booking?.addEventListener('submit', (event) => {
    event.preventDefault();

    const note = document.querySelector('#bookingSuccess');

    if (note) {
        note.classList.remove('hidden');
        note.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }
});
