(() => {
    const windows = new Map();
    let nextWindowTitleId = 1;
    let nextZIndex = 1080;

    function focusWindow(windowElement) {
        nextZIndex += 1;
        windowElement.style.zIndex = String(nextZIndex);
    }

    function closeWindow(id) {
        const windowElement = windows.get(id);

        if (!windowElement) {
            return;
        }

        windowElement.remove();
        windows.delete(id);
    }

    function maximizeWindow(windowElement, maximizeButton) {
        const isMaximized = windowElement.classList.toggle('app-window--maximized');

        maximizeButton.setAttribute('aria-pressed', String(isMaximized));
        maximizeButton.setAttribute(
            'aria-label',
            isMaximized ? 'Restaurar janela' : 'Maximizar janela'
        );
        maximizeButton.textContent = isMaximized ? '❐' : '□';
    }

    function makeDraggable(windowElement, header) {
        let drag = null;

        header.addEventListener('pointerdown', (event) => {
            if (event.button !== 0 || event.target.closest('button') || windowElement.classList.contains('app-window--maximized')) {
                return;
            }

            const bounds = windowElement.getBoundingClientRect();
            drag = {
                pointerId: event.pointerId,
                offsetX: event.clientX - bounds.left,
                offsetY: event.clientY - bounds.top,
            };

            windowElement.style.left = `${bounds.left}px`;
            windowElement.style.top = `${bounds.top}px`;
            windowElement.style.right = 'auto';
            windowElement.style.bottom = 'auto';
            header.setPointerCapture(event.pointerId);
            focusWindow(windowElement);
        });

        header.addEventListener('pointermove', (event) => {
            if (!drag || drag.pointerId !== event.pointerId) {
                return;
            }

            const maxLeft = Math.max(0, window.innerWidth - windowElement.offsetWidth);
            const maxTop = Math.max(0, window.innerHeight - header.offsetHeight);
            const left = Math.min(maxLeft, Math.max(0, event.clientX - drag.offsetX));
            const top = Math.min(maxTop, Math.max(0, event.clientY - drag.offsetY));

            windowElement.style.left = `${left}px`;
            windowElement.style.top = `${top}px`;
        });

        const stopDragging = (event) => {
            if (drag && drag.pointerId === event.pointerId) {
                drag = null;
            }
        };

        header.addEventListener('pointerup', stopDragging);
        header.addEventListener('pointercancel', stopDragging);
    }

    function makeResizable(windowElement) {
        if (typeof window.interact !== 'function') {
            windowElement.style.resize = 'both';
            windowElement.style.overflow = 'auto';
            return;
        }

        const edges = {
            top: '.app-window__resize--top',
            right: '.app-window__resize--right',
            bottom: '.app-window__resize--bottom',
            left: '.app-window__resize--left',
        };

        const handles = [
            ['top'], ['right'], ['bottom'], ['left'],
            ['top', 'left'], ['top', 'right'],
            ['bottom', 'left'], ['bottom', 'right'],
        ];

        handles.forEach((handleEdges) => {
            const handle = document.createElement('div');
            handle.className = `app-window__resize ${handleEdges.map((edge) => `app-window__resize--${edge}`).join(' ')}`;
            handle.setAttribute('aria-hidden', 'true');
            windowElement.append(handle);
        });

        window.interact(windowElement).resizable({
            edges,
            listeners: {
                start() {
                    const bounds = windowElement.getBoundingClientRect();
                    windowElement.style.left = `${bounds.left}px`;
                    windowElement.style.top = `${bounds.top}px`;
                    windowElement.style.right = 'auto';
                    windowElement.style.bottom = 'auto';
                    windowElement.style.width = `${bounds.width}px`;
                    windowElement.style.height = `${bounds.height}px`;
                },
                move(event) {
                    const left = Number.parseFloat(windowElement.style.left) || 0;
                    const top = Number.parseFloat(windowElement.style.top) || 0;

                    windowElement.style.width = `${event.rect.width}px`;
                    windowElement.style.height = `${event.rect.height}px`;
                    windowElement.style.left = `${left + event.deltaRect.left}px`;
                    windowElement.style.top = `${top + event.deltaRect.top}px`;
                },
            },
            modifiers: [
                window.interact.modifiers.restrictSize({
                    min: {
                        width: Math.min(window.innerWidth <= 575.98 ? 280 : 320, window.innerWidth),
                        height: Math.min(240, window.innerHeight),
                    },
                    max: {
                        width: window.innerWidth,
                        height: window.innerHeight,
                    },
                }),
            ],
        });
    }

    function open(options) {
        const id = String(options.id || 'window');
        const url = new URL(options.url || '/', window.location.origin);

        if (url.origin !== window.location.origin) {
            throw new TypeError('A janela aceita somente páginas da mesma origem.');
        }

        const existingWindow = windows.get(id);

        if (existingWindow) {
            focusWindow(existingWindow);
            return existingWindow;
        }

        const windowElement = document.createElement('section');
        windowElement.className = 'app-window';
        windowElement.setAttribute('role', 'dialog');
        windowElement.setAttribute('aria-modal', 'false');
        windowElement.dataset.windowId = id;
        windowElement.style.width = options.width || 'min(82vw, 1100px)';
        windowElement.style.height = options.height || 'min(78vh, 800px)';
        focusWindow(windowElement);

        const titleId = `app-window-title-${nextWindowTitleId++}`;

        windowElement.setAttribute('aria-labelledby', titleId);

        const header = document.createElement('header');

        header.className = 'app-window__header';
        makeDraggable(windowElement, header);

        const title = document.createElement('h2');

        title.className = 'app-window__title';
        title.id = titleId;

        const iconClasses = String(options.icon || '')
            .trim()
            .split(/\s+/)
            .filter((className) => /^fa-[a-z0-9-]+$/i.test(className));

        if (iconClasses.length > 0) {
            const icon = document.createElement('i');
            icon.classList.add(...iconClasses);
            icon.setAttribute('aria-hidden', 'true');
            title.append(icon);
        }

        const titleText = document.createElement('span');
        titleText.textContent = options.title || 'Janela';
        title.append(titleText);

        const controls = document.createElement('div');

        controls.className = 'app-window__controls';

        // MAXIMIZE_ESTRUCTURE
        const maximizeButton = document.createElement('button');

        maximizeButton.className = 'app-window__control';
        maximizeButton.type = 'button';
        maximizeButton.setAttribute('aria-label', 'Maximizar janela');
        maximizeButton.setAttribute('aria-pressed', 'false');
        maximizeButton.textContent = '□';

        maximizeButton.addEventListener('click', () => {
            maximizeWindow(windowElement, maximizeButton);
        });
        // MAXIMIZE_ESTRUCTURE

        // CLOSEBUTTON_ESTRUCTURE
        const closeButton = document.createElement('button');

        closeButton.className = 'app-window__control app-window__control--close';
        closeButton.type = 'button';
        closeButton.setAttribute('aria-label', 'Fechar janela');
        closeButton.textContent = '×';

        closeButton.addEventListener('click', () => closeWindow(id));
        // CLOSEBUTTON_ESTRUCTURE

        controls.append(maximizeButton, closeButton);
        header.append(title, controls);

        const frame = document.createElement('iframe');
        
        frame.className = 'app-window__frame';
        frame.src = url.href;
        frame.title = options.title || 'Conteúdo da janela';

        windowElement.append(header, frame);
        document.body.append(windowElement);

        if (options.position === 'top-center') {
            const bounds = windowElement.getBoundingClientRect();
            const topOffset = Number.parseFloat(getComputedStyle(document.documentElement).fontSize) || 16;

            windowElement.style.left = `${Math.max(0, (window.innerWidth - bounds.width) / 2)}px`;
            windowElement.style.top = `${topOffset}px`;
            windowElement.style.right = 'auto';
            windowElement.style.bottom = 'auto';
        }

        windows.set(id, windowElement);
        makeResizable(windowElement);

        windowElement.addEventListener('pointerdown', () => focusWindow(windowElement));

        return windowElement;
    }

    document.addEventListener('click', (event) => {
        const target = event.target;
        const trigger = target instanceof Element ? target.closest('[data-window-open]') : null;

        if (!trigger) {
            return;
        }

        event.preventDefault();

        try {
            open({
                id: trigger.dataset.windowId,
                title: trigger.dataset.windowTitle,
                icon: trigger.dataset.windowIcon,
                position: trigger.dataset.windowPosition,
                url: trigger.dataset.windowUrl || trigger.href,
                width: trigger.dataset.windowWidth,
                height: trigger.dataset.windowHeight,
            });
        } catch (error) {
            console.error('Não foi possível abrir a janela.', error);
        }
    });

    window.AppWindowManager = { open, close: closeWindow };
})();
