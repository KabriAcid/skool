/**
 * Utilities Index
 * Central export point for all utility functions and libraries
 */

// HTTP Client
export { default as axios } from './axios';

// State and LGA selector for Nigerian forms
export { default as stateCapitalModule } from './state-capital';

// Note: lottie-player is a large library, import it separately if needed
// import 'lottie-player' when you need it in components

// Re-export cn utility from lib (if needed here)
export { cn } from '../lib/utils';
