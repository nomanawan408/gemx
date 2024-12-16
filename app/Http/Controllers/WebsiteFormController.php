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
        \Log::info($request->all()); // Log for debugging

        $data = json_decode($request->getContent(), true);

        // Validate incoming data
        // Step 1: Validate incoming data
        $validated = $request->validate([
            'username' => 'required|string|max:255',
            'password' => 'required|string|min:8',
            'confirm_password' => 'required|same:password',
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'father_firstname' => 'nullable|string|max:255',
            'father_lastname' => 'nullable|string|max:255',
            'gender' => 'required|in:Male,Female,Other',
            
            'profession' => 'nullable|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable|string|max:20',
            'mobile' => 'nullable|string|max:20',
            'whatsapp' => 'nullable|string|max:20',
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
            'company_name' => 'nullable|string|max:255',
            'company_address' => 'nullable|string',
            'company_phone' => 'nullable|string|max:20',
            'business_mobile' => 'nullable|string|max:20',
            'position' => 'nullable|string|max:255',
            'export_items' => 'nullable|string',
            'Import_countries' => 'nullable|string',
            'export_country' => 'nullable|string',
            'annual_turnover' => 'nullable|numeric',
            'annual_export' => 'nullable|numeric',
            'url' => 'nullable|url',
        ]);

        // Step 2: Create User
        $user = User::create([
            'username' =>  $data['username'],
            'name' => $validated['firstname'] . ' ' . $validated['lastname'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'first_name' => $validated['firstname'],
            'last_name' => $validated['lastname'],
            'father_first_name' => $validated['father_firstname'],
            'father_last_name' => $validated['father_lastname'],
            'gender' => $validated['gender'],
            // 'country' => $data['country'],
            // 'city' => $data['city'],
            'address' => $data['address'], // Added address to users table
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
            'personal_photo' => $validated['personal_photo'],
            'declaration' => true,
        ]);

        $user->assignRole('visitor');

        // Step 3: Create Business Record if Business = 'Yes'
        try {
            if ($request->input('business') === 'Yes') {
                Business::create([
                    'user_id' => $user->id,
                    'company_name' => $validated['company_name'],
                    'address' => $validated['company_address'],
                    'company_phone' => $validated['company_phone'],
                    'company_mobile' => $validated['business_mobile'],
                    'position' => $validated['position'],
                    'website_url' => $validated['url'],
                    'main_export_items' => $validated['export_items'],
                    'main_import_countries' => $validated['Import_countries'],
                    'main_export_countries' => $validated['export_country'],
                    'annual_turnover' => $validated['annual_turnover'],
                    'national_sale' => $validated['national_sale'],
                    'annual_import_export' => $validated['annual_export'],
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create business record: ' . $e->getMessage()
            ], 500);
        }
        // Step 4: Save Attachments
        Attachment::create([
            'user_id' => $user->id,
            'passport_cnic_file' => $validated['cnic_picture'],
            'company_logo' => $validated['personal_photo'],
        ]);

        // Step 5: Return success response
        return response()->json([
            'success' => true,
            'message' => 'Form data successfully stored!',
            'user_id' => $user->id
        ], 200);
    }
    
    public function submit_international_visitor_form(Request $request)
    {
        //
        \Log::info($request->all()); // Log for debugging

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
            'personal_photo' => 'nullable|url',
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
            'personal_photo' => 'nullable|url',
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
            \Log::info($request->all()); // Log for debugging
            //
            $data = json_decode($request->getContent(), true);

            $validated = $request->validate([
                // User Information
                'paid_username' => 'required|string|max:255',
                'paid_password' => 'required|string|min:8',
                'paid_confirm_password' => 'required|same:paid_password',
                'paid_firstname' => 'required|string|max:255',
                'paid_lastname' => 'required|string|max:255',
                'paid_father_firstname' => 'nullable|string|max:255',
                'paid_father_lastname' => 'nullable|string|max:255',
                'paid_gender' => 'required|in:Male,Female,Other',
                'paid_phone' => 'nullable|string|max:20',
                'paid_mobile' => 'nullable|string|max:20',
                'paid_whatsapp' => 'nullable|string|max:20',
                'paid_email' => 'required|email|max:255',
                'paid_facebook' => 'nullable|url|max:255',
                'paid_linkedin' => 'nullable|url|max:255',
                'paid_instagram' => 'nullable|string|max:255',
                'paid_telegram' => 'nullable|string|max:255',
                'paid_wechat' => 'nullable|string|max:255',
                'paid_imo' => 'nullable|string|max:255',
        
                // Passport Information
                'paid_previous_trips' => 'nullable|string|in:Yes,No',
                'paid_passport_no' => 'nullable|string|max:20',
                'paid_passport_issue' => 'nullable|date',
                'paid_passport_expiry' => 'nullable|date|after:paid_passport_issue',
                'paid_passport_type' => 'nullable|string|in:Ordinary,Official',
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
                'paid_url' => 'nullable|url|max:255',
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
                'linkedin' => $validated['paid_linkedin'],
                'telegram' => $validated['paid_telegram'],
                'instagram' => $validated['paid_instagram'],
                'wechat' => $validated['paid_wechat'],
                'imo' => $validated['paid_imo'],
                'cnic_passport_no' => $validated['paid_passport_no'],
                'type_of_passport' => $validated['paid_passport_type'],
                'date_of_issue' => $validated['paid_passport_issue'],
                'date_of_expiry' => $validated['paid_passport_expiry'],
                'status' => 'pending',
                'declaration' => true,
            ]);        
            
            // assign role to user
            $user->assignRole('buyer');


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
                    'passport_file' => $request->hasFile('paid_participant_passport') ? $request->file('paid_participant_passport')->store("participant_attachment_{$user->id}", 'public') : null,
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
                'product_interest' => $validated['paid_products'],
                // 'ntn' => $validated['paid_ntn'],
                // 'gst' => $validated['paid_gst'],
                'chamber_association_no' => $validated['paid_chamber_member_number'] ? true : false,
            ]);


            
                // Function to save files and generate file name
            $saveFile = function ($file, $folder, $identifier) {
                if ($file) {
                    $fileName = time() . '-' . $identifier . '.' . $file->extension();
                    $file->move(public_path($folder), $fileName);
                    return $folder . '/' . $fileName; // Return relative file path
                }
                return null;
            };

            // Save files and get file paths
            $passportFile = $saveFile($request->file('passport_cnic_file'), 'attachments/passports', $request->user_id);
            $personalPhoto = $saveFile($request->file('personal_photo'), 'attachments/photos', $request->user_id);
            $companyCatalogue = $saveFile($request->file('company_catalogue'), 'attachments/catalogues', $request->user_id);
            $bankStatement = $saveFile($request->file('bank_statement'), 'attachments/statements', $request->user_id);
            $businessCard = $saveFile($request->file('business_card'), 'attachments/cards', $request->user_id);
            $companyCertificate = $saveFile($request->file('company_certificate'), 'attachments/certificates', $request->user_id);
            $chamberCertificate = $saveFile($request->file('chamber_certificate'), 'attachments/certificates', $request->user_id);

            // Insert into database
            $attachment = Attachment::create([
                'user_id' =>  $user->id,
                'passport_cnic_file' => $passportFile,
                'personal_photo' => $personalPhoto,
                'company_catalogue' => $companyCatalogue,
                'bank_statement' => $bankStatement,
                'business_card' => $businessCard,
                'company_certificate' => $companyCertificate,
                'chamber_association_certificate' => $chamberCertificate,
            ]);

            Log::info('Data Saved Successfully:', ['user_id' => $user->id]);
                
            return response()->json([
                'success' => true,
                'message' => 'Form data submitted successfully!',
                'user_id' => $user->id
            ], 200);
        }catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation Error:', $e->errors());
            return response()->json([
                'success' => false,
                'message' => 'Validation error.',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error('Server Error:', ['message' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong. Please try again later.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
