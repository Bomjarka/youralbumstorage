<div class="p-4 grid grid-cols-1 divide-y-2">
    <div>
        <a href="{{ route('admin') }}" class="text-white font-semibold hover:text-gray-300 uppercase lg:text-xl">
            {{ trans('admin-common.admin-tools') }}
        </a>
    </div>
    <div>
    </div>
</div>
<div class="links">
    <nav class="text-white text-base font-semibold pt-3">
        <a href="{{ route('adminDashboard') }}"
           class="flex items-center text-white py-4 pl-6 nav-item active-nav-link">
            <i class="fas fa-tachometer-alt mr-3"></i>
            {{ trans('admin-menu.dashboard') }}
        </a>
        <a href="{{ route('adminUsers') }}"
           class="flex items-center text-white hover:opacity-100 py-4 pl-6 nav-item active-nav-link">
            <i class="fas fa-sticky-note mr-3"></i>
            {{ trans('admin-menu.users') }}
        </a>
        <a href="{{ route('adminRoles') }}"
           class="flex items-center text-white hover:opacity-100 py-4 pl-6 nav-item active-nav-link">
            <i class="fas fa-table mr-3"></i>
            {{ trans('admin-menu.roles') }}
        </a>
        <a href="{{ route('adminForms') }}"
           class="flex items-center text-white hover:opacity-100 py-4 pl-6 nav-item active-nav-link">
            <i class="fas fa-align-left mr-3"></i>
            Forms
        </a>
        <a href="{{ route('adminCalendar') }}"
           class="flex items-center text-white hover:opacity-100 py-4 pl-6 nav-item active-nav-link">
            <i class="fas fa-calendar mr-3"></i>
            Calendar
        </a>
    </nav>
</div>
