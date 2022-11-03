<x-hr-layout>
    <!-- start page title -->
    <x-page-title>
        Upload Exit Interview
    </x-page-title>
    <!-- end page title -->

    <!-- end row-->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header pt-0">
                    <div class="row mb-2">
                        <div class="col-sm-12">
                            <div class="text-sm-end mt-3">
                                <h4 class="header-title mb-3  text-center">Upload Completed Exit Interview</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data" id="interviewForm">
                        @csrf
                        <div class="row col-md-12">
                            <div class=" mb-3 col-md-12">
                                <label for="interview_file" class="form-label">Completed Interview File</label>
                                <input name="interview_file" type="file" id="interview_file" class="form-control"
                                    required accept=".pdf">
                            </div>
                            <div class="col-md-8"></div>
                            <div class="col-md-4 text-end pt-1">
                                <button class="btn btn-success" type="submit">Submit</button>
                            </div>
                        </div>
                    </form>
                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>


    @push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {

            //STORE GRIEVANCE
            $('#interviewForm').submit(function(e) {

                e.preventDefault();
                let formData = new FormData(this);

                swal({
                        title: 'Are you sure you want to Upload?',
                        text: 'This action is irreversible once submitted!',
                        icon: 'warning',
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willConfirm) => {
                        if (willConfirm) {
                            $.ajax({
                                type: 'POST',
                                enctype: 'multipart/form-data',
                                url: "{{ route('exitInterviews.store') }}",
                                data: formData,
                                cache: false,
                                contentType: false,
                                processData: false,
                                success: (response) => {

                                    if (response.status === 'success') {
                                        iziToast.success({
                                            title: 'Good!',
                                            message: response.message,
                                            position: 'topRight'
                                        });
                                        $('#interviewForm').trigger('reset');
                                    } else {
                                        swal('Error', `Oops! ${response.message}`, 'error');
                                    }

                                },
                                error: function(response) {
                                    swal('Error', 'Oops! Something went wrong', 'error');

                                }
                            });
                        } else {

                            return
                        }
                    });

            });



        });
    </script>
@endpush
</x-hr-layout>
