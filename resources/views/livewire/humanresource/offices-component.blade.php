<div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header pt-0">
                    <div class="row mb-2">
                        <div class="col-sm-12 mt-3">
                            <div class="d-sm-flex align-items-center">
                                <h5 class="mb-2 mb-sm-0">
                                    Admin Offices
                                </h5>
                                <div class="ms-auto">
                                    <a type="button" class="btn btn-outline-success" wire:click="refresh()"><i
                                            class="bx bx-revision"></i></a>

                                    <a type="button" class="btn btn-success" data-bs-toggle="modal"
                                        data-bs-target="#ManageOffices"><i class="bx bx-plus"></i>{{ __('New') }}</a>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">

                    <x-table-utilities>
                        <div class="mb-1 col-md-2">
                            <label for="orderBy" class="form-label">OrderBy</label>
                            <select wire:model="orderBy" class="form-select">
                                <option type="name">Name</option>
                                <option type="id">Latest</option>
                            </select>
                        </div>
                    </x-table-utilities>

                    <div class="tab-content">
                        <div class="table-responsive">
                            <table id="datableButton" class="table table-striped table-bordered mb-0 w-100 sortable">
                                <thead class="table-light">
                                    <tr>
                                        <th>No.</th>
                                        <th>Office Name</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($offices as $key => $office)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $office->name }}</td>
                                            <td>{{ $office->description }}</td>
                                            <td class="d-flex table-actions">
                                                <a class="action-ico mx-1 "
                                                   href="javascript:void(0)" wire:click="editData({{ $office->id }})"
                                                    data-bs-toggle="modal" data-bs-target="#ManageOffices"><i  class="mdi mdi-pencil"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div> <!-- end preview-->
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="btn-group float-end">
                                    {{ $offices->links('vendor.livewire.bootstrap') }}
                                </div>
                            </div>
                        </div>
                    </div> <!-- end tab-content-->
                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
 
        {{-- Add/update modal --}}
        <div wire:ignore.self class="modal fade" id="ManageOffices" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        @if ($mode == 'edit')
                            <h5 class="modal-title" id="staticBackdropLabel">Update Office
                            </h5>
                        @else
                            <h5 class="modal-title" id="staticBackdropLabel">New Office
                            </h5>
                        @endif

                        <button type="button" class="btn-close" wire:click="close()" data-bs-dismiss="modal"
                            aria-hidden="true"></button>
                    </div>
                    <!-- end modal header -->
                    <div class="modal-body">
                        @if ($mode == 'edit')
                            <form wire:submit.prevent="updateData">
                            @else
                                <form wire:submit.prevent="storeData">
                        @endif
                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <label for="name" class="form-label required">Office Name</label>
                                <input type="text" id="name" class="form-control" name="name" required
                                    wire:model.lazy="name">
                                @error('name')
                                    <div class="text-danger text-small">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-12">
                                <label for="description" class="form-label">Description</label>
                                <textarea  id="description" class="form-control"
                                name="description" wire:model.lazy="description"></textarea>
                                @error('description')
                                    <div class="text-danger text-small">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <!-- end row-->
                        <div class="modal-footer">
                            <x-button type="btn btn-sm button" class="btn btn-danger" wire:click="close()"
                                data-bs-dismiss="modal">{{ __('Close') }}</x-button>
                                <x-button class="btn btn-sm btn-success">{{ __('Save') }}</x-button>
                        </div>
                        </form>
                    </div>
                </div> <!-- end modal content-->
            </div> <!-- end modal dialog-->
        </div> <!-- end modal-->

   

        @push('scripts')
            <script>
                window.addEventListener('close-modal', event => {
                    $('#ManageOffices').modal('hide');
                    $('#delete_modal').modal('hide');
                    $('#show-delete-confirmation-modal').modal('hide');
                });
                window.addEventListener('delete-modal', event => {
                    $('#delete_modal').modal('show');
                });
            </script>
        @endpush
    </div>
</div>
