<div class="bg-light border-right" id="sidebar-wrapper">
    <div class="sidebar-heading">{{ Auth::user()->name }}</div>
    <div class="list-group list-group-flush">
        <a href="{{ route('admin.index') }}" class="list-group-item list-group-item-action bg-light {{ request()->is('admin') ? 'active-item' : '' }}">Dashboard</a>
        <a href="{{ route('admin.events') }}" class="list-group-item list-group-item-action bg-light {{ request()->is('admin/events', 'admin/edit/*', 'admin/create') ? 'active-item' : '' }}">Events</a>

        @if(auth()->user()->role == "admin" || auth()->user()->role == "super_admin")
        <a href="{{ route('admin.users') }}" class="list-group-item list-group-item-action bg-light {{ request()->is('admin/users', 'admin/add_user', 'admin/edit_user/*') ? 'active-item' : '' }}">Users</a>
        <a href="{{ route('admin.groups') }}" class="list-group-item list-group-item-action bg-light {{ request()->is('admin/groups', 'admin/add_groups') ? 'active-item' : '' }}">Groups</a>
        <a href="{{ route('admin.categories.index') }}" class="list-group-item list-group-item-action bg-light {{ request()->is('admin/categories', 'admin/categories/*', 'admin/questions', 'admin/questions/*') ? 'active-item' : '' }}">FAQ</a>
        @endif
    </div>
</div>