const config = document.getElementById('guest-home-config');

if (config) {
    const heroImages = JSON.parse(config.dataset.heroImages || '[]');
    const heroImageElement = document.getElementById('hero-image');
    const popupOverlay = document.getElementById('iklan-popup-overlay');
    const closePopupButton = document.getElementById('close-iklan-popup');
    const closePopupActionButtons = Array.from(document.querySelectorAll('[data-close-iklan-popup-action]'));
    const prevPopupButton = document.getElementById('iklan-popup-prev');
    const nextPopupButton = document.getElementById('iklan-popup-next');
    const popupSessionKey = config.dataset.popupSessionKey;
    const popupSlides = Array.from(document.querySelectorAll('[data-iklan-slide]'));

    if (heroImageElement && heroImages.length > 1) {
        let heroIndex = 0;

        window.setInterval(() => {
            heroIndex = (heroIndex + 1) % heroImages.length;
            heroImageElement.classList.add('is-transitioning');

            window.setTimeout(() => {
                heroImageElement.src = heroImages[heroIndex];
                heroImageElement.classList.remove('is-transitioning');
            }, 250);
        }, 5000);
    }

    const revealElements = document.querySelectorAll('.scroll-reveal, .scroll-reveal-child');

    if (revealElements.length) {
        const revealObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting) {
                    return;
                }

                entry.target.classList.add('is-visible');
                observer.unobserve(entry.target);
            });
        }, {
            threshold: 0.12,
        });

        revealElements.forEach((element) => revealObserver.observe(element));
    }

    if (popupSlides.length > 0) {
        let activeSlideIndex = 0;
        let touchStartX = 0;
        let touchEndX = 0;

        const setActiveSlide = (index) => {
            popupSlides.forEach((slide, slideIndex) => {
                slide.classList.toggle('is-active', slideIndex === index);
            });
        };

        const showPreviousSlide = () => {
            activeSlideIndex = (activeSlideIndex - 1 + popupSlides.length) % popupSlides.length;
            setActiveSlide(activeSlideIndex);
        };

        const showNextSlide = () => {
            activeSlideIndex = (activeSlideIndex + 1) % popupSlides.length;
            setActiveSlide(activeSlideIndex);
        };

        setActiveSlide(activeSlideIndex);

        prevPopupButton?.addEventListener('click', showPreviousSlide);
        nextPopupButton?.addEventListener('click', showNextSlide);

        popupOverlay?.addEventListener('touchstart', (event) => {
            touchStartX = event.changedTouches[0]?.clientX ?? 0;
        }, {
            passive: true,
        });

        popupOverlay?.addEventListener('touchend', (event) => {
            touchEndX = event.changedTouches[0]?.clientX ?? 0;

            if (Math.abs(touchEndX - touchStartX) < 40) {
                return;
            }

            if (touchEndX < touchStartX) {
                showNextSlide();
                return;
            }

            showPreviousSlide();
        }, {
            passive: true,
        });
    }

    if (popupOverlay && popupSessionKey && sessionStorage.getItem(popupSessionKey) !== 'closed') {
        const popupDurationSeconds = 600;
        let remainingSeconds = popupDurationSeconds;
        let popupTimerId = null;

        const formatCountdown = (seconds) => {
            if (seconds >= 60) {
                const minutes = Math.floor(seconds / 60);
                const restSeconds = seconds % 60;

                return `${minutes}:${String(restSeconds).padStart(2, '0')} menit`;
            }

            return `${seconds} detik`;
        };

        const syncPopupMeta = () => {
            popupSlides.forEach((slide) => {
                const countdownTarget = slide.querySelector('[data-iklan-popup-countdown]');
                const progressTarget = slide.querySelector('[data-iklan-popup-progress]');

                if (countdownTarget) {
                    countdownTarget.textContent = formatCountdown(Math.max(remainingSeconds, 0));
                }

                if (progressTarget) {
                    const progressWidth = (remainingSeconds / popupDurationSeconds) * 100;
                    progressTarget.style.width = `${Math.max(progressWidth, 0)}%`;
                }
            });
        };

        const closePopup = () => {
            popupOverlay.classList.add('is-hidden');
            sessionStorage.setItem(popupSessionKey, 'closed');

            if (popupTimerId) {
                window.clearInterval(popupTimerId);
            }
        };

        syncPopupMeta();

        popupTimerId = window.setInterval(() => {
            remainingSeconds -= 1;
            syncPopupMeta();

            if (remainingSeconds <= 0) {
                closePopup();
            }
        }, 1000);

        closePopupButton?.addEventListener('click', closePopup);
        closePopupActionButtons.forEach((button) => button.addEventListener('click', closePopup));
    } else if (popupOverlay) {
        popupOverlay.remove();
    }
}
