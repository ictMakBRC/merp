 <!-- ADD NEW USER Modal -->

 <div class="modal fade" id="addUser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
     <div class="modal-dialog modal-lg">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="staticBackdropLabel">Add New User</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
             </div> <!-- end modal header -->
             <div class="modal-body">
                 <form method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data">
                     @csrf

                     <div class="row">
                         <div class="row col-md-12">
                             <div class="mb-3 col-md-6">
                                 <label for="emp_id" class="form-label">Emp-No<span class="text-success text-center"
                                         style="display: none" id="found"><i>(Employee Matched)</i></span><i
                                         class="text-danger text-center" style="display: none" id="notFound">(Employee
                                         Not Found)</i></label>
                                 <input type="text" style="text-transform: uppercase" id="emp_id"
                                     class="form-control" name="emp_id" required>
                             </div>
                             <input type="text" id="employee_id" hidden class="form-control" name="employee_id"
                                 required>
                             <div class="mb-3 col-md-6">
                                 <label for="title" class="form-label">Title</label>
                                 <select class="form-select" id="title" name="title" required>

                                 </select>
                             </div>
                             <div class="mb-3 col-md-6">
                                 <label for="name" class="form-label">Name</label>
                                 <input type="text" id="name" class="form-control" readonly name="name"
                                     required>
                             </div>
                             <div class="mb-3 col-md-6">
                                 <label for="email" class="form-label">Email</label>
                                 <input type="email" id="email" class="form-control" name="email" readonly
                                     required>
                             </div>
                         </div> <!-- end col -->

                         <div class="mb-3 col-md-6">
                             <label for="contact" class="form-label">Contact</label>
                             <input type="text" id="contact" class="form-control" name="contact" readonly required>
                         </div>
                         <div class="mb-3 col-md-6">
                             <label for="image" class="form-label">Image</label>
                             <input type="file" id="image" class="form-control" name="avatar">
                         </div>

                         <div class="mb-3 col-md-6">
                             <label for="is_active" class="form-label">Status</label>
                             <select class="form-select" id="is_active" name="is_active" required>
                                 <option value="1" style="color: green" selected>Active</option>
                                 <option value="0" style="color: red">Suspended</option>
                             </select>
                         </div>


                         <div class="mb-3 col-md-6">
                             <label for="password" class="form-label">Password</label>
                             <input type="text" id="password" class="form-control" name="password" required readonly
                                 placeholder="Focus to Auto-Generate" onfocus="generatePass();">
                         </div>
                     </div>
                     <!-- end row-->
                     {{-- <div class="d-grid mb-0 text-center">
                         <button class="btn btn-success" type="submit"
                             onclick="this.innerHTML='Processing please wait.....';" id="submitBtn"> Add User</button>
                     </div> --}}
                     @include('layouts.inc.form-submit')
                 </form>
             </div>

         </div> <!-- end modal content-->
     </div> <!-- end modal dialog-->
 </div> <!-- end modal-->
 <!-- UPDATE USER Modal -->
 @foreach ($users as $key => $user)
     <div class="modal fade" id="editUser{{ $user->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
         tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
         <div class="modal-dialog modal-lg">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title" id="staticBackdropLabel">UPDATE USER</h5>
                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                 </div> <!-- end modal header -->
                 <div class="modal-body">
                     <form method="POST" action="{{ route('users.update', [$user->id]) }}"
                         enctype="multipart/form-data">
                         @csrf
                         @method('PUT')
                         <div class="row">
                             <div class="row col-md-12">
                                 <div class="mb-3 col-md-4">
                                     <label for="emp_id2" class="form-label">Emp-No</label>
                                     <input type="text" style="text-transform: uppercase" id="emp_id2"
                                         class="form-control" name="emp_id" required readonly
                                         value="{{ $user->employee->emp_id??'N/A' }}">
                                 </div>
                                 <div class="mb-3 col-md-4">
                                     <label for="is_active2" class="form-label">Status</label>
                                     <select class="form-select" id="is_active2" name="is_active" required>
                                         @if ($user->employee->status??'N/A' == 'Active')
                                             <option value="1" style="color: rgb(130, 199, 130)" selected>
                                                 {{ $user->employee->status??'N/A' }}</option>
                                         @else
                                             <option value="0" style="color: red" selected>
                                                 {{ $user->employee->status??'N/A' }}</option>
                                         @endif
                                     </select>
                                 </div>
                                 <input type="text" id="employee_id" hidden class="form-control"
                                     name="employee_id" value="{{ $user->employee->id??'N/A' }}" required>
                                 <div class="mb-3 col-md-4">
                                     <label for="title2" class="form-label">Title</label>
                                     <select class="form-select" id="title2" name="title" required>
                                         <option value="{{ $user->employee->prefix??'N/A' }}">{{ $user->employee->prefix??'N/A' }}
                                         </option>
                                     </select>
                                 </div>
                                 <div class="mb-3 col-md-6">
                                     <label for="name2" class="form-label">Name</label>
                                     <input type="text" id="name2" class="form-control" readonly
                                         name="name" required
                                         value="{{ $user->employee->first_name??'N/A' . ' ' . $user->employee->surname??'N/A' }}">
                                 </div>
                                 <div class="mb-3 col-md-6">
                                     <label for="email2" class="form-label">Email</label>
                                     <input type="email" id="email2" class="form-control" name="email"
                                         readonly required value="{{ $user->employee->email??'N/A' }}">
                                 </div>
                             </div> <!-- end col -->

                             <div class="mb-3 col-md-6">
                                 <label for="contact2" class="form-label">Contact</label>
                                 <input type="text" id="contact2" class="form-control" name="contact" readonly
                                     required value="{{ $user->employee->contact??'N/A' }}">
                             </div>
                             <div class="mb-3 col-md-6">
                                 <label for="image2" class="form-label">Image</label>
                                 <input type="file" id="image2" class="form-control" name="avatar">
                             </div>


                         </div>
                         <!-- end row-->
                         <div class="d-grid mb-0 text-center">
                             <button class="btn btn-success" type="submit"
                                 onclick="this.innerHTML='Processing please wait.....';" id="submitButton"> Update
                                 User</button>
                         </div>
                     </form>
                 </div>

             </div> <!-- end modal content-->
         </div> <!-- end modal dialog-->
     </div> <!-- end modal-->
 @endforeach
 <!-- VIEW USER ACCOUNT DETAILS -->
 @foreach ($users as $key => $user)
     <div class="modal fade" id="viewUser{{ $user->id }}" data-bs-keyboard="false" tabindex="-1"
         aria-labelledby="staticBackdropLabel" aria-hidden="true">
         <div class="modal-dialog modal-lg">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title" id="staticBackdropLabel">USER DETAILS</h5>
                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                 </div> <!-- end modal header -->
                 <div class="modal-body">
                     <div class="row">
                         <div class="col-sm-12">
                             <!-- Profile -->
                             <div class="card bg-primary">
                                 <div class="card-body profile-user-box">
                                     <div class="row">
                                         <div class="col-sm-8">
                                             <div class="row align-items-center">
                                                 <div class="col-auto">
                                                     <div class="avatar-lg">
                                                         <img src="{{ asset('storage/' . $user->avatar) }}"
                                                             alt="" class="rounded-circle img-thumbnail">
                                                     </div>
                                                 </div>
                                                 <div class="col">
                                                     <div>
                                                         <h4 class="mt-1 mb-1 text-white">
                                                             {{ $user->title . ' ' . $user->name }}</h4>
                                                         <p class="font-13 text-white-50">{{ $user->email }}</p>

                                                         <ul class="mb-0 list-inline text-light">
                                                             <li class="list-inline-item me-3">
                                                                 <h5 class="mb-1">{{ $user->emp_id }}</h5>
                                                                 <p class="mb-0 font-13 text-white-50">Emp-No</p>
                                                             </li>
                                                             <li class="list-inline-item me-3">
                                                                 <h5 class="mb-1">{{ $user->contact }}</h5>
                                                                 <p class="mb-0 font-13 text-white-50">Contact</p>
                                                             </li>

                                                             <li class="list-inline-item">
                                                                 @if ($user->is_active == 1)
                                                                     <h5 class="mb-1"
                                                                         style="color: rgb(160, 221, 160)">Active</h5>
                                                                 @else
                                                                     <h5 class="mb-1" style="color: red">Suspended
                                                                     </h5>
                                                                 @endif
                                                                 <p class="mb-0 font-13 text-white-50">Status</p>
                                                             </li>
                                                         </ul>
                                                     </div>
                                                 </div>
                                             </div>
                                         </div> <!-- end col-->

                                         <div class="col-sm-4">
                                             <div class="text-center mt-sm-0 mt-3 text-sm-end">
                                                 <button type="button" class="btn btn-light" data-bs-toggle="modal"
                                                     data-bs-target="#editUser{{ $user->id }}"
                                                     data-bs-dismiss="modal">
                                                     <i class="mdi mdi-account-edit me-1"></i> Edit Profile
                                                 </button>
                                             </div>
                                         </div> <!-- end col-->
                                     </div> <!-- end row -->

                                 </div> <!-- end card-body/ profile-user-box-->
                             </div>
                             <!--end profile/ card -->
                         </div> <!-- end col-->
                     </div>
                 </div>
             </div> <!-- end modal content-->
         </div> <!-- end modal dialog-->
     </div> <!-- end modal-->
 @endforeach
 <script type="text/javascript">
     function generatePass() {
         var chars = "0123456789abcdefghijklmnopqrstuvwxyz!@#$%^&*()ABCDEFGHIJKLMNOPQRSTUVWXYZ";
         var passwordLength = 12;
         var password = "";
         var passwordInput = document.getElementById("password");
         for (var i = 0; i <= passwordLength; i++) {
             var randomNumber = Math.floor(Math.random() * chars.length);
             password += chars.substring(randomNumber, randomNumber + 1);
         };
         passwordInput.value = password;
         passwordInput.select();
         document.execCommand("copy");
     }
 </script>
