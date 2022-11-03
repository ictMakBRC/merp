@foreach ($awards as $award)
    <div class="modal fade" id="editAward{{ $award->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Update Education Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div> <!-- end modal header -->
                <div class="modal-body">
                    <form action="{{ route('educationBackground.update', $award->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="level" class="form-label">Education Level</label>
                                <select class="form-select" id="level" name="level" required>
                                    <option selected value="{{ $award->level }}">{{ $award->level }}</option>
                                    <option value='Primary'>Primary</option>
                                    <option value='O-level'>Ordinary Level</option>
                                    <option value='A-level'>Advanced/High School</option>
                                    <option value='College'>College Level</option>
                                    <option value='Vocation'>Vocational Level</option>
                                    <option value='Graduate'>Graduate</option>
                                    <option value='Post Graduate'>Post Graduate</option>
                                    <option value='Doctorate'>Doctorate</option>
                                </select>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="school" class="form-label">School/College/Institute/University</label>
                                <input type="text" id="school" class="form-control" name="school"
                                    value="{{ $award->school }}" required>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="start_date" class="form-label">From</label>
                                <input type="date" id="start_date" class="form-control"
                                    value="{{ $award->start_date }}" name="start_date">
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="end_date" class="form-label">To</label>
                                <input type="date" id="end_date" class="form-control" name="end_date"
                                    value="{{ $award->end_date }}">
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="award" class="form-label">Degree/Honor/Diploma/Certicate/Award</label>
                                <input type="text" id="award" class="form-control" name="award"
                                    value="{{ $award->award }}" required>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="award_document" class="form-label">Award Document</label>
                                <input type="file" id="award_document" class="form-control" name="award_document"
                                    accept=".pdf">
                            </div>
                            <div class="col-md-8"></div>
                            <div class="col-md-4 text-end pt-1">
                                <button class="btn btn-success" type="submit">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div> <!-- end modal content-->
        </div> <!-- end modal dialog-->
    </div> <!-- end modal-->
@endforeach
