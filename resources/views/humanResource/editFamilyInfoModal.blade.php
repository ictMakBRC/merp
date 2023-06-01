@foreach ($familybackgrounds as $familybackground)
    <div class="modal fade" id="editInfo{{ $familybackground->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Update Family Background Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div> <!-- end modal header -->
                <div class="modal-body">
                    <form action="{{ route('familyBackground.update', $familybackground->id) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="row">

                            <div class="mb-3 col-md-3">
                                <label for="member_type" class="form-label">Member Type</label>
                                <select class="form-select" id="member_type" name="member_type" required>
                                    <option selected value="{{ $familybackground->member_type }}">
                                        {{ $familybackground->member_type }}</option>
                                    <option value='Spouse'>Spouse</option>
                                    <option value='Father'>Father</option>
                                    <option value='Mother'>Mother</option>
                                    <option value='Brother'>Brother</option>
                                    <option value='Sister'>Sister</option>
                                </select>
                            </div>
                            <div class="mb-3 col-md-3">
                                <label for="surname" class="form-label">Surname</label>
                                <input type="text" id="surname" class="form-control" name="surname"
                                    value="{{ $familybackground->surname }}" required>
                            </div>
                            <div class="col-md-3">
                                <label for="first_name" class="form-label">First Name</label>
                                <input name="first_name" type="text" id="first_name" class="form-control"
                                    value="{{ $familybackground->first_name }}" required>
                            </div>
                            <div class="col-md-3">
                                <label for="middle_name" class="form-label">Middle Name</label>
                                <input name="middle_name" type="text" id="middle_name"
                                    value="{{ $familybackground->middle_name }}" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label for="address" class="form-label">Address</label>
                                <input name="address" type="text" id="address" class="form-control"
                                    value="{{ $familybackground->address }}">
                            </div>
                            <div class="col-md-4">
                                <label for="contact" class="form-label">Contact</label>
                                <input name="contact" type="text" id="contact" class="form-control"
                                    value="{{ $familybackground->contact }}">
                            </div>
                            <div class="col-md-4">
                                <label for="occupation" class="form-label">Occupation</label>
                                <input name="occupation" type="text" id="occupation" class="form-control"
                                    value="{{ $familybackground->occupation }}">
                            </div>
                            <div class="col-md-4 pt-3">
                                <label for="employer" class="form-label">Employer/Business Name</label>
                                <input name="employer" type="text" id="employer" class="form-control"
                                    value="{{ $familybackground->employer }}">
                            </div>
                            <div class="col-md-4 pt-3">
                                <label for="employer_contact" class="form-label">Employer/Business Contact</label>
                                <input name="employer_contact" type="text" id="employer_contact" class="form-control"
                                    value="{{ $familybackground->employer_contact }}">
                            </div>
                            <div class="col-md-4 pt-3">
                                <label for="employer_address" class="form-label">Employer/Business Address</label>
                                <input name="employer_address" type="text" id="employer_address"
                                    class="form-control" value="{{ $familybackground->employer_address }}">
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
