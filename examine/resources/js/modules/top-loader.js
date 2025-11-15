/**
 * Top Loading Bar - Alpine.js Module
 * Provides SPA-like loading animation on top of page
 */

export const topLoader = () => ({
    progress: 0,
    isLoading: false,
    interval: null,

    init() {
        this.setupListeners();
    },

    setupListeners() {
        // Listen for link clicks
        document.addEventListener("click", (e) => {
            const link = e.target.closest("a");
            if (link && !link.hasAttribute("data-no-loading")) {
                const href = link.getAttribute("href");
                const target = link.getAttribute("target");

                // Only show loader for internal links that open in current tab
                if (
                    href &&
                    !href.startsWith("http") &&
                    !href.startsWith("mailto:") &&
                    !href.startsWith("tel:") &&
                    target !== "_blank"
                ) {
                    if (!href.startsWith("#")) {
                        this.start();
                    }
                }
            }
        });

        // Listen for form submissions - but skip Livewire forms
        document.addEventListener("submit", (e) => {
            const form = e.target;
            if (!form.hasAttribute("data-no-loading")) {
                // Skip ALL Livewire forms (they handle their own loading)
                const hasLivewireAttribute =
                    form.hasAttribute("wire:submit") ||
                    form.hasAttribute("wire:model") ||
                    form.closest("[wire\\:id]");

                if (hasLivewireAttribute) {
                    // Don't show loader for Livewire forms
                    return;
                }

                // Check if form is a standard form (not AJAX)
                const hasAjaxClass = form.classList.contains("ajax-form");

                if (!hasAjaxClass) {
                    this.start();
                }
            }
        });

        // Listen for page visibility changes
        document.addEventListener("visibilitychange", () => {
            if (document.hidden) {
                this.pause();
            } else {
                this.resume();
            }
        });

        // Simulate page load completion
        window.addEventListener("load", () => {
            this.complete();
        });

        // Reset on unload
        window.addEventListener("beforeunload", () => {
            this.start();
        });

        // Handle page restoration (back/forward)
        window.addEventListener("pageshow", (e) => {
            if (e.persisted) {
                this.complete();
            }
        });

        // Handle page hide
        window.addEventListener("pagehide", () => {
            if (this.isLoading) {
                this.complete();
            }
        });
    },

    start() {
        if (this.isLoading) return;

        this.isLoading = true;
        this.progress = 10;

        this.increment();
    },

    increment() {
        if (!this.isLoading) return;

        const randomIncrement = Math.random() * 20 + 5;
        const nextProgress = Math.min(this.progress + randomIncrement, 95);
        this.progress = nextProgress;

        if (this.progress < 95) {
            clearTimeout(this.interval);
            this.interval = setTimeout(() => {
                this.increment();
            }, Math.random() * 800 + 200);
        }
    },

    complete() {
        this.progress = 100;
        this.isLoading = false;

        clearTimeout(this.interval);

        // Reset after brief delay
        setTimeout(() => {
            this.progress = 0;
        }, 300);
    },

    pause() {
        clearTimeout(this.interval);
    },

    resume() {
        if (this.isLoading && this.progress < 95) {
            this.increment();
        }
    },
});
