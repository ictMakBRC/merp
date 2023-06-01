 <!-- Topbar Start -->
 <div class="navbar-custom">
     <ul class="list-unstyled topbar-menu float-end mb-0">
         <x-birthdaynotification>

         </x-birthdaynotification>
         <x-notices-suggestions>

        </x-notices-suggestions>

        <li class="notification-list">
            <a class="nav-link end-bar-toggle" href="javascript: void(0);">
                <i class="dripicons-gear noti-icon"></i>
            </a>
        </li>
         <li class="dropdown notification-list">
             <a class="nav-link dropdown-toggle nav-user arrow-none me-0" data-bs-toggle="dropdown" href="#"
                 role="button" aria-haspopup="false" aria-expanded="false">
                 <span class="account-user-avatar">
                     <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="user-image" class="rounded-circle" onerror="this.onerror=null;this.src='{{asset('assets/images/users/avatar-4.jpg')}}';" >
                 </span>
                 <span>
                     <span class="account-user-name">{{ Auth::user()->name }}</span>

                 </span>
             </a>
             <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated topbar-dropdown-menu profile-dropdown">
                 <!-- item-->
                 <div class=" dropdown-header noti-title">
                     <h6 class="text-overflow m-0">Hi !</h6>
                 </div>

                 <!-- item-->
                 <a href="{{ route('user.account') }}" class="dropdown-item notify-item">
                     <i class="mdi mdi-account-circle me-1"></i>
                     <span>My Account</span>
                 </a>
                 <!-- item-->
                 <a href="{{ route('dashboard') }}" class="dropdown-item notify-item">
                     <i class="uil-home-alt"></i>
                     <span>Checkout</span>
                 </a>
                 <!-- item-->
                 <form method="POST" action="{{ route('logout') }}">
                     @csrf

                     <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();"
                         class="dropdown-item notify-item">
                         <i class="mdi mdi-logout me-1"></i>
                         <span>Logout</span>
                     </a>
                 </form>
             </div>
         </li>
     </ul>
     <button class="button-menu-mobile open-left">
         <i class="mdi mdi-menu"></i>
     </button>
 </div>
 <!-- end Topbar -->
