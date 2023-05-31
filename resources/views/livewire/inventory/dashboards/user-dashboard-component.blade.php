<div>
    @if (session()->has('department')) 

         <!-- start quote -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <form class="d-flex">
                        <div class="input-group">
                            <input type="text" class="form-control form-control-light" id="dash-daterange">
                            <span class="input-group-text bg-primary border-primary text-white">
                                <i class="mdi mdi-calendar-range font-13"></i>
                            </span>
                        </div>
                        <a href="{{url('inventory/dashboard')}}" class="btn btn-primary ms-2">
                            <i class="mdi mdi-autorenew"></i>
                        </a>
                    </form>
                </div>
                <h4 class="page-title"> {{ Session::get('department_name') }} Dashboard</h4>
            </div>
        </div>
    </div>
    <!-- end quote -->

    <div class="row">
        <div class="col-xl-4 col-lg-3">
            <div class="card tilebox-one">
                <div class="card-body">
                    <i class='uil uil-window-restore float-end'></i>
                    <h6 class="text-uppercase mt-0">Item count</h6>
                    <h2 class="my-2" >{{$items->count()}}</h2>
                    <p class="mb-0 text-muted">
                        <a href="{{url('inventory/Items')}}" class="text-nowrap">View all</a>
                    </p>
                </div> <!-- end card-body-->
            </div>
        </div>
        <div class="col-xl-4 col-lg-3">
            <div class=" card tilebox-one">
                <div class="card-body">
                    <i class='uil uil-users-alt float-end'></i>
                    <h6 class="text-uppercase mt-0">Pending Requests</h6>
                    <h2 class="my-2">{{$requestsPendingCount}}</h2>
                    <p class="mb-0 text-muted">

                        <a href="{{url('inventory/inv/requests')}}" class="text-nowrap">view all</a>
                    </p>
                </div> <!-- end card-body-->
            </div>
            <!--end card-->
        </div> <!-- end col -->
        <div class="col-xl-4 col-lg-3">
            <div class=" card tilebox-one">
                <div class="card-body">
                    <i class='uil uil-users-alt float-end'></i>
                    <h6 class="text-uppercase mt-0">Product Expiries</h6>
                    <h2 class="my-2">{{'0'}}</h2>
                    <p class="mb-0 text-muted">

                        <a href="{{url('inventory/inv/requests')}}" class="text-nowrap">view all</a>
                    </p>
                </div> <!-- end card-body-->
            </div>
            <!--end card-->
        </div> <!-- end col -->

        <div class="col-xl-12 col-lg-12">
            <div class="card card-h-100">
                <div class="card-body">

                        <div class="col-xl-12 col-lg-12">
                            <a href="{{url('inventory/inv/requests')}}" class="p-0 float-end">View All <i class="mdi mdi-download ms-1"></i></a>
                            <h4 class="header-title mb-3">Recent Pending Requests</h4>
        
                            <div class="table-responsive">
                                <table class="table table-sm table-centered mb-0 font-14">
                                        <thead class="table-light">
                                            <tr>
                                                <th>No.</th>
                                                <th>Request code</th>
                                                <th>Type</th>
                                                <th>Requested by</th>
                                                <th>Date added</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(count($pendingRequests)>0)
                                                @php($i=1)
                                                @foreach($pendingRequests as $value)
                                                <tr>
                                                    <td>{{$i++}}</td>
                                                    <td>{{$value->request_code}}</td>
                                                    <td>{{ $value->request_type}}</td>
                                                    <td>{{ $value->requester?->name}}</td>
            
                                                    <td>{{ $value->date_added}}</td>
            
                                                    <td class="table-action">
                                                        <a href="{{ url('inventory/request/inv/view/'.$value->request_code) }}" class="action-icon"> <i class="mdi mdi-eye" ></i></a>
            
                                                    </td>
                                                </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="7"><h5 class="text-center">No requests pending</h5></td>
                                                </tr>
                                            @endif
        
        
                                        </tbody>
                                    </table>
                                </table>
                            </div>
                        </div>


                        <div class="col-xl-12 col-lg-12 pt-2">
                                    <a href="" class="p-0 float-end">View All <i class="mdi mdi-download ms-1"></i></a>
                                    <h4 class="header-title mt-1 mb-3">Out of stock warning</h4>

                                    <div class="table-responsive">
                                        <table class="table table-sm table-centered mb-0 font-14">
                                            <thead class="table-light">
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Item name</th>
                                                        <th>Category</th>
                                                        <th>UOM</th>
                                                        <th>Quantity left</th>

                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    @php($i=1)
                                                    @foreach($stockwarning as $warning)
                                                    <tr>
                                                        <td>{{$i++}}</td>
                                                        <td>{{$warning->item_name??'N/A'}}</td>
                                                        <td>{{ $warning->subunit_name??'N/A'}}</td>
                                                        <td>{{ $warning->uom_name??'N/A'}}</td>
                                                        <td>{{ $warning->qty_left}}</td>
                                                        <td><button class="btn btn-info" type=""></button></td>
                                                    </tr>
                                                    @endforeach

                                                </tbody>
                                        </table>
                                    </div> <!-- end table-responsive-->
                              
                        </div>
                    </div>


                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div>
    </div>
    @else
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="header-title mb-3">Manage</h4>
                    <div id="progressbarwizard">
                        <div id="rootwizard">
                            <ul class="nav nav-pills nav-justified form-wizard-header mb-3">                                                   
                                <li class="nav-item" data-target-form="#otherForm">
                                    <a disabled data-bs-toggle="tab" data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                        <i class="mdi mdi-checkbox-marked-circle-outline me-1"></i>
                                        <span class=" d-sm-inline">Select A Department</span>
                                    </a>
                                </li>
                            </ul>                  

                                    <form  class="form-horizontal" wire:submit.prevent='selectDepartment'>
                                            @csrf
                                        <div class="row">
                                            <div class="col-12">                                                                   
                                                <div class="row mb-3">
                                                    <label class="col-md-3 col-form-label" for="password3">Deparment/Project/Category</label>
                                                    <div class="col-md-7">
                                                        <select id="my_department" class="form-control" name="my_department" wire:model='my_department' required>
                                                            <option value="" selected disabled>Select Department</option>

                                                            @foreach($deparments as $unit)
                                                            <option value="{{ $unit->department_id }}">{{$unit->department->department_name??''}}</option>
                                                        @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <button type="submit" class="btn btn-success">Check</button>
                                                    </div>
                                                </div>                                  </div> <!-- end col -->
                                        </div> <!-- end row -->          
                                    </form>
                                
                        </div> <!-- end #rootwizard-->
                    </div>

                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>
    @push('scripts')
        <script>
            window.addEventListener('livewire:load', () => {
                initializeSelect2();
            });

            $('#my_department').on('myselect:select', function(e) {
                var data = e.params.data;
                @this.set('sequencing_pathogen_id', data.id);
            });

            window.addEventListener('livewire:update', () => {
                $('.myselect').myselect('destroy'); //destroy the previous instances of select2
                initializeSelect2();
            });

            function initializeSelect2() {

                $('.myselect').each(function() {
                    $(this).myselect({
                        theme: 'bootstrap4',
                        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ?
                            '100%' : 'style',
                        placeholder: $(this).data('placeholder') ? $(this).data('placeholder') : 'Select',
                        allowClear: Boolean($(this).data('allow-clear')),
                    });
                });
            }
        </script>
        @endpush
    @endif
</div>
