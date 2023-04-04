<div>
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Documents</a></li>
                            <li class="breadcrumb-item active">Categories</li>
                        </ol>
                    </div>
                    <h4 class="page-title">All document categories</h4>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header pt-0">
                        <div class="row mb-2">
                            <div class="col-sm-12 mt-3">
                                <div class="d-sm-flex align-items-center">
                                    <h5 class="mb-2 mb-sm-0"> 
                                        @if (!$toggleForm)
                                            Document Categories
                                        @else
                                            Edit Categories
                                        @endif
                                    </h5>
                                    {{-- @include('livewire.layouts.partials.inc.create-resource') --}}
                                </div>
                            </div>
                            
                        </div>
                    </div>

                    <div class="card-body">
                        {{------------------------------------- creating a new button or document category ------------------------}}
                    
                                <div class="row">
                                    <div class="col-md-12">
                                        <div wire:ignore.self class="tab-content  py-3">
                                            {{-- Resource Category Form --}}
                                            <div class="">
                                                <x-inventory.table-utilities>
                                                    <div class="text-sm-end mt-1 ms-auto position-relative">
                                                        <a type="button" href="javascript:void()" class="btn @if (!$createNew) btn-success
                                                        @else
                                                        btn-outline-danger @endif"
                                                            wire:click="$set('createNew',{{ !$createNew }})">
                                                            @if (!$createNew)
                                                                <i class="mdi mdi-plus"></i>New
                                                            @else
                                                                <i class="mdi mdi-caret-up"></i>
                                                            @endif
                                                        
                                                        Close </a>
                                                    </div>
                                                </x-inventory.table-utilities>
                                                @if ($createNew)
                                                    <form
                                                        @if (!$toggleForm) wire:submit.prevent="storeCategory"
                                                        @else
                                                        wire:submit.prevent="updateCategory" @endif>
                                                        <div class="modal-content- p-2">
                                                            <div class="row">
                                                                <div class="mb-3 col-md-5">
                                                                    <label for="name" class="form-label">Category Name</label>
                                                                    <input type="text" id="name" class="form-control"
                                                                        wire:model.lazy="name">
                                                                    @error('name')
                                                                        <div class="text-danger text-small">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                                <div class="mb-3 col-md-5">
                                                                    <label for="name" class="form-label">Category type</label>
                                                                    <select name="parent_id" id="parent_id" wire:model="parent_id" class="form-select">
                                                                        <option value="0">None...</option>
                                                                        @forelse ($categories as $category)
                                                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    @error('parent_id')
                                                                        <div class="text-danger text-small">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            
                                                        
                                                                <div class="col-md-2">
                                                                    @if (!$toggleForm)
                                                                    <x-button class="btn-success mt-3">{{ __('Save') }}</x-button>
                                                                    @else
                                                                        <x-button class="btn-success mt-3">{{ __('Update') }}</x-button>
                                                                    @endif
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </form>                                                
                                                @endif
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-bordered table-hover table-sm mb-0">
                                                            <thead>
                                                                <tr>
                                                                    <th>Name <i class='mdi mdi-up-arrow-alt ms-2'></i></th>
                                                                    <th>Parent</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @forelse ($categories as $category)
                                                                <tr>
                                                                    <td>
                                                                        {{$category->name}}
                                                                    </td>
                                                                    <td>{{$category->parent->name??'N/A'}}</td>
                                                                    <td>
                                                                        <a href="jascript:void()" wire:click='editCategory({{$category->id}})'><i class='mdi mdi-pencil font-10'></i></a> 
                                                                        <a href="javascript: void(0);" 
                                                                        wire:click="deleteConfirmation({{ $category->id }})" class="action-ico text-danger  mx-1">
                                                                        <i class="mdi mdi-delete"></i></a>
                                                                    </td>
                                                                </tr>
                                                                @empty                                                            
                                                                    
                                                                <tr>
                                                                
                                                                    <td colspan="4" class="text-center text-danger">You have no resources uploaded</td>
                                                                
                                                                </tr>
                                                                @endforelse
                        
                                                            </tbody>
                                                        </table>
                                                    </div>
                                            </div>
                                        
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                            {{------------------------------------- displayng available categories ------------------------}}
                        
                        <!--end row-->
                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div>
    </div>
    @push('scripts')
    <script>
        window.addEventListener('close-modal', event => {
            $('#add_new_folder').modal('hide');
            $('#delete_modal').modal('hide');
            $('#show-delete-confirmation-modal').modal('hide');
        });
        window.addEventListener('delete-modal', event => {
            $('#delete_modal').modal('show');
        });
        window.addEventListener('show-modal', event => {
            $('#requestPreviewModal').modal('show');
        });
    </script>
    @endpush
</div>
