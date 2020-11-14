<aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="index3.html" class="brand-link">
          <img src="/uploads/images/project.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
               style="opacity: .8">
          <span class="brand-text font-weight-light">251Delivery</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
              <img src="/uploads/images/customer-support.png" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
              <a href="#" class="d-block">John Doe</a>
            </div>
          </div>

          <!-- Sidebar Menu -->
          <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
              <!-- Add icons to the links using the .nav-icon class
                   with font-awesome or any other icon font library -->
              <li class="nav-item">
                <a href="{{ route('buyers.home') }}" class="nav-link">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                    Home
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('buyers.orders.index') }}" class="nav-link {{ (request()->routeIs('buyers.orders.*')) ? 'active' : '' }}">
                  <i class="nav-icon fas fa-shopping-cart"></i>
                  <p>
                    Order History
                  </p>
                </a>
              </li>
              <li class="nav-item has-treeview {{ (request()->segment(3) == 'favorites') ? 'menu-open' : '' }}">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-star"></i>
                  <p>
                     Favorites
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="fas fa-circle nav-icon"></i>
                      <p>Shops</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="fas fa-circle nav-icon"></i>
                      <p>Meals</p>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="nav-item has-treeview {{ (request()->segment(3) == 'settings') ? 'menu-open' : '' }}">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-cog"></i>
                  <p>
                     Settings
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('buyers.accounts.index') }}" class="nav-link {{ (request()->routeIs('buyers.accounts.*')) ? 'active' : '' }}">
                      <i class="fas fa-circle nav-icon"></i>
                      <p>Account Settings</p>
                    </a>
                  </li>
                </ul>
              </li>

            </ul>
          </nav>
          <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
      </aside>