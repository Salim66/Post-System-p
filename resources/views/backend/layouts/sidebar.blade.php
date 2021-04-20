@php
$prefix = Request::route()->getPrefix();
$route = Route::current()->getName();
@endphp
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link">
        <img src="{{ asset('backend/assets/dist/') }}/img/AdminLTELogo.png" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Dashboard</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ (Auth::user()->image) ? URL::to('/upload/user_images/'.Auth::user()->image) : URL::to('/upload/no-image-found.png') }}"
                    class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>


        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                @if(Auth::user()->userType == 'Admin')
                <li class="nav-item  {{ ($prefix == '/users')  ? 'menu-open' : ' ' }}">
                    <a href="#" class="nav-link {{ ($prefix == '/users')  ? 'active' : ' ' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Manage User
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('users.view') }}"
                                class="nav-link {{ ($route == 'users.view')  ? 'active' : ' ' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View User</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif
                <li class="nav-item {{ ($prefix == '/profiles')  ? 'menu-open' : ' ' }}">
                    <a href="#" class="nav-link {{ ($prefix == '/profiles')  ? 'active' : ' ' }}">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Manage Profile
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('profile.view') }}"
                                class="nav-link {{ ($route == 'profile.view')  ? 'active' : ' ' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View Profile</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('profile.password.change') }}"
                                class="nav-link {{ ($route == 'profile.password.change')  ? 'active' : ' ' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Change Password</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ ($prefix == '/suppliers')  ? 'menu-open' : ' ' }}">
                    <a href="#" class="nav-link {{ ($prefix == '/suppliers')  ? 'active' : ' ' }}">
                        <i class="nav-icon fab fa-supple"></i>
                        <p>
                            Manage Supplier
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('suppliers.view') }}"
                                class="nav-link {{ ($route == 'suppliers.view')  ? 'active' : ' ' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View Supplier</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ ($prefix == '/customers')  ? 'menu-open' : ' ' }}">
                    <a href="#" class="nav-link {{ ($prefix == '/customers')  ? 'active' : ' ' }}">
                        <i class="nav-icon fab fa-intercom"></i>
                        <p>
                            Manage Customers
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('customers.view') }}"
                                class="nav-link {{ ($route == 'customers.view')  ? 'active' : ' ' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View Customers</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ ($prefix == '/units')  ? 'menu-open' : ' ' }}">
                    <a href="#" class="nav-link {{ ($prefix == '/units')  ? 'active' : ' ' }}">
                        <i class="nav-icon fab fa-unity"></i>
                        <p>
                            Manage Units
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('units.view') }}"
                                class="nav-link {{ ($route == 'units.view')  ? 'active' : ' ' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View Units</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ ($prefix == '/categories')  ? 'menu-open' : ' ' }}">
                    <a href="#" class="nav-link {{ ($prefix == '/categories')  ? 'active' : ' ' }}">
                        <i class="nav-icon fab fa-cuttlefish"></i>
                        <p>
                            Manage Category
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('categories.view') }}"
                                class="nav-link {{ ($route == 'categories.view')  ? 'active' : ' ' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View Category</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ ($prefix == '/products')  ? 'menu-open' : ' ' }}">
                    <a href="#" class="nav-link {{ ($prefix == '/products')  ? 'active' : ' ' }}">
                        <i class="nav-icon fab fa-product-hunt"></i>
                        <p>
                            Manage Product
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('products.view') }}"
                                class="nav-link {{ ($route == 'products.view')  ? 'active' : ' ' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View Product</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ ($prefix == '/purchases')  ? 'menu-open' : ' ' }}">
                    <a href="#" class="nav-link {{ ($prefix == '/purchases')  ? 'active' : ' ' }}">
                        <i class="nav-icon fas fa-store"></i>
                        <p>
                            Manage Purchase
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('purchases.view') }}"
                                class="nav-link {{ ($route == 'purchases.view')  ? 'active' : ' ' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View Purchase</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('purchases.pending.list') }}"
                                class="nav-link {{ ($route == 'purchases.pending.list')  ? 'active' : ' ' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Purchase Pending List</p>
                            </a>
                        </li>
                    </ul>
                </li>



            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>