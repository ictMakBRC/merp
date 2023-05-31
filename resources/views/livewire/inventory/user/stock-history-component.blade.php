<div>
    @push('styles')
    @include("inventdashboard.layouts.inc.data-table-style")
    @endpush
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">

                        <li class="breadcrumb-item"><a href="{{url('inventory/Items')}}">Items</a></li>
                          <li class="breadcrumb-item active">Stock levels</li>

                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end quote -->

    <div class="row">
        <div class="col-12">
            <div class="card">
              <div class="card-header pt-0">
                <div class="row mb-2">
                    <div class="col-sm-4">
                        <div class="text-sm-end mt-3">
                           <h4 class="header-title mb-3  text-center"> Stock levels</h4>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        
                        <div class="text-sm-end mt-3">
                            @role('InvUser')
                            <a class="btn btn-info" href="{{route('inv_user.stockHistory')}}">Stock History</a>                           
                            @endrole

                        </div>
                    </div><!-- end col-->
                </div>
            </div>
            <div class="card-body">

                <div class="tab-content">
                    <div class="tab-pane show active" id="scroll-horizontal-preview">
                        <table id="example2" class="table w-100">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Stock Code</th>
                                    <th>GRN</th>
                                    <th>Delivery No</th>
                                    <th>LPO</th>
                                    <th>Created By</th>
                                    <th>Date Recieved</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($stockDocuments)>0)
                                @php($i=1)
                                @foreach($stockDocuments as $stockDocument)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$stockDocument->stock_code??''}}</td>
                                    <td>{{$stockDocument->grn}}</td>
                                    <td>{{ $stockDocument->delivery_no??''}}</td>
                                    <td>{{ $stockDocument->lop??''}}</td>
                                    <td>{{ $stockDocument->user->name??''}}</td>
                                    <td>{{ $stockDocument->date_added}}</td>                                
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div> <!-- end preview-->


                </div> <!-- end tab-content-->

            </div> <!-- end card body-->
        </div> <!-- end card -->
        </div><!-- end col-->
    </div>
    @push('scripts')
    @include("inventdashboard.layouts.inc.data-table-scripts")
    @endpush
</div>

