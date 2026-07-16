document.addEventListener('DOMContentLoaded', () => {
    const cards = document.querySelectorAll('.card');
    cards.forEach((card, index) => {
        card.style.transitionDelay = `${index * 40}ms`;
    });

    const navLinks = document.querySelectorAll('.menu a');
    navLinks.forEach((link) => {
        link.addEventListener('mouseenter', () => {
            link.style.transform = 'translateY(-1px)';
        });
        link.addEventListener('mouseleave', () => {
            link.style.transform = 'translateY(0)';
        });
        link.addEventListener('click', () => {
            link.style.transform = 'translateY(0)';
            if (window.innerWidth <= 768) {
                document.querySelector('.menu')?.classList.remove('open');
                document.querySelector('.menu-toggle')?.setAttribute('aria-expanded', 'false');
            }
        });
    });

    const menuToggle = document.querySelector('.menu-toggle');
    const menu = document.querySelector('.menu');

    const closeMenu = () => {
        document.body.classList.remove('menu-open');
        menu?.classList.remove('open');
        menuToggle?.classList.remove('active');
        menuToggle?.setAttribute('aria-expanded', 'false');
    };

    if (menuToggle && menu) {
        menuToggle.addEventListener('click', (event) => {
            event.preventDefault();
            const isOpen = document.body.classList.toggle('menu-open');
            menu.classList.toggle('open', isOpen);
            menuToggle.classList.toggle('active', isOpen);
            menuToggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
        });

        menu.querySelectorAll('a').forEach((link) => {
            link.addEventListener('click', closeMenu);
        });
    }

    window.addEventListener('resize', () => {
        if (window.innerWidth > 768) {
            closeMenu();
        }
    });

    const hero = document.querySelector('.hero');
    if (hero) {
        hero.animate([
            { opacity: 0, transform: 'translateY(10px)' },
            { opacity: 1, transform: 'translateY(0)' }
        ], {
            duration: 650,
            easing: 'ease-out'
        });
    }
});
