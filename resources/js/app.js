import './bootstrap';

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

document.querySelectorAll('.reveal, .stagger').forEach((element) => {
    observer.observe(element);
});

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

/*
|--------------------------------------------------------------------------
| Home Page Hero Video Sound
|--------------------------------------------------------------------------
| The home page video starts muted for autoplay.
| User can click Enable Sound to hear it.
|--------------------------------------------------------------------------
*/

const homeHeroVideo = document.querySelector('#heroVideo');
const homeSoundBtn = document.querySelector('[data-sound]');

homeSoundBtn?.addEventListener('click', () => {
    if (!homeHeroVideo) return;

    homeHeroVideo.muted = !homeHeroVideo.muted;
    homeHeroVideo.volume = homeHeroVideo.muted ? 0 : 1;

    homeSoundBtn.textContent = homeHeroVideo.muted ? 'Enable Sound' : 'Sound On';

    homeHeroVideo.play().catch(() => { });
});

/*
|--------------------------------------------------------------------------
| Events Page Hero Video Sound
|--------------------------------------------------------------------------
| Do not force volume 0 here.
| Sound will work only after user clicks the button.
|--------------------------------------------------------------------------
*/

const eventsHeroVideo = document.querySelector('#eventsHeroVideo');
const eventsSoundBtn = document.querySelector('[data-events-sound]');

eventsSoundBtn?.addEventListener('click', () => {
    if (!eventsHeroVideo) return;

    eventsHeroVideo.muted = !eventsHeroVideo.muted;
    eventsHeroVideo.volume = eventsHeroVideo.muted ? 0 : 1;

    eventsSoundBtn.textContent = eventsHeroVideo.muted ? 'Enable Sound' : 'Sound On';

    eventsHeroVideo.play().catch(() => { });
});

/*
|--------------------------------------------------------------------------
| Reservation Package Selector
|--------------------------------------------------------------------------
*/

document.querySelectorAll('[data-package]').forEach((card) => {
    card.addEventListener('click', () => {
        document.querySelectorAll('[data-package]').forEach((item) => {
            item.classList.remove('active');
        });

        card.classList.add('active');

        const input = document.querySelector('#selectedPackage');
        const requestType = document.querySelector('select[name="request_type"]');

        if (input) {
            input.value = card.dataset.package || '';
        }

        if (requestType && card.dataset.package) {
            requestType.value = card.dataset.package;
        }
    });
});

/*
|--------------------------------------------------------------------------
| Accordion
|--------------------------------------------------------------------------
*/

document.querySelectorAll('.accordion').forEach((accordion) => {
    const button = accordion.querySelector('button');

    button?.addEventListener('click', () => {
        accordion.classList.toggle('open');
    });
});

/*
|--------------------------------------------------------------------------
| Booking Form Demo Success Message
|--------------------------------------------------------------------------
*/



/*
|--------------------------------------------------------------------------
| Home Hero Mobile Video Focus
|--------------------------------------------------------------------------
*/

if (homeHeroVideo) {
    const focusAfterSeconds = 20;
    let lastTime = 0;

    function resetVideoFocus() {
        homeHeroVideo.classList.remove('focus-girl');
    }

    function applyVideoFocus() {
        homeHeroVideo.classList.add('focus-girl');
    }

    homeHeroVideo.addEventListener('timeupdate', () => {
        const currentTime = homeHeroVideo.currentTime;

        if (currentTime < lastTime) {
            resetVideoFocus();
        }

        if (currentTime >= focusAfterSeconds) {
            applyVideoFocus();
        }

        lastTime = currentTime;
    });

    homeHeroVideo.addEventListener('play', () => {
        if (homeHeroVideo.currentTime < focusAfterSeconds) {
            resetVideoFocus();
        }
    });
}