<form action="{{ route('emergencyContact.update', $emergencycontact->id) }}" method="POST">
    @method('PUT')
    @csrf
    <div class="row">
        <div class="mb-3 col-md-6">
            <label for="contact_name" class="form-label">Contact Name</label>
            <input type="text" id="contact_name" class="form-control" name="contact_name"
                value="{{ $emergencycontact->contact_name }}" required>
        </div>
        <div class="mb-3 col-md-6">
            <label for="contact_relationship" class="form-label">Relationship To Contact</label>
            <input type="text" id="contact_relationship" class="form-control" name="contact_relationship"
                value="{{ $emergencycontact->contact_relationship }}" required>
        </div>
        <div class="col-md-4">
            <label for="contact_email" class="form-label">Email</label>
            <input name="contact_email" type="email" id="contact_email" class="form-control"
                value="{{ $emergencycontact->contact_email }}">
        </div>
        <div class="col-md-4">
            <label for="contact_phone" class="form-label">Phone Number</label>
            <input name="contact_phone" type="text" id="contact_phone" class="form-control"
                value="{{ $emergencycontact->contact_phone }}" required>
        </div>
        <div class="col-md-4">
            <label for="contact_address" class="form-label">Address</label>
            <input name="contact_address" type="text" id="contact_address" class="form-control"
                value="{{ $emergencycontact->contact_address }}" required>
        </div>
        <div class="col-md-8"></div>
        <div class="col-md-4 text-end pt-1">
            <button class="btn btn-success" type="submit">Update</button>
        </div>
    </div>
</form>
