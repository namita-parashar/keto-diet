<!-- top navbar-->
      <header class="topnavbar-wrapper">
         <!-- START Top Navbar-->
         <nav class="navbar topnavbar">
            <!-- START navbar header-->
            <div class="navbar-header"><a class="navbar-brand" href="{{route('dashboard')}}">
                  <div class="brand-logo"><img class="img-fluid" src="assets/images/logo.png" alt="App Logo"></div>
                  <div class="brand-logo-collapsed"><img class="img-fluid" src="assets/images/logo-single.png" alt="App Logo"></div>
               </a></div><!-- END navbar header-->
            <!-- START Left navbar-->
            <ul class="navbar-nav mr-auto flex-row">
               <li class="nav-item">
                  <!-- Button used to collapse the left sidebar. Only visible on tablet and desktops--><a class="nav-link d-none d-md-block d-lg-block d-xl-block" href="#" data-trigger-resize="" data-toggle-state="aside-collapsed"><em class="fas fa-bars"></em></a><!-- Button to show/hide the sidebar on mobile. Visible on mobile only.--><a class="nav-link sidebar-toggle d-md-none" href="#" data-toggle-state="aside-toggled" data-no-persist="true"><em class="fas fa-bars"></em></a></li>
            </ul><!-- END Left navbar-->
            <!-- START Right Navbar-->
            <ul class="navbar-nav flex-row">
               <li class="nav-item d-none d-md-block"><a class="nav-link" href="#" data-toggle-fullscreen=""><em class="fas fa-expand"></em></a></li>
               <!-- START Offsidebar button
               <li class="nav-item"><a class="nav-link" href="#" data-toggle-state="offsidebar-open" data-no-persist="true"><em class="icon-notebook"></em></a></li> END Offsidebar menu-->
            </ul>
            <!-- END Right Navbar-->
         </nav>
         <!-- END Top Navbar-->
      </header><!-- sidebar-->
      <aside class="aside-container">
         <!-- START Sidebar (left)-->
         <div class="aside-inner">
            <nav class="sidebar" data-sidebar-anyclick-close="">
               <!-- START sidebar nav-->
               <ul class="sidebar-nav">
                  <!-- Iterates over all sidebar items-->
                  <li class="nav-heading "><span>Navigation</span></li>
                  <li>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    </li>

                  <li @if(Route::is('dashboard')=="dashboard") class="active"   @endif><a href="{{route('dashboard')}}" title="Dashboard"><em class="far fa fa-rainbow"></em><span>Dashboard</span></a></li>
                  <li @if(Route::is('show_activity')=="show_activity") class="active"   @endif><a href="{{route('show_activity')}}" title="Activity"><em class="far fa fa-mask"></em><span>Activity</span></a></li>
                  <li @if(Route::is('show_products')=="show_products") class="active"   @endif><a href={{route('show_products')}} title="Product"><em class="far fa fa-list-ul"></em><span>Product</span></a></li>
                  <li @if(Route::is('show_users')=="show_users") class="active"   @endif ><a href="{{route('show_users')}}" title="Users"><em class="far fa fa-list-ul"></em><span>Users</span></a></li>
                  <li @if(Route::is('show_recipe')=="show_recipe") class="active"   @endif ><a href="{{route('show_recipe')}}" title="Recipe"><em class="far fa fa-list-ul"></em><span>Recipe</span></a></li>
               </ul><!-- END sidebar nav-->
            </nav>
         </div><!-- END Sidebar (left)-->
      </aside><!-- offsidebar-->
      <aside class="offsidebar d-none">
         <!-- START Off Sidebar (right)-->
         <nav>
            <div role="tabpanel">
               <!-- Nav tabs-->
               <ul class="nav nav-tabs nav-justified" role="tablist">
                  <li class="nav-item" role="presentation"><a class="nav-link active" href="#app-settings" aria-controls="app-settings" role="tab" data-toggle="tab"><em class="icon-equalizer fa-lg"></em></a></li>
                  <li class="nav-item" role="presentation"><a class="nav-link" href="#app-chat" aria-controls="app-chat" role="tab" data-toggle="tab"><em class="icon-user fa-lg"></em></a></li>
               </ul><!-- Tab panes-->
               <div class="tab-content">
                  <div class="tab-pane fade active show" id="app-settings" role="tabpanel">
                     <h3 class="text-center text-thin mt-4">Settings</h3>

                  </div>
                  <div class="tab-pane fade" id="app-chat" role="tabpanel">
                     <h3 class="text-center text-thin mt-4">Connections</h3>

                  </div>
               </div>
            </div>
         </nav><!-- END Off Sidebar (right)-->
      </aside>
