@extends('inventdashboard.layouts.tableLayout')
@section('title', 'Suppliers')
@section('content')
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">

                                <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">UOM</a></li>

                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                      <div class="card-header pt-0">
                        <div class="row mb-2">
                            <div class="col-sm-4">
                                <div class="text-sm-end mt-3">
                                   <h4 class="header-title mb-3  text-center"> MakBRC Units Of measurements</h4>
                               </div>
                           </div>
                           <div class="col-sm-8">
                            <div class="text-sm-end mt-3">
                                <a type="button" href="#" class="btn btn-primary mb-2 me-1" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Add UOM</a>
                            </div>
                        </div><!-- end col-->
                    </div>
                </div>
                <div class="card-body">

                    <div class="tab-content">
                        <div class="tab-pane show active" id="scroll-horizontal-preview">
                            <table id="example1" class="table w-100 nowrap">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Supplier name</th>
                                        <th>Description</th>
                                        <th>Email</th>
                                        <th>Contact</th>
                                        <th>Address</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($values)>0)
                                    @php($i=1)
                                    @foreach($values as $value)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{ $value->sup_name}}</td>
                                        <td>{{ $value->description}}</td>
                                        <td>{{ $value->email}}</td>
                                        <td>{{ $value->contact}}</td>
                                        <td>{{ $value->address}}</td>
                                        <td>@if($value->isActive==1)
                                            <span class="badge badge-success-lighten float-center">Active</span>
                                            @php($satate='Active' AND $Stvalue=1)
                                            @elseif($value->isActive==0)
                                            <span class="badge badge-danger-lighten float-center">InActive</span>
                                            @php($satate='InActive' AND $Stvalue=0)
                                            @endif
                                        </td>
                                        <td class="table-action">
                                            <a href="javascript: void(0);" class="action-icon"> <i class="mdi mdi-pencil" data-bs-toggle="modal" data-bs-target="#Umodal{{ $value->id }}"></i></a>
                                            <a onclick="return confirm('Are you sure you want to delete?');" href="{{ url('inventory/delete-supplier/'.$value->id) }}"  data-toggle="tooltip" title="Delete!" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                               <!-- ADD NEW Category Modal -->
                                            <div class="modal fade" id="Umodal{{ $value->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="staticBackdropLabel">Edit UOM</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                                                            </div> <!-- end modal header -->
                                                            <div class="modal-body">
                                                                <form action="{{ url('inventory/update-supplier/'.$value->id) }}" method="POST">
                                                                    @csrf

                                                                    <div class="row">
                                                                        <div class="col-md-12">

                                                                            <div class="mb-3">
                                                                                <label for="sup_name" class="form-label">Supplier Name</label>
                                                                                <input type="text" id="sup_name" value="{{ $value->sup_name}}" class="form-control" name="sup_name">
                                                                            </div>
                                                                            <div class="mb-3">
                                                                                <label for="address" class="form-label">Address</label>
                                                                                <input type="text" id="address" value="{{ $value->address}}" class="form-control" name="address">
                                                                            </div>
                                                                            <div class="mb-3">
                                                                                <label for="contact" class="form-label">Contact</label>
                                                                                <input type="text" id="contact" value="{{ $value->contact}}" class="form-control" name="contact">
                                                                            </div>
                                                                            <div class="mb-3">
                                                                                <label for="email" class="form-label">Email</label>
                                                                                <input type="text" id="email" value="{{ $value->email}}" class="form-control" name="email">
                                                                            </div>
                                                                            <div class="mb-3">
                                                                                <label for="email" class="form-label">Description</label>
                                                                                <textarea class="form-control" name="description">{{ $value->description}}<textarea>
                                                                            </div>
                                                                            <div class="mb-3">
                                                                                <label for="isActive" class="form-label">State</label>
                                                                                <select class="form-control" id="isActive" name="isActive">
                                                                                    <option value="{{$Stvalue}}">{{$satate}}</option>
                                                                                    <option value="1">Active</option>
                                                                                    <option value="0">InActive</option>
                                                                                </select>
                                                                            </div>
                                                                        </div> <!-- end col -->

                                                                    </div>
                                                                    <!-- end row-->
                                                                    <div class="d-grid mb-0 text-center">
                                                                        <button class="btn btn-primary" type="submit">Update</button>
                                                                    </div>

                                                                </form>

                                                            </div>

                                                        </div> <!-- end modal content-->
                                                    </div> <!-- end modal dialog-->
                                            </div> <!-- end modal-->
                                        </td>
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
    <!-- end row-->

</div>


 <!-- ADD NEW Category Modal -->
 <!-- end modal-->


@endsection
