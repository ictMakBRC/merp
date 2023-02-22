<x-super-admin-layout>
    <!-- start quote -->
    <x-quote>
    </x-quote>

    <!-- end row-->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <x-card-header>
                    Roles Assignment<
                    <x-slot:buttons>
                    </x-slot>
                </x-card-header>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datableButtons" class="table w-100 nowrap">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th class="th">Name</th>
                                    <th class="th">Roles</th>
                                    <th class="th">Permissions</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $key=>$user)
                                <tr>
                                  <td>
                                    {{$key+1}}
                                  </td>
                                  <td>
                                    {{$user->name ?? 'The model doesn\'t have a `name` attribute'}}
                                  </td>
                                  <td >
                                    {{$user->roles_count}}
                                  </td>
                                  @if(config('laratrust.panel.assign_permissions_to_user'))
                                  <td >
                                    {{$user->permissions_count}}
                                  </td>
                                  @endif
                                  <td>
                                    <a
                                      href="{{route('user-roles-assignment.edit', $user->id)}}" class="action-icon"> <i class="mdi mdi-pencil"></i></a>
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
</x-super-admin-layout>
