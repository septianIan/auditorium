<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="index3.html" class="brand-link">
        <span class="brand-text font-weight-bold">Auditorium UMM</span>
    </a>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @role('admin')
                    @include('template.components.menu.admin')
                @endrole
                @role('ketua')
                    @include('template.components.menu.ketua')
                @endrole
            <ul>
        </nav>
    </div>
</aside>