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
                <a href="#" class="nav-link">
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
                <a href="{{ route('retailer.products.index', ['shop' => $shop]) }}" class="nav-link">
                  <i class="nav-icon fas fa-utensils"></i>
                  <p>
                    Products
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
                    <a href="{{ route('retailer.taxes.index', ['shop' => $shop]) }}" class="nav-link">
                      <i class="fas fa-circle nav-icon"></i>
                      <p>Taxes</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('retailer.discounts.index', ['shop' => $shop]) }}" class="nav-link">
                      <i class="fas fa-circle nav-icon"></i>
                      <p>Discount</p>
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