<x-super-admin-layout>
    <!-- start quote -->
    <x-quote>
        {{-- Edit {{ Str::ucfirst($type) }} --}}
    </x-quote>

    <!-- end row-->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <x-card-header>
                    Edit {{ Str::ucfirst($type) }}
                    <x-slot:buttons>

                    </x-slot>
                </x-card-header>

                <div class="card-body">
                    <form method="POST" action="{{ $model ? route("user-{$type}s.update", $model->id) : route("user-{$type}s.store") }}">
                        @csrf
                        @if ($model)
                            @method('PUT')
                        @endif

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="name" class="form-label">Name/Code</label>
                                <input type="text" id="name" class="form-control" name="name" value="{{ $model->name}}"
                                    placeholder="this-will-be-the-code-name" required readonly>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="display_name" class="form-label">Display Name</label>
                                <input type="text" id="display_name" class="form-control" name="display_name" value="{{ $model->description}}"
                                    placeholder="Edit user profile" required>
                            </div>
                            <div class="mb-3 col-md-12">
                                <label for="description" class="form-label">Description</label>
                                <textarea type="email" id="description" class="form-control" name="description"
                                    placeholder="Some description for the {{$type}}">{{ $model->description ?? old('description') }}</textarea>
                            </div>
                        </div>
                        @if($type == 'role')
                        <div class="row">
                            <h3 class="text-success">Permissions</h3>
                            @foreach ($permissions as $permission)
                            <div class="mb-3 col-md-2">
                               <div class="form-check form-check-inline">
                                   <input class="form-check-input" type="checkbox" id="permission{{ $permission->id }}"
                                       name="permissions[]" value="{{ $permission->id }}" {!! $permission->assigned ? 'checked' : '' !!}>
                                   <label class="form-check-label"
                                       for="permission{{ $permission->id }}">{{$permission->display_name ?? $permission->name}}</label>
                               </div>
                            </div>
                                
                            @endforeach

                        </div>
                        @endif
                        <!-- end row-->
                        {{-- <div class="row">
                            <div class="col-md-8">

                            </div>
                            <div class="col-md-4 text-end">
                                    <button class="btn btn-success" type="submit">Save</button>
                            </div>
                        </div> --}}
                        @include('layouts.inc.form-submit')
                        
                    </form>


                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
    <!-- end row-->
</x-super-admin-layout>
