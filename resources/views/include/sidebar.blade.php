
<!-- Sidebar -->
<div class="sidebar">


    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
            <a href='{{ route('product.index') }}' class="nav-link">
              <i class="nav-icon fas fa-shopping-cart"></i>
              <p>Товары</p>
            </a>
        </li>
        <li class="nav-item">
            <a href='{{ route('category.index') }}' class="nav-link"> 
              <i class="nav-icon fas fa-list"></i>
              <p>Категории</p>
            </a>
        </li>
        <li class="nav-item">
            <a href='{{ route('order.index') }}' class="nav-link">
              <i class="nav-icon fas fa-pizza-slice"></i>
              <p>Заказы</p>
            </a>
        </li>
        <li class="nav-item">
            <a href='{{ route('user.index') }}' class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>Пользователи</p>
            </a>
        </li>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>