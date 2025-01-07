@extends('layouts.app')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3">Select Buyer</h3>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form method="get" action="{{ route('accommodation.create') }}">
                            @csrf
                            <!-- user Selection -->
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="select_user" class="form-label">Select Buyer</label>
                                    <select class="form-select" id="select_user" name="select_user">
                                        <option value="">Select user</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('select_user')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Dynamic user Details -->
                            <div id="user-details-form" style="display: none;">
                                <h5 class="mb-3" id="form-title"></h5>
                                <div class="row">
                                    <!-- Full Name -->
                                    <div class="col-md-6 mb-3">
                                        <label for="name" class="form-label">Full Name</label>
                                        <input type="text" class="form-control" id="name" readonly name="name" value="">
                                        @error('name')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!-- Phone Number -->
                                    <div class="col-md-6 mb-3">
                                        <label for="phone" class="form-label">Phone Number</label>
                                        <input type="tel" class="form-control" id="phone" readonly name="phone" value="">
                                        @error('phone')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!-- Email Address -->
                                    <div class="col-md-12 mb-3">
                                        <label for="email" class="form-label">Email Address</label>
                                        <input type="email" class="form-control" id="email" readonly name="email" value="">
                                        @error('email')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Form Submission -->
                            <div class="row mt-3">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Select user</button>
                                    <a href="{{ route('flight-details.index') }}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript to dynamically update forms -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const users = @json($users);

        const userSelect = document.getElementById('select_user');
        const userForm = document.getElementById('user-details-form');
        const formTitle = document.getElementById('form-title');
        const companyFields = document.getElementById('company-fields');

        userSelect.addEventListener('change', function () {
            const selecteduserId = this.value;

            // Hide and reset form if no user is selected
            if (!selecteduserId) {
                userForm.style.display = 'none';
                resetFormFields();
                return;
            }

            // Find selected user
            const selecteduser = users.find(user => user.id == selecteduserId);

            // Show form and populate data
            if (selecteduser) {
                userForm.style.display = 'block';
                formTitle.textContent = `user's Detail`;

                // Reset fields
                resetFormFields();

                // Populate fields
                document.getElementById('name').value = selecteduser.name || '';
                document.getElementById('phone').value = selecteduser.phone || '';
                document.getElementById('email').value = selecteduser.email || '';

                // Show/Hide company fields
                if (selecteduser.type === 'company') {
                    companyFields.style.display = 'block';
                    document.getElementById('company_name').value = selecteduser.company_name || '';
                    document.getElementById('company_registration').value = selecteduser.company_registration || '';
                    document.getElementById('company_address').value = selecteduser.company_address || '';
                    document.getElementById('contact_person').value = selecteduser.contact_person || '';
                    document.getElementById('contact_phone').value = selecteduser.contact_phone || '';
                } else {
                    companyFields.style.display = 'none';
                }
            }
        });

        // Reset form fields
        function resetFormFields() {
            document.querySelectorAll('input, textarea').forEach(input => input.value = '');
        }
    });
</script>
@endsection
