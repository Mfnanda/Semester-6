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
        });
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
