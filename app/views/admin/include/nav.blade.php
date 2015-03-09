        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">Cafe Ceylon Admin v1.0</a>
            </div>
            <!-- /.navbar-header -->

            

            <ul class="nav navbar-top-links navbar-right">

                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-shopping-cart fa-fw"></i><i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li>
                            <a href="{{ route('admin.ordernew') }}">New Order </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.orderlist') }}">Order List</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>

                @if($user_access == 'admin' || $user_access == 'manager')
                <li>
                    <a href="{{ route('admin.foodstock') }}"><i class="fa fa-book fa-fw"></i></a>
                </li>
                @endif

                @if($user_access == 'admin')
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-briefcase fa-fw"></i><i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li>
                            <a href="flot.html">User</a>
                        </li>
                        <li>
                            <a href="morris.html">Report</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                @endif

                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                    	<li>Hi, {{$username}}
                        </li>
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="{{URL::to('logout')}}"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            
            
            <!-- /.navbar-static-side -->
        </nav>