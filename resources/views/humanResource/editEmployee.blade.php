<x-hr-layout>
    <!-- start page title -->
    <x-page-title>
        Edit Employee Information
    </x-page-title>

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
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="personal_info">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="accordion custom-accordion" id="custom-accordion-one">
                                <div class="card mb-0">
                                    <div class="card-header" id="headingFour">
                                        <h5 class="m-0">
                                            <a class="custom-accordion-title d-block py-1" data-bs-toggle="collapse"
                                                href="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                                                Basic Information <i class="mdi mdi-chevron-down accordion-arrow"></i>
                                            </a>
                                        </h5>
                                    </div>
                                    <div id="collapseFour" class="collapse show" aria-labelledby="headingFour"
                                        data-bs-parent="#custom-accordion-one">
                                        <div class="card-body">
                                            @include('humanResource.editPersonalInfo')
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="card mb-0">
                                    <div class="card-header" id="banking">
                                        <h5 class="m-0">
                                            <a class="custom-accordion-title collapsed d-block py-1"
                                                data-bs-toggle="collapse" href="#bankingInfo" aria-expanded="false"
                                                aria-controls="bankingInfo">
                                                Banking Information<i class="mdi mdi-chevron-down accordion-arrow"></i>
                                            </a>
                                        </h5>
                                    </div>
                                    <div id="bankingInfo" class="collapse" aria-labelledby="banking"
                                        data-bs-parent="#custom-accordion-one">
                                        <div class="card-body">

                                            @include('humanResource.editBankingInfo')

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
                                                Family Background<i class="mdi mdi-chevron-down accordion-arrow"></i>
                                            </a>
                                        </h5>
                                    </div>
                                    <div id="collapseFive" class="collapse" aria-labelledby="headingFive"
                                        data-bs-parent="#custom-accordion-one">
                                        <div class="card-body">
                                            @include('humanResource.editFamilyInfo')
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="card mb-0">
                                    <div class="card-header" id="emergency">
                                        <h5 class="m-0">
                                            <a class="custom-accordion-title collapsed d-block py-1"
                                                data-bs-toggle="collapse" href="#emergencyInfo" aria-expanded="false"
                                                aria-controls="emergencyInfo">
                                                Emergency Contact Information<i
                                                    class="mdi mdi-chevron-down accordion-arrow"></i>
                                            </a>
                                        </h5>
                                    </div>
                                    <div id="emergencyInfo" class="collapse" aria-labelledby="emergency"
                                        data-bs-parent="#custom-accordion-one">
                                        <div class="card-body">
                                            @if (!$emergencycontacts->isEmpty())
                                                @foreach ($emergencycontacts as $emergencycontact)
                                                    @include('humanResource.editEmergencyInfo')
                                                @endforeach
                                            @else
                                            <x-not-available-alert>
                                                No Emergency Contact Information
                                            </x-not-available-alert>
                                            @endif
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
                        <div class="card-body">
                            @include('humanResource.editEducationInfo')
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
                                            <a class="custom-accordion-title d-block py-1" data-bs-toggle="collapse"
                                                href="#experienceInfo" aria-expanded="true"
                                                aria-controls="experienceInfo">
                                                Work Experience <i class="mdi mdi-chevron-down accordion-arrow"></i>
                                            </a>
                                        </h5>
                                    </div>
                                    <div id="experienceInfo" class="collapse show" aria-labelledby="experience"
                                        data-bs-parent="#custom-accordion-two">
                                        <div class="card-body">
                                            @include('humanResource.editWorkExperience')
                                        </div>
                                    </div>
                                </div>

                                <hr>
                                <div class="card mb-0">
                                    <div class="card-header" id="training">
                                        <h5 class="m-0">
                                            <a class="custom-accordion-title collapsed d-block py-1"
                                                data-bs-toggle="collapse" href="#trainingInfo" aria-expanded="false"
                                                aria-controls="trainingInfo">
                                                Training Program (attended in the last 3 years, Start from the most
                                                recent)<i class="mdi mdi-chevron-down accordion-arrow"></i>
                                            </a>
                                        </h5>
                                    </div>
                                    <div id="trainingInfo" class="collapse" aria-labelledby="training"
                                        data-bs-parent="#custom-accordion-two">
                                        <div class="card-body">
                                            @include('humanResource.editTrainingInfo')
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="card mb-0">
                                    <div class="card-header" id="other">
                                        <h5 class="m-0">
                                            <a class="custom-accordion-title collapsed d-block py-1"
                                                data-bs-toggle="collapse" href="#otherInformation"
                                                aria-expanded="false" aria-controls="otherInformation">
                                                Other Information<i class="mdi mdi-chevron-down accordion-arrow"></i>
                                            </a>
                                        </h5>
                                    </div>
                                    <div id="otherInformation" class="collapse" aria-labelledby="other"
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
    </div> <!-- end tab-content-->


    @push('scripts')
        <script type="text/javascript">
            $(document).ready(function() {


                $('#user_department').change(function() {
                    var id = $(this).val();
                    var url = "{{ route('units.change', ':id') }}";
                    url = url.replace(':id', id);

                    $('#department_unit_id').empty();
                    let unitElement;

                    $.ajax({
                        url: url,
                        method: "GET",
                        dataType: "json",
                        success: function(response) {
                            $("option[class='dynamic']").remove();
                            $('#department_unit_id').append(
                                `<option  value="" selected>Select</option>`);
                            $('#department_unit_id').append(`<option  value="">None</option>`);
                            response.map(unit => {

                                unitElement =
                                    `<option class="dynamic" value="${unit.id}">${unit.department_name}</option>`
                                $('#department_unit_id').append(unitElement);
                                return true;

                            });
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            console.log(xhr.status);
                            console.log(thrownError);
                        }
                    })
                })
            });
        </script>
    @endpush

</x-hr-layout>
