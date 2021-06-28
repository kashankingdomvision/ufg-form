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

                <li class="nav-item menu-open">
                    <a href="#" class="nav-link active">
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

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-file nav-icon"></i>
                        <p>
                            Quote Management
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
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
               
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fa fa-cloud nav-icon"></i>
                        <p>
                            Season Management
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fa fa-plus nav-icon"></i>
                                <p>Add Season</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/tables/simple.html" class="nav-link">
                                <i class="fa fa-eye nav-icon"></i>
                                <p>View Season</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fa fa-cloud nav-icon"></i>
                        <p>
                            User Management
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fa fa-plus nav-icon"></i>
                                <p>Add User</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/tables/simple.html" class="nav-link">
                                <i class="fa fa-eye nav-icon"></i>
                                <p>View User</p>
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fa fa-plus nav-icon"></i>
                                <p>Add Role</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/tables/simple.html" class="nav-link">
                                <i class="fa fa-eye nav-icon"></i>
                                <p>View Role</p>
                            </a>
                        </li>
                    </ul>
                </li>
 

             
               
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-cog"></i>
                        <p>
                            Setting
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fa fa-plane nav-icon"></i>
                                <p>
                                    Airline
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="fa fa-plus nav-icon"></i>
                                        <p>Add Airline</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="fa fa-eye nav-icon"></i>
                                        <p>View Airline</p>
                                    </a>
                                </li>

                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fas fa-money-check-alt nav-icon"></i>
                                <p>
                                    Payment Method
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="fa fa-plus nav-icon"></i>
                                        <p>Add Payment Method</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="fa fa-eye nav-icon"></i>
                                        <p>View Payment Method</p>
                                    </a>
                                </li>

                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fas fa-pen-square nav-icon"></i>
                                <p>
                                    Booking Method
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="fa fa-plus nav-icon"></i>
                                        <p>Add Booking Method</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
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
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Brand  
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="fa fa-plus nav-icon"></i>
                                        <p>Add Brand</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="fa fa-eye nav-icon"></i>
                                        <p>View Brand</p>
                                    </a>
                                </li>
                       

                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Holiday
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="fa fa-plus nav-icon"></i>
                                        <p>Add Brand</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="fa fa-eye nav-icon"></i>
                                        <p>View Brand</p>
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
