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
                                    <th>Item name</th>
                                    <th>Brand</th>
                                    <th>Category</th>
                                    <th>UOM</th>
                                    <th>Quantity left</th>
                                    <th>Qty Borrowed</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($items)>0)
                                @php($i=1)
                                @foreach($items as $value)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$value->item->item_name??''}}</td>
                                    <td>{{$value->brand}}</td>
                                    <td>{{ $value->item->subUnit?->subunit_name??''}}</td>
                                    <td>{{ $value->item->parentUom?->uom_name??''}}</td>
                                    <td class="text-end">{{ $value->qty_left}}</td>
                                    <td class="text-end">{{ $value->qty_held}}</td>                                
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
