  <!-- Sidebar -->
  <div class="sidebar sidebar-style-1 text-light" data-background-color="dark">
        <div class="sidebar-logo">
          <!-- Logo Header -->
          <div class="logo-header" data-background-color="dark">
            <a href="{{ route('dashboard.index') }}" class="logo">
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
          <div class="sidebar-content" >
            <ul class="nav nav-secondary">
              <li class="nav-item {{ request()->is('dashboard*') ? 'active' : '' }}">
                <a href="/dashboard">
                  <i class="fas fa-home"></i>
                  <p>Dashboard</p>
                </a>
              </li>
              @can('view buyers')
               <li class="nav-item {{ request()->is('buyers*') ? 'active' : '' }}">
                <a data-bs-toggle="collapse" href="#buyers">
                  <i class="fas fa-shopping-cart"></i>
                  <p>Buyers</p>
                  <span class="caret"></span>
                </a>
                <div class="collapse" id="buyers">
                  <ul class="nav nav-collapse">
                    @can('view buyers')
                    <li class="{{ request()->routeIs('buyers.index') ? 'active' : '' }}">
                      <a href="{{ route('buyers.index') }}">
                        <span class="sub-item">All Buyers</span>
                      </a>
                    </li>
                    @endcan
                    @if(auth()->user()->can('view purchase') || auth()->user()->can('manage sale_purchase'))
                    <li class="nav-item {{ request()->routeIs('sale-purchase.purchase') ? 'active' : '' }}">
                     <a href="{{ route('sale-purchase.purchase') }}">
                       <span class="sub-item">View PKGJS Purchase</span>
                     </a>
                   </li>
                    @endif
                    @can('create flights details')
                    <li class="{{ request()->routeIs('flight-details.buyer_selection') ? 'active' : '' }}">
                      <a href="{{ route('flight-details.buyer_selection') }}">
                        <span class="sub-item">Add Flight Details</span>
                      </a>
                    </li>
                    @endcan
                   @can('create accomodation details')
                     <li class="{{ request()->routeIs('accommodation.select_user') ? 'active' : '' }}">
                      <a href="{{ route('accommodation.select_user') }}">
                        <span class="sub-item">Add Accommodation Details</span>
                      </a>
                    </li>
                   @endcan
                    
                    @can('view accomodation details')
                       <li class="{{ request()->routeIs('accommodation.index') ? 'active' : '' }}">
                      <a href="{{ route('accommodation.index') }}">
                        <span class="sub-item">View Accommodations</span>
                      </a>
                    </li>
                    @endcan
                   @can('view visa')
                   <li class="{{ request()->routeIs('visa,index') ? 'active' : '' }}">
                    <a href="{{ route('visa.index', auth()->user()->id) }}">
                      <span class="sub-item">View All Visa Details</span>
                    </a>
                  </li> 
                   @endcan
                   @can('view flight details')
                   <li class="{{ request()->routeIs('flight-details.buyers') ? 'active' : '' }}">
                    <a href="{{ route('flight-details.buyers') }}">
                      <span class="sub-item">View Flight Details</span>
                    </a>
                  </li>
                  
                   @endcan
                   
                  </ul>
                </div>
              </li>
              @endcan

              @can('view international visitors')
              <li class="nav-item {{ request()->is('visitors*') ? 'active' : '' }}">
                <a data-bs-toggle="collapse" href="#visitors">
                  <i class="fas fa-users"></i>
                  <p>Visitors</p>
                  <span class="caret"></span>
                </a>
                <div class="collapse" id="visitors">
                  <ul class="nav nav-collapse">
                    @can('view visitors')
                      <li class="{{ request()->routeIs('visitors.index') ? 'active' : '' }}">
                        <a href="{{ route('visitors.index') }}">
                          <span class="sub-item">All Natioanl Visitors</span>
                        </a>
                      </li>
                    @endcan

                    @can('view international visitors')
                      <li class="{{ request()->routeIs('international-visitors.index') ? 'active' : '' }}">
                        <a href="{{ route('international-visitors.index') }}">
                          <span class="sub-item">All International Visiters</span>
                        </a>
                      </li>
                      @can('view visa')
                         <li class="{{ request()->routeIs('visa.index') ? 'active' : '' }}">
                        <a href="{{ route('visa.index') }}">
                          <span class="sub-item">View Visa Details</span>
                        </a>
                      </li>
                      @endcan
                     @can('view flight details')
                      <li class="{{ request()->routeIs('flight-details.visitors') ? 'active' : '' }}">
                        <a href="{{ route('flight-details.visitors') }}">
                          <span class="sub-item">View International Visitor Flight Details</span>
                        </a>
                      </li>
                     @endcan
                    {{-- @can('view accomodation details')
                    <li class="{{ request()->routeIs('accommodation.index') ? 'active' : '' }}">
                      <a href="{{ route('accommodation.index') }}">
                        <span class="sub-item">View Accommodations</span>
                      </a>
                    </li> --}}
                      
                    {{-- @endcan --}}
                      @endcan
                    </ul>
                  </div>
                </li>
              @endcan
              
             
              
             
              @can('view invitation letter')
                 <li class="nav-item {{ request()->routeIs('invitation.index') ? 'active' : '' }}">
                <a href="{{ route('invitation.index') }}">
                  <i class="fas fa-file-alt"></i>
                  <p>Inivitation Letter</p>
                </a>
              </li>
              @endcan
             
            

              @can('view entry pass')
              <li class="nav-item {{ request()->routeIs('entry-pass.index') ? 'active' : '' }}">
                <a href="{{ route('entry-pass.index') }}">
                  <i class="fas fa-key"></i>
                  <p>Enter Pass</p>
                </a>
              </li>
           
              @endcan
            
              {{-- ///////////////////////////////////////////// --}}
              {{-- ///////////////////////////////////////////// --}}

              @cannot('admin')
              @can('view visa')
              <li class="nav-item {{ request()->is('visa*') ? 'active' : '' }}">
                <a data-bs-toggle="collapse" href="#visa">
                  <i class="fas fa-passport"></i>
                  <p>Visa</p>
                  <span class="caret"></span>
                </a>
                <div class="collapse" id="visa">
                  <ul class="nav nav-collapse">
                    @can('view visa')
                    <li class="{{ request()->routeIs('visa.index') ? 'active' : '' }}">
                      <a href="{{ route('visa.index', auth()->user()->id) }}">
                        <span class="sub-item">View Visa</span>
                      </a>
                    </li>
                    @endcan
                    @can('create visa')
                    @if(!auth()->user()->visa)
                    <li class="{{ request()->routeIs('visa.create') ? 'active' : '' }}">
                      <a href="{{ route('visa.create') }}">
                        <span class="sub-item">Upload Visa</span>
                      </a>
                    </li>
                    @endif
                    @endcan
                  </ul>
                </div>
              </li>
              @endcan
                @can('view flight details')
                <li class="nav-item {{ request()->is('flight-details*') ? 'active' : '' }}">
                  <a data-bs-toggle="collapse" href="#flight-details">
                    <i class="fas fa-plane"></i>
                    <p>Flight Details</p>
                    <span class="caret"></span>
                  </a>
                  <div class="collapse" id="flight-details">
                    <ul class="nav nav-collapse">
                      @can('view flight details')
                      <li class="{{ request()->routeIs('flight-details.index') ? 'active' : '' }}">
                        <a href="{{ route('flight-details.index') }}">
                          <span class="sub-item">View Flight Details</span>
                        </a>
                      </li>
                      @endcan
                      @can('create flights details')
                        @if(!auth()->user()->flight)
                          <li class="{{ request()->routeIs('flight-details.selfcreate') ? 'active' : '' }}">
                            <a href="{{ route('flight-details.selfcreate') }}">
                              <span class="sub-item">Add Flight Details</span>
                            </a>
                          </li>
                        @endif
                      @endcan
                    </ul>
                  </div>
                </li>
                @endcan
                  
                @can('view accomodation details')
                <li class="nav-item {{ request()->is('accommodation*') ? 'active' : '' }}">
                  <a data-bs-toggle="collapse" href="#accommodation">
                    <i class="fas fa-bed"></i>
                    <p>Accommodation</p>
                    <span class="caret"></span>
                  </a>
                  <div class="collapse" id="accommodation">
                    <ul class="nav nav-collapse">
                      @can('view accomodation details')
                      <li class="{{ request()->routeIs('accommodation.index') ? 'active' : '' }}">
                        <a href="{{ route('accommodation.index') }}">
                          <span class="sub-item">View Accommodation</span>
                        </a>
                      </li>
                      @endcan
                      @can('create accomodation details')
                      <li class="{{ request()->routeIs('accommodation.create') ? 'active' : '' }}">
                        <a href="{{ route('accommodation.create') }}">
                          <span class="sub-item">Add Accommodation</span>
                        </a>
                      </li>
                      @endcan
                    </ul>
                  </div>
                </li>
              @endcan
              @endcannot


             
              @can('view exhibitors')
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
                    @if(auth()->user()->can('view sale') || auth()->user()->can('manage sale_purchase'))
                    <li class="nav-item {{ request()->routeIs('sale-purchase.sales') ? 'active' : '' }}">
                     <a href="{{ route('sale-purchase.sales') }}">
                       <span class="sub-item">View PKGJS Sales</span>
                     </a>
                   </li>
                   @endif 
                  </ul>
                </div>
              </li>
            @endcan
          
            @can('pkgjs sales')
            <li class="nav-item {{ request()->routeIs('floor-plan.index') ? 'active' : '' }}">
              <a href="{{ route('floor-plan.index') }}">
                <i class="fas fa-file-alt"></i>
                <p>Floor Plan</p>
              </a>
            </li>
              <li class="nav-item {{ request()->routeIs('pkgjs-sales.index') ? 'active' : '' }}">
                <a href="{{ route('pkgjs-sales.index') }}">
                  <i class="fas fa-file-alt"></i>
                  <p>PKGJS Sales</p>
                </a>
              </li>
              <li class="nav-item {{ request()->routeIs('fbr-tax.index') ? 'active' : '' }}">
                <a href="{{ route('fbr-tax.index') }}">
                  <i class="fas fa-file-alt"></i>
                  <p>FBR Tax</p>
                </a>
              </li>
            @endcan
            @can('pkgjs purchase')
              <li class="nav-item {{ request()->routeIs('pkgjs-purchase.index') ? 'active' : '' }}">
                <a href="{{ route('pkgjs-purchase.index') }}">
                  <i class="fas fa-file-alt"></i>
                  <p>PKGJS Purchase</p>
                </a>
              </li>
            @endcan
            
              
              <li class="nav-item {{ request()->is('profile*') ? 'active' : '' }}">
                <a data-bs-toggle="collapse" href="#profile">
                  <i class="fas fa-user"></i>
                  <p>Profile</p>
                  <span class="caret"></span>
                </a>
                <div class="collapse" id="profile">
                  <ul class="nav nav-collapse">
                    @if (auth()->user()->can('admin'))
                    <li class="{{ request()->routeIs('profile.personal') ? 'active' : '' }}">
                      <a href="{{ route('profile.personal') }}">
                        <span class="sub-item">View Profile</span>
                      </a>
                    </li>
                    @else
                    <li class="{{ request()->routeIs('profile.index') ? 'active' : '' }}">
                      <a href="{{ route('profile.index') }}">
                        <span class="sub-item">View Profile</span>
                      </a>
                    </li>
                    @endif
                    <li class="{{ request()->routeIs('auth.password.change') ? 'active' : '' }}">
                      <a href="{{ route('auth.password.change') }}">
                        <span class="sub-item">Change Password</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li>
              @if (auth()->user()->can('view onspot entry'))
              <li class="nav-item {{ request()->is('onspot-entry*') ? 'active' : '' }}">
                <a data-bs-toggle="collapse" href="#onspot-entry">
                  <i class="fas fa-keyboard"></i>
                  <p>Onspot Users</p>
                  <span class="caret"></span>
                </a>
                <div class="collapse" id="onspot-entry">
                  <ul class="nav nav-collapse">
                    @can('view onspot entry')
                    <li class="{{ request()->routeIs('onspot-entry.index') ? 'active' : '' }}">
                      <a href="{{ route('onspot-entry.index') }}">
                        <span class="sub-item">View All Onspot Users</span>
                      </a>
                    </li>
                    @endcan
                    @can('add onspot entry')
                    <li class="{{ request()->routeIs('onspot-entry.create') ? 'active' : '' }}">
                      <a href="{{ route('onspot-entry.create') }}">
                        <span class="sub-item">Add Onspot User</span>
                      </a>
                    </li>
                    @endcan
                  </ul>
                </div>
              </li>
              @endif

              {{-- @can('view transport')
              <li class="nav-item {{ request()->is('transports*') ? 'active' : '' }}">
                <a data-bs-toggle="collapse" href="#transports">
                  <i class="fas fa-bus"></i>
                  <p>Transports</p>
                  <span class="caret"></span>
                </a>
                <div class="collapse" id="transports">
                  <ul class="nav nav-collapse">
                    <li class="{{ request()->routeIs('flight-details.buyers') ? 'active' : '' }}">
                      <a href="{{ route('flight-details.buyers') }}">
                        <span class="sub-item">Buyers Flight Details</span>
                      </a>
                    </li>
                   
                  </ul>
                </div>
              </li>

              @endcan --}}
              
              {{-- <li class="nav-item {{ request()->is('hospitality*') ? 'active' : '' }}">
                <a data-bs-toggle="collapse" href="#hospitality">
                  <i class="fas fa-hotel"></i>
                  <p>Hospitality</p>
                  <span class="caret"></span>
                </a>
                <div class="collapse" id="hospitality">
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
                    <li class="{{ request()->routeIs('accommodation.select_user') ? 'active' : '' }}">
                      <a href="{{ route('accommodation.select_user') }}">
                        <span class="sub-item">Add Accommodation Details</span>
                      </a>
                    </li>
                    <li class="{{ request()->routeIs('accommodation.select_user') ? 'active' : '' }}">
                      <a href="{{ route('accommodation.select_user') }}">
                        <span class="sub-item">View Accommodations</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </li> --}}
              
              {{-- --- --}}
              @can('create visa | view visa')
                <li class="nav-item {{ request()->is('visa*') ? 'active' : '' }}">
                  <a data-bs-toggle="collapse" href="#visa">
                    <i class="fas fa-passport"></i>
                    <p>Visa</p>
                    <span class="caret"></span>
                  </a>
                  <div class="collapse" id="visa">
                    <ul class="nav nav-collapse">
                      @can('create visa')
                        <li class="{{ request()->routeIs('visa.create') ? 'active' : '' }}">
                          <a href="{{ route('visa.create') }}">
                            <span class="sub-item">Upload Visa</span>
                          </a>
                        </li>
                       <li class="{{ request()->routeIs('visa.show') ? 'active' : '' }}">
                          <a href="{{ route('visa.show', auth()->user()->id) }}">
                            <span class="sub-item">Visa Details</span>
                          </a>
                        </li> 
                      @endcan
                    </ul>
                  </div>
                </li>
              @endcan
              
              @if(auth()->user()->hasRole(['international-visitor']))
              <li class="nav-item {{ request()->is('flight-details*') ? 'active' : '' }}">
                      <a data-bs-toggle="collapse" href="#flight">
                        <i class="fas fa-plane"></i>
                        <p>Flight Details</p>
                        <span class="caret"></span>
                      </a>
                      <div class="collapse" id="flight">
                        <ul class="nav nav-collapse">
                       
                        <li class="{{ request()->routeIs('flight-details.selfcreate') ? 'active' : '' }}">
                          <a href="{{ route('flight-details.selfcreate') }}">
                          <span class="sub-item">Add Flight Details</span>
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