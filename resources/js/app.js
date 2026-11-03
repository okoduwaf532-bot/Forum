import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

const vantaBackground = document.querySelector('#vanta-background');

document.addEventListener('click', (event) => {
    const link = event.target.closest('a');

    if (link && link.origin === window.location.origin && link.target !== '_blank' && !link.hasAttribute('download')) {
        document.body.classList.add('is-leaving');
    }
});

window.addEventListener('beforeunload', () => {
    document.body.classList.add('is-leaving');
});

window.addEventListener('pageshow', () => {
    document.body.classList.remove('is-leaving');
});

if (vantaBackground && !window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
    const effectName = document.body.dataset.vantaEffect;
    const effectScripts = {
        waves: '/vanta/vanta.waves.min.js',
        birds: '/vanta/vanta.birds.min.js',
        halo: '/vanta/vanta.halo.min.js',
    };

    const loadScript = (src) => new Promise((resolve, reject) => {
        const script = document.createElement('script');
        script.src = src;
        script.onload = resolve;
        script.onerror = reject;
        document.head.appendChild(script);
    });

    const effectOptions = {
        waves: {
            color: 0x2563eb,
            shininess: 25,
            waveHeight: 12,
            waveSpeed: 0.65,
            zoom: 0.9,
        },
        birds: {
            backgroundColor: 0x0f172a,
            color1: 0x60a5fa,
            color2: 0x38bdf8,
            birdSize: 1.15,
            quantity: 3.5,
            speedLimit: 4,
            separation: 45,
            alignment: 30,
            cohesion: 35,
        },
        halo: {
            backgroundColor: 0x0f172a,
            baseColor: 0x2563eb,
            size: 1.25,
            amplitudeFactor: 1.2,
            xOffset: 0.05,
            yOffset: 0.05,
        },
    };

    if (effectName && effectScripts[effectName]) {
        loadScript('/vanta/three.r134.min.js')
            .then(() => loadScript(effectScripts[effectName]))
            .then(() => {
                const effect = window.VANTA?.[effectName.toUpperCase()];

                if (!effect) {
                    throw new Error(`Vanta effect "${effectName}" was not loaded.`);
                }

                window.vantaInstance = effect({
                    el: vantaBackground,
                    mouseControls: true,
                    touchControls: true,
                    gyroControls: false,
                    minHeight: 200,
                    minWidth: 200,
                    ...effectOptions[effectName],
                });
                requestAnimationFrame(() => vantaBackground.classList.add('vanta-ready'));
            })
            .catch((error) => {
                console.warn('Vanta background could not be initialized.', error);
            });
    }
} else if (vantaBackground) {
    vantaBackground.classList.add('vanta-ready');
}
