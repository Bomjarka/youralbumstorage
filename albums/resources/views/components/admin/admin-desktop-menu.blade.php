<div class="p-6 ">
    <a href="{{ route('admin') }}" class="text-white text-3xl font-semibold uppercase hover:text-gray-300">
        Admin Tools
    </a>
    <button
        class="w-full bg-white cta-btn font-semibold py-2 mt-5 rounded-br-lg rounded-bl-lg rounded-tr-lg shadow-lg hover:shadow-xl hover:bg-gray-300 flex items-center justify-center">
        <i class="fas fa-plus mr-3"></i> New Report
    </button>
</div>
<div class="links">
    <nav class="text-white text-base font-semibold pt-3">
        <a href="{{ route('adminDashboard') }}"
           class="flex items-center text-white py-4 pl-6 nav-item active-nav-link">
            <i class="fas fa-tachometer-alt mr-3"></i>
            Dashboard
        </a>
        <a href="{{ route('adminBlank') }}"
           class="flex items-center text-white hover:opacity-100 py-4 pl-6 nav-item active-nav-link">
            <i class="fas fa-sticky-note mr-3"></i>
            Blank Page
        </a>
        <a href="{{ route('adminUsers') }}"
           class="flex items-center text-white hover:opacity-100 py-4 pl-6 nav-item active-nav-link">
            <i class="fas fa-sticky-note mr-3"></i>
            Users
        </a>
        <a href="{{ route('adminRoles') }}"
           class="flex items-center text-white hover:opacity-100 py-4 pl-6 nav-item active-nav-link">
            <i class="fas fa-table mr-3"></i>
            Roles
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
