        <?php 
          $route  =   Route::currentRouteName();

         ?>




        <!-- BEGIN HEADER & CONTENT DIVIDER -->
        <div class="clearfix"> </div>
        <!-- END HEADER & CONTENT DIVIDER -->
        <!-- BEGIN CONTAINER -->
        <div class="page-container">
            <!-- BEGIN SIDEBAR -->
            <div class="page-sidebar-wrapper">
                <!-- BEGIN SIDEBAR -->
                <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                <div class="page-sidebar navbar-collapse collapse  custom_sidebar">
                    <!-- BEGIN SIDEBAR MENU -->
                    <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
                    <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
                    <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
                    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                    <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
                    <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                        <ul class="page-sidebar-menu custom_sidebar_menu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
                            <li class="nav-item start">
                                <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="fa fa-home"></i>
                                <span class="title">Dashboard</span>
                                <span class="arrow"></span>
                              
                            </a>
                            <ul class="sub-menu">
                                <li class="nav-item start ">
                                    <a href="{{url('admin/keyFeature')}}" class="nav-link ">
                                        <i class="fa fa-bar-chart"></i>
                                        <span class="title">Key Features</span>
                                    </a>
                                </li>
                            
                                <li class="nav-item start ">
                                    <a href="{{url('admin/primarykpi')}}" class="nav-link ">
                                        <i class="fa fa-bar-chart"></i>
                                        <span class="title">Primary KPI</span>
                                        
                                    </a>
                                </li>
                                <li class="nav-item start ">
                                    <a href="{{url('admin/secondarykpi')}}" class="nav-link ">
                                        <i class="fa fa-bar-chart"></i>
                                        <span class="title">Secondary KPI</span>
                                     
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @foreach($main_menu as $key => $result)
                <li class="nav-item start  @if($route==$result->title) active open @endif @if($route==$result->title.'.create') active open @endif">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="fa fa-th-large"></i>
                                <span class="title">{{ucfirst($result->title)}}</span>
                                <span class="arrow @if($route==$result->title) open @endif"></span>
                            </a>
                            <ul class="sub-menu" style="display: @if($route==$result->title) block @endif">
                                
                                @foreach($result->sub_menu as $key => $sub_menu)

                                @if(\Str::contains($sub_menu->title, 'Create'))

                            <li class="nav-item  @if($route==$result->title.'.create') active @endif">
                                
                                <a href="{{ route($result->title.'.create') }}" class="nav-link ">
                                       <i class="fa fa-th"></i>
                                        <span class="title">
                                        {{ $sub_menu->title }}
                                        </span>
                                    </a>
                                </li> 
                                @else
                                 <li class="nav-item  @if($route==$result->title) active @endif">
                                    <a href="{{ route($result->title) }}" class="nav-link ">
                                       <i class="fa fa-eye"></i>
                                        <span class="title">
                                        {{ $sub_menu->title }}
                                        </span>
                                    </a>
                                </li> 
                                @endif
                                @endforeach

                            </ul>
                </li>
                @endforeach  
                       
                    </ul>
                    <!-- END SIDEBAR MENU -->
               </div>
             </div>
                <!-- END SIDEBAR -->
  
        
            <!-- END SIDEBAR -->