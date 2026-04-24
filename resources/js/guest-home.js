const config = document.getElementById('guest-home-config');

if (config) {
    const heroImages = JSON.parse(config.dataset.heroImages || '[]');
    const heroImageElement = document.getElementById('hero-image');
    const popupOverlay = document.getElementById('iklan-popup-overlay');
    const closePopupButton = document.getElementById('close-iklan-popup');
    const closePopupActionButton = document.getElementById('close-iklan-popup-action');
    const countdownElement = document.getElementById('iklan-popup-countdown');
    const progressBar = document.querySelector('.popup-progress-bar');
    const popupSessionKey = config.dataset.popupSessionKey;

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

        const closePopup = () => {
            popupOverlay.classList.add('is-hidden');
            sessionStorage.setItem(popupSessionKey, 'closed');

            if (popupTimerId) {
                window.clearInterval(popupTimerId);
            }
        };

        if (countdownElement) {
            countdownElement.textContent = formatCountdown(remainingSeconds);
        }

        if (progressBar) {
            progressBar.style.width = '100%';
        }

        popupTimerId = window.setInterval(() => {
            remainingSeconds -= 1;

            if (countdownElement) {
                countdownElement.textContent = formatCountdown(Math.max(remainingSeconds, 0));
            }

            if (progressBar) {
                const progressWidth = (remainingSeconds / popupDurationSeconds) * 100;
                progressBar.style.width = `${Math.max(progressWidth, 0)}%`;
            }

            if (remainingSeconds <= 0) {
                closePopup();
            }
        }, 1000);

        closePopupButton?.addEventListener('click', closePopup);
        closePopupActionButton?.addEventListener('click', closePopup);
    } else if (popupOverlay) {
        popupOverlay.remove();
    }
}
