<x-hr-layout>
    <!-- start page title -->
    <x-page-title>
        Capture Employee Information
    </x-page-title>

    <div class="tab-content">
        <ul class="nav nav-tabs nav-justified nav-bordered mb-3">
            <li class="nav-item">
                <a href="#personal_info" data-bs-toggle="tab" aria-expanded="false" class="nav-link active">
                    <i class="mdi mdi-account-box d-md-none d-block"></i>
                    <span class="d-none d-md-block">Personal Information</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#education" data-bs-toggle="tab" aria-expanded="true" class="nav-link ">
                    <i class="mdi mdi-book-education d-md-none d-block"></i>
                    <span class="d-none d-md-block">Education</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#other_info" data-bs-toggle="tab" aria-expanded="true" class="nav-link ">
                    <i class="mdi mdi-book-clock-outline d-md-none d-block"></i>
                    <span class="d-none d-md-block">Other Information</span>
                </a>
            </li>
            @if (Auth::user()->hasRole(['HrAdmin']) && Auth::user()->isAbleTo('employee-create'))
                <li class="nav-item">
                    <a href="#files" data-bs-toggle="tab" aria-expanded="true" class="nav-link ">
                        <i class="mdi mdi-cloud-upload d-md-none d-block"></i>
                        <span class="d-none d-md-block">File Uploads</span>
                    </a>
                </li>
            @endif
        </ul>

        <div class="tab-content">
            <div class="tab-pane active" id="personal_info">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="accordion custom-accordion" id="custom-accordion-one">
                                    @if (Auth::user()->isAbleTo('employee-create'))
                                        <div class="card mb-0">
                                            <div class="card-header" id="headingFour">
                                                <h5 class="m-0">
                                                    <a class="custom-accordion-title d-block py-1"
                                                        data-bs-toggle="collapse" href="#collapseFour"
                                                        aria-expanded="true" aria-controls="collapseFour">
                                                        Basic Information <i
                                                            class="mdi mdi-chevron-down accordion-arrow"></i>
                                                    </a>
                                                </h5>
                                            </div>
                                            <div id="collapseFour" class="collapse show" aria-labelledby="headingFour"
                                                data-bs-parent="#custom-accordion-one">
                                                <div class="card-body">
                                                    @include('humanResource.personalInfo')
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div></div>
                                    @endif
                                    <hr>
                                    <div class="card mb-0">
                                        <div class="card-header" id="banking">
                                            <h5 class="m-0">
                                                <a class="custom-accordion-title collapsed d-block py-1"
                                                    data-bs-toggle="collapse" href="#bankingInfo" aria-expanded="false"
                                                    aria-controls="bankingInfo">
                                                    Banking Information<i
                                                        class="mdi mdi-chevron-down accordion-arrow"></i>
                                                </a>
                                            </h5>
                                        </div>
                                        <div id="bankingInfo" class="collapse" aria-labelledby="banking"
                                            data-bs-parent="#custom-accordion-one">
                                            <div class="card-body">
                                                @include('humanResource.bankingInfo')
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="card mb-0">
                                        <div class="card-header" id="headingFive">
                                            <h5 class="m-0">
                                                <a class="custom-accordion-title collapsed d-block py-1"
                                                    data-bs-toggle="collapse" href="#collapseFive" aria-expanded="false"
                                                    aria-controls="collapseFive">
                                                    Family Background<i
                                                        class="mdi mdi-chevron-down accordion-arrow"></i>
                                                </a>
                                            </h5>
                                        </div>
                                        <div id="collapseFive" class="collapse" aria-labelledby="headingFive"
                                            data-bs-parent="#custom-accordion-one">
                                            <div class="card-body">
                                                @include('humanResource.familyInfo')
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="card mb-0">
                                        <div class="card-header" id="emergency">
                                            <h5 class="m-0">
                                                <a class="custom-accordion-title collapsed d-block py-1"
                                                    data-bs-toggle="collapse" href="#emergencyInfo"
                                                    aria-expanded="false" aria-controls="emergencyInfo">
                                                    Emergency Contact Information<i
                                                        class="mdi mdi-chevron-down accordion-arrow"></i>
                                                </a>
                                            </h5>
                                        </div>
                                        <div id="emergencyInfo" class="collapse" aria-labelledby="emergency"
                                            data-bs-parent="#custom-accordion-one">
                                            <div class="card-body">
                                                @include('humanResource.emergencyInfo')
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end card body-->
                        </div><!-- end card -->
                    </div> <!-- end col -->
                </div>
                <!--end of row-->
            </div>
            <div class="tab-pane show" id="education">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header pt-0">
                                <div class="row mb-2">
                                    <div class="col-sm-12">
                                        <div class="text-sm-end mt-3">
                                            <h4 class="header-title mb-3  text-center">Education Information</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                @include('humanResource.educationInfo')
                            </div> <!-- end card body-->
                        </div> <!-- end card -->
                    </div><!-- end col-->
                </div>
            </div>

            <div class="tab-pane show" id="other_info">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="accordion custom-accordion" id="custom-accordion-two">
                                    <div class="card mb-0">
                                        <div class="card-header" id="experience">
                                            <h5 class="m-0">
                                                <a class="custom-accordion-title d-block py-1"
                                                    data-bs-toggle="collapse" href="#experienceInfo"
                                                    aria-expanded="true" aria-controls="experienceInfo">
                                                    Work Experience <i
                                                        class="mdi mdi-chevron-down accordion-arrow"></i>
                                                </a>
                                            </h5>
                                        </div>
                                        <div id="experienceInfo" class="collapse show" aria-labelledby="experience"
                                            data-bs-parent="#custom-accordion-two">
                                            <div class="card-body">
                                                @include('humanResource.workExperience')
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="card mb-0">
                                        <div class="card-header" id="training">
                                            <h5 class="m-0">
                                                <a class="custom-accordion-title collapsed d-block py-1"
                                                    data-bs-toggle="collapse" href="#trainingInfo"
                                                    aria-expanded="false" aria-controls="trainingInfo">
                                                    Training Program (attended in the last 3 years, Start from the most
                                                    recent)<i class="mdi mdi-chevron-down accordion-arrow"></i>
                                                </a>
                                            </h5>
                                        </div>
                                        <div id="trainingInfo" class="collapse" aria-labelledby="training"
                                            data-bs-parent="#custom-accordion-two">
                                            <div class="card-body">
                                                @include('humanResource.trainingInfo')
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="card mb-0">
                                        <div class="card-header" id="other">
                                            <h5 class="m-0">
                                                <a class="custom-accordion-title collapsed d-block py-1"
                                                    data-bs-toggle="collapse" href="#otherInfo" aria-expanded="false"
                                                    aria-controls="otherInfo">
                                                    Other Information<i
                                                        class="mdi mdi-chevron-down accordion-arrow"></i>
                                                </a>
                                            </h5>
                                        </div>
                                        <div id="otherInfo" class="collapse" aria-labelledby="other"
                                            data-bs-parent="#custom-accordion-two">
                                            <div class="card-body">
                                                ...
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end card body-->
                        </div><!-- end card -->
                    </div> <!-- end col -->
                </div>
                <!--end of row-->
            </div>
            @if (Auth::user()->hasRole(['HrAdmin']) && Auth::user()->isAbleTo('employee-create'))
                <div class="tab-pane show" id="files">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="accordion custom-accordion" id="custom-accordion-three">
                                        <div class="card mb-0">
                                            <div class="card-header" id="experience">
                                                <h5 class="m-0">
                                                    <a class="custom-accordion-title d-block py-1"
                                                        data-bs-toggle="collapse" href="#experienceInfo"
                                                        aria-expanded="true" aria-controls="experienceInfo">
                                                        Official Contract <i
                                                            class="mdi mdi-chevron-down accordion-arrow"></i>
                                                    </a>
                                                </h5>
                                            </div>
                                            <div id="experienceInfo" class="collapse show"
                                                aria-labelledby="experience" data-bs-parent="#custom-accordion-three">
                                                <div class="card-body">
                                                    @include('humanResource.officialContract')
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="card mb-0">
                                            <div class="card-header" id="training">
                                                <h5 class="m-0">
                                                    <a class="custom-accordion-title collapsed d-block py-1"
                                                        data-bs-toggle="collapse" href="#trainingInfo"
                                                        aria-expanded="false" aria-controls="trainingInfo">
                                                        Project Contract<i
                                                            class="mdi mdi-chevron-down accordion-arrow"></i>
                                                    </a>
                                                </h5>
                                            </div>
                                            <div id="trainingInfo" class="collapse" aria-labelledby="training"
                                                data-bs-parent="#custom-accordion-three">
                                                <div class="card-body">
                                                    @include('humanResource.projectContract')
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="card mb-0">
                                            <div class="card-header" id="other">
                                                <h5 class="m-0">
                                                    <a class="custom-accordion-title collapsed d-block py-1"
                                                        data-bs-toggle="collapse" href="#otherInfo"
                                                        aria-expanded="false" aria-controls="otherInfo">
                                                        Other Information<i
                                                            class="mdi mdi-chevron-down accordion-arrow"></i>
                                                    </a>
                                                </h5>
                                            </div>
                                            <div id="otherInfo" class="collapse" aria-labelledby="other"
                                                data-bs-parent="#custom-accordion-three">
                                                <div class="card-body">
                                                    ...
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end card body-->
                            </div><!-- end card -->
                        </div> <!-- end col -->
                    </div>
                    <!--end of row-->
                </div>
            @endif
        </div>

    </div> <!-- end tab-content-->

    @push('scripts')
        <script type="text/javascript">
            $(document).ready(function() {

                $('#user_department').change(function() {
                    var id = $(this).val();
                    var url = "{{ route('units.get', ':id') }}";
                    url = url.replace(':id', id);

                    let unitElement;

                    $.ajax({
                        url: url,
                        method: "GET",
                        dataType: "json",
                        success: function(response) {
                            console.log(response);

                            $("option[class='dynamic']").remove();

                            response[0].map(unit => {
                                unitElement =
                                    `<option class="dynamic" value="${unit.id}">${unit.department_name}</option>`
                                $('#department_unit_id').append(unitElement);
                                return true;

                            });
                            // $('#emp_id').val(response[1]);

                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            console.log(xhr.status);
                            console.log(thrownError);
                        }
                    })
                })

                //STORE BANKING INFORMATION
                $('#bankingForm').submit(function(e) {

                    e.preventDefault();
                    let formData = new FormData(this);

                    $.ajax({
                        type: 'POST',
                        url: "{{ route('bankingInformation.store') }}",
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: (response) => {

                            iziToast.success({
                                title: 'Good!',
                                message: response.message,
                                position: 'topRight'
                            });
                            $('#bankingForm').trigger('reset');

                        },
                        error: function(response) {
                            swal('Error', 'Oops! Something went wrong', 'error');

                        }
                    });
                });

                //STORE FAMILY INFORMATION
                $('#familyBackground').submit(function(e) {

                    e.preventDefault();
                    let formData = new FormData(this);

                    $.ajax({
                        type: 'POST',
                        url: "{{ route('familyBackground.store') }}",
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: (response) => {

                            iziToast.success({
                                title: 'Good!',
                                message: response.message,
                                position: 'topRight'
                            });
                            $('#familyBackground').trigger('reset');

                        },
                        error: function(response) {
                            swal('Error', 'Oops! Something went wrong', 'error');

                        }
                    });
                });

                //STORE DEPENDANTS INFORMATION
                $('#dependantInfo').submit(function(e) {

                    e.preventDefault();
                    let formData = new FormData(this);

                    $.ajax({
                        type: 'POST',
                        url: "{{ route('employeeChildren.store') }}",
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: (response) => {

                            iziToast.success({
                                title: 'Good!',
                                message: response.message,
                                position: 'topRight'
                            });
                            $('#dependantInfo').trigger('reset');

                        },
                        error: function(response) {
                            swal('Error', 'Oops! Something went wrong', 'error');

                        }
                    });
                });

                //STORE EMERGENCY CONTACT INFORMATION
                $('#emergencyContact').submit(function(e) {

                    e.preventDefault();
                    let formData = new FormData(this);

                    $.ajax({
                        type: 'POST',
                        url: "{{ route('emergencyContact.store') }}",
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
                                $('#emergencyContact').trigger('reset');
                            } else {
                                swal('Error', `Oops! ${response.message}`, 'error');
                            }

                        },
                        error: function(response) {
                            swal('Error', 'Oops! Something went wrong', 'error');

                        }

                    });
                });

                //STORE EDUCATION INFORMATION
                $('#educationInfo').submit(function(e) {

                    e.preventDefault();
                    let formData = new FormData(this);

                    $.ajax({
                        type: 'POST',
                        enctype: 'multipart/form-data',
                        url: "{{ route('educationBackground.store') }}",
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: (response) => {

                            iziToast.success({
                                title: 'Good!',
                                message: response.message,
                                position: 'topRight'
                            });
                            $('#educationInfo').trigger('reset');

                        },
                        error: function(response) {
                            swal('Error', 'Oops! Something went wrong', 'error');

                        }
                    });
                });


                //STORE WORK EXPERIENCE INFORMATION
                $('#experienceForm').submit(function(e) {

                    e.preventDefault();
                    let formData = new FormData(this);

                    $.ajax({
                        type: 'POST',
                        url: "{{ route('workExperience.store') }}",
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: (response) => {

                            iziToast.success({
                                title: 'Good!',
                                message: response.message,
                                position: 'topRight'
                            });
                            $('#experienceForm').trigger('reset');

                        },
                        error: function(response) {
                            swal('Error', 'Oops! Something went wrong', 'error');

                        }
                    });
                });


                //STORE TRAINING INFORMATION
                $('#trainingForm').submit(function(e) {

                    e.preventDefault();
                    let formData = new FormData(this);

                    $.ajax({
                        type: 'POST',
                        enctype: 'multipart/form-data',
                        url: "{{ route('trainingProgram.store') }}",
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: (response) => {

                            iziToast.success({
                                title: 'Good!',
                                message: response.message,
                                position: 'topRight'
                            });
                            $('#trainingForm').trigger('reset');

                        },
                        error: function(response) {
                            swal('Error', 'Oops! Something went wrong', 'error');

                        }
                    });
                });

                //STORE OFFICIAL CONTRACT
                $('#officialContractForm').submit(function(e) {

                    e.preventDefault();
                    let formData = new FormData(this);

                    swal({
                            title: 'Is Supervisor and Designation information already Updated?',
                            text: 'Continue if they are upto date or Cancel and update them first please!',
                            icon: 'warning',
                            buttons: true,
                            dangerMode: true,
                        })
                        .then((willConfirm) => {
                            if (willConfirm) {
                                $.ajax({
                                    type: 'POST',
                                    enctype: 'multipart/form-data',
                                    url: "{{ route('officialContracts.store') }}",
                                    data: formData,
                                    cache: false,
                                    contentType: false,
                                    processData: false,
                                    success: (response) => {

                                        iziToast.success({
                                            title: 'Good!',
                                            message: response.message,
                                            position: 'topRight'
                                        });
                                        $('#officialContractForm').trigger('reset');

                                    },
                                    error: function(response) {
                                        swal('Error', 'Oops! Something went wrong', 'error');

                                    }
                                });
                            } else {

                                return false;
                            }
                        });


                });

                //STORE PROJECT CONTRACT
                $('#projectContractForm').submit(function(e) {

                    e.preventDefault();
                    let formData = new FormData(this);

                    $.ajax({
                        type: 'POST',
                        enctype: 'multipart/form-data',
                        url: "{{ route('projectContracts.store') }}",
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: (response) => {

                            iziToast.success({
                                title: 'Good!',
                                message: response.message,
                                position: 'topRight'
                            });
                            $('#projectContractForm').trigger('reset');

                        },
                        error: function(response) {
                            swal('Error', 'Oops! Something went wrong', 'error');

                        }
                    });
                });



            });
        </script>
    @endpush
</x-hr-layout>
