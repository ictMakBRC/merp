<div>
    <div class="row">


        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="header-title mb-3"> Make a new request</h4>
                    <div id="progressbarwizard">
                        <div id="rootwizard">
                            <ul class="nav nav-pills nav-justified form-wizard-header mb-3">
                                <li class="nav-item active">
                                    <a href="#first" data-bs-toggle="tab" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2 active">
                                        <i class="mdi mdi-account-circle me-1"></i>
                                        <span class="d-none d-sm-inline">Rquester Details</span>
                                    </a>
                                </li>
                                <li class="nav-item" data-target-form="#profileForm">
                                    <a disabled data-bs-toggle="tab" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2 @if ($active=='items'||$active=='preview')active @endif">
                                        <i class="mdi mdi-face-profile me-1"></i>
                                        <span class="d-none d-sm-inline">Request Items</span>
                                    </a>
                                </li>
                                <li class="nav-item" data-target-form="#otherForm">
                                    <a disabled data-bs-toggle="tab" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2 @if ($active=='preview')active @endif">
                                        <i class="mdi mdi-checkbox-marked-circle-outline me-1"></i>
                                        <span class="d-none d-sm-inline">Finish</span>
                                    </a>
                                </li>
                            </ul>

                            <div class="tab-content mb-0 b-0">
                                @if ($active==1)
                                    <div class="tab-pane show active" id="first">

                                        <form  class="form-horizontal" wire:submit.prevent='createRequest()'>
                                            @csrf
                                            <div class="row">
                                                    <div class="row col-6 mb-3">
                                                        <label class="col-md-3 col-form-label" for="userName3">Requester</label>
                                                        <div class="col-md-9">
                                                            <input type="text" class="form-control" id="userName3" readonly name="userName3" value="{{ Auth::user()->name }}" required="">
                                                            <input type="hidden" class="form-control" id="department_id" readonly name="department_id" wire:model='department_id' required="">
                                                            
                                                        @error('department_id')
                                                            <div class="text-danger text-small">{{ $message }}</div>
                                                        @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row col-6 mb-3">
                                                        <label class="col-md-3 col-form-label" for="request_code">Request Code</label>
                                                        <div class="col-md-9">
                                                            <input type="text" class="form-control" id="request_code" readonly name="request_code" wire:model='request_code' required="">
                                                        </div>
                                                        @error('request_code')
                                                            <div class="text-danger text-small">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="row col-12 mb-3">
                                                        <label for="approver"  class="col-md-3 col-form-label">Approver</label>
                                                        <div class="col-md-9">
                                                        <select name="approver_id" id="approver" wire:model.lazy="approver_id" required class="form-control">
                                                            <option value="">Select</option>
                                                            @forelse ($approvers as $approver)
                                                                <option value="{{$approver->user->id??''}}">{{$approver->user->name??'N/A'}}</option>
                                                            @empty
                                                                <option value="">Empty List</option>
                                                            @endforelse
                                                        </select>
                                                        @error('approver_id')
                                                            <div class="text-danger text-small">{{ $message }}</div>
                                                        @enderror
                                                        </div>
                                                    </div>

                                            </div> <!-- end row -->
                                            <ul class="list-inline wizard mb-0">

                                                <li class="list-inline-item float-end"><button type="submit" class="btn btn-info">Next</button></li>
                                            </ul>
                                        </form>
                                    </div>
                                @elseif ($active=='items')
                                    <div class="tab-pane show active" id="second">
                                        <div class="row">
                                            {{$active}}
                                            <div class="col-12">
                                                <div class="card">
                                                    <div class="card-header pt-0">

                                                        <form wire:submit.prevent="addItem()"  name="myForm"  class="needs-validation">
                                                            @csrf                                               
                                                            <div class="row mb-2 mt-3">

                                                            <input type="hidden" class="form-control" name="inv_requests_id" wire:model='inv_requests_id'  readonly >

                                                            <input type="hidden" class="form-control" name="request_code" wire:model='request_code' readonly value="{{ $request_code }}">
                                                                <div class="col-sm-5">
                                                                    <div class="text-sm">
                                                                    <label>Item</label>
                                                                    <select class="form-control " name="inv_items_id" wire:model.lazy="inv_items_id" id="item" required>
                                                                        <option value="">Select item</option>
                                                                        @foreach($items as $item)
                                                                            <option value="{{$item->id}}">{{$item->item?->item_name.'  ('.$item->item?->parentUom?->uom_name.')'}}</option>
                                                                            @endforeach
                                                                    </select>
                                                                    <input type="hidden" readonly  class="form-control" name="inv_item_id" id="inv_item_id" required>
                                                                    </div>
                                                                </div><!-- end col-->
                                                                <div class="col-sm-2">
                                                                    <div class="text-sm">
                                                                        <label>Qyantity Left</label>
                                                                        <input type="text" readonly value="0" class="form-control" name="qty_left" wire:model='qty_left' id="qtyleft" required>
                                                                    </div>
                                                                </div>

                                                                <div class="col-sm-3">
                                                                    <div class="text-sm">
                                                                        <label>Quantity required</label>
                                                                        <input type="number" min="1"  class="form-control" wire:model='request_qty' required name="request_qty">
                                                                    </div>
                                                                </div><!-- end col-->

                                                                <div class="col-sm-2">
                                                                    <div class="text-sm-end pt-2">
                                                                        @if ($request_qty>$qty_left)
                                                                        <small class="text-danger">The required quantity can not be greater than the available quantity</small>
                                                                        @else
                                                                            <button type="submit" class="btn btn-primary mb-2 me-1">Add item</button>
                                                                        @endif
                                                                        
                                                                    </div>
                                                                </div><!-- end col-->
                                                            </div>
                                                        </form>
                                            
                                                    </div>
                                                    <div class="card-body">
                                                    <form method="POST" action="{{ url('inventory/request/delete') }}">
                                                        @csrf
                                                    <div class="tab-content">
                                                        <div class="tab-pane show active" id="scroll-horizontal-preview">
                                                            <table id="scroll-horizontal-datatable" class="table w-100 nowrap">
                                                                <thead>
                                                                    <tr>
                                                                        <th>No.</th>
                                                                        <th>Item name</th>
                                                                        <th>Description</th>
                                                                        <th>UOM</th>
                                                                        <th>Quantity</th>
                                                                        <th>Action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @if(count($requestItems)>0)
                                                                    @php($i=1)
                                                                    @php($display="d-none")
                                                                    @foreach($requestItems as $value)
                                                                    <tr>
                                                                        <td>{{$i++}}</td>
                                                                        <td>{{$value->item->item_name}}<input type="hidden" name="item[]" value="{{$value->item}}"></td>
                                                                        <td>{{ $value->item->description}}</td>
                                                                        <td>{{ $value->item->parentUom->uom_name}}</td>
                                                                        <td>{{ $value->request_qty}} <input type="hidden" id="totaltqty" name="quantity[]" value="{{$value->request_qty}}"></td>
                                                                        {{-- <td> <a onclick="return confirm('Are you sure you want to delete?');" href="{{ url('inventory/request/delete-item/?id='.$value->ritem_id.'&qty='.$value->request_qty) }}"  data-toggle="tooltip" title="Delete!" class="action-icon"> <i class="mdi mdi-delete"></i></a></td> --}}
                                                                        <td> <a onclick="return confirm('Are you sure you want to delete?');" href="javacript:void()"  data-toggle="tooltip" title="Delete!" wire:click="destroyItem({{$value->id}})" class="action-icon"> <i class="mdi mdi-delete"></i></a></td>
                                                                    </tr>
                                                                    @endforeach
                                                                    @else  @php($display="block")
                                                                    @endif
                                                                </tbody>
                                                            </table>

                                                        </div> <!-- end preview-->
                                                        <input type="hidden" class="form-control" name="requestcode"  readonly value="{{ $request_code }}">

                                                        <div class="text-sm-end mt-3">
                                                            @if ($display == 'd-none')
                                                            <button wire:click="$set('active','preview')"  type="button"   data-toggle="tooltip" title="Submit request request!" class="btn btn-success mb-2 me-1 text-sm-end"> <i class="mdi mdi-check"> Finish request</i></button>
                                                            @else
                                                            <button onclick="return confirm('Are you sure you want to delete the entire request with its details?');" type="submit" id="cancelbtn"  data-toggle="tooltip" title="Delete request!" class="btn btn-danger mb-2 me-1 text-sm-end {{$display}}"> <i class="mdi mdi-cancel"> Cancel request</i></button>
                                                            @endif
                                                    
                                                        </div>
                                                    </div> <!-- end tab-content-->
                                                </form>
                                                </div> <!-- end card body-->
                                            </div> <!-- end card -->
                                        </div>
                                        </div>
                                    </div>
                                @elseif ($active=='preview')
                                    <div class="tab-pane fade show active" id="third">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="text-center">
                                                        <h6 class="mt-0">
                                                            <i class="mdi mdi-check-all"></i>
                                                        </h6>

                                                        <div class="row justify-content-center">
                                                            <div class="col-lg-7 col-md-10 col-sm-11">

                                                                <div class="horizontal-steps mt-0 mb-0 pb-2" id="tooltip-container">
                                                                    <div class="horizontal-steps-content">
                                                                        <div class="step-item current">
                                                                            <span data-bs-container="#tooltip-container" data-bs-toggle="tooltip" data-bs-placement="bottom" title="20/09/2021 07:24 PM">Placed order</span>
                                                                        </div>
                                                                        <div class="step-item">
                                                                            <span data-bs-container="#tooltip-container" data-bs-toggle="tooltip" data-bs-placement="bottom" title="21/09/2021 11:32 AM">Request Approved</span>
                                                                        </div>
                                                                        <div class="step-item">
                                                                            <span>Confirm request</span>
                                                                        </div>

                                                                    </div>

                                                                    <div class="process-line" style="width: 33%;"></div>
                                                                </div>
                                                            </div>
                                                        </div>    <!-- end row -->
                                                        <div class="row">
                                                            <div class="col-lg-8">
                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        <h4 class="header-title mb-3">Items from Order #{{$request_code}}</h4>

                                                                        <div class="table-responsive">
                                                                            <table id="example1" class="table w-100 nowrap">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>No.</th>
                                                                                        <th>Item name</th>
                                                                                        <th>Description</th>
                                                                                        <th>UOM</th>
                                                                                        <th>Quantity</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    @if(count($requestItems)>0)
                                                                                    @php($i=1)
                                                                                    @php($display="d-none")
                                                                                    @foreach($requestItems as $value)
                                                                                    <tr>
                                                                                        <td>{{$i++}}</td>
                                                                                        <td>{{$value->item->item_name}}<input type="hidden" name="item[]" value="{{$value->item}}"></td>
                                                                                        <td>{{ $value->item->description}}</td>
                                                                                        <td>{{ $value->item->parentUom->uom_name}}</td>
                                                                                        <td>{{ $value->request_qty}} <input type="hidden" id="totaltqty" name="quantity[]" value="{{$value->request_qty}}"></td>
                                                                                       </tr>
                                                                                    @endforeach
                                                                                    @else  @php($display="block")
                                                                                    @endif
                                                                                </tbody>
                                                                            </table>
                                                                            <p class="text-end mt-2">Total items: <strong><span id="totalcount"></span></strong></p>
                                                                        </div>
                                                                        <!-- end table-responsive -->

                                                                    </div>
                                                                </div>
                                                            </div> <!-- end col -->

                                                            <div class="col-lg-4">
                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        <h4 class="header-title mb-3">Requester Summary</h4>

                                                                        <div class="table-responsive">
                                                                            <table class="table mb-0">
                                                                                <thead class="table-light">
                                                                                <tr>
                                                                                    <th>Department</th>
                                                                                    <th>{{$requestDetails->department->department_name}}</th>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>Request type :</th>
                                                                                    <td>{{ $requestDetails->request_type}}</td>
                                                                                </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                <tr>
                                                                                    <th>Date requested: </th>
                                                                                    <td>{{ $requestDetails->date_added}}</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>To be pproved by :</th>
                                                                                    <td>{{ $requestDetails->approver->name}}</td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th>Request by :</th>
                                                                                    <td>{{ $requestDetails->requester->name}}</td>
                                                                                </tr>
                                                                               

                                                                                </tbody>
                                                                                @if($requestDetails->borrower_id != "")
                                                                                <tr>
                                                                                    <th>Borrower:</th>
                                                                                    <th>{{$requestDetails->borrower->department_name}}</th>
                                                                                </tr>
                                                                                @endif
                                                                            </table>
                                                                        </div>
                                                                        <!-- end table-responsive -->

                                                                    </div>
                                                                </div>
                                                            </div> <!-- end col -->
                                                        </div>
                                                    </div>
                                                    <ul class="list-inline wizard mb-0">
                                                        <li class="previous list-inline-item"><a href="javacript:void(0)" wire:click="$set('active','items')" class="btn btn-info">Previous</a>
                                                        </li>
                                                        <li class="next list-inline-item float-end"><a href="javacript:void(0)" wire:click="submitRequest('{{$request_code}}')" id="nxtbtn" class="btn btn-success">Submit Request</a></li>
                                                    </ul>
                                                </div>
                                                <!-- end col -->
                                            </div>
                                            <!-- end row -->
                                    </div>
                                @endif 



                            </div> <!-- tab-content -->
                        </div> <!-- end #rootwizard-->
                    </div>

                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>
</div>
