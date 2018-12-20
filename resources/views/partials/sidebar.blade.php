<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <img src="{{asset('public/asset/img/logo.png')}}" class="img-circle img-responsive" alt="User Image" width="150" style="margin: 0 auto;">
        </div>
        <!--      <div class="user-panel">
                <div class="pull-left image">
                  <img src="{{asset('public/health/img/mak.jpg')}}" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>{{Auth::user()->name}}</p>
                  <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
              </div>-->

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="{!! Request::is('dashboard') ? 'active' : '' !!}">
                <a href="{{route('dashboard')}}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>

            @if(Auth::user()->unit_type() == 'Main Unit')
            <li class="{!! Request::is('unit/*') ? 'active' : '' !!}">
                <a href="{{route('list_unit')}}">
                    <i class="fa fa-tree"></i> <span>Units</span>
                </a>
            </li>
            @endif
            <li class="{!! Request::is('employee/*') ? 'active' : '' !!}">
                <a href="{{route('list_employee')}}">
                    <i class="fa fa-id-card"></i> <span>Employees</span>
                </a>
            </li>

            @if(Auth::user()->unit_type() == 'Sub Unit')
            <li class="{!! Request::is('demand/*') ? 'active' : '' !!}">
                <a href="{{route('demand_request_sub')}}"><i class="fa fa-clone"></i><span> Demand Request</span></a>
            </li>
            @elseif(Auth::user()->unit_type() == 'Main Unit')
            <li class="{!! Request::is('demand/*') ? 'active' : '' !!}">
                <a href="{{route('demand_request_main')}}"><i class="fa fa-clone"></i> <span>Demand Request</span></a>
            </li>
            @endif
            <!--            <li class="treeview">
                            <a href="#">
                                <i class="fa fa-folder"></i> <span>Procurement</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li>
                                    <a href="pages/examples/invoice.html"><i class="fa fa-circle-o"></i> Committee</a>
                                </li>
                                <li>
                                    <a href="pages/examples/profile.html"><i class="fa fa-circle-o"></i> Accept Demand</a>
                                </li>
                            </ul>
                        </li>-->
            @if(Auth::user()->unit_type() == 'Main Unit')
            
            <li class="treeview {!! Request::is('items/*') ? 'active' : '' !!}">
                <a href="#">
                    <i class="fa fa-list-alt"></i> <span>Items</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{!! Request::is('items/product/*') ? 'active' : '' !!}">
                        <a href="{{route('list_product')}}">
                            <i class="fa fa-gift"></i> <span>Product</span>
                        </a>
                    </li>
                    <li class="{!! Request::is('items/category/*') ? 'active' : '' !!}">
                        <a href="{{route('list_product_category')}}">
                            <i class="fa fa-tag"></i> <span>Product Category</span>
                        </a>
                    </li>
                    <li class="{!! Request::is('items/brand/*') ? 'active' : '' !!}">
                        <a href="{{route('list_product_brand')}}">
                            <i class="fa fa-list-alt"></i> <span>Product Brand</span>
                        </a>
                    </li>
                </ul>
            </li>
            @endif
            @if(Auth::user()->unit_type() == 'Main Unit')
            <li class="{!! Request::is('stock/*') ? 'active' : '' !!}">
                <a href="{{route('list_stock')}}">
                    <i class="fa fa-industry"></i> <span>Stock</span>
                </a>
            </li>
            @elseif(Auth::user()->unit_type() == 'Sub Unit')
            <li class="{!! Request::is('stock/*') ? 'active' : '' !!}">
                <a href="{{route('list_stock_sub')}}">
                    <i class="fa fa-industry"></i> <span>Stock</span>
                </a>
            </li>
            @endif

            @if(Auth::user()->unit_type() == 'Main Unit')
            <li class="{!! Request::is('distribution/*') ? 'active' : '' !!}">
                <a href="{{route('list_distribution_main')}}"><i class="fa fa-share-alt"></i><span> Distribution</span></a>
            </li>
            @endif
            @if(Auth::user()->unit_type() == 'Sub Unit')
            <li class="{!! Request::is('distribution/*') ? 'active' : '' !!}">
                <a href="{{route('distribution_sub')}}"><i class="fa fa-share-alt"></i><span> Distribution</span></a>
            </li>
            @endif
            <!--                    <li>
                                    <a href="pages/examples/profile.html"><i class="fa fa-circle-o"></i> IVS</a>
                                </li>
                                <li>
                                    <a href="pages/examples/profile.html"><i class="fa fa-circle-o"></i> RVS</a>
                                </li>-->
            <!--            <li>
                            <a href="{{route('dashboard')}}">
                                <i class="fa fa-circle-o"></i> <span>Auction</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('dashboard')}}">
                                <i class="fa fa-circle-o"></i> <span>Return</span>
                            </a>
                        </li>-->
            <li class="treeview {!! Request::is('report/*') ? 'active' : '' !!}">
                <a href="#">
                    <i class="fa fa-bar-chart"></i> <span>Report</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{!! Request::is('report/demand-report*') ? 'active' : '' !!}">
                        <a href="{{route('demand_report')}}"><i class="fa fa-circle-o"></i> <span>On Demand</span></a>
                    </li>
                    <li class="{!! Request::is('report/stock-report*') ? 'active' : '' !!}">
                        <a href="{{route('stock_report')}}"><i class="fa fa-circle-o"></i> <span>On Stock</span></a>
                    </li>
                    <li class="{!! Request::is('report/distribution-report*') ? 'active' : '' !!}">
                        <a href="{{route('distribution_report')}}"><i class="fa fa-circle-o"></i> <span>On Distribution</span></a>
                    </li>
<!--                    <li>
                        <a href="pages/examples/profile.html"><i class="fa fa-circle-o"></i> On Procrument</a>
                    </li>
                    <li>
                        <a href="pages/examples/profile.html"><i class="fa fa-circle-o"></i> On Auction</a>
                    </li>-->
                </ul>
            </li>
            @role('Admin')
            <li class="header">Users, Roles & Permissions</li>

            <li class="{!! Request::is('users','users/*') ? 'active' : '' !!}">
                <a href="{{route('users.index')}}"><i class="fa fa-users"></i><span> Users</span></a>
            </li>
            <li class="{!! Request::is('roles','roles/*') ? 'active' : '' !!}">
                <a href="{{route('roles.index')}}"><i class="fa fa-bell"></i> <span>Roles</span></a>
            </li>
            <li class="{!! Request::is('permissions','permissions/*') ? 'active' : '' !!}">
                <a href="{{route('permissions.index')}}"><i class="fa fa-lock"></i> <span>Permissions</span></a>
            </li>
            @endrole

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>