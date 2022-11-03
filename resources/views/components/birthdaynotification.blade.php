<li class="dropdown notification-list">
    <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#"
        role="button" aria-haspopup="false" aria-expanded="false">
        <i class="mdi mdi-cake noti-icon"></i>
        <span class="badge-outline text-danger"> <strong>{{ $birthdays->count() }}</strong></span>
    </a>
    <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated dropdown-lg">

        <!-- item-->
        <div class="dropdown-item noti-title">
            <h5 class="m-0">
                <span class="float-end">
                </span>Today's Birthdays
            </h5>
        </div>

        <div style="max-height: 230px;" data-simplebar="">
            @if (!$birthdays->isEmpty())
                @foreach ($birthdays as $birthday)
                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <div class="notify-icon">
                            <img class="me-3 rounded-circle"
                                src="{{ asset('storage/' . $birthday->photo) }}" width="40"
                                alt="Photo">
                        </div>
                        <p class="notify-details">
                            {{ $birthday->fullName }}
                        </p>
                        <p class="text-muted mb-0 user-msg">
                            <small>Let them know you are thinking about them</small>
                        </p>
                    </a>
                @endforeach
            @else
                <div class="text-center">
                    <p class="text-muted mb-1">
                        <small>Nothing to show here.</small>
                    </p>
                </div>
            @endif
        </div>
    </div>
</li>