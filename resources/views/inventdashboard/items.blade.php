
@extends('inventdashboard.layouts.tableLayout')
@section('title', 'Items')
@section('content')
<div class="container-fluid">

    <!-- start quote -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">

                            <li class="breadcrumb-item"><a href="{{url('inventory/')}}">Home</a></li>
                            <li class="breadcrumb-item active">Item List</li>

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

                <div class="row mb-2 mt-3">
                        <div class="col-sm-4">
                        <a type="button" href="newItem" class="btn btn-primary mb-2 me-1">Add item</a>
                        </div>
                        <div class="col-sm-8">
                            <div class="text-sm-end">
                                <button type="button" class="btn btn-success mb-2 me-1"><i class="mdi mdi-cog-outline"></i></button>
                                <button type="button" class="btn btn-light mb-2 me-1">Import</button>
                                <button type="button" class="btn btn-light mb-2">Export</button>
                            </div>
                        </div><!-- end col-->
                    </div>
            </div>
            <div class="card-body">

                <div class="tab-content">
                    <div class="tab-pane show active" id="scroll-horizontal-preview">
<div class="table-responsive">
                         <table class="table table-centered w-100 dt-responsive nowrap" id="example2">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Subcategory</th>
                                    <th>Costprice</th>
                                    <th>Date added</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($values)>0)
                                @php($i=1)
                                @foreach($values as $value)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$value->item_name}}</td>
                                    <td>{{ $value->description}}</td>
                                    <td>{{ $value->subunit_name}}</td>
                                    <td>{{ $value->cost_price}}</td>
                                    <td>{{ $value->date_added}}</td>

                                    <td class="table-action">
                                        @if($value->is_active==1)
                                        <span class="badge badge-success-lighten float-center">Active</span>
                                        @php($satate='Active' AND $Stvalue=1)
                                        @elseif($value->is_active==0)
                                        <span class="badge badge-danger-lighten float-center">InActive</span>
                                        @php($satate='InActive' AND $Stvalue=0)
                                        @endif
                                        <a href="{{ url('inventory/edit-item/'.$value->item_id) }}" class="action-icon"> <i class="mdi mdi-pencil" ></i></a>
                                        <a onclick="return confirm('Are you sure you want to delete?');" href="{{ url('inventory/delete-item/'.$value->item_id) }}"  data-toggle="tooltip" title="Delete!" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                           <!-- ADD NEW Category Modal -->

                                    </td>
                                </tr>
                                @endforeach
                                @endif


                            </tbody>
                        </table>
</div>
                    </div> <!-- end preview-->


                </div> <!-- end tab-content-->

            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
    </div>
<!-- end row-->

</div> <!-- container -->
@endsection
