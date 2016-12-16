<div class="col-md-3 left_col">
                <div class="left_col scroll-view">

                    <div class="navbar nav_title" style="border: 0;">
                        <a href="index.html" class="site_title">
                            Crawler
                        </a>
                    </div>
                    <div class="clearfix"></div>

                    <!-- menu prile quick info -->
                    @if(Sentry::check())
                    <div class="profile">
                        <div class="profile_pic">
                            <img src="{{asset('assets/images/img.jpg')}}" alt="..." class="img-circle profile_img">
                        </div>
                        <div class="profile_info">
                            <span>Welcome</span>
                            <h2>{{Sentry::getUser()->first_name}}</h2>
                        </div>
                    </div>
                    @endif
                    <!-- /menu prile quick info -->

                    <br />

                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

                        <div class="menu_section">
                            <h3>General</h3>
                            <ul class="nav side-menu">
                                <li><a href="{{ route('admin_dashboard') }}"><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a></li>
                                <li><a><i class="fa fa-tree"></i> Members (Admin)<span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="{{ URL::to('admin/member') }}">List Member</a>
                                        </li>
                                    </ul>
                                </li>

                                <li><a><i class="fa fa-users"></i> Users <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="#abc">List User</a>
                                        </li>
                                    </ul>
                                </li>

                                <li><a><i class="fa fa-tags"></i> Categories <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="{{ URL::to('admin/category') }}">List Category</a>
                                        </li>
                                    </ul>
                                </li>
                                <li><a><i class="fa fa-lightbulb-o"></i> Authors <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="{{ URL::to('admin/author') }}">List Author</a>
                                        </li>
                                    </ul>
                                </li>
                                <li><a><i class="fa fa-usd"></i> Products <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="{{ URL::to('admin/product') }}">List Product</a>
                                        </li>
                                    </ul>
                                </li>
                                <li><a href="#"><i class="fa fa-cog"></i> Crawl tool <span class="fa fa-chevron-down"></span></a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- /sidebar menu -->

                    <!-- /menu footer buttons -->
                    <div class="sidebar-footer hidden-small">
                        <a data-toggle="tooltip" data-placement="top" title="Settings">
                            <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                            <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="Lock">
                            <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="Logout">
                            <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                        </a>
                    </div>
                    <!-- /menu footer buttons -->
                </div>
            </div>