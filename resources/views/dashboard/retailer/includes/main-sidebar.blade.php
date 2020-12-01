<aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="/" class="brand-link">
          <img src="/uploads/images/project.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
               style="opacity: .8">
          <span class="brand-text font-weight-light">251Delivery</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info">
              <small class="text-white">{{$shop->name}}</small>

                  <div class="custom-control custom-switch">                      
                    <input name="availability" type="checkbox" class="custom-control-input" disabled
                      id="availability-{{$shop->slug}}" {{ (bool)$shop->is_available ? 'checked' : ''}}>
                      
                      <label class="custom-control-label" for="availability-{{$shop->slug}}">
                        <a href="{{route('retailer.shops.accounts.edit', ['shop' => $shop])}}" class="{{ (bool)$shop->is_available ? 'text-success' : 'text-danger'}}">
                          Shop is {{$shop->is_available ? 'Available' : 'unavailable'}}
                        </a>
                      </label>
                  </div>

            </div>
          </div>

          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
              <img src="/uploads/images/customer-support.png" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
              <a href="{{route('retailer.users.edit', ['shop' => $shop, 'user'=>auth()->user()->slug])}}" class="d-block">{{Auth::user()->full_name}}</a>
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
                  <i class="nav-icon fas fa-list-alt"></i>
                  <p>
                    My Shops
                  </p>
                </a>
              </li>
              <li class="nav-item has-treeview menu-open">
                <a href="#" class="nav-link {{ (request()->routeIs('retailer.orders.*')) ? 'active' : '' }}">
                  <i class="nav-icon fas fa-shopping-cart"></i>
                  <p>
                     Orders
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('retailer.orders.new.index', ['shop' => $shop]) }}" class="nav-link 
                      {{ (request()->routeIs('retailer.orders.new.*') 
                        || request()->routeIs('retailer.orders.in-progress.*') 
                        || request()->routeIs('retailer.orders.ready.*')) ? 'active' : '' }}">
                      <i class="fas fa-circle nav-icon text-danger"></i>
                      <p>Manage Orders</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('retailer.orders.index', ['shop' => $shop]) }}" class="nav-link {{ (request()->routeIs('retailer.orders.index')) ? 'active' : '' }}">
                      <i class="fas fa-circle nav-icon text-info"></i>
                      <p>Order History</p>
                    </a>
                  </li>
                </ul>
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

              <li class="nav-item">
                <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  <i class="nav-icon fas fa-sign-out-alt"></i>
                  <p>
                    {{ __('Logout') }}
                  </p>
                </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                  </form>
              </li>
              
            </ul>
          </nav>
          <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
      </aside>