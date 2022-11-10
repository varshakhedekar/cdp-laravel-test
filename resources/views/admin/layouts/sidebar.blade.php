
@include('admin.layouts.header')
<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <a href="{{env('ADMIN_URL')}}" class="brand-link">
        <h3 class="brand-text font-weight-light">CDPINDIA</h3>
    </a>

    <div class="sidebar">

        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info">
                <a href="#" class="d-block">@if(isset(Auth::user()->first_name)) {{ Auth::user()->first_name }} @endif</a>
            </div>
        </div>


        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link">
                        <i class="nav-icon fa fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="{{ route('admin.products.index') }}" class="nav-link">
                        <i class="nav-icon fa fa-product-hunt"></i>
                        <p>
                            Products
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-cog"></i>
                        <p>
                            Site Settings
                            <i class="right fa fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.setting.change-password') }}" class="nav-link">
                                <i class="fa fa-circle nav-icon"></i>
                                <p>Change Password</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>

    </div>

</aside>