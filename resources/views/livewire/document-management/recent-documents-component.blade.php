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
                            <li class="breadcrumb-item active">New</li>
                        </ol>
                    </div>
                    <h4 class="page-title">View Request</h4>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h6>Recently uploaded</h6>
                <x-inventory.table-utilities>
                </x-inventory.table-utilities>
                <div class="table-responsive mt-3">
                    <table class="table table-striped table-hover table-sm mb-0">
                        <thead>
                            <tr>
                                <th>Name <i class='mdi mdi-up-arrow-alt ms-2'></i></th>
                                <th>Category</th>
                                <th>Request</th>
                                <th>Created On</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($documents as $requests)
                            <tr >
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div><i class='mdi mdis-file me-2 font-24 text-primary'></i>
                                        </div>
                                        <div class="font-weight-bold text-primary">{{$requests->title}}</div>
                                    </div>
                                </td>
                                <td>{{$requests->category->name??'N/A'}}</td>
                                <td>{{$requests->request_code??'N/A'}}</td>
                            
                                <th>{{$requests->created_at??'N/A'}}</th>
                                <th>{{$requests->status??'N/A'}}</th>
                                <td>
                                    
                                <a href="{{route('document.sign',$requests->request_code)}}" class="text-success" ><i class='mdi mdi-eye font-20'></i></a> 
                                                             
                                            
                                </td>
                            </tr>
                            @empty                                                            
                                
                            <tr>
                            
                                <td colspan="6" class="text-center text-danger">You have no resources uploaded in the following folder</td>
                            
                            </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
