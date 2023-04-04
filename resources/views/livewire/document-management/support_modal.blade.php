
<div wire:ignore.self class="modal fade" id="addNewSuportDoc" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">New document</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div> <!-- end modal header -->
            <div class="modal-body">
                <form wire:submit.prevent='addSupportDocument'>
                    <div class="row">
                        <div class="col-md-12 mb-1">
                            <label for="title" class="form-label">Document Title</label>
                            <input type="text" id="support_document_title" class="form-control"
                                wire:model.defer="support_document_title">
                            @error('support_document_title')
                                <div class="text-danger text-small">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12 mb-1">
                            <label for="file" class="form-label">Upload File</label>
                            <input type="file" id="support_file{{$iteration}}" class="form-control"
                                wire:model.lazy="support_file">
                            @error('support_file')
                                <div class="text-danger text-small">{{ $message }}</div>
                            @enderror
                            <div class="text-success text-small" wire:loading
                            wire:target="file">Uploading file...</div>
                        </div> 
                        <div class="col-md-12 mt-3">
                            <button wire:click="$set('active_document_id',{{$document->id}})" type="submit" class="btn text-white btn-info btn-sm float-end">Add</button>
                        </div>
                    </div>
                </form> 
            </div>
        </div>
    </div>
</div>

<div wire:ignore.self class="modal fade" id="addNewSignatories" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">New document</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div> <!-- end modal header -->
            <div class="modal-body">

                <form wire:submit.prevent='addSignatory'>
                    <div class=" add-input">
                        <div class="row">
                            <div class="col-12 mb-1">
                                <div class="form-group">
                                    <label for="title" class="form-label">Level</label>
                                    <input type="number"class="form-control" id="signatory_level" wire:model.lazy="signatory_level" placeholder="Enter level ">
                                    @error('signatory_level') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-md-12 mb-1">
                                <div class="form-group">
                                    <label for="title" class="form-label">Signatory</label>
                                    <select name="signatory_id" class="form-control form-select" id="signatory_id" wire:model.lazy="signatory_id">
                                        <option value="">Select...</option>
                                        @forelse ($users as $user)
                                            <option value="{{$user->id}}">{{$user->name}}</option>
                                        @empty
                                            <option value="">No user</option>
                                        @endforelse
                                    </select>
                                    @error('signatory_id') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-md-12 mb-1">
                                <div class="form-group">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text"class="form-control" id="name_title.0" wire:model.lazy="name_title" placeholder="Enter signatory title for level ">
                                    @error('name_title') <span class="text-danger error">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-md-12 mt-2">
                                <button type="submit" wire:click="$set('active_document_id',{{$document->id}})" class="btn text-white btn-info btn-sm float-end">Add</button>
                            </div>
                        </div>
                    </div>
                </form> 

            </div>
        </div>
    </div>
</div>