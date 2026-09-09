const toggle = document.querySelector('[data-menu-toggle]');
const menu = document.querySelector('[data-menu]');
const header = document.querySelector('[data-header]');
const reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
const finePointer = window.matchMedia('(pointer: fine)').matches;

const closeMenu = () => {
    if (!toggle || !menu) return;
    toggle.setAttribute('aria-expanded', 'false');
    menu.classList.remove('open');
    document.body.classList.remove('menu-open');
};

if (toggle && menu) {
    toggle.addEventListener('click', () => {
        const open = toggle.getAttribute('aria-expanded') === 'true';
        toggle.setAttribute('aria-expanded', String(!open));
        menu.classList.toggle('open', !open);
        document.body.classList.toggle('menu-open', !open);
    });

    menu.querySelectorAll('a').forEach((link) => link.addEventListener('click', closeMenu));
    window.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') closeMenu();
    });

    const desktop = window.matchMedia('(min-width: 901px)');
    desktop.addEventListener?.('change', (event) => {
        if (event.matches) closeMenu();
    });
}

if (header) {
    const sync = () => header.classList.toggle('scrolled', window.scrollY > 18);
    sync();
    window.addEventListener('scroll', sync, { passive: true });
}

const observer = !reduce && 'IntersectionObserver' in window
    ? new IntersectionObserver((entries) => entries.forEach((entry) => {
        if (entry.isIntersecting) {
            entry.target.classList.add('visible');
            observer.unobserve(entry.target);
        }
    }), { threshold: 0.1 })
    : null;

document.querySelectorAll('.reveal').forEach((element) => observer ? observer.observe(element) : element.classList.add('visible'));

if (!reduce && finePointer) {
    document.querySelectorAll('[data-parallax-scene]').forEach((scene) => {
        const layers = [...scene.querySelectorAll('[data-parallax]')];
        let frame = 0;

        scene.addEventListener('pointermove', (event) => {
            const rect = scene.getBoundingClientRect();
            const x = ((event.clientX - rect.left) / rect.width - 0.5) * 2;
            const y = ((event.clientY - rect.top) / rect.height - 0.5) * 2;

            cancelAnimationFrame(frame);
            frame = requestAnimationFrame(() => layers.forEach((layer) => {
                const depth = Number(layer.dataset.depth || 10);
                layer.style.transform = `translate3d(${x * depth}px,${y * depth}px,0)`;
            }));
        }, { passive: true });

        scene.addEventListener('pointerleave', () => {
            layers.forEach((layer) => layer.style.transform = 'translate3d(0,0,0)');
        }, { passive: true });
    });

    document.querySelectorAll('[data-tilt]').forEach((card) => {
        card.addEventListener('pointermove', (event) => {
            const rect = card.getBoundingClientRect();
            const x = (event.clientX - rect.left) / rect.width - 0.5;
            const y = (event.clientY - rect.top) / rect.height - 0.5;
            card.style.transform = `perspective(900px) rotateX(${-y * 2.2}deg) rotateY(${x * 3.2}deg) translateY(-3px)`;
        }, { passive: true });
        card.addEventListener('pointerleave', () => card.style.transform = '', { passive: true });
    });
}

const dot = document.querySelector('[data-cursor-dot]');
const ring = document.querySelector('[data-cursor-ring]');

if (dot && ring && !reduce && finePointer) {
    let ringX = 0;
    let ringY = 0;
    let mouseX = 0;
    let mouseY = 0;

    window.addEventListener('pointermove', (event) => {
        mouseX = event.clientX;
        mouseY = event.clientY;
        dot.style.transform = `translate3d(${mouseX}px,${mouseY}px,0)`;
    }, { passive: true });

    const animate = () => {
        ringX += (mouseX - ringX) * 0.16;
        ringY += (mouseY - ringY) * 0.16;
        ring.style.transform = `translate3d(${ringX}px,${ringY}px,0)`;
        requestAnimationFrame(animate);
    };
    animate();

    document.querySelectorAll('a,button,input,textarea,select').forEach((element) => {
        element.addEventListener('mouseenter', () => document.body.classList.add('cursor-hover'));
        element.addEventListener('mouseleave', () => document.body.classList.remove('cursor-hover'));
    });
}
