<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use App\Models\Business;
use App\Models\Attachment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;
use App\Models\UserParticipant;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;



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
        
        \Log::info('Request Data:', $request->all());

        // Remove json_decode since data is already available in $request
        $validated = $request->validate([
            'username' => 'required|string|max:255',
            'password' => 'required|string|min:8',
            'confirm_password' => 'required|same:password',
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'father_firstname' => 'nullable|string|max:255',
            'father_lastname' => 'nullable|string|max:255',
            'gender' => 'required|string|max:255',
            'address' => 'required|string',
            'profession' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'mobile' => 'nullable|string|max:20',
            'whatsapp' => 'nullable|string|max:20',
            'email' => 'required|email|unique:users,email',
            'facebook' => 'nullable|string|max:255',
            'linkedin' => 'nullable|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'telegram' => 'nullable|string|max:255',
            'wechat' => 'nullable|string|max:255',
            'imo' => 'nullable|string|max:255',
            'cnic_no' => 'nullable|string|max:20',
            'cnic_issue' => 'nullable|date',
            'cnic_expiry' => 'nullable|date',
            'cnic_picture' => 'nullable|url',
            'personal_photo' => 'nullable|url',
            'invited_way' => 'nullable|string',
            'shoowothers' => 'nullable|string',
            'business' => 'nullable|in:Yes,No',
            'company_name' => 'nullable|string|max:255',
            'company_address' => 'nullable|string',
            'company_phone' => 'nullable|string|max:20',
            'business_mobile' => 'nullable|string|max:20',
            'business_phone' => 'nullable|string|max:20',
            'position' => 'nullable|string|max:255',
            'url' => 'nullable',
            'export_items' => 'nullable|string',
            'import_countries' => 'nullable|string',
            'export_country' => 'nullable|string',
            'annual_turnover' => 'nullable|string',
            'national_sale' => 'nullable|numeric',
            'annual_export' => 'nullable|numeric',        
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
            'profession' => $validated['profession'],
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
            'invited_way' => $validated['invited_way'],
            'declaration' => true,
        ]);

        $user->assignRole('visitor');

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
            $passport = $saveFileFromUrl($validated['cnic_picture'], 'uploads/passports', $user->id);
            
            // Step 3: Save Attachments to Database
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
                    'business_phone' => $validated['business_phone'],
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
        \Log::info($request->all()); // Log for debugging

        try {
        $data = json_decode($request->getContent(), true);

        $validated = $request->validate([
            'int_username' => 'required|string|max:255|unique:users,username',
            'int_password' => 'required|string|min:6',
            'int_confirm_password' => 'required|same:int_password',
            'int_firstname' => 'required|string|max:255',
            'int_lastname' => 'required|string|max:255',
            'int_father_firstname' => 'nullable|string|max:255',
            'int_father_lastname' => 'nullable|string|max:255',
            'int_gender' => 'required|string',
            'int_country' => 'required|string',
            'int_nationality' => 'required|string',
            'int_profession' => 'required|string',
            'int_address' => 'required|string',
            'int_phone' => 'nullable|string|max:15',
            'int_mobile' => 'nullable|string|max:15',
            'int_whatsapp' => 'nullable|string|max:15',
            'int_email' => 'required|email|unique:users,email',
            'int_facebook' => 'nullable|string|max:255',
            'int_linkedin' => 'nullable|string|max:255',
            'int_instagram' => 'nullable|string|max:255',
            'int_telegram' => 'nullable|string|max:255',
            'int_wechat' => 'nullable|string|max:255',
            'int_imo' => 'nullable|string|max:255',
            'int_privous_trips' => 'required|string',
            'int_passport_no' => 'required|string',
            'int_passport_issue' => 'required|date',
            'int_passort_expiry' => 'required|date',
            'int_passport_type' => 'required|string',
            'int_passport' => 'required|string',
            'personal_photo' => 'required|string',
            'int_product_interest' => 'required|string',
            'int_items' => 'string|nullable',
            'invited_way' => 'nullable|string',
            'describe_way' => 'nullable|string',
            'int_amount' => 'nullable|string',
            'business' => 'nullable|string',
            'int_comapny_name' => 'nullable|string',
            'int_company_address' => 'nullable|string',
            'int_business_mobile' => 'nullable|string|max:15',
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
            'profession' => $validated['int_profession'],
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
            'invited_way' => $validated['invited_way'],
            // 'describe_way' => $validated['describe_way'],
            'declaration' => $validated['field_eac81b5'],
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
                'company_phone' => $validated['int_business_phone'],
                'position' => $validated['int_company_position'],
                'website_url' => $validated['int_url'],
                'type_of_business' => $validated['int_type_biz'],
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


    public function submit_exhibitor_form(Request $request)
    {
        \Log::info($request->all()); // Log for debugging
        //
        $data = json_decode($request->getContent(), true);

        $validated = Validator::make($data, [
            'username' => 'required|string|max:255|unique:users,username',
            'password' => 'required|string|min:6|confirmed',
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'father_firstname' => 'nullable|string|max:255',
            'father_lastname' => 'nullable|string|max:255',
            'gender' => 'required|in:Male,Female,Other',
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable|string|max:15',
            'mobile' => 'nullable|string|max:15',
            'whatsapp' => 'nullable|string|max:15',
            'linkedin' => 'nullable|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'telegram' => 'nullable|string|max:255',
            'wechat' => 'nullable|string|max:255',
            'imo' => 'nullable|string|max:255',
            'cnic_no' => 'nullable|string|max:20',
            'cnic_issue' => 'nullable|date',
            'cnic_expiry' => 'nullable|date',
            'personal_photo' => 'nullable',
        ])->validate();

        // Step 1: Create User
        $user = User::create([
            'username' => $data['username'],
            'name' => $data['firstname'] . ' ' . $data['lastname'],
            'email' => $validated['email'],
            'password' => bcrypt($data['password'] ?? str_random(10)),
            'first_name' => $validated['firstname'],
            'last_name' => $validated['lastname'],
            'father_first_name' => $validated['father_firstname'],
            'father_last_name' => $validated['father_lastname'],
            'gender' => $validated['gender'],
            'mobile' => $validated['mobile'],
            'phone' => $validated['phone'],
            'whatsapp' => $validated['whatsapp'],
            'linkedin' => $validated['linkedin'],
            'telegram' => $validated['telegram'],
            'instagram' => $validated['instagram'],
            'wechat' => $validated['wechat'],
            'imo' => $validated['imo'],
            'cnic_passport_no' => $validated['cnic_no'],
            'personal_photo' => $validated['personal_photo'],   
            'date_of_issue' => $validated['cnic_issue'],
            'date_of_expiry' => $validated['cnic_expiry'],
            'declaration' => true,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Form data submitted successfully!',
            'user_id' => $user->id
        ], 200);
    }

    public function submit_buyer_form(Request $request)
    {
        try {
            \Log::info('Request Data:', $request->all());
    
            // **Handle File Uploads** and Validation Rules
            $validated = $request->validate([
                'paid_username' => 'required|string|max:255',
                'paid_password' => 'required|string|min:8',
                'paid_confirm_password' => 'required|same:paid_password',
                'paid_firstname' => 'required|string|max:255',
                'paid_lastname' => 'required|string|max:255',
                'paid_father_firstname' => 'nullable|string|max:255',
                'paid_father_lastname' => 'nullable|string|max:255',
                'paid_gender' => 'required|string|max:255',
                'paid_phone' => 'nullable|string|max:20',
                'paid_mobile' => 'nullable|string|max:20',
                'paid_whatsapp' => 'nullable|string|max:20',
                'paid_email' => 'required|email|max:255',
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
                'paid_passport' => 'nullable|url',
        
                // Participant Information
                'paid_participant' => 'nullable|in:Yes,No',
                'paid_participant_firstname' => 'nullable|string|max:255',
                'paid_participant_lastname' => 'nullable|string|max:255',
                'paid_participant_father_firstname' => 'nullable|string|max:255',
                'paid_participant_father_lastname' => 'nullable|string|max:255',
                'paid_participant_gender' => 'nullable|in:Male,Female,Other',
                'paid_participant_phone' => 'nullable|string|max:20',
                'paid_participant_mobile' => 'nullable|string|max:20',
                'paid_participant_whatsapp' => 'nullable|string|max:20',
                'paid_participant_email' => 'nullable|email|max:255',
                'paid_participant_facebook' => 'nullable|url|max:255',
                'paid_participant_linkedin' => 'nullable|url|max:255',
                'paid_participant_instagram' => 'nullable|string|max:255',
                'paid_participant_telegram' => 'nullable|string|max:255',
                'paid_participant_wechat' => 'nullable|string|max:255',
                'paid_participant_imo' => 'nullable|string|max:255',
                'paid_participant_passport_no' => 'nullable|string|max:20',
                'paid_participant_passport_issue' => 'nullable|date',
                'paid_participant_passport_expiry' => 'nullable|date|after:paid_participant_passport_issue',
                'paid_participant_passport_type' => 'nullable|string|in:Ordinary,Official',
                'paid_participant_passport' => 'nullable|url',
        
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
                'gender' => $validated['paid_gender'],
                'mobile' => $validated['paid_mobile'],
                'phone' => $validated['paid_phone'],
                'whatsapp' => $validated['paid_whatsapp'],
                'fb_url' => $validated['paid_facebook'],
                'linkedin' => $validated['paid_linkedin'],
                'telegram' => $validated['paid_telegram'],
                'instagram' => $validated['paid_instagram'],
                'wechat' => $validated['paid_wechat'],
                'imo' => $validated['paid_imo'],
                'cnic_passport_no' => $validated['paid_passport_no'],
                'passport_type' => $validated['paid_passport_type'],
                'date_of_issue' => $validated['paid_passport_issue'],
                'date_of_expiry' => $validated['paid_passport_expiry'],
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
            $participantPassport = $saveFileFromUrl($request->input('paid_participant_passport'), 'uploads/participants/passports', $user->id);
            
            if ($request->filled('paid_participant_firstname')) {
                UserParticipant::create([
                    'user_id' => $user->id, // ID of the main user
                    'firstname' => $request->input('paid_participant_firstname'),
                    'lastname' => $request->input('paid_participant_lastname'),
                    'father_firstname' => $request->input('paid_participant_father_firstname'),
                    'father_lastname' => $request->input('paid_participant_father_lastname'),
                    'gender' => $request->input('paid_participant_gender'),
                    'phone' => $request->input('paid_participant_phone'),
                    'mobile' => $request->input('paid_participant_mobile'),
                    'whatsapp' => $request->input('paid_participant_whatsapp'),
                    'email' => $request->input('paid_participant_email'),
                    'facebook' => $request->input('paid_participant_facebook'),
                    'linkedin' => $request->input('paid_participant_linkedin'),
                    'instagram' => $request->input('paid_participant_instagram'),
                    'telegram' => $request->input('paid_participant_telegram'),
                    'wechat' => $request->input('paid_participant_wechat'),
                    'imo' => $request->input('paid_participant_imo'),
                    'passport_no' => $request->input('paid_participant_passport_no'),
                    'passport_issue' => $request->input('paid_participant_passport_issue'),
                    'passport_expiry' => $request->input('paid_participant_passport_expiry'),
                    'passport_type' => $request->input('paid_participant_passport_type'),
                    'previous_trips' => $request->input('paid_participant_previous_trips'),
                    'passport_file' => $participantPassport,
                ]);        
            }

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

            // Step 3: Save Attachments to Database
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
        }    }
}


