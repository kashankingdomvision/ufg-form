@php
    $route = \Route::currentRouteName();
    $currenct_user_is_admin = Auth::user()->isAdmin();

    $supplier_routes = [
        'suppliers.index',
        'suppliers.create',
        'suppliers.edit',
        'suppliers.index',
        'products.create',
        'products.edit',
        'products.index',
        'categories.create',
        'categories.index',
        'categories.edit',
        'wallets.index',
        'supplier_rate_sheets.create',
        'supplier_rate_sheets.index',
        'supplier_rate_sheets.edit',
        'group_owners.create',
        'group_owners.index',
        'group_owners.edit',
    ];

    $setting_routes = [
        'airport_codes.index',
        'airport_codes.create',
        'airport_codes.edit',
        'banks.index',
        'banks.create',
        'banks.edit',
        'brands.index',
        'brands.create',
        'brands.edit',
        'countries.index',
        'countries.create',
        'countries.edit',
        'currencies.index',
        'currencies.create',
        'currencies.edit',
        'currency_conversions.index',
        'currency_conversions.edit',
        'harbours.index',
        'harbours.create',
        'harbours.edit',
        'holiday_types.index',
        'holiday_types.create',
        'holiday_types.edit',
        'hotels.create',
        'hotels.index',
        'hotels.edit',
        'locations.create',
        'locations.index',
        'locations.edit',
        'payment_methods.index',
        'payment_methods.create',
        'payment_methods.edit',
        'preset_comments.index',
        'preset_comments.create',
        'preset_comments.edit',
        'seasons.index',
        'seasons.create',
        'seasons.edit',
        'store_texts.create',
        'store_texts.index', 
        'store_texts.edit',
        'cabins.create',
        'cabins.index', 
        'cabins.edit',
        'stations.create',
        'stations.index', 
        'stations.edit',
        'tour_contacts.create',
        'tour_contacts.index',
        'tour_contacts.edit',
        'booking_methods.create',
        'booking_methods.index',
        'booking_methods.edit',

    ];
@endphp

 <!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard.index') }}" class="brand-link logo-switch brand-anchor">
        {!! file_get_contents(asset('images/logos/dashboard_logo.svg')) !!}
        {!! file_get_contents(asset('images/logos/collapse_logo.svg')) !!}
    </a>

    <hr class="brand-anchor-hr">
    <!-- Sidebar -->
    <div class="sidebar">
  
        <nav>
            <ul class="nav nav-pills nav-sidebar flex-column text-sm" data-widget="treeview" role="menu"
                data-accordion="false">

                <li class="nav-item">
                    <a href="{{ route('dashboard.index') }}" class="nav-link {{ in_array($route, ['dashboard.index']) ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('bookings.index') }}" class="nav-link {{ in_array($route, ['bookings.view.seasons', 'bookings.index', 'bookings.edit', 'bookings.version', 'bookings.show']) ? 'active' : '' }}">
                        <i class="fas fa-pen-square nav-icon"></i>
                        <p>Bookings</p>
                    </a>
                </li>

                <li class="nav-item {{ in_array($route, ['quotes.index', 'quotes.view.trash', 'quotes.create', 'quotes.edit', 'roles.index', 'roles.create', 'roles.edit', 'quotes.view.version', 'quotes.final', 'quotes.archive', 'groups.index', 'groups.edit', 'groups.create', 'quotes.quote.documment', 'quotes.compare.quote' ]) ? 'menu-open': '' }}">
                    
                    <a href="#" class="nav-link">
                        <i class="fas fa-file nav-icon"></i>
                        <p>
                            Quote Management
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="{{ route('quotes.create') }}" class="nav-link sidebar-border-left {{ in_array($route, ['quotes.create']) ? 'active' : '' }}">
                                <i class="fa fa-plus nav-icon"></i>
                                <p>Add Quote</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('quotes.index') }}" class="nav-link sidebar-border-left {{ in_array($route, ['quotes.index', 'quotes.edit', 'quotes.view.version', 'quotes.final', 'quotes.quote.documment']) ? 'active' : '' }}">
                                <i class="fa fa-eye nav-icon"></i>
                                <p>View Quote</p>
                            </a>
                        </li>
               
                        <li class="nav-item">
                            <a href="{{ route('quotes.archive') }}" class="nav-link sidebar-border-left {{ in_array($route, ['quotes.view.archive', 'quotes.archive']) ? 'active' : '' }}">
                                <i class="fa fa-archive nav-icon"></i>
                                <p>Archived</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('groups.index') }}" class="nav-link sidebar-border-left {{ in_array($route, ['groups.index', 'groups.create', 'groups.edit']) ? 'active' : '' }}">
                                <i class="fa fa-users nav-icon"></i>
                                <p>View Group Quote</p>
                            </a>
                        </li>

                        
                        <li class="nav-item">
                            <a href="{{ route('quotes.compare.quote') }}" class="nav-link sidebar-border-left {{ in_array($route, ['quotes.compare.quote']) ? 'active' : '' }}">
                                <i class="nav-icon far fa-circle"></i>
                                <p>Compare Quote</p>
                            </a>
                        </li>
                        
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="{{ route('customers.index') }}" class="nav-link {{ in_array($route, ['customers.index', 'customers.quote.listing', 'customers.booking.listing']) ? 'active' : '' }}">
                        <i class="fa fa-user nav-icon"></i>
                        <p>Customers</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('templates.index') }}" class="nav-link {{ in_array($route, ['templates.index', 'templates.create', 'templates.edit']) ? 'active' : '' }}">
                        <i class="fa fa-clone nav-icon"></i>
                        <p>Templates</p>
                    </a>
                </li>
               
                @if($currenct_user_is_admin)

                    <li class="nav-item {{ in_array($route, ['users.index', 'users.create', 'users.edit', 'roles.index', 'roles.create', 'roles.edit']) ? 'menu-open': '' }}">
                        
                        <a href="#" class="nav-link">
                            <i class="fa fa-user nav-icon"></i>
                            <p>
                                User Management
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>

                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('users.index') }}" class="nav-link sidebar-border-left {{ in_array($route, ['users.index', 'users.create', 'users.edit']) ? 'active' : '' }}">
                                    <i class="fa fa-eye nav-icon"></i>
                                    <p>View User</p>
                                </a>
                            </li>


                            <li class="nav-item">
                                <a href="{{ route('roles.index')}}" class="nav-link sidebar-border-left {{ in_array($route, ['roles.index', 'roles.edit']) ? 'active' : ''}}">
                                    <i class="fa fa-eye nav-icon"></i>
                                    <p>View Role</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item {{  in_array($route, ['commissions.index', 'commissions.create', 'commissions.edit', 'commission_groups.index', 'commission_groups.create', 'commission_groups.edit', 'commission_criterias.index', 'commission_criterias.create', 'commission_criterias.edit']) ? 'menu-open': '' }}">
                        
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-percentage"></i>
                            <p>
                                Commision Management
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>

                        <ul class="nav nav-treeview">

                            {{-- <li class="nav-item">
                                <a href="{{ route('commissions.index') }}" class="nav-link sidebar-border-left {{ in_array($route, ['commissions.index', 'commissions.create', 'commissions.edit']) ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-percentage"></i>
                                    <p>
                                        Commissions
                                    </p>
                                </a>
                            </li> --}}

                            {{-- <li class="nav-item">
                                <a href="{{ route('commission_groups.index') }}" class="nav-link sidebar-border-left {{ in_array($route, ['commission_groups.index', 'commission_groups.create', 'commission_groups.edit']) ? 'active' : '' }}">
                                    <i class="fa fa-users nav-icon"></i>
                                    <p>
                                        Commission Groups
                                    </p>
                                </a>
                            </li> --}}

                            <li class="nav-item">
                                <a href="{{ route('commission_criterias.index') }}" class="nav-link sidebar-border-left {{ in_array($route, ['commission_criterias.index', 'commission_criterias.create', 'commission_criterias.edit']) ? 'active' : '' }}">
                                    <i class="nav-icon far fa-circle"></i>
                                    <p>
                                        Commission Criteria
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                <li class="nav-item {{ in_array($route, $supplier_routes) ? 'menu-open': '' }}">
                    <a href="#" class="nav-link">
                        <i class="fa fa-user nav-icon"></i>
                        <p>
                            Supplier Management
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="{{ route('suppliers.index') }}" class="nav-link sidebar-border-left {{ in_array($route, ['suppliers.index', 'suppliers.create', 'suppliers.edit']) ? 'active' : '' }}">
                                <i class="fa fa-eye nav-icon"></i>
                                <p>View Supplier</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('group_owners.index') }}" class="nav-link sidebar-border-left {{ in_array($route, ['group_owners.index', 'group_owners.create', 'group_owners.edit']) ? 'active' : '' }}">
                                <i class="fa fa-users nav-icon"></i>
                                <p>Group Owners</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('supplier_rate_sheets.index') }}" class="nav-link sidebar-border-left {{ in_array($route, ['supplier_rate_sheets.index', 'supplier_rate_sheets.create', 'supplier_rate_sheets.edit']) ? 'active' : '' }}">
                                <i class="fa fa-eye nav-icon"></i>
                                <p>Supplier Rate Sheet</p>
                            </a>
                        </li>


                        <li class="nav-item">
                            <a href="{{ route('products.index')}}" class="nav-link sidebar-border-left {{ in_array($route, ['products.index', 'products.create', 'products.edit']) ? 'active' : ''}}">
                                <i class="fa fa-eye nav-icon"></i>
                                <p>View Product</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('categories.index')}}" class="nav-link sidebar-border-left {{ in_array($route, ['categories.index', 'categories.create', 'categories.edit']) ? 'active' : ''}}">
                                <i class="fa fa-eye nav-icon"></i>
                                <p>View Category</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('wallets.index') }}" class="nav-link sidebar-border-left {{ in_array($route, ['wallets.index']) ? 'active' : '' }}">
                                <i class="fas fa-wallet nav-icon"></i>
                                <p>Supplier Wallet</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item {{ in_array($route, ['supplier-bulk-payments.index', 'supplier-bulk-payments.view']) ? 'menu-open': '' }}">
                    <a href="#" class="nav-link">
                        <i class="fa fa-user nav-icon"></i>
                        <p>
                            Supplier Bulk Payments
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('supplier-bulk-payments.index') }}" class="nav-link sidebar-border-left {{ in_array($route, ['supplier-bulk-payments.index']) ? 'active' : '' }}">
                                <i class="nav-icon far fa-circle"></i>
                                <p>Add Supplier Bulk Payments</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('supplier-bulk-payments.view') }}" class="nav-link sidebar-border-left d-inline-flex {{ in_array($route, ['supplier-bulk-payments.view']) ? 'active' : '' }}">
                                <i class="nav-icon far fa-circle"></i>
                                <p>View Supplier Bulk Payments</p>
                            </a>
                        </li>
                    </ul>

                </li>

                @if($currenct_user_is_admin)
                <li class="nav-item {{ in_array($route, $setting_routes) ? 'menu-open': '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-cog"></i>
                        <p>
                            Setting
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="{{ route('airport_codes.index') }}" class="nav-link sidebar-border-left {{ in_array($route, ['airport_codes.index', 'airport_codes.create', 'airport_codes.edit']) ? 'active' : '' }}">
                                <i class="fa fa-plane nav-icon"></i>
                                <p>Airport</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('banks.index') }}" class="nav-link sidebar-border-left {{ in_array($route, ['banks.index', 'banks.create', 'banks.edit']) ? 'active' : '' }}">
                                <i class="nav-icon far fa-circle"></i>
                                <p>
                                    Banks
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('booking_methods.index') }}" class="nav-link sidebar-border-left {{ in_array($route, ['booking_methods.index', 'booking_methods.create', 'booking_methods.edit']) ? 'active' : '' }}">
                                <i class="nav-icon fas fa-book"></i>
                                <p>
                                    Booking Methods
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('brands.index') }}" class="nav-link sidebar-border-left {{ in_array($route, ['brands.index', 'brands.create', 'brands.edit']) ? 'active' : '' }}">
                                <i class="nav-icon far fa-circle"></i>
                                <p>
                                    Brands
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('cabins.index') }}" class="nav-link sidebar-border-left {{ in_array($route, ['cabins.index', 'cabins.create', 'cabins.edit']) ? 'active' : '' }}">
                                <i class="nav-icon fas fa-box"></i>
                                {{-- <i class="fa-solid fa-cabinet-filing"></i> --}}
                                <p>
                                    Cabins
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('countries.index') }}" class="nav-link sidebar-border-left {{ in_array($route, ['countries.index', 'countries.create', 'countries.edit']) ? 'active' : '' }}">
                                <i class="fa fa-globe nav-icon"></i>
                                <p>Countries</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('currencies.index') }}" class="nav-link sidebar-border-left {{ in_array($route, ['currencies.index', 'currencies.create', 'currencies.edit']) ? 'active' : '' }}">
                                <i class="nav-icon fas fa-money-bill-alt"></i>
                                <p>
                                    Currencies
                                </p>
                            </a>
                        </li>


                        <li class="nav-item">
                            <a  href="{{ route('currency_conversions.index') }}" class="nav-link sidebar-border-left {{ in_array($route, ['currency_conversions.index', 'currency_conversions.create', 'currency_conversions.edit']) ? 'active' : '' }}">
                                <i class="fas fa-money-bill-alt nav-icon"></i>
                                <p>
                                    Currency Rates
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('cabins.index') }}" class="nav-link sidebar-border-left {{ in_array($route, ['cabins.index', 'cabins.create', 'cabins.edit']) ? 'active' : '' }}">
                                <i class="nav-icon far fa-circle"></i>
                                <p>
                                    Cabin Type
                                </p>
                            </a>
                        </li>


                        <li class="nav-item">
                            <a href="{{ route('harbours.index') }}" title="Harbours, Train & Points of Interest" class="nav-link sidebar-border-left d-inline-flex {{ in_array($route, ['harbours.index', 'harbours.create', 'harbours.edit']) ? 'active' : '' }}">
                                <i class="fa fa-map-marker nav-icon"></i>
                                <p>Harbours, Train & POI </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('holiday_types.index') }}" class="nav-link sidebar-border-left {{ in_array($route, ['holiday_types.index', 'holiday_types.create', 'holiday_types.edit']) ? 'active' : '' }}">
                                <i class="nav-icon far fa-circle"></i>
                                <p>
                                    Holiday Types
                                </p>
                            </a>
                        </li>
           

                        <li class="nav-item">
                            <a href="{{ route('hotels.index') }}" class="nav-link sidebar-border-left {{ in_array($route, ['hotels.index', 'hotels.create', 'hotels.edit']) ? 'active' : '' }}">
                                <i class="fa fa-hotel nav-icon"></i>
                                <p>Hotels</p>
                            </a>
                        </li>

        

                        <li class="nav-item">
                            <a href="{{ route('locations.index') }}" class="nav-link sidebar-border-left {{ in_array($route, ['locations.index', 'locations.create', 'locations.edit']) ? 'active' : '' }}">
                                <i class="fa fa-map-marker nav-icon"></i>
                                <p>Locations</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('payment_methods.index') }}" class="nav-link sidebar-border-left {{ in_array($route, ['payment_methods.index', 'payment_methods.create', 'payment_methods.edit']) ? 'active' : '' }}">
                                <i class="nav-icon fas fa-money-check-alt"></i>
                                <p>
                                    Payment Methods
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('preset_comments.index') }}" class="nav-link sidebar-border-left {{ in_array($route, ['preset_comments.index', 'preset_comments.create', 'preset_comments.edit']) ? 'active' : '' }}">
                                <i class="fa fa-comment nav-icon"></i>
                                <p>Preset Comments</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('seasons.index') }}" class="nav-link sidebar-border-left {{ in_array($route, ['seasons.index', 'seasons.create', 'seasons.edit']) ? 'active' : '' }}">
                                <i class="fa fa-cloud nav-icon"></i>
                                <p>Seasons</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('store_texts.index') }}" class="nav-link sidebar-border-left {{ in_array($route, ['store_texts.index', 'store_texts.create', 'store_texts.edit']) ? 'active' : '' }}">
                                <i class="fa fa-file-word nav-icon" aria-hidden="true"></i>
                                <p>Stored Text</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('stations.index') }}" class="nav-link sidebar-border-left {{ in_array($route, ['stations.index', 'stations.create', 'stations.edit']) ? 'active' : '' }}">
                                <i class="nav-icon fa fa-train"></i>
                                <p>
                                    Stations
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('tour_contacts.index') }}" class="nav-link sidebar-border-left {{ in_array($route, ['tour_contacts.index', 'tour_contacts.create', 'tour_contacts.edit']) ? 'active' : '' }}">
                                <i class="nav-icon fas fa-address-book"></i>
                                <p>
                                    Tour Contacts
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif

                <li class="nav-item {{ in_array($route, ['reports.user.report', 'reports.activity.by.user', 'reports.supplier.report', 'reports.wallet.report', 'reports.quote.report', 'reports.customer.report', 'reports.payment.method.report', 'reports.refund.by.bank.report', 'reports.refund.by.credit.note.report', 'reports.transfer.report', 'reports.commission.report']) ? 'menu-open': '' }}">
                    
                    <a href="#" class="nav-link">
                        <i class="fa fa-chart-bar nav-icon"></i>
                        <p>
                            Reports
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        @if($currenct_user_is_admin)
                            <li class="nav-item">
                                <a href="{{ route('reports.commission.report') }}" class="nav-link sidebar-border-left {{ in_array($route, ['reports.commission.report']) ? 'active' : '' }}">
                                    <i class="nav-icon far fa-circle"></i>
                                    <p>Commision Report</p>
                                </a>
                            </li>
                        @endif

                        <li class="nav-item">
                            <a href="{{ route('reports.transfer.report') }}" class="nav-link sidebar-border-left {{ in_array($route, ['reports.transfer.report']) ? 'active' : '' }}">
                                <i class="nav-icon far fa-circle"></i>
                                <p>Transfer Report</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('reports.user.report') }}" class="nav-link sidebar-border-left {{ in_array($route, ['reports.user.report']) ? 'active' : '' }}">
                                <i class="nav-icon far fa-circle"></i>
                                <p>User Report</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('reports.activity.by.user') }}" class="nav-link sidebar-border-left {{ in_array($route, ['reports.activity.by.user']) ? 'active' : '' }}">
                                <i class="nav-icon far fa-circle"></i>
                                <p>Activity By User</p>
                            </a>
                            <a href="{{ route('reports.supplier.report') }}" class="nav-link sidebar-border-left {{ in_array($route, ['reports.supplier.report']) ? 'active' : '' }}">
                                <i class="nav-icon far fa-circle"></i>
                                <p>Supplier Report</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('reports.wallet.report') }}" class="nav-link sidebar-border-left {{ in_array($route, ['reports.wallet.report']) ? 'active' : '' }}">
                                <i class="nav-icon far fa-circle"></i>
                                <p>Wallet Report</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('reports.quote.report') }}" class="nav-link sidebar-border-left {{ in_array($route, ['reports.quote.report']) ? 'active' : '' }}">
                                <i class="nav-icon far fa-circle"></i>
                                <p>Quote Report</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('reports.customer.report') }}" class="nav-link sidebar-border-left {{ in_array($route, ['reports.customer.report']) ? 'active' : '' }}">
                                <i class="nav-icon far fa-circle"></i>
                                <p>Customer Report</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('reports.payment.method.report') }}" class="nav-link sidebar-border-left {{ in_array($route, ['reports.payment.method.report']) ? 'active' : '' }}">
                                <i class="nav-icon far fa-circle"></i>
                                <p>Payment Method Report</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('reports.refund.by.bank.report') }}" class="nav-link sidebar-border-left {{ in_array($route, ['reports.refund.by.bank.report']) ? 'active' : '' }}">
                                <i class="nav-icon far fa-circle"></i>
                                <p>Refund By Bank Report</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('reports.refund.by.credit.note.report') }}" class="nav-link sidebar-border-left d-inline-flex {{ in_array($route, ['reports.refund.by.credit.note.report']) ? 'active' : '' }}">
                                <i class="nav-icon far fa-circle"></i>
                                <p>Refund By Credit Note Report</p>
                            </a>
                        </li>

                        <li class="">
                            <a href="" class="nav-link">
                                <i class=""></i>
                                <p></p>
                            </a>
                        </li>

                        <li class="">
                            <a href="" class="">
                                <i class=""></i>
                                <p></p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="">
                    <a href="" class="nav-link">
                        <i class=""></i>
                        <p></p>
                    </a>
                </li>

                <li class="">
                    <a href="" class="">
                        <i class=""></i>
                        <p></p>
                    </a>
                </li>

            </ul>
        </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

{{-- <img src="{{ asset('images/logos/collapse_logo.png') }}" alt="Small" class="brand-image-xl logo-xs"> --}}
{{-- <img src="{{ asset('images/logos/logo.png') }}" alt="Large" class="brand-image-xs logo-xl" style="left: 16px"> --}}

<!-- Sidebar user panel (optional) -->
    {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
    <div class="image">
        <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
    </div>
    <div class="info">
        <a href="#" class="d-block">Alexander Pierce</a>
    </div>
    </div> --}}



{{-- <li class="nav-item">
    <a href="{{ route('category-detail-forms.create')}}" class="nav-link {{ $route == 'category-detail-forms.create'  ? 'active' : ''}}">
        <i class="fa fa-eye nav-icon"></i>
        <p>Add Category Form</p>
    </a>
</li> --}}

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

    {{-- <li class="nav-item">
    <a href="{{ route('quotes.view.trash') }}" class="nav-link {{ $route == 'quotes.view.trash' ? 'active' : '' }}">
        <i class="fa fa-window-close nav-icon"></i>
        <p>Cancel Quote</p>
    </a>
</li> --}}

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


{{-- <li class="nav-item">
    <a href="{{ route('setting.towns.index') }}" class="nav-link {{ $route == 'setting.towns.index' || $route == 'setting.towns.create' || $route == 'setting.towns.edit' ? 'active' : '' }}">
        <i class="fa fa-city nav-icon"></i>
        <p>Towns</p>
    </a>
</li> --}}


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

{{-- <li class="nav-item {{ $route == 'payment_methods.index' || $route == 'payment_methods.create' || $route == 'payment_methods.edit' ? 'menu-open': '' }}">
    <a href="#" class="nav-link {{ $route == 'payment_methods.index' || $route == 'payment_methods.create' || $route == 'payment_methods.edit' ? 'setting-child-active' : '' }}">
        <i class="fas fa-money-check-alt nav-icon"></i>
        <p>
            Payment Method
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('payment_methods.create') }}" class="nav-link {{ $route == 'payment_methods.create' ? 'active' : '' }}">
                <i class="fa fa-plus nav-icon"></i>
                <p>Add Payment Method</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('payment_methods.index') }}" class="nav-link {{ $route == 'payment_methods.index' || $route == 'payment_methods.edit' ? 'active' : '' }}">
                <i class="fa fa-eye nav-icon"></i>
                <p>View Payment Method</p>
            </a>
        </li>

    </ul>
</li> --}}



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

{{-- <li class="nav-item {{ $route == 'currencies.index' || $route == 'currencies.create' || $route == 'currencies.edit' ? 'menu-open': '' }}">
    <a href="#" class="nav-link {{ $route == 'currencies.index' || $route == 'currencies.create' || $route == 'currencies.edit' ? 'setting-child-active' : '' }}">
        <i class="fas fa-money-bill-alt nav-icon"></i>
        <p>
            Currency
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('currencies.create') }}" class="nav-link {{ $route == 'currencies.create' ? 'active' : '' }}">
                <i class="fa fa-plus nav-icon"></i>
                <p>Add Currency</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('currencies.index') }}" class="nav-link {{ $route == 'currencies.index' || $route == 'currencies.edit' ? 'active' : '' }}">
                <i class="fa fa-eye nav-icon"></i>
                <p>View Currency</p>
            </a>
        </li>

    </ul>
</li> --}}


{{-- <li class="nav-item {{ $route == 'brands.index' || $route == 'brands.create' || $route == 'brands.edit' ? 'menu-open': '' }}">
    <a href="#" class="nav-link {{ $route == 'brands.index' || $route == 'brands.create' || $route == 'brands.edit' ? 'setting-child-active' : '' }}">
        <i class="far fa-circle nav-icon"></i>
        <p>
            Brand
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('brands.create') }}" class="nav-link {{ $route == 'brands.create' ? 'active' : '' }}">
                <i class="fa fa-plus nav-icon"></i>
                <p>Add Brand</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('brands.index') }}" class="nav-link {{ $route == 'brands.index' || $route == 'brands.edit' ? 'active' : '' }}">
                <i class="fa fa-eye nav-icon"></i>
                <p>View Brand</p>
            </a>
        </li>

    </ul>
</li> --}}


{{-- <li class="nav-item {{ $route == 'holiday_types.index' || $route == 'holiday_types.create' || $route == 'holiday_types.edit' ? 'menu-open': '' }}">
    <a href="#" class="nav-link {{ $route == 'holiday_types.index' || $route == 'holiday_types.create' || $route == 'holiday_types.edit' ? 'setting-child-active' : '' }}">
        <i class="far fa-circle nav-icon"></i>
        <p>
            Holiday Type
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('holiday_types.create') }}" class="nav-link {{ $route == 'holiday_types.create' ? 'active' : '' }}">
                <i class="fa fa-plus nav-icon"></i>
                <p>Add Holiday Type</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('holiday_types.index') }}" class="nav-link {{ $route == 'holiday_types.index' || $route == 'holiday_types.edit' ? 'active' : '' }}">
                <i class="fa fa-eye nav-icon"></i>
                <p>View Holiday Type</p>
            </a>
        </li>

    </ul>
</li> --}}
{{-- 

'setting.towns.create',
'setting.towns.index',
'setting.towns.edit',
'setting.booking_methods.index',
'setting.booking_methods.create',
'setting.booking_methods.edit', --}}

{{-- 'setting.airlines.index',
'setting.airlines.create',
'setting.airlines.edit', --}}