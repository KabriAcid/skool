# School Admin Portal UI Generation Prompt (React + Tailwind)

## Overview

Generate a complete **School Admin Portal UI** for a CBT platform built for schools to manage mock WAEC, JAMB, NECO, and other internal tests. The portal must match the visual identity, tone, layout, and modern UI/UX style of the existing **Student Dashboard**, which has a premium feel featuring vibrant gradients, soft rounded cards, balanced white space, subtle multi-layered shadows, and clean typography.

This portal must be produced as **static HTML files**, one per screen/page, using **Tailwind CSS**, **Lucide icons**, and **Framer Motion** for subtle animations. No frameworks or backend logic should be included. The pages should be easily migratable into Blade views later.

## Design & Branding Requirements

1. Maintain the exact visual language demonstrated in the student dashboard:

   * Gradient banners (purple–blue blends)
   * Rounded, soft-edged cards
   * Subtle shadows and glassmorphism-inspired panels
   * Clean sans-serif typography and structured spacing
   * Consistent icon usage (Lucide)
   * Clear section headings and content grouping
   * Light, friendly color palette with professional tones

2. Ensure all pages are:

   * Fully responsive (mobile-first layout)
   * Modern and minimal
   * Visually consistent across the entire portal
   * Professionally aligned with premium SaaS dashboard standards
   * Intuitive for school staff with varying tech literacy

3. Use **Framer Motion** only for light animations:

   * Fade-ins for cards and content blocks
   * Smooth transitions for modals and dropdowns
   * Soft micro-interactions

4. Stick strictly to Tailwind utility classes for layout and styling.

## Design Parity with Student Dashboard (Critical Reference)

The admin portal **must mirror** the exact design patterns, component styling, and interactions from the student dashboard. Use the following as your design specification:

### Layout Structure

**Sidebar (Desktop)**
* Fixed position: `fixed lg:fixed top-0 left-0 z-40 w-72 h-screen`
* Background: `bg-white/95 backdrop-blur-lg border-r border-spiritual-200 shadow-strong`
* Logo section: `px-4 sm:px-6 py-4 sm:py-5 border-b border-spiritual-200`
* Logo icon: `w-8 h-8 sm:w-10 sm:h-10 bg-gradient-to-br from-primary-500 to-secondary-600 rounded-lg sm:rounded-xl`
* Navigation spacing: `px-2 sm:px-3 space-y-0.5 sm:space-y-1`
* Active nav item: `bg-gradient-to-r from-primary-500 to-primary-600 text-white shadow-medium`
* Inactive nav item: `text-spiritual-700 hover:bg-spiritual-50`
* Nav item structure: `flex items-center gap-2 sm:gap-3 px-3 sm:px-4 py-2 sm:py-3 rounded-lg sm:rounded-xl transition-all duration-300`

**Top Header Bar**
* Sticky position: `sticky top-0 z-30 bg-white/90 backdrop-blur-md border-b border-spiritual-200 shadow-soft`
* Padding: `px-3 sm:px-6 lg:px-8 py-3 sm:py-4`
* Page title: `text-xl sm:text-2xl font-bold text-spiritual-900`
* Page description: `text-xs sm:text-sm text-spiritual-600 mt-1`

**Mobile Bottom Navigation**
* Fixed position: `fixed bottom-0 left-0 right-0 lg:hidden z-50`
* Background: `bg-white/95 backdrop-blur-md border-t border-spiritual-200 shadow-strong`
* Height: `h-20`
* Icon + label structure with responsive states

**Main Content**
* Padding: `p-4 sm:p-6 lg:p-8`
* Spacing between sections: `space-y-5 sm:space-y-6 md:space-y-7 lg:space-y-8`

### Card Components

**Glassmorphism Cards**
* Base: `bg-white/90 backdrop-blur-sm rounded-xl sm:rounded-2xl p-4 sm:p-5 lg:p-6 shadow-soft border border-white/20`
* Hover: `hover:shadow-medium transition-all duration-300`
* Inner padding: `p-3 sm:p-4 lg:p-6`

**Gradient Banner/Hero Cards**
* Welcome banner: `bg-gradient-to-r from-primary-500 to-secondary-600 rounded-2xl sm:rounded-3xl p-4 sm:p-6 md:p-7 lg:p-8 shadow-strong text-white`
* Heading: `text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold mb-1 sm:mb-2 leading-tight`
* Subtext: `text-xs sm:text-sm md:text-base text-primary-100`

**Stat/KPI Cards**
* Number display: `text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold text-spiritual-900 truncate`
* Label: `text-xs sm:text-sm text-spiritual-600 mb-0.5 sm:mb-1`
* Icon container: `w-8 h-8 sm:w-10 sm:h-10 lg:w-12 lg:h-12 bg-primary-100 rounded-lg sm:rounded-xl flex items-center justify-center`
* Icon size: `w-4 h-4 sm:w-5 sm:h-5 lg:w-6 lg:h-6 text-primary-600`
* Trend indicator: `text-xs sm:text-sm text-success-600 font-medium`

### Gradients & Color Usage

**Primary Gradients**
* Primary blend: `bg-gradient-to-r from-primary-500 to-primary-600`
* Primary-secondary blend: `bg-gradient-to-r from-primary-500 to-secondary-600`
* Success blend: `bg-gradient-to-r from-success-500 to-success-600`
* Warning blend: `bg-gradient-to-br from-warning-500 to-warning-600`
* Subtle background: `bg-gradient-to-br from-spiritual-50 to-white`

**Badge/Status Colors**
* Success: `bg-success-100 text-success-600`
* Warning: `bg-warning-100 text-warning-600`
* Error: `bg-error-100 text-error-600`
* Primary: `bg-primary-100 text-primary-600`
* Neutral: `bg-spiritual-100 text-spiritual-600`

### Icon Integration (Lucide)

* Use Lucide icons consistently with responsive sizing
* Standard sizes: `w-4 h-4`, `w-5 h-5`, `w-6 h-6`
* Responsive: `w-4 h-4 sm:w-5 sm:h-5 lg:w-6 lg:h-6`
* Always pair icons with text labels in navigation
* Use icon-only on mobile bottom nav
* Common icons:
  - Dashboard: `layout-dashboard`
  - Students: `users` or `user-circle`
  - Exams: `book-open` or `clipboard-list`
  - Results: `bar-chart-3`
  - Performance: `trending-up`
  - Settings: `settings`
  - Notifications: `bell`
  - Help: `help-circle`
  - Logout: `log-out`

### Badges & Pills

**Standard Badge**
* Small: `text-xs bg-primary-100 text-primary-600 px-2 py-1 rounded-full font-medium`
* With icon: `flex items-center gap-1`

**Status Badges**
* Completed: `bg-success-100 text-success-600 px-2 py-0.5 rounded text-xs font-medium`
* Pending: `bg-warning-100 text-warning-600 px-2 py-0.5 rounded text-xs font-medium`
* Failed/Error: `bg-error-100 text-error-600 px-2 py-0.5 rounded text-xs font-medium`

### Buttons & Interactive Elements

**Primary Button**
* Base: `bg-gradient-to-r from-primary-500 to-primary-600 text-white px-4 sm:px-5 py-2 sm:py-2.5 rounded-lg sm:rounded-xl font-medium shadow-soft hover:shadow-medium transition-all duration-300`

**Secondary/Ghost Button**
* Base: `border border-spiritual-300 text-spiritual-700 hover:bg-spiritual-50 px-4 py-2 rounded-lg transition-all duration-300`

**Icon Button**
* Base: `p-1.5 sm:p-2 text-spiritual-600 hover:text-primary-600 transition-colors rounded-lg hover:bg-spiritual-50`

### Tables & Lists

**Table Structure**
* Container: `bg-white/90 backdrop-blur-sm rounded-xl sm:rounded-2xl p-4 sm:p-5 lg:p-6 shadow-soft border border-white/20`
* Row hover: `hover:bg-spiritual-50 transition-colors`
* Border: `border border-spiritual-200 rounded-lg sm:rounded-xl`

**List Items**
* Card item: `border border-spiritual-200 rounded-lg sm:rounded-xl p-3 sm:p-4 hover:border-primary-300 hover:shadow-medium transition-all duration-300`

### Progress Bars

* Container: `w-full bg-spiritual-200 rounded-full h-1.5 sm:h-2`
* Fill: `bg-gradient-to-r from-success-500 to-success-600 h-1.5 sm:h-2 rounded-full`

### Animations & Transitions (Alpine.js patterns)

**Staggered Fade-in**
```html
x-data="{ show: false }"
x-init="setTimeout(() => show = true, [delay])"
x-show="show"
x-transition:enter="transition ease-out duration-500"
x-transition:enter-start="opacity-0 translate-y-4"
x-transition:enter-end="opacity-100 translate-y-0"
```

**Dropdown/Modal**
```html
x-show="open"
@click.away="open = false"
x-transition:enter="transition ease-out duration-200"
x-transition:enter-start="opacity-0 scale-95"
x-transition:enter-end="opacity-100 scale-100"
```

### Empty States

* Icon: `w-12 h-12 sm:w-16 sm:h-16 text-spiritual-300 mx-auto mb-3 sm:mb-4`
* Text: `text-spiritual-600 text-sm sm:text-base`
* CTA: `text-primary-600 hover:text-primary-700 text-xs sm:text-sm font-medium mt-2`

### Typography Scale

* Hero heading: `text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold`
* Section heading: `text-lg sm:text-xl lg:text-2xl font-bold text-spiritual-900`
* Subheading: `text-base sm:text-lg font-semibold`
* Body: `text-sm sm:text-base text-spiritual-700`
* Small/meta: `text-xs sm:text-sm text-spiritual-600`

### Spacing & Rhythm

* Section gaps: `gap-5 sm:gap-6 md:gap-7 lg:gap-8`
* Card gaps: `gap-3 sm:gap-4 lg:gap-6`
* Stack spacing: `space-y-3 sm:space-y-4` or `space-y-5 sm:space-y-6`

### Responsive Grid Patterns

* Stats grid: `grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4 lg:gap-6`
* Main content: `grid grid-cols-1 lg:grid-cols-3 gap-5 sm:gap-6 md:gap-7 lg:gap-8`
* Two-column: `grid grid-cols-2 gap-3 sm:gap-4`

**Key Principle**: Every admin page should feel like a natural extension of the student experience, using identical visual building blocks, spacing rhythms, and interaction patterns.

## Technical Requirements

* Each UI screen must be provided as **individual static HTML files**.
* No JavaScript frameworks (React, Vue, Alpine, Livewire) should be included.
* Only minimal vanilla JS is allowed for interactions (menus, tabs, modals).
* Structure every page semantically (`header`, `aside`, `main`, etc.).
* Include Lucide icons in a consistent manner.
* Do not include any backend-related logic.

## Context and Role Definition

This portal is exclusively for **school administrators** who have:

* Already registered their school
* Already paid for the subscription
* Successfully logged in

Therefore, **no onboarding pages, no registration UI, and no payment setup pages** are required.

The pages should directly represent the workflow a typical school admin needs to manage day-to-day academic preparatory testing.

## Required Pages (Generate All)

Generate the full School Admin Portal UI covering the pages below. Each should be provided as a separate HTML file.

### 1. Dashboard

* Welcome banner similar to student UI, tailored to school admin
* KPIs such as:

  * Number of students
  * Active exams
  * Completed exams
  * Average performance
  * Recent activity logs
* Quick action cards
* Upcoming scheduled exams
* Recently added students

### 2. Student Management

* **Students List** page with search, filters, pagination
* Profile page for individual students with all details about the student
* Add new student form modal (manual creation)
* Bulk upload template UI (CSV placeholder)
* Status indicators (active, suspended)

### 3. Exams Management

* Exams overview list
* Create Exam wizard (multi-step):

  1. Basic info (title, type, duration, date)
  2. Subjects selection
  3. Number of questions / difficulty mix
  4. Review & confirm
* Exam detail page
* Scheduling UI

### 4. Question Bank Management

* Subject selection screen
* Question list table with filters (difficulty, topic, type)
* Add question UI:

  * Objective single-choice
  * Objective multi-choice
  * Theory/essay
* Edit question UI
* Import/export placeholders

### 5. Performance & Analytics

* Overall analytics dashboard
* Subject performance charts (use placeholder boxes for charts)
* Student ranking tables
* Exam-based analytics
* Insight cards (weak topics, improvement trends)

### 6. Results

* All exam results list view
* Result detail page for a single exam session
* Student-specific result breakdown page

### 7. Subjects Management

* List of subjects school uses
* Ability to activate/deactivate subjects
* UI for subject metadata (shortcode, full name)

### 8. Settings

* School profile settings
* Admin user account settings
* Notification preferences
* Roles & permissions (basic placeholders)

### 9. Notifications

* Notification list page
* Read/unread states
* Filters

### 10. Help & Support

* FAQ layout
* Contact support page
* Issue reporting form

### 11. UI Components Library

A separate HTML page containing all reusable UI components:

* Buttons
* Inputs
* Selects
* Tabs
* Modals
* Tables
* Stats cards
* Gradients
* Badges
* Alerts
* Pagination

## Layout Requirements

Each page must include:

* A **fixed sidebar** similar to student dashboard but tailored for admins (dashboard, students, exams, results, performance, subjects, settings, support)
* A **top navigation bar** showing:

  * Admin profile avatar
  * Notifications icon
  * Quick actions
* A clean **main content** container with:

  * Section heading
  * Breadcrumbs where appropriate

## Navigation Structure

### Sidebar Links

* Dashboard
* Students
* Exams
* Question Bank
* Results
* Performance
* Subjects
* Settings
* Help & Support
* Logout

### Top Bar Elements

* School name
* Quick add button (for student/exam)
* Notification bell
* Profile dropdown

## Formatting and Output Requirements

* Produce **well-organized, readable, semantic HTML**.
* Keep Tailwind classes clean and manageable.
* Only use placeholder images/icons where necessary.
* All charts should be represented as simple placeholders (no chart libraries).
* For multi-step wizards, include all steps within the same HTML file.
* For tables, include realistic sample rows for structure.
* Maintain consistent spacing, paddings, and typography across all screens.

## Final Deliverable

Output all pages as **a structured set of HTML files**, each following the visual language of the student dashboard and implementing the admin-specific requirements listed above. Avoid backend references. Provide clean, production-ready static layouts that can easily be ported into Blade templates later.
