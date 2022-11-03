 <!-- ADD NEW VENDOR Modal -->
 <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="staticBackdropLabel">Add New Vendor</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
             </div> <!-- end modal header -->
             <div class="modal-body">
                 <form method="POST" action="{{ route('vendors.store') }}">
                     @csrf

                     <div class="row">
                         <div class="col-md-12">
                             <div class="mb-3">
                                 <label for="vendorName" class="form-label">Name</label>
                                 <input type="text" id="vendorName" class="form-control" name="vendor_name">
                             </div>
                             <div class="mb-3">
                                 <label for="vendorAddress" class="form-label">Address</label>
                                 <input type="text" id="vendorAddress" class="form-control" name="address">
                             </div>
                             <input type="text" id="belongsTo" hidden value='assets' class="form-control"
                                 name="belongs_to">
                             <div class="mb-3">
                                 <label for="vendorContact" class="form-label">Contact</label>
                                 <input type="text" id="vendorContact" class="form-control" name="contact">
                             </div>
                             <div class="mb-3">
                                 <label for="vendorEmail" class="form-label">Email</label>
                                 <input type="email" id="vendorEmail" class="form-control" name="email">
                             </div>
                             <div class="mb-3">
                                 <label for="comment" class="form-label">Comment</label>
                                 <textarea type="text" id="vendorComment" class="form-control" name="comment"></textarea>
                             </div>

                         </div> <!-- end col -->

                     </div>
                     <!-- end row-->
                     <div class="d-grid mb-0 text-center">
                         <button class="btn btn-success" type="submit"> Add Vendor</button>
                     </div>

                 </form>

             </div>

         </div> <!-- end modal content-->
     </div> <!-- end modal dialog-->
 </div> <!-- end modal-->
