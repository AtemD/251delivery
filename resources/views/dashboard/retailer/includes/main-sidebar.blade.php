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
              <a href="#" class="d-block">{{Auth::user()->full_name}}</a>
            </div>
          </div>

          <!-- Sidebar Menu -->
          <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
              <!-- Add icons to the links using the .nav-icon class
                   with font-awesome or any other icon font library -->
              <li class="nav-item">
                <a href="{{ route('retailer.shops.index', ['shop' => $shop]) }}" class="nav-link {{ (request()->segment(5) == '') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                    Dashboard
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('retailer.shops') }}" class="nav-link">
                  <i class="nav-icon fas fa-store-alt"></i>
                  <p>
                    My Shops
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('retailer.orders.index', ['shop' => $shop]) }}" class="nav-link {{ (request()->routeIs('retailer.orders.*')) ? 'active' : '' }}">
                  <i class="nav-icon fas fa-shopping-cart"></i>
                  <p>
                    Orders
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('retailer.products.index', ['shop' => $shop]) }}" class="nav-link {{ (request()->routeIs('retailer.products.*')) ? 'active' : '' }}">
                  <i class="nav-icon fas fa-utensils"></i>
                  <p>
                    Products
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('retailer.users.index', ['shop' => $shop]) }}" class="nav-link {{ (request()->routeIs('retailer.users.*')) ? 'active' : '' }}">
                  <i class="nav-icon fas fa-users"></i>
                  <p>
                    Users
                  </p>
                </a>
              </li>
              <li class="nav-item has-treeview {{ (request()->segment(5) == 'settings') ? 'menu-open' : '' }}">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-cog"></i>
                  <p>
                     Settings
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('retailer.shops.accounts.index', ['shop' => $shop]) }}" class="nav-link {{ (request()->routeIs('retailer.shops.accounts.*')) ? 'active' : '' }}">
                      <i class="fas fa-circle nav-icon"></i>
                      <p>Account</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('retailer.taxes.index', ['shop' => $shop]) }}" class="nav-link {{ (request()->routeIs('retailer.taxes.*')) ? 'active' : '' }}">
                      <i class="fas fa-circle nav-icon"></i>
                      <p>Taxes</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('retailer.sections.index', ['shop' => $shop]) }}" class="nav-link {{ (request()->routeIs('retailer.sections.*')) ? 'active' : '' }}">
                      <i class="fas fa-circle nav-icon"></i>
                      <p>Sections</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('retailer.discounts.index', ['shop' => $shop]) }}" class="nav-link {{ (request()->routeIs('retailer.discounts.*')) ? 'active' : '' }}">
                      <i class="fas fa-circle nav-icon"></i>
                      <p>Discounts</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('retailer.cuisines.index', ['shop' => $shop]) }}" class="nav-link {{ (request()->routeIs('retailer.cuisines.*')) ? 'active' : '' }}">
                      <i class="fas fa-circle nav-icon"></i>
                      <p>Cuisines</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('retailer.locations.index', ['shop' => $shop]) }}" class="nav-link {{ (request()->routeIs('retailer.locations.*')) ? 'active' : '' }}">
                      <i class="fas fa-circle nav-icon"></i>
                      <p>Location</p>
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