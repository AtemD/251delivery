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
              <a href="#" class="d-block">Daniel Atem</a>
            </div>
          </div>

          <!-- Sidebar Menu -->
          <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
              <!-- Add icons to the links using the .nav-icon class
                   with font-awesome or any other icon font library -->
              <li class="nav-item">
                <a href="{{ route('company.home') }}" class="nav-link">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                    Dashboard
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('company.shops.index') }}" class="nav-link">
                  <i class="nav-icon fas fa-store-alt"></i>
                  <p>
                    Shops
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('company.users.index') }}" class="nav-link">
                  <i class="nav-icon fas fa-users"></i>
                  <p>
                    Users
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('company.orders.index') }}" class="nav-link">
                  <i class="nav-icon fas fa-shopping-cart"></i>
                  <p>
                    Orders
                  </p>
                </a>
              </li>

              <li class="nav-item has-treeview menu-open">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-cog"></i>
                  <p>
                     Settings
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('company.settings.cuisines.index') }}" class="nav-link">
                      <i class="fas fa-circle nav-icon"></i>
                      <p>cuisines</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('company.settings.order-types.index') }}" class="nav-link">
                      <i class="fas fa-circle nav-icon"></i>
                      <p>order types</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('company.settings.payment-methods.index') }}" class="nav-link">
                      <i class="fas fa-circle nav-icon"></i>
                      <p>payment methods</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('company.settings.shop-types.index') }}" class="nav-link">
                      <i class="fas fa-circle nav-icon"></i>
                      <p>shop types</p>
                    </a>
                  </li>
                  <li class="nav-item has-treeview menu-open">
                    <a href="#" class="nav-link">
                      <i class="nav-icon fas fa-circle"></i>
                      <p>
                        statuses
                        <i class="right fas fa-angle-left"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: block;">
                      <li class="nav-item">
                        <a href="{{ route('company.settings.order-statuses.index') }}" class="nav-link">
                          <i class="fas fa-circle nav-icon"></i>
                          <p>Order Statuses</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{ route('company.settings.shop-account-statuses.index') }}" class="nav-link">
                          <i class="fas fa-circle nav-icon"></i>
                          <p>Shop Account Statuses</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{ route('company.settings.user-account-statuses.index') }}" class="nav-link">
                          <i class="fas fa-circle nav-icon"></i>
                          <p>User Account Statuses</p>
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="nav-item has-treeview menu-open">
                    <a href="#" class="nav-link">
                      <i class="nav-icon fas fa-circle"></i>
                      <p>
                        Locations
                        <i class="right fas fa-angle-left"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: block;">
                      <li class="nav-item">
                        <a href="{{ route('company.settings.countries.index') }}" class="nav-link">
                          <i class="fas fa-circle nav-icon"></i>
                          <p>countries</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="{{ route('company.settings.regions.index') }}" class="nav-link">
                          <i class="fas fa-circle nav-icon"></i>
                          <p>regions</p>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a href="#" class="nav-link">
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