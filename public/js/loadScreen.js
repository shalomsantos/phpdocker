(() => {
    const loadScreen = document.createElement('div');
    loadScreen.className = 'load-screen';
    loadScreen.setAttribute('role', 'status');
    loadScreen.setAttribute('aria-live', 'polite');
    loadScreen.innerHTML = `
        <div class="spinner-grow" role="status">
            <span class="visually-hidden">Carregando...</span>
        </div>
    `;
    document.body.append(loadScreen); // Cria o elemento loading

    const show = () => loadScreen.classList.add('load-screen--visible');
    const hide = () => loadScreen.classList.remove('load-screen--visible');

    if (document.readyState === 'complete') {
        hide();
    } else {
        show();   
        window.addEventListener('load', hide, { once: true });
    }

    document.addEventListener('click', (event) => {
        if (event.defaultPrevented || event.button !== 0 || event.metaKey || event.ctrlKey || event.shiftKey || event.altKey) {
            return;
        }

        const link = event.target instanceof Element ? event.target.closest('a[href]') : null;
        if (!link || link.hasAttribute('download')) return;

        const target = link.getAttribute('target');
        if (target && target !== '_self') return;

        const destination = new URL(link.href, window.location.href);
        if (destination.origin !== window.location.origin) return;
        if (destination.pathname === window.location.pathname && destination.search === window.location.search && destination.hash) return;

        window.setTimeout(() => {
            if (!event.defaultPrevented) show();
        }, 0);
    }, true);

    document.addEventListener('submit', (event) => {
        if (event.defaultPrevented) return;

        const form = event.target;
        const target = form.getAttribute('target');
        if (target && target !== '_self') return;

        window.setTimeout(() => {
            if (!event.defaultPrevented) show();
        }, 0);
    }, true);

    window.addEventListener('pageshow', hide);
})();
