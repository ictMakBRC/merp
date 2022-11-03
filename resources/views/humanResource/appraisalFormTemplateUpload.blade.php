<x-hr-layout>
    <!-- start page title -->
    <x-page-title>
        Appraisal Template Upload
    </x-page-title>

    <!-- end row-->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header pt-0">
                    <div class="row mb-2">
                        <div class="col-sm-12">
                            <div class="text-sm-end mt-3">
                                <h4 class="header-title mb-3  text-center">Appraisal Form Template Upload</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <!-- File Upload -->
                    <form action="{{ route('appraisaltemplate.upload') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row col-md-12">
                            <div class="col-md-12">
                                <label for="apparaisalform" class="form-label">Appraisal Form Template</label>
                                <input name="apparaisalform" type="file" id="apparaisalform" class="form-control"
                                    required accept=".docx">
                            </div>
                            <div class="col-md-8"></div>
                            <div class="col-md-4 text-end pt-1">
                                <button class="btn btn-success" type="submit"
                                    onclick="return confirm('Are you sure you want to Upload?');">Submit</button>
                            </div>
                        </div>
                    </form>
                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>

</x-hr-layout>
