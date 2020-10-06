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
                <a href="{{ route('company.home') }}" class="nav-link {{ (request()->routeIs('company.home')) ? 'active' : '' }}">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                    Dashboard
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('company.shops.index') }}" class="nav-link {{ (request()->routeIs('company.shops.*')) ? 'active' : '' }}">
                  <i class="nav-icon fas fa-store-alt"></i>
                  <p>
                    Shops
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('company.orders.index') }}" class="nav-link {{ (request()->routeIs('company.orders.*')) ? 'active' : '' }}">
                  <i class="nav-icon fas fa-shopping-cart"></i>
                  <p>
                    Orders
                  </p>
                </a>
              </li>
              <li class="nav-item has-treeview {{ (request()->routeIs('company.users.*')) ? 'menu-open' : '' }}">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-users"></i>
                  <p>
                    Users
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('company.users.index') }}" class="nav-link {{ (request()->routeIs('company.users.index')) ? 'active' : '' }}">
                      <i class="fas fa-circle nav-icon"></i>
                      <p>All Users</p>
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
                    <a href="{{ route('company.cuisines.index') }}" class="nav-link {{ (request()->routeIs('company.cuisines.*')) ? 'active' : '' }}">
                      <i class="fas fa-circle nav-icon"></i>
                      <p>cuisines</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('company.order-types.index') }}" class="nav-link {{ (request()->routeIs('company.order-types.*')) ? 'active' : '' }}">
                      <i class="fas fa-circle nav-icon"></i>
                      <p>order types</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('company.payment-methods.index') }}" class="nav-link {{ (request()->routeIs('company.payment-methods.*')) ? 'active' : '' }}">
                      <i class="fas fa-circle nav-icon"></i>
                      <p>payment methods</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('company.shop-types.index') }}" class="nav-link {{ (request()->routeIs('company.shop-types.*')) ? 'active' : '' }}">
                      <i class="fas fa-circle nav-icon"></i>
                      <p>shop types</p>
                    </a>
                  </li>
                  <li class="nav-item has-treeview {{ (request()->segment(4) == 'access-control-levels') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                      <i class="nav-icon fas fa-circle"></i>
                      <p>
                        ACL
                        <i class="right fas fa-angle-left"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="{{ route('company.roles.index') }}" class="nav-link {{ (request()->routeIs('company.roles.*')) ? 'active' : '' }}">
                          <i class="fas fa-circle nav-icon"></i>
                          <p>Roles</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{ route('company.permissions.index') }}" class="nav-link {{ (request()->routeIs('company.permissions.*')) ? 'active' : '' }}">
                          <i class="fas fa-circle nav-icon"></i>
                          <p>Permissions</p>
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="nav-item has-treeview {{ (request()->segment(4) == 'statuses') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                      <i class="nav-icon fas fa-circle"></i>
                      <p>
                        statuses
                        <i class="right fas fa-angle-left"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="{{ route('company.order-statuses.index') }}" class="nav-link {{ (request()->routeIs('company.order-statuses.*')) ? 'active' : '' }}">
                          <i class="fas fa-circle nav-icon"></i>
                          <p>Order Statuses</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{ route('company.shop-account-statuses.index') }}" class="nav-link {{ (request()->routeIs('company.shop-account-statuses.*')) ? 'active' : '' }}">
                          <i class="fas fa-circle nav-icon"></i>
                          <p>Shop Account Statuses</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{ route('company.user-account-statuses.index') }}" class="nav-link {{ (request()->routeIs('company.user-account-statuses.*')) ? 'active' : '' }}">
                          <i class="fas fa-circle nav-icon"></i>
                          <p>User Account Statuses</p>
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="nav-item has-treeview {{ (request()->segment(4) == 'locations') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                      <i class="nav-icon fas fa-circle"></i>
                      <p>
                        Locations
                        <i class="right fas fa-angle-left"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="{{ route('company.countries.index') }}" class="nav-link {{ (request()->routeIs('company.countries.*')) ? 'active' : '' }}">
                          <i class="fas fa-circle nav-icon"></i>
                          <p>countries</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{ route('company.regions.index') }}" class="nav-link {{ (request()->routeIs('company.regions.*')) ? 'active' : '' }}">
                          <i class="fas fa-circle nav-icon"></i>
                          <p>regions</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{ route('company.cities.index') }}" class="nav-link {{ (request()->routeIs('company.cities.*')) ? 'active' : '' }}">
                          <i class="fas fa-circle nav-icon"></i>
                          <p>cities</p>
                        </a>
                      </li>
                    </ul>
                  </li>
                </ul>
              </li>

            </ul>
          </nav>
          <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
      </aside>