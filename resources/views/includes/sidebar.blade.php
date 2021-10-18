@php
  $route = \Route::currentRouteName()
@endphp

<aside class="main-sidebar sidebar-dark-primary elevation-4">

    {{-- <a href="{{ route('dashboard.index') }}" class="brand-link d-xs-none ">
        <img src="{{ asset('img/logo.png') }}" >
    </a>
    <a href="{{ route('dashboard.index') }}" class="brand-link d-md-none">
        <img src="{{ asset('img/fav-icon.png') }}" >
    </a> --}}


    <li class="nav-item nav-sidebar flex-column ">
        <a href="{{ route('dashboard.index') }}" class="nav-link  brand-link  {{ $route == 'dashboard.index' ? 'active' : '' }}">
            <div class="d-flex">
                <img src="{{ asset('img/fa.png') }}" class="ml-2" >
                <p>
                    <img src="{{ asset('img/logo.png') }}" >
                </p>
            </div>
        </a>
    </li>

    {{-- <a href="/docs/3.0/index.html" class="brand-link logo-switch">
        <img src="{{ asset('img/fav-icon.png') }}"  alt="AdminLTE Docs Logo Small" class="brand-image-xl logo-xs">
        <img src="{{ asset('img/logo.png') }}"  style="width: 218px;" alt="AdminLTE Docs Logo Large" class="brand-image-xs logo-xl" style="left: 12px">
    </a> --}}

    <div class="sidebar">
        {{-- <!-- Sidebar user panel (optional) --> --}}
        {{-- <div class="user-panel mt-1 pb-3 mb-3 d-flex text-white">
            <div class="image">
                Main Navigation
                <img src="{{ asset('img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Welcome, {{ ucfirst(auth()->user()->name) }}</a>
            </div>
        </div> --}}


        <nav>
            <ul class="nav nav-pills nav-sidebar flex-column mt-1" data-widget="treeview" role="menu"
                data-accordion="false">

                <li class="nav-item">
                    <a href="{{ route('dashboard.index') }}" class="nav-link  {{ $route == 'dashboard.index' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('bookings.index') }}" class="nav-link {{ $route == 'bookings.view.seasons' || $route == 'bookings.index' || $route == 'bookings.edit' || $route == 'bookings.version' || $route == 'bookings.show' ? 'active' : '' }}">
                        <i class="fas fa-pen-square nav-icon"></i>
                        <p>Bookings</p>
                    </a>
                </li>

                {{-- <li class="nav-item {{ $route == 'bookings.view.seasons' || $route == 'bookings.index' || $route == 'bookings.edit' || $route == 'bookings.version' || $route == 'bookings.show' ? 'menu-open': '' }}">
                    <a href="#" class="nav-link">
                        <i class="fas fa-pen-square nav-icon"></i>
                        <p>
                            Booking
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('bookings.view.seasons') }}" class="nav-link {{ $route == 'bookings.view.seasons' || $route == 'bookings.index' || $route == 'bookings.edit' || $route == 'bookings.version' || $route == 'bookings.show' ? 'active' : '' }}">
                                <i class="fa fa-eye nav-icon"></i>
                                <p>View Booking Season</p>
                            </a>
                        </li>
                    </ul>
                </li> --}}

                <li class="nav-item {{ $route == 'quotes.index' || $route == 'quotes.view.trash' || $route == 'quotes.create'  || $route == 'quotes.edit' || $route == 'roles.index' || $route == 'roles.create' || $route == 'roles.edit' || $route == 'quotes.view.version' || $route == 'quotes.final' || $route == 'quotes.archive' || $route == 'quotes.group-quote.index' || $route == 'quotes.group-quote.edit' || $route == 'quotes.group-quote.create' || $route == 'quotes.quote.documment' ? 'menu-open': '' }}">
                    <a href="#" class="nav-link">
                        <i class="fas fa-file nav-icon"></i>
                        <p>
                            Quote Management
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="{{ route('quotes.index') }}" class="nav-link {{ $route == 'quotes.index' || $route == 'quotes.edit' || $route == 'quotes.view.version' || $route == 'quotes.final' || $route == 'quotes.quote.documment' ? 'active' : '' }}">
                                <i class="fa fa-eye nav-icon"></i>
                                <p>View Quote</p>
                            </a>
                        </li>
                        {{-- <li class="nav-item">
                            <a href="{{ route('quotes.view.trash') }}" class="nav-link {{ $route == 'quotes.view.trash' ? 'active' : '' }}">
                                  <i class="fa fa-window-close nav-icon"></i>
                                <p>Cancel Quote</p>
                            </a>
                        </li> --}}
                        <li class="nav-item">
                            <a href="{{ route('quotes.archive') }}" class="nav-link {{ $route == 'quotes.view.archive' || $route == 'quotes.archive' ? 'active' : '' }}">
                                <i class="fa fa-archive nav-icon"></i>
                                <p>Archived</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('quotes.group-quote.index') }}" class="nav-link {{ $route == 'quotes.group-quote.index' || $route == 'quotes.group-quote.create' || $route == 'quotes.group-quote.edit' ? 'active' : '' }}">
                                <i class="nav-icon far fa-circle"></i>
                                <p>View Group Quote</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="{{ route('customers.index') }}" class="nav-link {{ $route == 'customers.index' || $route == 'customers.quote.listing' || $route == 'customers.booking.listing'  ? 'active' : '' }}">
                        <i class="fa fa-user nav-icon"></i>
                        <p>Customers</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('templates.index') }}" class="nav-link {{ $route == 'templates.index' || $route == 'templates.edit' || $route == 'templates.create' ? 'active' : '' }}">
                        <i class="fa fa-clone nav-icon"></i>
                        <p>Templates</p>
                    </a>
                </li>
                {{-- <li class="nav-item {{  $route == 'templates.index' || $route == 'templates.create' || $route == 'templates.edit'  ? 'menu-open': '' }}">
                    <a href="#" class="nav-link">
                        <i class="fa fa-clone nav-icon"></i>
                        <p>
                            Template Management
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="{{ route('templates.index') }}"class="nav-link {{ $route == 'templates.index' || $route == 'templates.edit'  ? 'active' : '' }}">
                                <i class="fa fa-eye nav-icon"></i>
                                <p>View Template</p>
                            </a>
                        </li>
                    </ul>
                </li> --}}



                {{-- <li class="nav-item {{ ($route == 'seasons.index' || $route == 'seasons.create' || $route == 'seasons.edit') ? 'menu-open': '' }}">
                    <a href="#" class="nav-link">
                        <i class="fa fa-cloud nav-icon"></i>
                        <p>
                            Season Management
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="{{ route('seasons.index') }}" class="nav-link {{ $route == 'seasons.index' || $route == 'seasons.edit'  ? 'active' : '' }}">
                                <i class="fa fa-eye nav-icon"></i>
                                <p>View Season</p>
                            </a>
                        </li>
                    </ul>
                </li> --}}
                @if(Auth::user()->hasAdmin())

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
                                <a href="{{ route('users.index') }}" class="nav-link {{  $route == 'users.index' || $route == 'users.edit' ? 'active' : '' }}">
                                    <i class="fa fa-eye nav-icon"></i>
                                    <p>View User</p>
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

                    <li class="nav-item {{ $route == 'commissions.commission.index' || $route == 'commissions.commission.create' || $route == 'commissions.commission.edit' ||  $route == 'commissions.commission-group.index' || $route == 'commissions.commission-group.create' || $route == 'commissions.commission-group.edit' || $route == 'commissions.commission-criteria.index' || $route == 'commissions.commission-criteria.create' || $route == 'commissions.commission-criteria.edit' ? 'menu-open': '' }}">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-percentage"></i>
                            <p>
                                Commision Management
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">

                            <li class="nav-item">
                                <a href="{{ route('commissions.commission.index') }}" class="nav-link {{ $route == 'commissions.commission.index' || $route == 'commissions.commission.create' || $route == 'commissions.commission.edit' ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-percentage"></i>
                                    <p>
                                        Commissions
                                    </p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('commissions.commission-group.index') }}" class="nav-link {{ $route == 'commissions.commission-group.index' || $route == 'commissions.commission-group.create' || $route == 'commissions.commission-group.edit'  ? 'active' : '' }}">
                                    <i class="nav-icon far fa-circle"></i>
                                    <p>
                                        Commission Groups
                                    </p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('commissions.commission-criteria.index') }}" class="nav-link {{ $route == 'commissions.commission-criteria.index' || $route == 'commissions.commission-criteria.create' || $route == 'commissions.commission-criteria.edit' ? 'active' : '' }}">
                                    <i class="nav-icon far fa-circle"></i>
                                    <p>
                                        Commission Criteria
                                    </p>
                                </a>
                            </li>

                        </ul>
                    </li>
                @endif

                <li class="nav-item {{ ($route == 'suppliers.index' || $route == 'suppliers.create' || $route == 'suppliers.edit' || $route == 'suppliers.index' || $route == 'products.create') || $route == 'products.edit' || $route == 'products.index'  || $route == 'categories.create' || $route == 'categories.index' || $route == 'categories.edit' || $route == 'wallets.index' || $route == 'supplier-rate-sheet.create' || $route == 'supplier-rate-sheet.index' || $route == 'supplier-rate-sheet.edit' ? 'menu-open': '' }}">
                    <a href="#" class="nav-link">
                        <i class="fa fa-user nav-icon"></i>
                        <p>
                            Supplier Management
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="{{ route('suppliers.index') }}" class="nav-link {{  $route == 'suppliers.create' || $route == 'suppliers.index' || $route == 'suppliers.edit' ? 'active' : '' }}">
                                <i class="fa fa-eye nav-icon"></i>
                                <p>View Supplier</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('supplier-rate-sheet.index') }}" class="nav-link {{  $route == 'supplier-rate-sheet.create' || $route == 'supplier-rate-sheet.index' || $route == 'supplier-rate-sheet.edit' ? 'active' : '' }}">
                                <i class="fa fa-eye nav-icon"></i>
                                <p>Supplier Rate Sheet</p>
                            </a>
                        </li>


                        <li class="nav-item">
                            <a href="{{ route('products.index')}}" class="nav-link {{ $route == 'products.create' || $route == 'products.index' || $route == 'products.edit' ? 'active' : ''}}">
                                <i class="fa fa-eye nav-icon"></i>
                                <p>View Product</p>
                            </a>
                        </li>



                        <li class="nav-item">
                            <a href="{{ route('categories.index')}}" class="nav-link {{ $route == 'categories.create' || $route == 'categories.index' || $route == 'categories.edit' ? 'active' : ''}}">
                                <i class="fa fa-eye nav-icon"></i>
                                <p>View Category</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('wallets.index') }}" class="nav-link {{ $route == 'wallets.index' ? 'active' : '' }}">
                                <i class="fas fa-wallet nav-icon"></i>
                                <p>Wallet</p>
                            </a>
                        </li>
                    </ul>
                </li>




                @if(Auth::user()->hasAdmin())
                <li class="nav-item {{ $route == 'setting.airlines.index' || $route == 'setting.airlines.create' || $route == 'setting.airlines.edit' || $route == 'setting.payment_methods.index' || $route == 'setting.payment_methods.create' || $route == 'setting.payment_methods.edit' || $route == 'setting.booking_methods.index' || $route == 'setting.booking_methods.create' || $route == 'setting.booking_methods.edit' || $route == 'setting.brands.index' || $route == 'setting.brands.create' || $route == 'setting.brands.edit' || $route == 'setting.holidaytypes.index' || $route == 'setting.holidaytypes.create' || $route == 'setting.holidaytypes.edit' || $route == 'setting.currencies.index' || $route == 'setting.currencies.create' || $route == 'setting.currencies.edit' || $route == 'setting.currency_conversions.index' || $route == 'setting.currency_conversions.edit' || $route ==  'store.texts.create' || $route ==  'store.texts.index' || $route ==  'store.texts.edit' ? 'menu-open': '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-cog"></i>
                        <p>
                            Setting
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="{{ route('seasons.index') }}" class="nav-link {{ $route == 'seasons.index' || $route == 'seasons.edit'  ? 'active' : '' }}">
                                <i class="fa fa-cloud nav-icon"></i>
                                <p>Seasons</p>
                            </a>
                        </li>

                        {{-- <li class="nav-item {{ $route == 'setting.airlines.index' || $route == 'setting.airlines.create' || $route == 'setting.airlines.edit' ? 'menu-open': '' }}">
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
                        </li> --}}

                        {{-- <li class="nav-item">
                            <a href="{{ route('setting.airlines.index') }}" class="nav-link {{ $route == 'setting.airlines.index' || $route == 'setting.airlines.create' || $route == 'setting.airlines.edit' ? 'active' : '' }}">
                                <i class="nav-icon fa fa-plane"></i>
                                <p>
                                    Airlines
                                </p>
                            </a>
                        </li> --}}

                        {{-- <li class="nav-item {{ $route == 'setting.payment_methods.index' || $route == 'setting.payment_methods.create' || $route == 'setting.payment_methods.edit' ? 'menu-open': '' }}">
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
                        </li> --}}

                        <li class="nav-item">
                            <a href="{{ route('setting.payment_methods.index') }}" class="nav-link {{ $route == 'setting.payment_methods.index' || $route == 'setting.payment_methods.create' || $route == 'setting.payment_methods.edit' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-money-check-alt"></i>
                                <p>
                                    Payment Methods
                                </p>
                            </a>
                        </li>

                        {{-- <li class="nav-item {{ $route == 'setting.booking_methods.index' || $route == 'setting.booking_methods.create' || $route == 'setting.booking_methods.edit' ? 'menu-open': '' }}">
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
                        </li> --}}

                        {{-- <li class="nav-item">
                            <a href="{{ route('setting.booking_methods.index') }}" class="nav-link {{ $route == 'setting.booking_methods.index' || $route == 'setting.booking_methods.create' || $route == 'setting.booking_methods.edit' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-pen-square"></i>
                                <p>
                                    Booking Methods
                                </p>
                            </a>
                        </li> --}}

                        {{-- <li class="nav-item {{ $route == 'setting.currencies.index' || $route == 'setting.currencies.create' || $route == 'setting.currencies.edit' ? 'menu-open': '' }}">
                            <a href="#" class="nav-link {{ $route == 'setting.currencies.index' || $route == 'setting.currencies.create' || $route == 'setting.currencies.edit' ? 'setting-child-active' : '' }}">
                                <i class="fas fa-money-bill-alt nav-icon"></i>
                                <p>
                                    Currency
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('setting.currencies.create') }}" class="nav-link {{ $route == 'setting.currencies.create' ? 'active' : '' }}">
                                        <i class="fa fa-plus nav-icon"></i>
                                        <p>Add Currency</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('setting.currencies.index') }}" class="nav-link {{ $route == 'setting.currencies.index' || $route == 'setting.currencies.edit' ? 'active' : '' }}">
                                        <i class="fa fa-eye nav-icon"></i>
                                        <p>View Currency</p>
                                    </a>
                                </li>

                            </ul>
                        </li> --}}

                        <li class="nav-item">
                            <a href="{{ route('setting.currencies.index') }}" class="nav-link {{ $route == 'setting.currencies.index' || $route == 'setting.currencies.create' || $route == 'setting.currencies.edit' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-money-bill-alt"></i>
                                <p>
                                    Currencies
                                </p>
                            </a>
                        </li>

                        {{-- <li class="nav-item {{ $route == 'setting.brands.index' || $route == 'setting.brands.create' || $route == 'setting.brands.edit' ? 'menu-open': '' }}">
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
                        </li> --}}

                        <li class="nav-item">
                            <a href="{{ route('setting.brands.index') }}" class="nav-link {{ $route == 'setting.brands.index' || $route == 'setting.brands.create' || $route == 'setting.brands.edit' ? 'active' : '' }}">
                                <i class="nav-icon far fa-circle"></i>
                                <p>
                                    Brands
                                </p>
                            </a>
                        </li>


                        {{-- <li class="nav-item {{ $route == 'setting.holidaytypes.index' || $route == 'setting.holidaytypes.create' || $route == 'setting.holidaytypes.edit' ? 'menu-open': '' }}">
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
                        </li> --}}

                        <li class="nav-item">
                            <a href="{{ route('setting.holidaytypes.index') }}" class="nav-link {{ $route == 'setting.holidaytypes.index' || $route == 'setting.holidaytypes.create' || $route == 'setting.holidaytypes.edit' ? 'active' : '' }}">
                                <i class="nav-icon far fa-circle"></i>
                                <p>
                                    Holiday Types
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('setting.banks.index') }}" class="nav-link {{ $route == 'setting.banks.index' || $route == 'setting.banks.create' || $route == 'setting.banks.edit' ? 'active' : '' }}">
                                <i class="nav-icon far fa-circle"></i>
                                <p>
                                    Banks
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a  href="{{ route('setting.currency_conversions.index') }}" class="nav-link {{ $route == 'setting.currency_conversions.index' || $route == 'setting.currency_conversions.edit' ? 'active' : '' }}">
                                <i class="fas fa-money-bill-alt nav-icon"></i>
                                <p>
                                    View Currency Rate
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('store.texts.index') }}" class="nav-link {{ $route == 'store.texts.index' || $route == 'store.texts.create' || $route == 'store.texts.edit'  ? 'active' : '' }}">
                                <i class="fa fa-file-word nav-icon" aria-hidden="true"></i>
                                <p>Stored Text</p>
                            </a>
                        </li>

                    </ul>
                </li>
                @endif

                <li class="nav-item">
                    <a href="{{ route('supplier-bulk-payments.index') }}" class="nav-link {{ $route == 'supplier-bulk-payments.index' ? 'active' : '' }}">
                        <i class="nav-icon far fa-circle"></i>
                        <p>Supplier Bulk Payments Report</p>
                    </a>
                </li>

                <li class="nav-item {{ $route == 'reports.user.report' || $route == 'reports.activity.by.user' || $route == 'reports.supplier.report' || $route == 'reports.wallet.report' || $route == 'reports.quote.report' || $route == 'reports.customer.report' || $route == 'reports.payment.method.report' ||  $route == 'reports.refund.by.bank.report' || $route == 'reports.refund.by.credit.note.report' || $route == 'reports.transfer.report' || $route == 'reports.commission.report' ? 'menu-open': '' }}">
                    <a href="#" class="nav-link">
                        <i class="fa fa-chart-bar nav-icon"></i>
                        <p>
                            Reports
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if(Auth::user()->hasAdmin())
                            <li class="nav-item">
                                <a href="{{ route('reports.commission.report') }}" class="nav-link {{  $route == 'reports.commission.report' ? 'active' : '' }}">
                                    <i class="nav-icon far fa-circle"></i>
                                    <p>Commision Report</p>
                                </a>
                            </li>
                        @endif

                        <li class="nav-item">
                            <a href="{{ route('reports.transfer.report') }}" class="nav-link {{  $route == 'reports.transfer.report' ? 'active' : '' }}">
                                <i class="nav-icon far fa-circle"></i>
                                <p>Transfer Report</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('reports.user.report') }}" class="nav-link {{  $route == 'reports.user.report' ? 'active' : '' }}">
                                <i class="nav-icon far fa-circle"></i>
                                <p>User Report</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('reports.activity.by.user') }}" class="nav-link {{  $route == 'reports.activity.by.user' ? 'active' : '' }}">
                                <i class="nav-icon far fa-circle"></i>
                                <p>Activity By User</p>
                            <a href="{{ route('reports.supplier.report') }}" class="nav-link {{  $route == 'reports.supplier.report' ? 'active' : '' }}">
                                <i class="nav-icon far fa-circle"></i>
                                <p>Supplier Report</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('reports.wallet.report') }}" class="nav-link {{  $route == 'reports.wallet.report' ? 'active' : '' }}">
                                <i class="nav-icon far fa-circle"></i>
                                <p>Wallet Report</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('reports.quote.report') }}" class="nav-link {{  $route == 'reports.quote.report' ? 'active' : '' }}">
                                <i class="nav-icon far fa-circle"></i>
                                <p>Quote Report</p>
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a href="{{ route('reports.customer.report') }}" class="nav-link {{ $route == 'reports.customer.report' ? 'active' : '' }}">
                                <i class="nav-icon far fa-circle"></i>
                                <p>Customer Report</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('reports.payment.method.report') }}" class="nav-link {{ $route == 'reports.payment.method.report' ? 'active' : '' }}">
                                <i class="nav-icon far fa-circle"></i>
                                <p>Payment Method Report</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('reports.refund.by.bank.report') }}" class="nav-link {{ $route == 'reports.refund.by.bank.report' ? 'active' : '' }}">
                                <i class="nav-icon far fa-circle"></i>
                                <p>Refund By Bank Report</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('reports.refund.by.credit.note.report') }}" class="nav-link {{ $route == 'reports.refund.by.credit.note.report' ? 'active' : '' }}">
                                <i class="nav-icon far fa-circle"></i>
                                <p>Refund By Credit Note Report</p>
                            </a>
                        </li>

                    </ul>
                </li>

            </ul>
        </nav>

    </div>

</aside>
