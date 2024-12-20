  <!-- Sidebar -->
  <div class="sidebar sidebar-style-2" data-background-color="dark">
        <div class="sidebar-logo">
          <!-- Logo Header -->
          <div class="logo-header" data-background-color="dark">
            <a href="index.html" class="logo">
              <img src="{{ asset('assets/img/logo.png') }}" alt="" style="width:80px;margin:0 auto;">

            </a>
            <div class="nav-toggle">
              <button class="btn btn-toggle toggle-sidebar">
                <i class="gg-menu-right"></i>
              </button>
              <button class="btn btn-toggle sidenav-toggler">
                <i class="gg-menu-left"></i>
              </button>
            </div>
            <button class="topbar-toggler more">
              <i class="gg-more-vertical-alt"></i>
            </button>
          </div>
          <!-- End Logo Header -->
        </div>
        <div class="sidebar-wrapper scrollbar scrollbar-inner">
          <div class="sidebar-content">
            <ul class="nav nav-secondary">
              <li class="nav-item {{ request()->is('dashboard*') ? 'active' : '' }}">
                <a href="/dashboard">
                  <i class="fas fa-home"></i>
                  <p>Dashboard</p>
                </a>
              </li>
              @if(auth()->user()->hasRole('superadmin'))
              <li class="nav-item {{ request()->is('visitors*') ? 'active' : '' }}">
                <a data-bs-toggle="collapse" href="#visitors">
                  <i class="fas fa-users"></i>
                  <p>Visitors</p>
                  <span class="caret"></span>
                </a>
                <div class="collapse" id="visitors">
                  <ul class="nav nav-collapse">
                    <li class="{{ request()->routeIs('visitors.index') ? 'active' : '' }}">
                      <a href="{{ route('visitors.index') }}">
                        <span class="sub-item">All Visitors</span>
                      </a>
                    </li>
                    {{-- <li class="{{ request()->routeIs('visitors.create') ? 'active' : '' }}">
                      <a href="{{ route('visitors.create') }}">
                        <span class="sub-item">Add New Visitor</span>
                      </a>
                    </li> --}}
                  </ul>
                </div>
              </li>
              <li class="nav-item {{ request()->is('buyers*') ? 'active' : '' }}">
                <a data-bs-toggle="collapse" href="#buyers">
                  <i class="fas fa-shopping-cart"></i>
                  <p>Buyers</p>
                  <span class="caret"></span>
                </a>
                <div class="collapse" id="buyers">
                  <ul class="nav nav-collapse">
                    <li class="{{ request()->routeIs('buyers.index') ? 'active' : '' }}">
                      <a href="{{ route('buyers.index') }}">
                        <span class="sub-item">All Buyers</span>
                      </a>
                    </li>
                    {{-- <li class="{{ request()->routeIs('buyers.create') ? 'active' : '' }}">
                      <a href="{{ route('buyers.create') }}">
                        <span class="sub-item">Add New Buyer</span>
                      </a>
                    </li> --}}
                  </ul>
                </div>
              </li>
              <li class="nav-item {{ request()->is('exhibitors*') ? 'active' : '' }}">
                <a data-bs-toggle="collapse" href="#exhibitors">
                  <i class="fas fa-store"></i>
                  <p>Exhibitors</p>
                  <span class="caret"></span>
                </a>
                <div class="collapse" id="exhibitors">
                  <ul class="nav nav-collapse">
                    <li class="{{ request()->routeIs('exhibitors.index') ? 'active' : '' }}">
                      <a href="{{ route('exhibitors.index') }}">
                        <span class="sub-item">All Exhibitors</span>
                      </a>
                    </li>
                    {{-- <li class="{{ request()->routeIs('exhibitors.create') ? 'active' : '' }}">
                      <a href="{{ route('exhibitors.create') }}">
                        <span class="sub-item">Add New Exhibitor</span>
                      </a>
                    </li> --}}
                  </ul>
                </div>
              </li>

              <li class="nav-item {{ request()->is('transports*') ? 'active' : '' }}">
                <a data-bs-toggle="collapse" href="#transports">
                  <i class="fas fa-bus"></i>
                  <p>Transports</p>
                  <span class="caret"></span>
                </a>
                <div class="collapse" id="transports">
                  <ul class="nav nav-collapse">
                    <li class="{{ request()->routeIs('transports.index') ? 'active' : '' }}">
                      <a href="{{ route('transports.index') }}">
                        <span class="sub-item">All Transports</span>
                      </a>
                    </li>
                    {{-- <li class="{{ request()->routeIs('transports.create') ? 'active' : '' }}">
                      <a href="{{ route('transports.create') }}">
                        <span class="sub-item">Add New Transport</span>
                      </a>
                    </li> --}}
                  </ul>
                </div>
              </li>

              <li class="nav-item {{ request()->is('hospitality*') ? 'active' : '' }}">
                <a data-bs-toggle="collapse" href="#hospitality">
                  <i class="fas fa-hotel"></i>
                  <p>Hospitality</p>
                  <span class="caret"></span>
                </a>
                <div class="collapse" id="hospitality">
                  <ul class="nav nav-collapse">
                    <li class="{{ request()->routeIs('hospitality.index') ? 'active' : '' }}">
                      <a href="{{ route('hospitality.index') }}">
                        <span class="sub-item">All Hospitality</span>
                      </a>
                    </li>
                    {{-- <li class="{{ request()->routeIs('hospitality.create') ? 'active' : '' }}">
                      <a href="{{ route('hospitality.create') }}">
                        <span class="sub-item">Add New Hospitality</span>
                      </a>
                    </li> --}}
                  </ul>
                </div>
              </li>

              <li class="nav-item {{ request()->is('international-visitors*') ? 'active' : '' }}">
                <a data-bs-toggle="collapse" href="#international">
                  <i class="fas fa-globe"></i>
                  <p>International Visiters</p>
                  <span class="caret"></span>
                </a>
                <div class="collapse" id="international">
                  <ul class="nav nav-collapse">
                    <li class="{{ request()->routeIs('international-visitors.index') ? 'active' : '' }}">
                      <a href="{{ route('international-visitors.index') }}">
                        <span class="sub-item">All International Visiters</span>
                      </a>
                    </li>
                    <li>
                      <a href="{{ route('flight-details.index') }}">
                        <span class="sub-item">Flight Details</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li>
              @endif
              {{-- --- --}}
              @if(auth()->user()->hasRole('buyer'))
              <li class="nav-item {{ request()->is('flight-details*') ? 'active' : '' }}">
                <a data-bs-toggle="collapse" href="#flight">
                  <i class="fas fa-plane"></i>
                  <p>Flight Details</p>
                  <span class="caret"></span>
                </a>
                <div class="collapse" id="flight">
                  <ul class="nav nav-collapse">
                    <li class="{{ request()->routeIs('flight-details.buyer_selection') ? 'active' : '' }}">
                      <a href="{{ route('flight-details.buyer_selection') }}">
                        <span class="sub-item">Add Flight Details</span>
                      </a>
                    </li>
                    <li class="{{ request()->routeIs('flight-details.buyers') ? 'active' : '' }}">
                      <a href="{{ route('flight-details.buyers') }}">
                        <span class="sub-item">Buyers Flight Details</span>
                      </a>
                    </li>
                    <li class="{{ request()->routeIs('flight-details.visitors') ? 'active' : '' }}">
                      <a href="{{ route('flight-details.visitors') }}">
                        <span class="sub-item">Foreigners Flight Details</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li>
              @endif            
            </ul>
          </div>
        </div>
      </div>
      <!-- End Sidebar -->