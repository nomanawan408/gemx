<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use App\Models\Business;
use App\Models\Attachment;
use App\Models\Exhibition;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;
use App\Models\Stall;
use App\Models\UserParticipant;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;




class WebsiteFormController extends Controller
{
    //

    /**
     * Handle an incoming website form request.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function submit_national_visitor_form(Request $request)
    {
        try {
        
        // \Log::info('Request Data:', $request->all());

        // Remove json_decode since data is already available in $request
        $validated = $request->validate([
            'username' => 'nullable|string|max:255',
            'password' => 'nullable|string',
            'confirm_password' => 'nullable|same:password',
            'firstname' => 'nullable|string|max:255',
            'lastname' => 'nullable|string|max:255',
            'father_firstname' => 'nullable|string|max:255',
            'father_lastname' => 'nullable|string|max:255',
            'gender' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'profession' => 'nullable|string|max:255',

            'phone' => 'nullable|string|max:20',
            'mobile' => 'nullable|string|max:20',
            'whatsapp' => 'nullable|string|max:20',
            'email' => 'nullable|email|unique:users,email',
            'facebook' => 'nullable|string|max:255',
            'linkedin' => 'nullable|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'telegram' => 'nullable|string|max:255',
            'wechat' => 'nullable|string|max:255',
            'imo' => 'nullable|string|max:255',
            'cnic_no' => 'nullable|string|max:20',
            'cnic_issue' => 'nullable|date',
            'cnic_expiry' => 'nullable|date',
            'cnic_picture' => 'nullable',
            'personal_photo' => 'nullable',
            'invited_way' => 'nullable|string',
            'shoowothers' => 'nullable|string',
            'business' => 'nullable|in:Yes,No',
            'company_name' => 'nullable|string|max:255',
            'company_address' => 'nullable|string',
            'company_phone' => 'nullable|string|max:20',
            'business_mobile' => 'nullable|string|max:50',
            'business_phone' => 'nullable|string|max:50',
            'position' => 'nullable|string|max:255',
            'url' => 'nullable',
            'export_items' => 'nullable|string',
            'import_countries' => 'nullable|string',
            'export_country' => 'nullable|string',
            'annual_turnover' => 'nullable|string',
            'national_sale' => 'nullable|numeric',
            'annual_export' => 'nullable|numeric',    
            'other_professtion' => 'nullable|string',    
            'shoowothers' => 'nullable|string',
        ]);        
        
        // Step 2: Create User
        $user = User::create([
            'username' =>  $validated['username'],
            'name' => $validated['firstname'] . ' ' . $validated['lastname'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'first_name' => $validated['firstname'],
            'last_name' => $validated['lastname'],
            'father_first_name' => $validated['father_firstname'],
            'father_last_name' => $validated['father_lastname'],
            'gender' => $validated['gender'],
            'country' => 'Pakistan', 
            'nationality' => 'Pakistani', 
            'address' => $validated['address'], 
            'profession' => $validated['profession'] != 'Others' ? $validated['profession'] : $validated['other_professtion'],
            'phone' => $validated['phone'],
            'mobile' => $validated['mobile'],
            'whatsapp' => $validated['whatsapp'],
            'fb_url' => $validated['facebook'],
            'linkedin' => $validated['linkedin'],
            'telegram' => $validated['telegram'],
            'instagram' => $validated['instagram'],
            'wechat' => $validated['wechat'],
            'imo' => $validated['imo'],
            'cnic_passport_no' => $validated['cnic_no'],
            'date_of_issue' => $validated['cnic_issue'],
            'date_of_expiry' => $validated['cnic_expiry'],
            'invited_way' => $validated['invited_way'] != 'Others' ? $validated['invited_way'] : $validated['shoowothers'],
            'declaration' => true,
        ]);

        $user->assignRole('visitor');
            
        $saveFileFromUrl = function ($url, $folder, $userId) {
            if ($url && filter_var($url, FILTER_VALIDATE_URL)) {
                try {
                    $response = Http::withOptions([
                        'allow_redirects' => true, 
                    ])
                    ->timeout(30)
                    ->accept('*/*')
                    ->get($url);

                    // Check status
                    if (!$response->successful()) {
                        throw new \Exception("Failed to fetch the file. HTTP status: " . $response->status());
                    }

                    $contents = $response->body();
                    $contentType = strtolower(explode(';', $response->header('Content-Type'))[0]);
                    
                    Log::info("HTTP Status: " . $response->status());
                    Log::info("Content-Type: " . $contentType);
                    Log::info("File content preview: " . substr($contents, 0, 200));

                    // Determine file extension
                    $extension = match ($contentType) {
                        'image/jpeg' => 'jpg',
                        'image/png'  => 'png',
                        'application/pdf' => 'pdf',
                        default => pathinfo(parse_url($url, PHP_URL_PATH), PATHINFO_EXTENSION),
                    };

                    $fileName = time() . '-' . $userId . '.' . $extension;
                    $filePath = $folder . '/' . $fileName;

                    // Save to public disk
                    Storage::disk('public')->put($filePath, $contents);

                    // Check file size to confirm successful save
                    $savedFileSize = Storage::disk('public')->size($filePath);
                    if (!$savedFileSize || $savedFileSize <= 0) {
                        throw new \Exception("File saved is empty or corrupted. File path: $filePath");
                    }

                    Log::info("File saved successfully: $filePath, Size: $savedFileSize bytes");

                    return $filePath;
                } catch (\Exception $e) {
                    Log::error("Failed to download file: {$url}, Error: " . $e->getMessage());
                    return null;
                }
            } else {
                Log::warning("Invalid or missing URL: {$url}");
                return null;
            }
        };

        

        // Step 3: Download and Save Each File
        $personalPhoto = $saveFileFromUrl($validated['personal_photo'] ?? null, 'uploads/photos', $user->id);
        $passport = $saveFileFromUrl($validated['cnic_picture'] ?? null, 'uploads/passports', $user->id);

        // Step 4: Save Attachments to Database
        Attachment::create([
            'user_id' => $user->id,
            'personal_photo' => $personalPhoto,
            'passport_cnic_file' => $passport,
        ]);

        // Step 4: Save Business Information if applicable
        if ($validated['business'] === 'Yes') {
            Business::create([
                'user_id' => $user->id,
                'company_name' => $validated['company_name'],
                'address' => $validated['company_address'],
                'company_phone' => $validated['company_phone'],
                'company_mobile' => $validated['business_mobile'],
                'position' => $validated['position'],
                'website_url' => $validated['url'],
                'main_export_items' => $validated['export_items'],
                'main_import_countries' => $validated['import_countries'],
                'main_export_countries' => $validated['export_country'],
                'annual_turnover' => $validated['annual_turnover'],
                'national_sale' => $validated['national_sale'],
                'annual_import_export' => $validated['annual_export'],
            ]);
        }
        

        Log::info("User {$user->id} and attachments saved successfully.");

        return response()->json([
            'success' => true,
            'message' => 'Form submitted and files saved successfully.',
            'user_id' => $user->id,
        ], 200);
    } catch (\Illuminate\Validation\ValidationException $e) {
        Log::error('Validation Error:', $e->errors());
        return response()->json([
            'success' => false,
            'message' => 'Validation failed.',
            'errors' => $e->errors(),
        ], 422);
    } catch (\Exception $e) {
        Log::error('Server Error:', ['message' => $e->getMessage()]);
        return response()->json([
            'success' => false,
            'message' => 'Something went wrong. Please try again later.',
            'error' => $e->getMessage(),
        ], 500);
    }
}

    public function submit_international_visitor_form(Request $request)
    {
        //
        // \Log::info($request->all()); // Log for debugging

        try {
        $data = json_decode($request->getContent(), true);

        $validated = $request->validate([
            'int_username' => 'nullable|string|max:255|unique:users,username',
            'int_password' => 'nullable|string',
            'int_confirm_password' => 'nullable|same:int_password',
            'int_firstname' => 'nullable|string|max:255',
            'int_lastname' => 'nullable|string|max:255',
            'int_father_firstname' => 'nullable|string|max:255',
            'int_father_lastname' => 'nullable|string|max:255',
            'int_gender' => 'nullable|string',
            'int_country' => 'nullable|string',
            'int_nationality' => 'nullable|string',
            'int_profession' => 'nullable|string',
            'int_address' => 'nullable|string',
            'int_phone' => 'nullable|string|max:15',
            'int_mobile' => 'nullable|string|max:15',
            'int_whatsapp' => 'nullable|string|max:15',
            'int_email' => 'nullable|email|unique:users,email',
            'int_facebook' => 'nullable|string|max:255',
            'int_linkedin' => 'nullable|string|max:255',
            'int_instagram' => 'nullable|string|max:255',
            'int_telegram' => 'nullable|string|max:255',
            'int_wechat' => 'nullable|string|max:255',
            'int_imo' => 'nullable|string|max:255',
            'int_privous_trips' => 'nullable|string',
            'int_passport_no' => 'nullable|string',
            'int_passport_issue' => 'nullable|date',
            'int_passort_expiry' => 'nullable|date',
            'int_passport_type' => 'nullable|string',
            'int_passport' => 'nullable|string',
            'personal_photo' => 'nullable|string',
            'int_product_interest' => 'nullable|string',
            'int_items' => 'string|nullable',
            'invited_way' => 'nullable|string',
            'describe_way' => 'nullable|string',
            'int_amount' => 'nullable|string',
            'business' => 'nullable|string',
            'int_comapny_name' => 'nullable|string',
            'int_company_address' => 'nullable|string',
            'int_business_mobile' => 'nullable|string|max:15',
            'int_business_email' => 'nullable|string',
            'int_business_phone' => 'nullable|string|max:15',
            'int_company_position' => 'nullable|string',
            'int_url' => 'nullable|string|url',
            'int_type_biz' => 'nullable|string',
            'int_business_items' => 'nullable|string',
            'int_import_items' => 'nullable|string',
            'int_import_countries' => 'nullable|string',
            'int_main_export_countries' => 'nullable|string',
            'int_annual_turnover' => 'nullable|string',
            'int_annual_export' => 'nullable|string',
            'int_annual_import_pakistan' => 'nullable|string',
            'int_company_tax_number' => 'nullable|string',
            'field_eac81b5' => 'nullable|string',
            'field_df21b13' => 'nullable|string',
        ]);

        // Step 1: Create User
        $user = User::create([
            'username' => $validated['int_username'],
            'name' => $validated['int_firstname'] . ' ' . $validated['int_lastname'],
            'password' => bcrypt($validated['int_password']),
            'email' => $validated['int_email'],
            'first_name' => $validated['int_firstname'],
            'last_name' => $validated['int_lastname'],
            'father_first_name' => $validated['int_father_firstname'],
            'father_last_name' => $validated['int_father_lastname'],
            'gender' => $validated['int_gender'],
            'country' => $validated['int_country'],
            'nationality' => $validated['int_nationality'],
            'profession' => $validated['int_profession'] != 'Other' ? $validated['int_profession'] : $validated['field_df21b13'],
            'address' => $validated['int_address'],
            'phone' => $validated['int_phone'],
            'mobile' => $validated['int_mobile'],
            'whatsapp' => $validated['int_whatsapp'],
            'fb_url' => $validated['int_facebook'],
            'linkedin' => $validated['int_linkedin'],
            'instagram' => $validated['int_instagram'],
            'telegram' => $validated['int_telegram'],
            'wechat' => $validated['int_wechat'],
            'imo' => $validated['int_imo'],
            'cnic_passport_no' => $validated['int_passport_no'],
            'passport_type' => $validated['int_passport_type'],
            'date_of_issue' => $validated['int_passport_issue'],
            'date_of_expiry' => $validated['int_passort_expiry'],
            'trip_to_pak' => $validated['int_privous_trips'],
            'invited_way' => $validated['invited_way'] != 'Others' ? $validated['invited_way'] : $validated['describe_way'],
            'declaration' => true,
            'status' => 'pending'
        ]);        

        $user->assignRole('international_visitor');

            // Step 2: Download Files from URLs and Save Them
            $saveFileFromUrl = function ($url, $folder, $userId) {
                if ($url) {
                    try {
                        $contents = file_get_contents($url); // Download file content
                        $extension = pathinfo($url, PATHINFO_EXTENSION);
                        $fileName = time() . '-' . $userId . '.' . $extension;
                        $filePath = $folder . '/' . $fileName;

                        // Save file to public storage
                        Storage::disk('public')->put($filePath, $contents);

                        return $filePath;
                    } catch (\Exception $e) {
                        Log::error("Failed to download file: {$url}, Error: " . $e->getMessage());
                        return null;
                    }
                }
                return null;
            };

            // Download and save each file
            $personalPhoto = $saveFileFromUrl($validated['personal_photo'], 'uploads/photos', $user->id);
            $passport = $saveFileFromUrl($validated['int_passport'], 'uploads/passports', $user->id);
            
            // Step 3: Save Attachments to Database
            Attachment::create([
                'user_id' => $user->id,
                'personal_photo' => $personalPhoto,
                'passport_cnic_file' => $passport,
            ]);


        // Step 3: Create Business Information if provided
        if ($validated['business'] === 'Yes') {
            Business::create([
                'user_id' => $user->id,
                'company_name' => $validated['int_comapny_name'],
                'address' => $validated['int_company_address'],
                'company_mobile' => $validated['int_business_mobile'],
                'company_email' => $validated['int_business_email'],
                'company_phone' => $validated['int_business_phone'],
                'position' => $validated['int_company_position'],
                'website_url' => $validated['int_url'],
                'product_interest' => json_encode($validated['int_product_interest']),
                'type_of_business' =>  json_encode($validated['int_type_biz']), // Convert to JSON
                'main_business_items' => $validated['int_business_items'],
                'main_import_items' => $validated['int_import_items'],
                'main_import_countries' => $validated['int_import_countries'],
                'main_export_countries' => $validated['int_main_export_countries'],
                'annual_turnover' => $validated['int_annual_turnover'],
                'annual_import_export' => $validated['int_annual_export'],
                'annual_import_from_pak' => $validated['int_annual_import_pakistan'],
                'amount' => $validated['int_amount'],
                'vat_tax_number' => $validated['int_company_tax_number'],
            ]);
        }
        return response()->json([
            'success' => true,
            'message' => 'International visitor registration completed successfully.',
            'user_id' => $user->id,
        ], 200);

    } catch (\Illuminate\Validation\ValidationException $e) {
        Log::error('Validation Error:', $e->errors());
        return response()->json([
            'success' => false,
            'message' => 'Validation failed.',
            'errors' => $e->errors(),
        ], 422);
    } catch (\Exception $e) {
        Log::error('Server Error:', ['message' => $e->getMessage()]);
        return response()->json([
            'success' => false,
            'message' => 'Something went wrong. Please try again later.',
            'error' => $e->getMessage(),
        ], 500);    }
}

    public function submit_buyer_form(Request $request)
    {
        try {
            // \Log::info('Request Data:', $request->all());
    
            // **Handle File Uploads** and Validation Rules
            $validated = $request->validate([
                'paid_username' => 'nullable|string|max:255',
                'paid_password' => 'nullable|string|max:255',
                'paid_confirm_password' => 'nullable|same:paid_password',
                'paid_firstname' => 'nullable|string|max:255',
                'paid_lastname' => 'nullable|string|max:255',
                'paid_father_firstname' => 'nullable|string|max:255',
                'paid_father_lastname' => 'nullable|string|max:255',
                'paid_gender' => 'nullable|string|max:255',

                'paid_country' => 'nullable|string|max:255',
                'paid_nationality' => 'nullable|string|max:255',
                'paid_address' => 'nullable|string|max:255',

                // 'paid_phone' => 'nullable|string',
                'paid_mobile' => 'nullable|string',
                'paid_whatsapp' => 'nullable|string',
                'paid_email' => 'nullable|email|max:255',
                'paid_facebook' => 'nullable|max:255',
                'paid_linkedin' => 'nullable|max:255',
                'paid_instagram' => 'nullable|string|max:255',
                'paid_telegram' => 'nullable|string|max:255',
                'paid_wechat' => 'nullable|string|max:255',
                'paid_imo' => 'nullable|string|max:255',
        
                // Passport Information
                'paid_previous_trips' => 'nullable|string|in:Yes,No',
                'paid_passport_no' => 'nullable|string|max:20',
                'paid_passport_issue' => 'nullable|date',
                'paid_passport_expiry' => 'nullable|date|after:paid_passport_issue',
                'paid_passport_type' => 'nullable|string',
                'paid_passport' => 'nullable',
        
                // Participant Information
                // 'paid_participant' => 'nullable',
                // 'paid_participant_firstname' => 'nullable|string|max:255',
                // 'paid_participant_lastname' => 'nullable|string|max:255',
                // 'paid_participant_father_firstname' => 'nullable|string|max:255',
                // 'paid_participant_father_lastname' => 'nullable|string|max:255',
                // 'paid_participant_gender' => 'nullable',
                // 'paid_participant_phone' => 'nullable|string|max:20',
                // 'paid_participant_mobile' => 'nullable|string|max:20',
                // 'paid_participant_whatsapp' => 'nullable|string|max:20',
                // 'paid_participant_email' => 'nullable|email|max:255',
                // 'paid_participant_facebook' => 'nullable|max:255',
                // 'paid_participant_linkedin' => 'nullable|max:255',
                // 'paid_participant_instagram' => 'nullable|string|max:255',
                // 'paid_participant_telegram' => 'nullable|string|max:255',
                // 'paid_participant_wechat' => 'nullable|string|max:255',
                // 'paid_participant_imo' => 'nullable|string|max:255',
                // 'paid_participant_passport_no' => 'nullable|string|max:20',
                // 'paid_participant_passport_issue' => 'nullable|date',
                // 'paid_participant_passport_expiry' => 'nullable|date|after:paid_participant_passport_issue',
                // 'paid_participant_passport_type' => 'nullable|string|in:Ordinary,Official',
                // 'paid_participant_passport' => 'nullable',
        
                // Business Information
                'paid_company_name' => 'nullable|string|max:255',
                'paid_company_address' => 'nullable|string|max:255',
                'paid_company_email' => 'nullable|email|max:255',
                'paid_position' => 'nullable|string|max:255',
                'paid_business_phone' => 'nullable|string|max:20',
                'paid_business_mobile' => 'nullable|string|max:20',
                'paid_url' => 'nullable|max:255',
                'paid_company_registered_number' => 'nullable|string|max:255',
                'paid_vat_number' => 'nullable|string|max:255',
                'paid_chamber_member_number' => 'nullable|string|max:20',
                'paid_business_type' => 'nullable|string|max:255',
                'paid_business_items' => 'nullable|string|max:255',
                'paid_import_items' => 'nullable|string|max:255',
                'paid_import_countries' => 'nullable|string|max:255',
                'paid_export_countries' => 'nullable|string|max:255',
                'paid_annual_turnover' => 'nullable|numeric|min:0',
                'paid_annaul_import' => 'nullable|numeric|min:0',
                'paid_annual_import_pakistan' => 'nullable|numeric|min:0',
                'paid_products' => 'nullable|string|max:255',
                'paid_products_2' => 'nullable|string|max:255',
                'paid_invited_by' => 'nullable|string|max:255',
                'paid_invited_by_other' => 'nullable|string|max:255',
                'paid_amount' => 'nullable|string|max:255',
                
        
                // Files and Attachments
                'paid_personal_photo' => 'nullable|url',
                'paid_company_catalog' => 'nullable|url',
                'bank_statment' => 'nullable|url',
                'paid_business_card' => 'nullable|url',
                'paid_company_certificate' => 'nullable|url',
                'chamber_certificate' => 'nullable|url',
                'field_a5c721c' => 'nullable|string',
                'field_eac81b5' => 'nullable|string',
            ]);

            // Step 1: Create User
            $user = User::create([
                'username' => $validated['paid_username'],
                'name' => $validated['paid_firstname'] . ' ' . $validated['paid_lastname'],
                'email' => $validated['paid_email'],
                'password' => bcrypt($validated['paid_password']),
                'first_name' => $validated['paid_firstname'],
                'last_name' => $validated['paid_lastname'],
                'father_first_name' => $validated['paid_father_firstname'],
                'father_last_name' => $validated['paid_father_lastname'],
                'country' => $validated['paid_country'],
                'nationality' => $validated['paid_nationality'],
                'address' => $validated['paid_address'],
                'gender' => $validated['paid_gender'],
                'mobile' => $validated['paid_mobile'],
                'phone' => $request->input('paid_phone'),
                'whatsapp' => $validated['paid_whatsapp'],
                'fb_url' => $validated['paid_facebook'],
                'linkedin' => $validated['paid_linkedin'],
                'telegram' => $validated['paid_telegram'],
                'instagram' => $validated['paid_instagram'],
                'wechat' => $validated['paid_wechat'],
                'imo' => $validated['paid_imo'],
                'trip_to_pak' => $validated['paid_previous_trips'],
                'cnic_passport_no' => $validated['paid_passport_no'],
                'passport_type' => $validated['paid_passport_type'],
                'date_of_issue' => $validated['paid_passport_issue'],
                'date_of_expiry' => $validated['paid_passport_expiry'],
                'invited_way' => $validated['paid_invited_by'] == 'Others' ? $validated['paid_invited_by_other'] : $validated['paid_invited_by'],
                'status' => 'pending',
                'declaration' => true,
            ]);        
            
            // assign role to user
            $user->assignRole('buyer');

            // Step 2: Download Files from URLs and Save Them
            $saveFileFromUrl = function ($url, $folder, $userId) {
                if ($url) {
                    try {
                        $contents = file_get_contents($url); // Download file content
                        $extension = pathinfo($url, PATHINFO_EXTENSION);
                        $fileName = time() . '-' . $userId . '.' . $extension;
                        $filePath = $folder . '/' . $fileName;

                        // Save file to public storage
                        Storage::disk('public')->put($filePath, $contents);

                        return $filePath;
                    } catch (\Exception $e) {
                        Log::error("Failed to download file: {$url}, Error: " . $e->getMessage());
                        return null;
                    }
                }
                return null;
            };

            // For Participants
            // $participantPassport = $saveFileFromUrl($request->input('paid_participant_passport'), 'uploads/participants/passports', $user->id);
            
            // if ($request->filled('paid_participant_firstname')) {
            //     UserParticipant::create([
            //         'user_id' => $user->id, // ID of the main user
            //         'firstname' => $request->input('paid_participant_firstname'),
            //         'lastname' => $request->input('paid_participant_lastname'),
            //         'father_firstname' => $request->input('paid_participant_father_firstname'),
            //         'father_lastname' => $request->input('paid_participant_father_lastname'),
            //         'gender' => $request->input('paid_participant_gender'),
            //         'phone' => $request->input('paid_participant_phone'),
            //         'mobile' => $request->input('paid_participant_mobile'),
            //         'whatsapp' => $request->input('paid_participant_whatsapp'),
            //         'email' => $request->input('paid_participant_email'),
            //         'facebook' => $request->input('paid_participant_facebook'),
            //         'linkedin' => $request->input('paid_participant_linkedin'),
            //         'instagram' => $request->input('paid_participant_instagram'),
            //         'telegram' => $request->input('paid_participant_telegram'),
            //         'wechat' => $request->input('paid_participant_wechat'),
            //         'imo' => $request->input('paid_participant_imo'),
            //         'passport_no' => $request->input('paid_participant_passport_no'),
            //         'passport_issue' => $request->input('paid_participant_passport_issue'),
            //         'passport_expiry' => $request->input('paid_participant_passport_expiry'),
            //         'passport_type' => $request->input('paid_participant_passport_type'),
            //         'previous_trips' => $request->input('paid_participant_previous_trips'),
            //         // 'passport_file' => $participantPassport,
            //     ]);        
            // }

            // Step 3: Insert Business Details
            Business::create([
                'user_id' => $user->id,
                'company_name' => $validated['paid_company_name'],
                'address' => $validated['paid_company_address'],
                'company_email' => $validated['paid_company_email'],
                'position' => $validated['paid_position'],
                'company_phone' => $validated['paid_business_phone'],
                'company_mobile' => $validated['paid_business_mobile'],
                'website_url' => $validated['paid_url'],
                'company_registered_number' => $validated['paid_company_registered_number'],
                'vat_tax_number' => $validated['paid_vat_number'],
                'chamber_association_member' => json_encode($validated['paid_chamber_member_number']),
                'nature_of_business' => $validated['paid_business_type'],
                'type_of_business' => json_encode($validated['paid_business_type']),
                'main_business_items' => $validated['paid_business_items'],
                'main_import_items' => $validated['paid_import_items'],
                // 'main_export_items' => $validated['paid_export_items'],
                'main_import_countries' => $validated['paid_import_countries'],
                'main_export_countries' => $validated['paid_export_countries'],
                'annual_turnover' => $validated['paid_annual_turnover'],
                'annual_import_export' => $validated['paid_annaul_import'],
                'annual_import_from_pak' => $validated['paid_annual_import_pakistan'],
                // 'national_sale' => $validated['paid_national_sale'],
                'product_interest' => json_encode($validated['paid_products']), // Ensure proper JSON encoding
                'amount' => $validated['paid_amount'],
                // 'ntn' => $validated['paid_ntn'],
                // 'gst' => $validated['paid_gst'],
                'chamber_association_no' => $validated['paid_chamber_member_number'] ? true : false,
            ]);
            
            // Download and save each file
            $personalPhoto = $saveFileFromUrl($request->input('paid_personal_photo'), 'uploads/photos', $user->id);
            $companyCatalog = $saveFileFromUrl($request->input('paid_company_catalog'), 'uploads/catalogs', $user->id);
            $bankStatement = $saveFileFromUrl($request->input('bank_statment'), 'uploads/statements', $user->id);
            $businessCard = $saveFileFromUrl($request->input('paid_business_card'), 'uploads/cards', $user->id);
            $companyCertificate = $saveFileFromUrl($request->input('paid_company_certificate'), 'uploads/certificates', $user->id);
            $chamberCertificate = $saveFileFromUrl($request->input('chamber_certificate'), 'uploads/certificates', $user->id);
            $passport = $saveFileFromUrl($request->input('paid_passport'), 'uploads/passports', $user->id);

            // // Step 3: Save Attachments to Database
            Attachment::create([
                'user_id' => $user->id,
                'personal_photo' => $personalPhoto,
                'company_catalogue' => $companyCatalog,
                'bank_statement' => $bankStatement,
                'business_card' => $businessCard,
                'company_certificate' => $companyCertificate,
                'chamber_association_certificate' => $chamberCertificate,
                'passport_cnic_file' => $passport,
            ]);

            Log::info("User {$user->id} and attachments saved successfully.");

            return response()->json([
                'success' => true,
                'message' => 'Form submitted and files saved successfully.',
                'user_id' => $user->id,
            ], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation Error:', $e->errors());
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            Log::error('Server Error:', ['message' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong. Please try again later.',
                'error' => $e->getMessage(),
            ], 500);
        }    
    }

    
    public function submit_exhibitor_form(Request $request)
    {

        try{
            
            // \Log::info($request->all()); // Log for debugging
            //
            $data = json_decode($request->getContent(), true);

            $validated = $request->validate([
                'field_25c2fed' => 'nullable',
                'username' => 'nullable|string|unique:users',
                'password' => 'nullable|string',
                'confirm_password' => 'nullable|same:password',
                'field_9bb0f5b' => 'nullable',
                'firstname' => 'nullable|string',
                'lastname' => 'nullable|string',
                'father_firstname' => 'nullable|string',
                'father_lastname' => 'nullable|string',
                'gender' => 'nullable',
                'country' => 'nullable|string',
                'city' => 'nullable|string',
                'profession' => 'nullable|string',
                'field_9cf3165' => 'nullable',
                'phone' => 'nullable|string',
                'mobile' => 'nullable|string',
                'whatsapp' => 'nullable|string',
                'email' => 'nullable',
                'facebook' => 'nullable|string',
                'linkedin' => 'nullable|string',
                'instagram' => 'nullable|string',
                'telegram' => 'nullable|string',
                'wechat' => 'nullable|string',
                'imo' => 'nullable|string',
                'cnic_no' => 'nullable|string',
                'cnic_file' => 'nullable|string',
                'cnic_issue' => 'nullable|date',
                'cnic_expiry' => 'nullable|date',
                'field_29aa5ef' => 'nullable',
                'company_name' => 'nullable|string',
                'company_address' => 'nullable|string',
                'company_phone' => 'nullable|string',
                'company_email' => 'nullable|email',
                'business_mobile' => 'nullable|string',
                'business_phone' => 'nullable|string',
                'position' => 'nullable|string',
                'url' => 'nullable',
                'chamber_number' => 'nullable|string',
                'business_nature' => 'nullable|string',
                'business_type' => 'nullable|string',
                'export_items' => 'nullable|string',
                'business_registered' => 'nullable',
                'ntn' => 'nullable|string',
                'gst' => 'nullable|string',
                'chamber_member_number' => 'nullable|string',
                // 'field_22800ae' => 'nullable',
                'export_countries' => 'nullable|string',
                'annual_turnover' => 'nullable|string',
                'annual_export' => 'nullable|string',
                'bank_statement' => 'nullable',
                'exhibition' => 'nullable|string',
                'exhibition_date' => 'nullable',
                'exhibition_type' => 'nullable|string',
                'exhibition_country' => 'nullable|string',
                'exhibition_name' => 'nullable|string',
                'invited_way' => 'nullable|string',
                'invited_by_other' => 'nullable|string',
                'field_89099fa' => 'nullable',
                'stall' => 'nullable|string',
                'stall_products' => 'nullable|string',
                'selectbiz' => 'nullable|string',
                'booth_type' => 'nullable|string',
                'booth_size' => 'nullable|string',
                'other_booth_size' => 'nullable|string',
                'personal_photo' => 'nullable|string',
                'company_registration_copy' => 'nullable|string',
                'company_logo' => 'nullable|string',
                'company_catalog' => 'nullable',
                'business_card' => 'nullable|string',
                'chamber_membership_certificate' => 'nullable|string',
                'pay_order' => 'nullable|string',
                'amount' => 'nullable|numeric',
                'pay_date' => 'nullable|date',
                'bank_name' => 'nullable|string',
                'pay_order_copy' => 'nullable|string',
                'recommendation' => 'nullable|string',
                // 'term_conditions' => 'nullable|string',
                'field_0863cce' => 'nullable',
                'field_eac81b5' => 'nullable',
                'field_13750aa' => 'nullable',    
                'import_countries' => 'nullable',    
                'other_turnover' => 'nullable|string',
                'invited_by_other' => 'nullable|string',
                'field_7fbc2d7' => 'nullable|string',  
                'field_6c3a5cd' => 'nullable|string',


             ]);   
             

        // Step 1: Create User
        $user = User::create([
            'username' => $validated['username'],
            'name' => $validated['firstname'] . ' ' . $validated['lastname'],
            'password' => bcrypt($validated['password']),
            'email' => $validated['email'],
            'first_name' => $validated['firstname'],
            'last_name' => $validated['lastname'],
            'father_first_name' => $validated['father_firstname'],
            'father_last_name' => $validated['father_lastname'],
            'gender' => $validated['gender'],
            'country' => $validated['country'],
            'city' => $validated['city'],
            'nationality' => $validated['country'],
            'profession' => $validated['profession'],
            'address' => $validated['city'],
            'phone' => $validated['phone'],
            'mobile' => $validated['mobile'],
            'whatsapp' => $validated['whatsapp'],
            'fb_url' => $validated['facebook'],
            'linkedin' => $validated['linkedin'],
            'instagram' => $validated['instagram'],
            'telegram' => $validated['telegram'],
            'wechat' => $validated['wechat'],
            'imo' => $validated['imo'],
            'cnic_passport_no' => $validated['cnic_no'],
            'passport_type' => null,
            'date_of_issue' => $validated['cnic_issue'],
            'date_of_expiry' => $validated['cnic_expiry'],
            'invited_way' => $validated['invited_way'] != 'Others' ? $validated['invited_way'] : $validated['invited_by_other'] ?? null,
            'declaration' => true,
            'status' => 'pending'        
        ]);        

        $user->assignRole('exhibitor');

            // Step 2: Download Files from URLs and Save Them
            $saveFileFromUrl = function ($url, $folder, $userId) {
                if ($url) {
                    try {
                        $contents = file_get_contents($url); // Download file content
                        $extension = pathinfo($url, PATHINFO_EXTENSION);
                        $fileName = time() . '-' . $userId . '.' . $extension;
                        $filePath = $folder . '/' . $fileName;

                        // Save file to public storage
                        Storage::disk('public')->put($filePath, $contents);

                        return $filePath;
                    } catch (\Exception $e) {
                        Log::error("Failed to download file: {$url}, Error: " . $e->getMessage());
                        return null;
                    }
                }
                return null;
            };

           // Download and save each file
            $personalPhoto = $saveFileFromUrl($validated['personal_photo'], 'uploads/photos', $user->id);
            $companyRegistration = $saveFileFromUrl($validated['company_registration_copy'], 'uploads/registrations', $user->id);
            $companyLogo = $saveFileFromUrl($validated['company_logo'], 'uploads/logos', $user->id);
            $companyCatalog = $saveFileFromUrl($validated['company_catalog'], 'uploads/catalogs', $user->id);
            $businessCard = $saveFileFromUrl($validated['business_card'], 'uploads/cards', $user->id);
            $chamberCertificate = $saveFileFromUrl($validated['chamber_membership_certificate'], 'uploads/certificates', $user->id);
            $cnicFile = $saveFileFromUrl($validated['cnic_file'], 'uploads/passports', $user->id);
            $bankStatement = $saveFileFromUrl($validated['bank_statement'], 'uploads/bank_statements', $user->id);
            $payOrderCopy = $saveFileFromUrl($validated['pay_order_copy'], 'uploads/pay_orders', $user->id);
            

            // Save Attachments to Database
            Attachment::create([
                'user_id' => $user->id,
                'personal_photo' => $personalPhoto,
                'company_registration_number' => $companyRegistration,
                'company_logo' => $companyLogo,
                'company_catalogue' => $companyCatalog,
                'business_card' => $businessCard,
                'chamber_association_certificate' => $chamberCertificate,
                'passport_cnic_file' => $cnicFile,
                'bank_statement' => $bankStatement,
                'pay_order_image' => $payOrderCopy,
                'pay_order_draft_no' => $validated['pay_order'] ?? null,
                'pay_order_amount' => $validated['amount'] ?? null,
                'pay_order_date' => $validated['pay_date'] ?? null,
                'pay_order_bank_name' => $validated['bank_name'] ?? null,
                'recommendation' => $validated['recommendation'],
                ]);

            // Step 4: Save Business Details
            Business::create([
                'user_id' => $user->id,
                'field_29aa5ef' => $validated['field_29aa5ef'] ?? null,
                'company_name' => $validated['company_name'] ?? null,
                'address' => $validated['company_address'] ?? null,
                'company_phone' => $validated['company_phone'] ?? null,
                'company_mobile' => $validated['business_mobile'] ?? null,
                'company_email' => $validated['company_email'] ?? null,
                'website_url' => $validated['url'] ?? null,
                'position' => $validated['position'] ?? null,
                'company_registered_number' => $validated['business_registered'] != 'Others' ? $validated['business_registered'] : ($validated['field_7fbc2d7'] ?? null),
                'chamber_association_member' => $validated['chamber_number'] ? json_encode($validated['chamber_number']) : null,
                'nature_of_business' => $validated['business_nature'] ?? null,
                'type_of_business' => json_encode(array_merge($validated['business_type'] ?? [], $validated['business_type_other'] == 'Others' ? [$validated['business_type_other_value']] : [])),
                'main_export_items' => $validated['export_items'] ?? null,
                'main_import_countries' => $validated['import_countries'] ?? null,
                'main_export_countries' => $validated['export_countries'] ?? null,
                'annual_turnover' => $validated['annual_turnover'] != 'Others' ? $validated['annual_turnover'] : ($validated['other_turnover'] ?? null),
                'annual_import_export' => $validated['annual_export'] ?? null,
                'ntn' => $validated['ntn'] ?? null,
                'gst' => $validated['gst'] ?? null,
                'chamber_association_no' => $validated['chamber_member_number'] ?? null,
            ]);
            // Save Exhibition Details
            Exhibition::create([
                'user_id' => $user->id,
                'exhibition_name' => $validated['exhibition_name'] ?? null,
                'exhibition_date' => $validated['exhibition_date'] ?? null,
                'type' => $validated['exhibition_type'] ?? null,
                'country' => $validated['exhibition_country'] ?? null,
            ]);
            // Step 5: Save Stall Details
            Stall::create([
                'user_id' => $user->id,
                'stall' => $validated['stall'],
                'stall_products' => json_encode($validated['stall_products']),
                'selectbiz' => json_encode($validated['selectbiz']),
                'booth_type' => $validated['booth_type'] ?? null,
                'booth_size' => $validated['booth_size'] ?? null,
                'other_booth_size' => $validated['other_booth_size'] ?? null,
            ]);


            Log::info("User {$user->id} and attachments saved successfully.");

            return response()->json([
                'success' => true,
                'message' => 'Form submitted and files saved successfully.',
                'user_id' => $user->id,
            ], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation Error:', $e->errors());
            return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            Log::error('Server Error:', ['message' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong. Please try again later.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}