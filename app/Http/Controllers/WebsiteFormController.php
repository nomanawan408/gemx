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
            'country' => $data['country'],
            'city' => $data['city'],
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
        if ($request->input('business') === 'Yes') {
            Business::create([
                'user_id' => $user->id,
                'company_name' => $validated['company_name'],
                'address' => $validated['company_address'],
                'company_phone' => $validated['company_phone'],
                'company_mobile' => $validated['business_mobile'],
                'position' => $validated['position'],
                'main_export_items' => $validated['export_items'],
                'main_import_countries' => $validated['Import_countries'],
                'main_export_countries' => $validated['export_country'],
                'annual_turnover' => $validated['annual_turnover'],
                'annual_import_export' => $validated['annual_export'],
            ]);
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

}
