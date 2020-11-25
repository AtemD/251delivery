<nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
          </li>
        </ul>

        <!-- SEARCH FORM -->
        <form class="form-inline ml-3">
          <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-navbar" type="submit">
                <i class="fas fa-search"></i>
              </button>
            </div>
          </div>
        </form>

        @php
            $notifications = collect($shop->notifications);
            $notifications_count = $notifications->count();

            // filter notifications to only get the orderplaced notifications.
            $order_placed_notifications = $notifications->filter(function($value, $key) {
              return $value->type == 'App\Notifications\OrderPlaced';
            });

            $order_placed_notifications_count = $order_placed_notifications->count();
        @endphp

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
          @if(!empty($notifications->first()))
            <li class="nav-item dropdown">
              <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                <i class="fas fa-bell mr-3"></i>

                <span class="badge badge-warning navbar-badge">{{ $notifications_count }}</span>
              </a>
              <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">{{ $notifications_count }} {{ Str::plural('Notification', $notifications_count) }} </span>
                <div class="dropdown-divider"></div>

                @if(!empty($order_placed_notifications->first()))
                  <a href="#" class="dropdown-item">
                    <i class="fas fa-shopping-cart mr-2"></i> {{ $order_placed_notifications_count }} new {{ Str::plural('order', $order_placed_notifications_count) }}
                    <span class="float-right text-muted text-sm">
                      {{ $order_placed_notifications->first()->created_at->diffForHumans() }}
                    </span>
                  </a>
                @endif
                
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
              </div>
            </li>
          @endif
        </ul>
      </nav>