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
                        <form method="GET" action="{{ route('flight-details.create') }}">
                            @csrf
                            <!-- Buyer Selection -->
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="select_buyer" class="form-label">Select Buyer</label>
                                    <select class="form-select @error('select_buyer') is-invalid @enderror" id="select_buyer" name="select_buyer">
                                        <option value="">Select Buyer</option>
                                        @foreach($buyers as $buyer)
                                            @if(isset($buyer->flight))
                                                <option value="{{ $buyer->id }}" disabled>{{ $buyer->name }} (Already have flights)</option>
                                            @else
                                                <option value="{{ $buyer->id }}">{{ $buyer->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('select_buyer')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Dynamic Buyer Details -->
                            <div id="buyer-details-form" style="display: none;">
                                <h5 class="mb-3" id="form-title"></h5>
                                <div class="row">
                                    <!-- Full Name -->
                                    <div class="col-md-6 mb-3">
                                        <label for="name" class="form-label">Full Name</label>
                                        <input type="text" class="form-control" id="name" readonly name="name" value="">
                                    </div>
                                    <!-- Phone Number -->
                                    <div class="col-md-6 mb-3">
                                        <label for="phone" class="form-label">Phone Number</label>
                                        <input type="tel" class="form-control" id="phone" readonly name="phone" value="">
                                    </div>
                                    <!-- Email Address -->
                                    <div class="col-md-6 mb-3">
                                        <label for="email" class="form-label">Email Address</label>
                                        <input type="email" class="form-control" id="email" readonly name="email" value="">
                                    </div>
                                    {{-- <!-- Participant Name -->
                                    <div class="col-md-6 mb-3">
                                        <label for="participant_name" class="form-label">Participant Name</label>
                                        <input type="text" class="form-control" id="participant_name" readonly name="participant_name" value="">
                                    </div> --}}
                                </div>
                            </div>

                            <!-- Form Submission -->
                            <div class="row mt-3">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Select Buyer</button>
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
        const buyers = @json($buyers);

        const buyerSelect = document.getElementById('select_buyer');
        const buyerForm = document.getElementById('buyer-details-form');
        const formTitle = document.getElementById('form-title');

        buyerSelect.addEventListener('change', function () {
            const selectedBuyerId = this.value;

            // Hide and reset form if no buyer is selected
            if (!selectedBuyerId) {
                buyerForm.style.display = 'none';
                resetFormFields();
                return;
            }

            // Find selected buyer
            const selectedBuyer = buyers.find(buyer => buyer.id == selectedBuyerId);

            // Show form and populate data
            if (selectedBuyer) {
                buyerForm.style.display = 'block';
                formTitle.textContent = `Buyer's Detail`;

                // Reset fields
                resetFormFields();

                // Populate fields
                document.getElementById('name').value = selectedBuyer.name || '';
                document.getElementById('phone').value = selectedBuyer.phone || '';
                document.getElementById('email').value = selectedBuyer.email || '';

                // Check and set participant name if available
                const participant = selectedBuyer.user_participants?.[0]?.firstname 
                    ? selectedBuyer.user_participants[0].firstname + ' ' + selectedBuyer.user_participants[0].lastname 
                    : 'No participant found';
                document.getElementById('participant_name').value = participant;
            }
        });

        // Reset form fields
        function resetFormFields() {
            document.querySelectorAll('input').forEach(input => input.value = '');
        }
    });
</script>
@endsection
