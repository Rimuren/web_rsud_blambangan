const guestHomeConfig = document.getElementById('guest-home-config');

if (guestHomeConfig) {
    const popupSessionKey = guestHomeConfig.dataset.popupSessionKey || null;
    const heroImages = JSON.parse(guestHomeConfig.dataset.heroImages || '[]');

    document.addEventListener('DOMContentLoaded', () => {
        const iklanPopup = document.getElementById('iklan-popup-overlay');
        const iklanCountdown = document.getElementById('iklan-popup-countdown');
        const heroImage = document.getElementById('hero-image');
        const revealElements = document.querySelectorAll('.scroll-reveal, .scroll-reveal-child');

        let iklanTimer = null;
        let iklanCountdownInterval = null;
        let currentIndex = 0;

        const popupDurationMs = 600000;
        const popupDurationSeconds = Math.ceil(popupDurationMs / 1000);
        const navigationEntry = performance.getEntriesByType('navigation')[0];
        const isReload = navigationEntry
            ? navigationEntry.type === 'reload'
            : performance.navigation && performance.navigation.type === 1;
        const hasShownInSession = popupSessionKey
            ? sessionStorage.getItem(popupSessionKey) === '1'
            : false;

        const closeIklanPopup = () => {
            if (!iklanPopup) {
                return;
            }

            if (iklanTimer) {
                clearTimeout(iklanTimer);
                iklanTimer = null;
            }

            if (iklanCountdownInterval) {
                clearInterval(iklanCountdownInterval);
                iklanCountdownInterval = null;
            }

            iklanPopup.classList.add('popup-hidden');
        };

        document.getElementById('close-iklan-popup')?.addEventListener('click', closeIklanPopup);
        document.getElementById('close-iklan-popup-action')?.addEventListener('click', closeIklanPopup);

        iklanPopup?.addEventListener('click', (event) => {
            if (event.target === iklanPopup) {
                closeIklanPopup();
            }
        });

        if (iklanPopup) {
            if (isReload || hasShownInSession) {
                iklanPopup.classList.add('popup-hidden');
            } else {
                if (popupSessionKey) {
                    sessionStorage.setItem(popupSessionKey, '1');
                }

                if (iklanCountdown) {
                    let remainingSeconds = popupDurationSeconds;
                    iklanCountdown.textContent = `${remainingSeconds} detik`;

                    iklanCountdownInterval = setInterval(() => {
                        remainingSeconds -= 1;

                        if (remainingSeconds <= 0) {
                            iklanCountdown.textContent = '0 detik';
                            clearInterval(iklanCountdownInterval);
                            iklanCountdownInterval = null;
                            return;
                        }

                        iklanCountdown.textContent = `${remainingSeconds} detik`;
                    }, 1000);
                }

                iklanTimer = setTimeout(closeIklanPopup, popupDurationMs);
            }
        }

        if (heroImage && heroImages.length > 0) {
            setInterval(() => {
                heroImage.classList.add('fade-out');

                setTimeout(() => {
                    currentIndex = (currentIndex + 1) % heroImages.length;
                    heroImage.src = heroImages[currentIndex];
                    heroImage.classList.remove('fade-out');
                }, 500);
            }, 3000);
        }

        if (revealElements.length > 0) {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                    }
                });
            }, {
                threshold: 0.15,
                rootMargin: '0px 0px -20px 0px',
            });

            revealElements.forEach((element) => observer.observe(element));
        }
    });
}
