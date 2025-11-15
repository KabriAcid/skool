// Skeleton Loader Component
export const skeletonLoader = () => ({
    // Skeleton states
    isLoading: true,

    // Initialize with delay to show skeleton briefly
    init() {
        // Show skeleton for a minimum of 300ms for better UX
        setTimeout(() => {
            this.isLoading = false;
        }, 300);
    },

    // Restart loading animation
    reload() {
        this.isLoading = true;
        setTimeout(() => {
            this.isLoading = false;
        }, 300);
    },
});

// Skeleton Pulse Animation (CSS-based in Tailwind)
// Use: animate-pulse on skeleton elements
