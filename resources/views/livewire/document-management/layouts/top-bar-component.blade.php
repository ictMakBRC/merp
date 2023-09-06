<div class="navbar-custom">
    <ul class="list-unstyled topbar-menu float-end mb-0">
        <li class="dropdown notification-list d-lg-none">
            <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                <i class="dripicons-search noti-icon"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-animated dropdown-lg p-0">
                <form class="p-3" wire:submit.prevent='findDocument'>
                    <input type="text" wire:model.lazy='search' class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                </form>
            </div>
        </li>

        <li class="dropdown notification-list">
            <a class="nav-link dropdown-toggle nav-user arrow-none me-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                <span class="account-user-avatar">
                    <img src="{{ asset('assets/images/users/avatar-1.jpg')}}" alt="user-image" class="rounded-circle">
                </span>
                <span>
                    <span class="account-user-name">{{ Auth::user()->name }}</span>
                    <span class="account-position"></span>
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated topbar-dropdown-menu profile-dropdown">
                <!-- item-->
                <div class=" dropdown-header noti-title">
                    <h6 class="text-overflow m-0">Welcome !</h6>
                </div>

                <!-- item-->
                <a href="javascript:void(0);" class="dropdown-item notify-item">
                    <i class="mdi mdi-account-circle me-1"></i>
                    <span>My Account</span>
                </a>

                <!-- item-->
                <a href="javascript:void(0);" class="dropdown-item notify-item">
                    <i class="mdi mdi-account-edit me-1"></i>
                    <span>Settings</span>
                </a>

                <!-- item-->
                <a href="javascript:void(0);" class="dropdown-item notify-item">
                    <i class="mdi mdi-lifebuoy me-1"></i>
                    <span>Support</span>
                </a>

                <!-- item-->
                <a href="{{url('dashboard')}}" class="dropdown-item notify-item">
                    <i class="mdi mdi-lock-outline me-1"></i>
                    <span>Switch Module</span>
                </a>

                <!-- item-->
                <a  href="{{ route('logout') }}" onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();" class="dropdown-item notify-item">
                    <i class="mdi mdi-logout me-1"></i>
                    <span>Logout</span>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </a>
            </div>
        </li>

    </ul>
    <button class="button-menu-mobile open-left">
        <i class="mdi mdi-menu"></i>
    </button>
    <div class="app-search dropdown d-none d-lg-block">
        <form wire:submit.prevent='findDocument'>
            <div class="input-group">
                <input type="text" class="form-control dropdown-toggle" placeholder="Search..." id="top-search">
                <span class="mdi mdi-magnify search-icon"></span>
                <button class="input-group-text btn-primary" wire:model='search' type="submit">Search</button>
            </div>
        </form>
        {{-- {{$foundDocuments}} --}}
        {{$search}}
        {{-- @if (count($foundDocuments)>0) --}}
        
            <div class="dropdown-menu dropdown-menu-animated dropdown-lg" id="search-dropdown">
                <!-- item-->
                <div class="dropdown-header noti-title">
                    <h5 class="text-overflow mb-2">Found <span class="text-danger">{{$foundDocuments->count()}}</span> results</h5>
                </div>
                    @forelse ($foundDocuments as $document)
                        <a href="{{route('document.sign',$document->request_code)}}" class="dropdown-item notify-item">
                            <i class="fa fa-file font-16 me-1"></i>
                            <span>{{$document->title}}</span>
                        </a>
                    @empty                    
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <i class="uil-cog font-16 me-1"></i>
                            <span>No results found</span>
                        </a>
                    @endforelse
            </div>
            
        {{-- @endif --}}
    </div>
</div>
