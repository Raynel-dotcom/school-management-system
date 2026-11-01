{{--
    Grouped like the Campus Service Portal: section label, then the links that
    belong to it. Every link is wrapped in @can, so what a user sees matches
    what their role is allowed to reach. The routes themselves are guarded by
    permission middleware — this nav is a convenience, never the control.
--}}

<div class="mb-5 space-y-1">
    <p class="sidebar-section">Main</p>

    <a href="{{ route('dashboard') }}"
       class="sidebar-item group {{ request()->routeIs('dashboard') ? 'sidebar-item-active' : '' }}">
        <svg class="sidebar-icon" fill="none" stroke="currentColor" stroke-width="2"
             stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
            <rect x="3" y="3" width="7" height="9" rx="1"/><rect x="14" y="3" width="7" height="5" rx="1"/>
            <rect x="14" y="12" width="7" height="9" rx="1"/><rect x="3" y="16" width="7" height="5" rx="1"/>
        </svg>
        <span class="ms-3">Dashboard</span>
    </a>

    @can('view courses')
        <a href="{{ route('courses.index') }}"
           class="sidebar-item group {{ request()->routeIs('courses.*') ? 'sidebar-item-active' : '' }}">
            <svg class="sidebar-icon" fill="none" stroke="currentColor" stroke-width="2"
                 stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                <path d="M4 19.5A2.5 2.5 0 016.5 17H20"/>
                <path d="M6.5 2H20v20H6.5A2.5 2.5 0 014 19.5v-15A2.5 2.5 0 016.5 2z"/>
            </svg>
            <span class="ms-3">Courses</span>
        </a>
    @endcan
</div>

@canany(['manage students', 'manage registrations'])
    <div class="mb-5 space-y-1">
        <p class="sidebar-section">Administration</p>

        @can('manage students')
            <a href="{{ route('students.index') }}"
               class="sidebar-item group {{ request()->routeIs('students.*') ? 'sidebar-item-active' : '' }}">
                <svg class="sidebar-icon" fill="none" stroke="currentColor" stroke-width="2"
                     stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                    <path d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/>
                    <path d="M22 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/>
                </svg>
                <span class="ms-3">Students</span>
            </a>
        @endcan

        @can('manage registrations')
            <a href="{{ route('registrations.index') }}"
               class="sidebar-item group {{ request()->routeIs('registrations.*') ? 'sidebar-item-active' : '' }}">
                <svg class="sidebar-icon" fill="none" stroke="currentColor" stroke-width="2"
                     stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                    <rect x="8" y="2" width="8" height="4" rx="1"/>
                    <path d="M16 4h2a2 2 0 012 2v14a2 2 0 01-2 2H6a2 2 0 01-2-2V6a2 2 0 012-2h2"/>
                    <path d="M9 14l2 2 4-4"/>
                </svg>
                <span class="ms-3">Registrations</span>
            </a>
        @endcan
    </div>
@endcanany

@canany(['view assigned courses', 'view own registrations'])
    <div class="mb-5 space-y-1">
        <p class="sidebar-section">My Work</p>

        @can('view assigned courses')
            <a href="{{ route('teaching.index') }}"
               class="sidebar-item group {{ request()->routeIs('teaching.*') ? 'sidebar-item-active' : '' }}">
                <svg class="sidebar-icon" fill="none" stroke="currentColor" stroke-width="2"
                     stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                    <path d="M22 10L12 5 2 10l10 5 10-5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/>
                </svg>
                <span class="ms-3">Teaching</span>
            </a>
        @endcan

        @can('view own registrations')
            <a href="{{ route('my.courses') }}"
               class="sidebar-item group {{ request()->routeIs('my.courses') ? 'sidebar-item-active' : '' }}">
                <svg class="sidebar-icon" fill="none" stroke="currentColor" stroke-width="2"
                     stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                    <path d="M9 11l3 3L22 4"/>
                    <path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"/>
                </svg>
                <span class="ms-3">My Registrations</span>
            </a>
        @endcan
    </div>
@endcanany

<div class="space-y-1">
    <p class="sidebar-section">Account</p>

    <a href="{{ route('profile.edit') }}"
       class="sidebar-item group {{ request()->routeIs('profile.*') ? 'sidebar-item-active' : '' }}">
        <svg class="sidebar-icon" fill="none" stroke="currentColor" stroke-width="2"
             stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
            <circle cx="12" cy="12" r="3"/>
            <path d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 11-2.83 2.83l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 11-4 0v-.09A1.65 1.65 0 008 19.4a1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 11-2.83-2.83l.06-.06A1.65 1.65 0 004.6 15a1.65 1.65 0 00-1.51-1H3a2 2 0 110-4h.09A1.65 1.65 0 004.6 9a1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 112.83-2.83l.06.06A1.65 1.65 0 009 4.6a1.65 1.65 0 001-1.51V3a2 2 0 114 0v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.06-.06a2 2 0 112.83 2.83l-.06.06A1.65 1.65 0 0019.4 9v0a1.65 1.65 0 001.51 1H21a2 2 0 110 4h-.09a1.65 1.65 0 00-1.51 1z"/>
        </svg>
        <span class="ms-3">My Account</span>
    </a>
</div>
