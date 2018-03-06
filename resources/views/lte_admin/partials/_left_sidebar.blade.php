  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
           @if(Auth::user()->image != 'default_profile.jpeg')
                <img src="{{ asset('uploads/profile-pic/'.Auth::user()->image) }}" class="img-circle" alt="{{Auth::user()->username}}">
            @else
                <img src="https://api.adorable.io/avatars/181/{{Auth::user()->email}}.png" class="img-circle" alt="{{Auth::user()->username}}">
            @endif
        </div>
        <div class="pull-left info">
          <p>{{Auth::user()->fullname}}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form hidden">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat">
                  <i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="active treeview menu-open">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="/lte-admin"><i class="fa fa-circle-o"></i> Main Page</a></li>
            <li class="hidden"><a href="index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Innovations &nbsp;&nbsp;</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
              <span class="label label-success pull-right"> {{$countinnovations}}</span>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="/lte-admin/innovations"><i class="fa fa-circle-o"></i> View All</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Approved</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Pending</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Declined</a></li>
          </ul>
        </li>
        <li class="hidden">
          <a href="pages/widgets.html">
            <i class="fa fa-th"></i> <span>Widgets</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green">new</small>
            </span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>Categories</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
              <span class="label label-success pull-right"> {{$countcategories}}</span>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="/lte-admin/categories"><i class="fa fa-circle-o"></i> View All</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i> New</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-laptop"></i>
            <span>Users &nbsp;&nbsp;</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
              <span class="label label-primary pull-right"> {{$countusers}}</span>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="/lte-admin/users"><i class="fa fa-circle-o"></i> View All</a></li>
            <li><a href="pages/UI/icons.html"><i class="fa fa-circle-o"></i> Innovators</a></li>
            <li><a href="pages/UI/buttons.html"><i class="fa fa-circle-o"></i> Investors</a></li>
            <li><a href="pages/UI/sliders.html"><i class="fa fa-circle-o"></i> Subscribed</a></li>
            <li><a href="pages/UI/timeline.html"><i class="fa fa-circle-o"></i> Blocked</a></li>
            <li><a href="pages/UI/modals.html"><i class="fa fa-circle-o"></i> Admins</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-edit"></i> <span>News</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
              <span class="label label-warning pull-right"> {{$countnews}}</span>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="/lte-admin/news"><i class="fa fa-circle-o"></i> View All</a></li>
            <li><a href="pages/forms/advanced.html"><i class="fa fa-circle-o"></i> New</a></li>
          </ul>
        </li>
        <li class="treeview hidden">
          <a href="#">
            <i class="fa fa-table"></i> <span>Tables</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="pages/tables/simple.html"><i class="fa fa-circle-o"></i> Simple tables</a></li>
            <li><a href="pages/tables/data.html"><i class="fa fa-circle-o"></i> Data tables</a></li>
          </ul>
        </li>
        <li class="hidden">
          <a href="pages/calendar.html">
            <i class="fa fa-calendar"></i> <span>Calendar</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-red">3</small>
              <small class="label pull-right bg-blue">17</small>
            </span>
          </a>
        </li>
        <li>
          <a href="/team_requests" target="blank">
            <i class="fa fa-envelope"></i> <span>Team Requests</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right invisible"></i>
              <small class="label pull-right bg-yellow">{{$count_teamrequests}}</small>
              <small class="label pull-right bg-green hidden">16</small>
            </span>
          </a>
        </li>
        <li class="treeview hidden">
          <a href="#">
            <i class="fa fa-folder"></i> <span>Examples</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="pages/examples/invoice.html"><i class="fa fa-circle-o"></i> Invoice</a></li>
            <li><a href="pages/examples/profile.html"><i class="fa fa-circle-o"></i> Profile</a></li>
            <li><a href="pages/examples/login.html"><i class="fa fa-circle-o"></i> Login</a></li>
            <li><a href="pages/examples/register.html"><i class="fa fa-circle-o"></i> Register</a></li>
            <li><a href="pages/examples/lockscreen.html"><i class="fa fa-circle-o"></i> Lockscreen</a></li>
            <li><a href="pages/examples/404.html"><i class="fa fa-circle-o"></i> 404 Error</a></li>
            <li><a href="pages/examples/500.html"><i class="fa fa-circle-o"></i> 500 Error</a></li>
            <li><a href="pages/examples/blank.html"><i class="fa fa-circle-o"></i> Blank Page</a></li>
            <li><a href="pages/examples/pace.html"><i class="fa fa-circle-o"></i> Pace Page</a></li>
          </ul>
        </li>
        <li class="treeview hidden">
          <a href="#">
            <i class="fa fa-share"></i> <span>Multilevel</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
            <li class="treeview">
              <a href="#"><i class="fa fa-circle-o"></i> Level One
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="#"><i class="fa fa-circle-o"></i> Level Two</a></li>
                <li class="treeview">
                  <a href="#"><i class="fa fa-circle-o"></i> Level Two
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                  </ul>
                </li>
              </ul>
            </li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
          </ul>
        </li>
        <li class="hidden"><a href="https://adminlte.io/docs"><i class="fa fa-book"></i> <span>Documentation</span></a></li>
        <li><a href="/about"><i class="fa fa-book"></i> <span>About</span></a></li>
        <li><a href="/terms"><i class="fa fa-book"></i> <span>Terms</span></a></li>
        <li><a href="/privacy"><i class="fa fa-book"></i> <span>Privacy Policy</span></a></li>
        <li class="header">SOCIAL</li>
        <li><a href="#"><i class="fa fa-google-plus text-red"></i> <span>Google Page</span></a></li>
        <li><a href="https://www.facebook.com/teaminnovestors/" target="blank"><i class="fa fa-facebook text-aqua"></i> <span>Facebook Page</span></a></li>
        @if(checkPermission(['superadmin']))
            <li><a href="#"><i class="fa fa-github" style="color: grey;"></i> <span>Github Page</span></a></li>
        @endif
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>