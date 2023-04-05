<x-super-admin-layout>
    <!-- start quote -->
    <x-quote>
    </x-quote>

    <!-- end row-->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <x-card-header>
                    User Permissions
                    <x-slot:buttons>
                        <a type="button" href="#" class="btn btn-success mb-2 me-1"
                        data-bs-toggle="modal" data-bs-target="#addPermission">Create Permission</a>
                    </x-slot>
                </x-card-header>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datableButtons" class="table w-100 nowrap">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th class="th">Name</th>
                                    <th class="th">Display Name</th>
                                    <th class="th">Description</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($permissions as $key => $permission)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>
                                            {{ $permission->name }}
                                        </td>
                                        <td>
                                            {{ $permission->display_name }}
                                        </td>
                                        <td>
                                            {{ $permission->description }}
                                        </td>
                                        <td class="table-action">
                                            <a href="{{route('user-permissions.edit', $permission->id)}}" class="action-icon"> <i class="mdi mdi-pencil"></i></a>
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
    @include('super-admin.createPermissionModal')

</x-super-admin-layout>
