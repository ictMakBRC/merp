<div>
    <div class="card">
        <div class="card-body">
            <form
                @if (!$toggleForm) wire:submit.prevent="storeDocument"
                @else
                wire:submit.prevent="updateDocument" @endif>
                <div class="row"> 
                    <div class="mb-3 col-md-2">
                        <label for="priority" class="form-label">Priority</label>
                        <select class="form-select" id="priority" wire:model.defer="priority">
                            <option selected value="">Select</option>
                            <option value="Normal">Normal</option>
                            <option value="Urgent">Urgent</option>
                        </select>
                        @error('priority')
                            <div class="text-danger text-small">{{ $message }}</div>
                        @enderror
                    </div>                 
                    <div class="mb-3 col-md-10">
                        <label for="title" class="form-label">Request Title</label>
                        <input type="text" id="title" class="form-control"
                            wire:model.defer="title">
                        @error('title')
                            <div class="text-danger text-small">{{ $message }}</div>
                        @enderror
                    </div>
                        
                    <div class="mb-3 col-4">
                        <label for="file" class="form-label">Upload File</label>
                        <input type="file" id="file" class="form-control"
                            wire:model.lazy="file">
                        @error('file')
                            <div class="text-danger text-small">{{ $message }}</div>
                        @enderror
                        <div class="text-success text-small" wire:loading
                        wire:target="file">Uploading file...</div>
                    </div>                                                            
                    <div class="col-md-8">
                        <textarea name="details" id="details" class="form-control" wire:model.defer='details'></textarea>
                    </div>
                </div>             
                <div class="modal-footer">
                    @if (!$toggleForm)
                        <x-button class="btn-success">{{ __('Save') }}</x-button>
                    @else
                        <x-button class="btn-success">{{ __('Update') }}</x-button>
                    @endif
                </div>
            </form>

            
        <div>
            @if ($addSignatory)
                <div class="row">
                    @if ($active_document && count($active_document->signatories)>0)                            
                        <div class="mt-2">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Title</th>
                                        <th>Level</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($active_document->signatories as $signatory)                                        
                                        <tr>
                                            <td>{{$signatory->user->name}}</td>
                                            <td>{{$signatory->title}}</td>
                                            <td>{{$signatory->signatory_level}}</td>
                                            <td>
                                                <a href="javascript: void(0);" 
                                                wire:click="deleteSignatory({{ $signatory->id }})" class="action-ico text-danger  mx-1">
                                                <i class="mdi mdi-delete"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <h6 class="text-center text-success"> No Signatory attached</h6>
                    @endif
                    <div class="col-12">
                        <form wire:submit.prevent='addSignatory'>
                            <div class=" add-input">
                                <div class="row">
                                    <div class="col-2">
                                        <div class="form-group">
                                            <input type="number"class="form-control" id="signatory_level" wire:model.lazy="signatory_level" placeholder="Enter level ">
                                            @error('signatory_level') <span class="text-danger error">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
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
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text"class="form-control" id="name_title.0" wire:model.lazy="name_title" placeholder="Enter signatory title for level ">
                                            @error('name_title') <span class="text-danger error">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="submit" class="btn text-white btn-info btn-sm">Add</button>
                                    </div>
                                </div>
                            </div>
                        </form>                    
                    </div>
                </div>
            @endif
        </div>
        </div>
        @if ($active_document && count($active_document->signatories)>0)
        <button class="btn btn-success"wire:click="submutRequest">Submit Request</button>
        @endif
    </div>
</div>
