<x-super-admin-layout>
    <!-- start quote -->
    <x-quote>
    </x-quote>

    <!-- end row-->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <x-card-header>
                    User Roles
                    <x-slot:buttons>
                        <a type="button" href="#" class="btn btn-success mb-2 me-1"
                        data-bs-toggle="modal" data-bs-target="#addRole">Create Role</a>
                    </x-slot>
                </x-card-header>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datableButtons" class="table w-100 nowrap">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th class="th">Display Name</th>
                                    <th class="th">Name</th>
                                    <th class="th"># Permissions</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $key => $role)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $role->display_name }}</td>
                                        <td> {{ $role->name }}</td>
                                        <td>{{ $role->permissions_count }}</td>
                                        <td class="table-action d-flex">
                                            @if (\Laratrust\Helper::roleIsEditable($role))
                                                <a href="{{ route('user-roles.edit', $role->id) }}" class="action-icon">
                                                    <i class="mdi mdi-pencil"></i></a>
                                            @else
                                                <a href="{{ route('user-roles.show', $role->id) }}" class="action-icon">
                                                    <i class="mdi mdi-eye"></i></a>
                                            @endif

                                            <form action="{{ route('user-roles.destroy', $role->id) }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                @if (\Laratrust\Helper::roleIsDeletable($role))
                                                    <a href="#" class="action-icon"
                                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                                        <i class="mdi mdi-delete"></i></a>
                                                @else
                                                    {{-- <i class="uil-padlock"></i> --}}
                                                @endif
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div> <!-- end preview-->

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
    <!-- end row-->
    @include('super-admin.createRoleModal')

</x-super-admin-layout>
