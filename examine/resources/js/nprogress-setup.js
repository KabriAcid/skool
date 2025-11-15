import NProgress from "nprogress";

// Configure NProgress
NProgress.configure({
    minimum: 0.3,
    easing: "ease",
    speed: 200,
    showSpinner: false,
    trickleSpeed: 100,
    trickleRate: 0.05,
});

// Export configured NProgress
export default NProgress;
