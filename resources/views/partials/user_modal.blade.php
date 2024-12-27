<!-- Modal for user {{ $user->id }} -->
<div class="modal fade" id="userModal{{ $user->id }}" tabindex="-1" aria-labelledby="userModalLabel{{ $user->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel{{ $user->id }}">user Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <div class="row">
                    <!-- Personal Details -->
                    <div class="col-md-6">
                        <h3>Personal Details</h3>
                        <p><strong>Username:</strong> {{ $user->username }}</p>
                        <p><strong>Name:</strong> {{ $user->first_name }} {{ $user->last_name }}</p>
                        <p><strong>Father's Name:</strong> {{ $user->father_first_name }} {{ $user->father_last_name }}</p>
                        <p><strong>Gender:</strong> {{ $user->gender }}</p>
                        <p><strong>Country:</strong> {{ $user->country }}</p>
                        <p><strong>Nationality:</strong> {{ $user->nationality }}</p>
                        <p><strong>Address:</strong> {{ $user->address }}</p>
                        <p><strong>Profession:</strong> {{ $user->profession }}</p>
                        <p><strong>Phone:</strong> {{ $user->phone }}</p>
                        <p><strong>Mobile:</strong> {{ $user->mobile }}</p>
                        <p><strong>WhatsApp:</strong> {{ $user->whatsapp }}</p>
                        <p><strong>Facebook:</strong> <a href="{{ $user->fb_url }}" target="_blank">{{ $user->fb_url }}</a></p>
                        <p><strong>LinkedIn:</strong> <a href="{{ $user->linkedin }}" target="_blank">{{ $user->linkedin }}</a></p>
                        <p><strong>Telegram:</strong> {{ $user->telegram }}</p>
                        <p><strong>Instagram:</strong> {{ $user->instagram }}</p>
                        <p><strong>WeChat:</strong> {{ $user->wechat }}</p>
                        <p><strong>IMO:</strong> {{ $user->imo }}</p>
                        <p><strong>CNIC/Passport No:</strong> {{ $user->cnic_passport_no }}</p>
                        <p><strong>Date of Issue:</strong> {{ \Carbon\Carbon::parse($user->date_of_issue)->format('d M, Y') }}</p>
                        <p><strong>Date of Expiry:</strong> {{ \Carbon\Carbon::parse($user->date_of_expiry)->format('d M, Y') }}</p>
                        <p><strong>Invited Way:</strong> {{ $user->invited_way }}</p>
                    </div>

                    <!-- Business Details -->
                    <div class="col-md-6">
                        <h3>Business Details</h3>
                        @if($user->business)
                            <p><strong>Company Name:</strong> {{ $user->business->company_name }}</p>
                            <p><strong>Address:</strong> {{ $user->business->address }}</p>
                            <p><strong>Company Phone:</strong> {{ $user->business->company_phone }}</p>
                            <p><strong>Company Mobile:</strong> {{ $user->business->company_mobile }}</p>
                            <p><strong>Business Phone:</strong> {{ $user->business->business_phone }}</p>
                            <p><strong>Position:</strong> {{ $user->business->position }}</p>
                            <p><strong>Website URL:</strong> <a href="{{ $user->business->website_url }}" target="_blank">{{ $user->business->website_url }}</a></p>
                            <p><strong>Export Items:</strong> {{ $user->business->export_items }}</p>
                            <p><strong>Main Import Countries:</strong> {{ $user->business->main_import_countries }}</p>
                            <p><strong>Main Export Countries:</strong> {{ $user->business->main_export_countries }}</p>
                            <p><strong>Annual Turnover:</strong> {{ $user->business->annual_turnover }}</p>
                            <p><strong>National Sale:</strong> {{ $user->business->national_sale }}</p>
                            <p><strong>Annual Import/Export:</strong> {{ $user->business->annual_import_export }}</p>
                        @else
                            <p class="text-muted">No business details available.</p>
                        @endif
                    </div>
                </div>
            </div>
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
