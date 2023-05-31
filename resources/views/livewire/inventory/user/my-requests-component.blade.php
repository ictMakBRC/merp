<div >
    @push('styles')
    @include("inventdashboard.layouts.inc.data-table-style")
    @endpush

    <!-- start quote -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">

                            <li class="breadcrumb-item"><a href="{{url('inventory/')}}">Home</a></li>
                            <li class="breadcrumb-item active">Pending request List</li>

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
                My requests

            </div>
            <div class="card-body">

                <div class="tab-content">
                    <div class="tab-pane show active" id="scroll-horizontal-preview">

                         <table class="table table-centered w-100 dt-responsive nowrap" id="example2">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Request code</th>
                                    <th>Type</th>
                                    <th>Approver</th>
                                    <th>State</th>
                                    <th>Date added</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($requests)>0)
                                @php($i=1)
                                @foreach($requests as $request)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$request->request_code}}</td>
                                    <td>{{ $request->request_type}}</td>
                                    <td>{{ $request->approver->name??''}}</td>
                                    <td>{{ $request->request_state}}</td>
                                    <td>{{ $request->date_added}}</td>

                                    <td class="table-action">
                                        <a href="{{ route('inv_user.requestNew',$request->request_code) }}" class="action-icon"> <i class="mdi mdi-pencil" ></i></a>

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
 @push('scripts')
 @include("inventdashboard.layouts.inc.data-table-scripts")
 @endpush
</div> <!-- container -->
