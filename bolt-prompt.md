# Examine CBT - Student Dashboard Design System

## Project Overview

**Examine CBT** is a comprehensive Computer-Based Testing platform designed specifically for Nigerian high school students preparing for WAEC, JAMB, and other standardized exams. The platform provides exam practice, performance tracking, and interactive learning tools to help students ace their examinations.

The student dashboard is the central hub where students access exams, track their progress, view results, and navigate between different sections of the application. This is a high-engagement interface that must be responsive, performant, and visually engaging.

---

## Design System Foundation

### Color Palette

The application uses a carefully curated color system with specific semantic meanings:

- **Primary (Blue)**: `#0ea5e9` - Primary actions, CTAs, active states, highlights. Used for interactive elements like buttons, links, and active navigation items.
- **Secondary (Magenta)**: `#d946ef` - Accents, gradients, premium features. Often paired with primary in gradient backgrounds.
- **Spiritual (Slate Gray)**: Various shades from `#f8fafc` (50) to `#0f172a` (900) - Default text, borders, backgrounds. Used for neutral elements.
- **Success (Green)**: `#22c55e` - Completion status, passing scores, achievements. Alert colors for positive outcomes.
- **Warning (Amber)**: `#f59e0b` - Attention, streaks, rankings, caution states. Shows urgency or special achievement.
- **Error (Red)**: `#ef4444` - Failed exams, errors, critical alerts. Used for negative states.
- **Islamic (Dark Slate)**: Various shades - Secondary neutral colors, often used for text contrast.

### Typography

- **Font**: Ginto (custom variable font with weights 300-700)
- **Fallback**: System UI fonts with sans-serif
- **Sizing Scale**: Responsive with sm/md/lg breakpoints using Tailwind conventions
    - Mobile: Smaller sizes (xs: 12px, sm: 14px)
    - Desktop: Larger sizes (base: 16px, lg: 18px, xl: 20px)
    - Headings: Scale from h3 (18px) to h1 (48px depending on context)

### Spacing & Layout

- **Base Unit**: 4px (Tailwind default)
- **Responsive Gaps**:
    - Mobile: `gap-3` (12px), `gap-4` (16px)
    - Desktop: `gap-5` (20px), `gap-6` (24px), `gap-8` (32px)
- **Padding**:
    - Cards: `p-3 sm:p-4 lg:p-6` (12px → 16px → 24px)
    - Sections: `p-4 sm:p-6 lg:p-8` (16px → 24px → 32px)

### Border Radius

- **Inputs/Buttons**: `rounded-lg` (8px) or `rounded-xl` (12px)
- **Cards**: `rounded-xl` (12px) or `rounded-2xl` (16px)
- **Large Elements**: `rounded-2xl` (16px) or `rounded-3xl` (24px) on mobile headers

### Shadows

- **Soft**: `shadow-soft` - Light, subtle shadows for cards and hover states
- **Medium**: `shadow-medium` - Moderate elevation for interactive elements
- **Strong**: `shadow-strong` - Deep shadows for prominent elements like modals

### Backgrounds

- **Base**: Gradient from `from-primary-50 via-white to-secondary-50` (light blue → white → light magenta)
- **Cards**: `bg-white/90 backdrop-blur-sm` - Semi-transparent white with blur effect for glass morphism
- **Overlays**: `bg-white/95 backdrop-blur-md` - Slightly more opaque for header/navigation

---

## Layout Architecture

### Overall Structure

The student dashboard uses a **responsive three-column layout** for desktop:

```
┌─────────────────────────────────────────────┐
│          STICKY TOP HEADER                  │
│  (Logo, Page Title, Streak, Notifications) │
└─────────────────────────────────────────────┘
┌──────────────┬─────────────────────────────┐
│              │                             │
│   SIDEBAR    │     MAIN CONTENT            │
│  (Fixed)     │   ┌───────────────────────┐ │
│              │   │  2/3 Width Left Column│ │
│              │   │  - Welcome Banner     │ │
│              │   │  - Quick Stats (1x4)  │ │
│              │   │  - Upcoming Exams     │ │
│              │   │  - Subject Chart      │ │
│              │   │  - Recent Results     │ │
│              │   └───────────────────────┘ │
│              │                             │
│              │   ┌───────────────────────┐ │
│              │   │  1/3 Width Right Col  │ │
│              │   │  - Quick Actions      │ │
│              │   │  - Best Subject Card  │ │
│              │   │  - Study Tips         │ │
│              │   │  - Top Performers     │ │
│              │   └───────────────────────┘ │
└──────────────┴─────────────────────────────┘
```

**Mobile** (sm: < 1024px):

- Sidebar collapses into hamburger menu (visible on md as overlay)
- Main content spans full width
- Two-column grid becomes single column
- Bottom navigation bar (4 icons: Dashboard, Practice, Results, More)

**Tablet** (md: 768px - 1024px):

- Sidebar collapses, hamburger menu visible
- Header and content still accessible
- Flexible grid items

**Desktop** (lg: 1024px+):

- Fixed 72 character width (w-72) sidebar always visible on left
- Main content has left margin (ml-72)
- Full three-column layout visible

---

## Component Specifications

### 1. Sidebar Navigation

**Container**:

- Fixed position, z-index 40, width 288px (w-72)
- Background: `bg-white/95 backdrop-blur-lg`
- Border: `border-r border-spiritual-200`
- Shadow: `shadow-strong`
- Mobile: Transforms off-screen, overlay controlled by Alpine.js

**Logo Section**:

- Height: 64-80px (py-4 sm:py-5)
- Contains icon badge (8-10px width, gradient bg) and text "Examine"
- Border bottom: `border-b border-spiritual-200`

**Navigation Items**:

- Structure: Icon (flex-shrink-0) + Text (flex-1)
- Icon size: 20px (w-5 h-5)
- Padding: `px-3 sm:px-4 py-2 sm:py-3`
- Active state: `bg-gradient-to-r from-primary-500 to-primary-600 text-white shadow-medium`
- Inactive state: `text-spiritual-700 hover:bg-spiritual-50`
- Text: font-medium, truncate on overflow
- Transition: `transition-all duration-300`

**Navigation Items**:

1. Dashboard (layout-dashboard icon)
2. My Exams (book-open icon)
3. Practice Tests (trophy icon)
4. Results (bar-chart-3 icon)
5. Performance (trending-up icon)
6. Subjects (layers icon)
7. [Divider line]
8. Settings (settings icon)
9. Help & Support (help-circle icon)

**Bottom Section**:

- Logout button with red hover state
- Background: `hover:bg-error-50 hover:text-error-600`

### 2. Top Header Bar

**Container**:

- Sticky top, z-index 30, full width
- Background: `bg-white/90 backdrop-blur-md`
- Border bottom: `border-b border-spiritual-200`
- Padding: `px-3 sm:px-6 lg:px-8 py-3 sm:py-4`

**Left Side**:

- Mobile menu toggle button (hidden on lg, visible on md)
- Page title (hidden on mobile, visible on lg)

**Center** (Spacer):

- Uses flex-1 for proper spacing

**Right Side Actions**:

- **Streak Counter**: Flame icon with number, background `from-warning-50 to-orange-50`, flame badge with gradient
- **Notifications Bell**:
    - Icon with red dot indicator
    - Dropdown menu on click (z-index 50)
    - Shows notification items with timestamp
- **User Avatar**:
    - Circular badge with gradient background `from-primary-500 to-secondary-500`
    - Initials inside, white text
    - Chevron icon on desktop (hidden on mobile)
    - Dropdown on click with Profile, Settings, Logout

### 3. Welcome Banner

**Container**:

- Full width, top of main content
- Background: `bg-gradient-to-r from-primary-500 to-secondary-600`
- Rounded: `rounded-2xl sm:rounded-3xl`
- Padding: `p-4 sm:p-6 md:p-7 lg:p-8`
- Text color: white
- Shadow: `shadow-strong`

**Content**:

- Left side: Heading (xl → 4xl depending on breakpoint) + subtitle
- Right side: Rocket icon (hidden on mobile, visible on md+), opacity-20

**Animation**:

- Alpine.js fade-in on component mount
- Staggered entrance with delay

### 4. Quick Stats Grid

**Container**:

- 4-column grid on lg: `grid-cols-1 sm:grid-cols-2 lg:grid-cols-4`
- Gap: `gap-3 sm:gap-4 lg:gap-6`

**Stat Card** (4 cards: Total Exams, Completed, Avg Score, Class Rank):

- Background: `bg-white/90 backdrop-blur-sm`
- Rounded: `rounded-xl sm:rounded-2xl`
- Padding: `p-3 sm:p-4 lg:p-6`
- Border: `border border-white/20`
- Shadow: `shadow-soft hover:shadow-medium`
- Transition: `transition-all duration-300`

**Card Layout**:

- Flex container: justify-between gap-2 sm:gap-3
- Left: Icon badge (8-12px, colored bg) + Text + Number
- Number: Largest font (xl → 4xl), bold, truncate
- Subtitle: Small text, colored (success/spiritual)
- Progress bar (only on Completed card): thin bar showing percentage

**Animation**:

- Each card has staggered delay (200ms, 300ms, 400ms, 500ms)

### 5. Main Content Sections

#### Upcoming Exams Card

**Container**:

- Background: `bg-white/90 backdrop-blur-sm`
- Rounded: `rounded-xl sm:rounded-2xl`
- Padding: `p-4 sm:p-5 lg:p-6`
- Border: `border border-white/20`

**Header**:

- Flex justify-between
- Title: lg → 2xl font-bold
- "View All" link with arrow icon

**Exam Items** (list):

- Border: `border border-spiritual-200 rounded-lg sm:rounded-xl`
- Padding: `p-3 sm:p-4`
- Hover: `hover:border-primary-300 hover:shadow-medium`

**Exam Item Content**:

- Title: Heading (sm → base font-semibold, line-clamp-2)
- Badges (scrollable on mobile):
    - Subject with book icon
    - Duration with clock icon
    - Question count with file-question icon
    - Connected with bullet separators
- Date: Small text "Scheduled: M d, Y - h:i A"
- Button: Full width gradient button "Start Exam"

**Empty State**:

- Calendar-x icon (lg size)
- Text: "No upcoming exams"
- Link: "Browse Practice Tests"

#### Subject Performance Chart

**Container**: Same styling as Upcoming Exams

**Chart Area**:

- Canvas element (subjectChart)
- Background: `from-spiritual-50 to-white` gradient
- Height: 200px canvas

**Chart Type**: Horizontal bar chart

- Subjects: Mathematics, English, Physics, Chemistry
- Shows scores as percentages
- Colors: Primary (blue), Secondary (magenta), Success (green), Warning (amber)
- Bars have rounded corners, border-width 2

**Stats Below Chart**:

- Grid 2 columns
- Overall Average: "80.75%"
- Week Improvement: "↑ 3.2%" in success-green color

#### Recent Results

**Container**: Same as above

**Result Items**:

- Flex container: status icon + info + score
- Status icon: Badge with check (success) or x-circle (error)
- Info: Title (truncate), timestamp (diffForHumans)
- Score: Large font, color based on percentage (≥70% green, <70% red)
- Percentage + fraction: "85% (85/100)"

### 6. Right Sidebar Sections

#### Quick Actions Card

**Header**: "Quick Actions"

**Action Items** (3 items: Practice, Results, Subjects):

- Flex: Icon badge + Text + Description
- Background: Default transparent, hover colored (primary-50, secondary-50, success-50)
- Icon badge: 8-10px size, colored background
- Text: Medium font, description below

#### Best Subject Card

**Background**: Gradient `from-warning-500 to-warning-600`

- Text: white
- Border radius: `rounded-xl sm:rounded-2xl`
- Padding: `p-4 sm:p-5 lg:p-6`

**Content**:

- Star icon + "Best Subject" heading
- Subject name: Large bold text
- Subtitle: "Keep up the great work!"

#### Study Tip Card

**Background**: `bg-white/90 backdrop-blur-sm`

- Lightbulb icon (primary color) + "Study Tip"
- Text: Small, leading-relaxed

#### Top Performers Leaderboard

**Background**: Same as other cards

**Header**: Medal icon + "Top Performers" + "Other Schools" badge

**Leaderboard Items** (5 items):

- Flex container: Badge + Info + Score
- Badge: Emoji (🥇🥈🥉) or number
    - Top 3 have gradient colored backgrounds
    - Rank 4-5: Primary-100 background
- Info: Name (truncate) + School name
- Score: Bold, colored by rank

### 7. Mobile Bottom Navigation

**Container**:

- Fixed bottom, z-index 50
- Full width, left-right 0
- Background: `bg-white/95 backdrop-blur-md`
- Border top: `border-t border-spiritual-200`
- Height: 80px (h-20)
- Hidden on lg+ (lg:hidden)

**Nav Items** (4 items: Dashboard, Practice, Results, More):

- Flex column: Icon + Text
- Icon: 24px (w-6 h-6)
- Text: 12px font-medium
- Centered in equal width containers
- Active: `text-primary-600`
- Inactive: `text-spiritual-600`
- Hover: `hover:text-primary-600`

---

## Animations & Interactions

### Page Load Animations

- Welcome banner: Fade-in from bottom with `opacity-0 translate-y-4` to `opacity-100 translate-y-0` over 500ms
- Stat cards: Staggered entrance delays (200ms, 300ms, 400ms, 500ms)
- Content sections: Fade-in scale effect on mount

### Hover States

- Cards: `translate-y-[-4px]` with enhanced shadow
- Buttons: Scale up slightly on hover (buttons have scale-105)
- Links: Color transition to darker shade
- Navigation items: Background color transition

### Dropdown Animations

- Notifications/User menu: Scale from 95% with opacity 0 to 100% opacity
- Duration: 200ms enter, 150ms exit
- Backdrop color for mobile sidebar: Fade in/out with backdrop blur

### Smooth Scrolling

- Overflow-y-auto on nav and dropdowns
- Custom scrollbar styling (6px width, slate colors)

---

## Data Structures & Props

### Dashboard Component Props

```
- stats: {
    total_exams: number,
    completed: number,
    average_score: number,
    total_time: string,
    best_subject: string,
    rank: number
  }
- upcomingExams: [{
    id: number,
    title: string,
    subject: string,
    duration: string,
    questions: number,
    scheduled_at: Date
  }]
- recentResults: [{
    exam: string,
    score: number,
    total: number,
    percentage: number,
    date: Date,
    status: 'passed' | 'failed'
  }]
- isLoading: boolean (shows skeleton loaders while data loads)
```

### Route Parameters

- Route name: `student.dashboard`
- URL: `/student/dashboard`
- Layout: Student layout (sidebar + header + bottom nav mobile)
- Title: "Dashboard - Examine CBT"

---

## Responsive Behavior

### Breakpoints Used

- **Mobile**: < 640px (sm)
- **Tablet**: 640px - 1024px (md)
- **Desktop**: 1024px+ (lg)

### Key Responsiveness Rules

1. **Sidebar**: Hidden on mobile/tablet (hamburger menu), fixed on desktop
2. **Header**: Simplified on mobile (no title), full on desktop
3. **Main Grid**:
    - Mobile: 1 column (all sections stack)
    - Tablet: 1 column with sidebar hidden
    - Desktop: 3 columns (2/3 left + 1/3 right)
4. **Stats Grid**:
    - Mobile: 1 column
    - Tablet: 2 columns
    - Desktop: 4 columns
5. **Bottom Nav**: Only visible on mobile/tablet, hidden on desktop
6. **Spacing**: Consistent scale-down on mobile (p-3 → p-4 → p-6, gap-3 → gap-5)

---

## Missing Pages to Create

Based on the sidebar navigation and exam platform requirements, the following React/Inertia pages need to be created:

### 1. **Student Dashboard** (✅ Current focus)

- Path: `resources/js/pages/student/Dashboard.tsx`
- Status: To be built
- Features: Stats overview, upcoming exams, results, quick actions

### 2. **My Exams Page**

- Path: `resources/js/pages/student/Exams.tsx`
- Features: List of all available exams with filters
- Layout: Similar card grid structure
- Sections: Upcoming, Practice, Completed

### 3. **Practice Tests Page**

- Path: `resources/js/pages/student/Practice.tsx`
- Features: Browse available practice tests by subject
- Layout: Grid of practice test cards
- Features: Subject filters, difficulty levels, duration

### 4. **Results Page**

- Path: `resources/js/pages/student/Results.tsx`
- Features: Detailed exam results with filtering
- Sections: Recent results table, filters by subject/date/status
- Sorting: By date, score, subject

### 5. **Performance Analytics Page**

- Path: `resources/js/pages/student/Performance.tsx`
- Features: Advanced analytics dashboard
- Charts: Line chart (progress over time), pie chart (subject breakdown), heatmap
- Metrics: Time spent, questions answered, accuracy rate

### 6. **Subjects Page**

- Path: `resources/js/pages/student/Subjects.tsx`
- Features: Browse all subjects
- Cards: Subject overview with progress bars
- Quick links: Recent tests, favorite topics

### 7. **Settings Page**

- Path: `resources/js/pages/student/Settings.tsx`
- Sections:
    - Account settings (email, password, profile)
    - Privacy & notifications
    - Study preferences
    - Theme/appearance

### 8. **Help & Support Page**

- Path: `resources/js/pages/student/Help.tsx`
- Sections:
    - FAQs accordion
    - Contact support form
    - Video tutorials
    - Knowledge base

### 9. **Mobile More Options Page** (Specific for mobile/tablet)

- Path: `resources/js/pages/student/MobileMore.tsx`
- Features: Additional menu items shown on mobile "More" tab
- Grid layout of quick links to all features
- Premium section

### 10. **Quiz/Exam Taker Page**

- Path: `resources/js/pages/student/ExamTaker.tsx`
- Features: Full-screen exam interface
- Layout: Questions on left, options on right (desktop) or full-width (mobile)
- Timer: Countdown display
- Navigation: Question selector sidebar
- Status: Current question highlighting

---

## Design Consistency Rules

1. **Color Usage**:
    - Primary (blue) = Main actions, active states
    - Secondary (magenta) = Accents, gradients with primary
    - Success (green) = Passed exams, completed
    - Warning (amber) = Streaks, rankings, special states
    - Error (red) = Failed exams, critical alerts
    - Spiritual (slate) = Neutral text, borders, disabled states

2. **Spacing Pattern**:
    - Always use responsive scale: `p-3 sm:p-4 lg:p-6`
    - Gaps follow same pattern: `gap-3 sm:gap-4 lg:gap-6`
    - Margins for sections: `space-y-5 sm:space-y-6 md:space-y-7 lg:space-y-8`

3. **Typography Pattern**:
    - Headings: `text-lg sm:text-xl lg:text-2xl` at minimum
    - Buttons: `text-sm sm:text-base`
    - Small text: `text-xs sm:text-sm`
    - Always include appropriate line clamping where needed

4. **Card Pattern**:
    - All cards: `bg-white/90 backdrop-blur-sm rounded-xl sm:rounded-2xl border border-white/20 shadow-soft`
    - Hover: `hover:shadow-medium transition-all duration-300`

5. **Interactive Pattern**:
    - Buttons: Gradient background with shadow, hover scale/shadow, active scale-down
    - Inputs: Border on focus, ring effect, no default outline
    - Transitions: 300ms ease default

6. **Accessibility**:
    - Color not sole identifier (use icons + color)
    - Sufficient contrast ratios (WCAG AA minimum)
    - Touch targets minimum 44x44px on mobile
    - Alt text for all icons/images

---

## Skeleton Loaders

Use reusable React skeleton components during data loading with a pulsing animation effect. Show skeletons when `isLoading` is true, fade to actual content when false (300ms transition).

### Reusable Skeleton Components

**Location**: `resources/js/components/ui/`

1. **SkeletonStatCard.tsx** - Single stat card placeholder
    - Square icon placeholder + large number bar + text bars
    - Reuse 4x for stats grid

2. **SkeletonExamCard.tsx** - Single exam/result item placeholder
    - Icon + title bar + info badges + button area
    - Reuse for exam lists and results

3. **SkeletonChart.tsx** - Chart section placeholder
    - Title bar + chart area with gradient + 4 placeholder bars + stats section

4. **SkeletonCard.tsx** - Generic card skeleton
    - Header + content lines (configurable count)
    - Use for Quick Actions, Study Tips, Leaderboard

### Skeleton Styling

- **Background**: `bg-spiritual-200`
- **Animation**: Pulse opacity (1.0 → 0.5 → 1.0) every 1.5s
- **Rounded**: Match real component radius
- **No shadows** during loading state

### Usage Pattern

```tsx
{isLoading ? (
  <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4 lg:gap-6">
    {[1, 2, 3, 4].map(i => <SkeletonStatCard key={i} />)}
  </div>
) : (
  // Actual stats cards
)}
```

---

## Chart.js Integration

**Subject Performance Chart** specifications:

- Type: Horizontal bar chart
- Data: 4 subjects with percentage scores
- Colors: Primary, Secondary, Success, Warning (different colors per bar)
- Styling:
    - Border radius: 8px on bars
    - Border width: 2px
    - Border skipped: false
    - Responsive: true
    - Aspect ratio: Maintained
- Legend: Hidden
- Tooltip: Custom with percentage suffix
- Grid: Minimal, light color
- Ticks: Custom formatting with % suffix

---

## Performance Considerations

1. **Lazy Loading**: Defer Chart.js loading until component mounts
2. **Image Optimization**: Use appropriate sizes for icons (SVG from Lucide)
3. **CSS**: Minimize repaints with backdrop-blur (GPU acceleration)
4. **State Management**: Use React context or Inertia for global state
5. **Pagination**: Implement for lists (Upcoming Exams, Recent Results) if > 5 items

## Implementation Notes

- Use React 19 with Inertia.js for page rendering
- Alpine.js for interactive elements (sidebar toggle, dropdowns)
- Lucide React for all icons
- Framer Motion for complex animations (if needed)
- Chart.js for data visualization
- TypeScript for type safety
- Tailwind CSS v3 for styling
- Responsive design: Mobile-first approach
