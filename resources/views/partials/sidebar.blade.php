@php
  $route = \Route::currentRouteName()
@endphp

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    
    <a href="index3.html" class="brand-link">
        <img src="{{ asset('img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex text-white">
            <div class="image">
                Main Navigation
                {{-- <img src="{{ asset('img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image"> --}}
            </div>
            <div class="info">
                {{-- <a href="#" class="d-block">Alexander Pierce</a> --}}
            </div>
        </div>


        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>


                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-pen-square nav-icon"></i>
                        <p>
                            Booking
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="pages/tables/simple.html" class="nav-link">
                                <i class="fa fa-eye nav-icon"></i>
                                <p>View Booking Season</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item {{ ($route == 'quotes.index' || $route == 'quotes.create' || $route == 'users.edit' || $route == 'roles.index' || $route == 'roles.create') || $route == 'roles.edit' ? 'menu-open': '' }}">
                    <a href="#" class="nav-link">
                        <i class="fas fa-file nav-icon"></i>
                        <p>
                            Quote Management
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('quotes.create') }}" class="nav-link {{ $route == 'quotes.create' ? 'active' : '' }}">
                                <i class="fa fa-plus nav-icon"></i>
                                <p>Add Quote</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/tables/simple.html" class="nav-link">
                                <i class="fa fa-eye nav-icon"></i>
                                <p>View Quote</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fa fa-clone nav-icon"></i>
                        <p>
                            Template Management
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fa fa-plus nav-icon"></i>
                                <p>Add Template</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/tables/simple.html" class="nav-link">
                                <i class="fa fa-eye nav-icon"></i>
                                <p>View Template</p>
                            </a>
                        </li>
                    </ul>
                </li>
               
                <li class="nav-item {{ ($route == 'seasons.index' || $route == 'seasons.create' || $route == 'seasons.edit') ? 'menu-open': '' }}">
                    <a href="#" class="nav-link">
                        <i class="fa fa-cloud nav-icon"></i>
                        <p>
                            Season Management
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('seasons.create') }}"  class="nav-link {{ $route == 'seasons.create' ? 'active' : ''}} ">
                                <i class="fa fa-plus nav-icon"></i>
                                <p>Add Season</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('seasons.index') }}" class="nav-link {{ $route == 'seasons.index' || $route == 'seasons.edit'  ? 'active' : ''}} ">
                                <i class="fa fa-eye nav-icon"></i>
                                <p>View Season</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item {{ ($route == 'users.index' || $route == 'users.create' || $route == 'users.edit' || $route == 'roles.index' || $route == 'roles.create') || $route == 'roles.edit' ? 'menu-open': '' }}">
                    <a href="#" class="nav-link">
                        <i class="fa fa-user nav-icon"></i>
                        <p>
                            User Management
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('users.create') }}" class="nav-link {{ $route == 'users.create' ? 'active' : ''}} ">
                                <i class="fa fa-plus nav-icon"></i>
                                <p>Add User</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('users.index') }}" class="nav-link {{  $route == 'users.index' || $route == 'users.edit' ? 'active' : '' }}">
                                <i class="fa fa-eye nav-icon"></i>
                                <p>View User</p>
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a href="{{ route('roles.create')}}" class="nav-link {{ $route == 'roles.create' ? 'active' : ''}}">
                                <i class="fa fa-plus nav-icon"></i>
                                <p>Add Role</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('roles.index')}}" class="nav-link {{ $route == 'roles.index' || $route == 'roles.edit' ? 'active' : ''}}">
                                <i class="fa fa-eye nav-icon"></i>
                                <p>View Role</p>
                            </a>
                        </li>
                    </ul>
                </li>
 

             
               
                <li class="nav-item {{ $route == 'setting.airlines.index' || $route == 'setting.airlines.create' || $route == 'setting.airlines.edit' || $route == 'setting.payment_methods.index' || $route == 'setting.payment_methods.create' || $route == 'setting.payment_methods.edit' || $route == 'setting.booking_methods.index' || $route == 'setting.booking_methods.create' || $route == 'setting.booking_methods.edit' || $route == 'setting.brands.index' || $route == 'setting.brands.create' || $route == 'setting.brands.edit' || $route == 'setting.holidaytypes.index' || $route == 'setting.holidaytypes.create' || $route == 'setting.holidaytypes.edit' ? 'menu-open': '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-cog"></i>
                        <p>
                            Setting
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item {{ $route == 'setting.airlines.index' || $route == 'setting.airlines.create' || $route == 'setting.airlines.edit' ? 'menu-open': '' }}">
                            <a href="#" class="nav-link {{ $route == 'setting.airlines.index' || $route == 'setting.airlines.create' || $route == 'setting.airlines.edit' ? 'setting-child-active' : '' }}">
                                <i class="fa fa-plane nav-icon"></i>
                                <p>
                                    Airline
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('setting.airlines.create') }}" class="nav-link {{ $route == 'setting.airlines.create' ? 'active' : '' }}">
                                        <i class="fa fa-plus nav-icon"></i>
                                        <p>Add Airline</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('setting.airlines.index') }}" class="nav-link {{ $route == 'setting.airlines.index' || $route == 'setting.airlines.edit' ? 'active' : '' }}">
                                        <i class="fa fa-eye nav-icon"></i>
                                        <p>View Airline</p>
                                    </a>
                                </li>

                            </ul>
                        </li>

                        <li class="nav-item {{ $route == 'setting.payment_methods.index' || $route == 'setting.payment_methods.create' || $route == 'setting.payment_methods.edit' ? 'menu-open': '' }}">
                            <a href="#" class="nav-link {{ $route == 'setting.payment_methods.index' || $route == 'setting.payment_methods.create' || $route == 'setting.payment_methods.edit' ? 'setting-child-active' : '' }}">
                                <i class="fas fa-money-check-alt nav-icon"></i>
                                <p>
                                    Payment Method
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('setting.payment_methods.create') }}" class="nav-link {{ $route == 'setting.payment_methods.create' ? 'active' : '' }}">
                                        <i class="fa fa-plus nav-icon"></i>
                                        <p>Add Payment Method</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('setting.payment_methods.index') }}" class="nav-link {{ $route == 'setting.payment_methods.index' || $route == 'setting.payment_methods.edit' ? 'active' : '' }}">
                                        <i class="fa fa-eye nav-icon"></i>
                                        <p>View Payment Method</p>
                                    </a>
                                </li>

                            </ul>
                        </li>

                        <li class="nav-item {{ $route == 'setting.booking_methods.index' || $route == 'setting.booking_methods.create' || $route == 'setting.booking_methods.edit' ? 'menu-open': '' }}">
                            <a href="#" class="nav-link {{ $route == 'setting.booking_methods.index' || $route == 'setting.booking_methods.create' || $route == 'setting.booking_methods.edit' ? 'setting-child-active' : '' }}">
                                <i class="fas fa-pen-square nav-icon"></i>
                                <p>
                                    Booking Method
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('setting.booking_methods.create') }}" class="nav-link {{ $route == 'setting.booking_methods.create' ? 'active' : '' }}">
                                        <i class="fa fa-plus nav-icon"></i>
                                        <p>Add Booking Method</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('setting.booking_methods.index') }}" class="nav-link {{ $route == 'setting.booking_methods.index' || $route == 'setting.booking_methods.edit' ? 'active' : '' }}">
                                        <i class="fa fa-eye nav-icon"></i>
                                        <p>View Booking Method</p>
                                    </a>
                                </li>

                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fas fa-money-bill-alt nav-icon"></i>
                                <p>
                                    Currency
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="fa fa-plus nav-icon"></i>
                                        <p>Add Currency</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="fa fa-eye nav-icon"></i>
                                        <p>View Currency</p>
                                    </a>
                                </li>

                            </ul>
                        </li>

                        <li class="nav-item {{ $route == 'setting.brands.index' || $route == 'setting.brands.create' || $route == 'setting.brands.edit' ? 'menu-open': '' }}">
                            <a href="#" class="nav-link {{ $route == 'setting.brands.index' || $route == 'setting.brands.create' || $route == 'setting.brands.edit' ? 'setting-child-active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Brand
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('setting.brands.create') }}" class="nav-link {{ $route == 'setting.brands.create' ? 'active' : '' }}">
                                        <i class="fa fa-plus nav-icon"></i>
                                        <p>Add Brand</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('setting.brands.index') }}" class="nav-link {{ $route == 'setting.brands.index' || $route == 'setting.brands.edit' ? 'active' : '' }}">
                                        <i class="fa fa-eye nav-icon"></i>
                                        <p>View Brand</p>
                                    </a>
                                </li>

                            </ul>
                        </li>

                        <li class="nav-item {{ $route == 'setting.holidaytypes.index' || $route == 'setting.holidaytypes.create' || $route == 'setting.holidaytypes.edit' ? 'menu-open': '' }}">
                            <a href="#" class="nav-link {{ $route == 'setting.holidaytypes.index' || $route == 'setting.holidaytypes.create' || $route == 'setting.holidaytypes.edit' ? 'setting-child-active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Holiday Type
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('setting.holidaytypes.create') }}" class="nav-link {{ $route == 'setting.holidaytypes.create' ? 'active' : '' }}">
                                        <i class="fa fa-plus nav-icon"></i>
                                        <p>Add Holiday Type</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('setting.holidaytypes.index') }}" class="nav-link {{ $route == 'setting.holidaytypes.index' || $route == 'setting.holidaytypes.edit' ? 'active' : '' }}">
                                        <i class="fa fa-eye nav-icon"></i>
                                        <p>View Holiday Type</p>
                                    </a>
                                </li>

                            </ul>
                        </li>

                 

                    </ul>
                </li>

            </ul>
        </nav>
        
    </div>
    
</aside>
