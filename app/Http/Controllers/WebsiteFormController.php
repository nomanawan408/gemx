<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Log;


class WebsiteFormController extends Controller
{
    //

    public function store(Request $request)
    {
        \Log::info($request->all()); // Log for debugging

        $data = json_decode($request->getContent(), true);

        // Validate incoming data
        $validated = validator($data, [
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
            'company_name' => 'nullable|string|max:255',
            'company_address' => 'nullable|string',
            'company_phone' => 'nullable|string|max:15',
            'business_mobile' => 'nullable|string|max:15',
            'position' => 'nullable|string|max:255',
            'annual_turnover' => 'nullable|numeric',
            'annual_export' => 'nullable|numeric',
            'export_items' => 'nullable|string',
            'export_country' => 'nullable|string',
            'Import_countries' => 'nullable|string',
            'cnic_picture' => 'nullable|url',
            'personal_photo' => 'nullable|url',
        ])->validate();

        // Step 1: Create User
        $user = User::create([
            'name' => $data['username'] ?? $data['firstname'] . ' ' . $data['lastname'],
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
            'date_of_issue' => $validated['cnic_issue'],
            'date_of_expiry' => $validated['cnic_expiry'],
            'declaration' => true,
        ]);

        // Step 2: Create Business Entry
        if (isset($data['business']) && $data['business'] === 'Yes') {
            Business::create([
                'user_id' => $user->id,
                'company_name' => $validated['company_name'],
                'address' => $validated['company_address'],
                'company_phone' => $validated['company_phone'],
                'company_mobile' => $validated['business_mobile'],
                'position' => $validated['position'],
                'main_export_items' => $validated['export_items'],
                'main_export_countries' => $validated['export_country'],
                'main_import_countries' => $validated['Import_countries'],
                'annual_turnover' => $validated['annual_turnover'],
                'annual_import_export' => $validated['annual_export'],
            ]);
        }

        // Step 3: Save Attachments
        Attachment::create([
            'user_id' => $user->id,
            'passport_cnic_file' => $validated['cnic_picture'],
            'company_logo' => $validated['field_c3dd1a6'],
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Form data submitted successfully!',
            'user_id' => $user->id
        ], 200);
    }

// public function submitBuyerForm(Request $request){
       
//     $validated = $request->validate([
//             'form_fields.paid_firstname' => 'nullable|string',
//             'form_fields.paid_lastname' => 'nullable|string',
//             'form_fields.paid_father_firstname' => 'nullable|string',
//             'form_fields.paid_father_lastname' => 'nullable|string',
//             'form_fields.paid_gender' => 'nullable|string',
//             'form_fields.paid_phone' => 'nullable|string',
//             'form_fields.paid_mobile' => 'nullable|string',
//             'form_fields.paid_whatsapp' => 'nullable|string',
//             'form_fields.paid_email' => 'nullable|email',
//             'form_fields.paid_facebook' => 'nullable|string',
//             'form_fields.paid_linkedin' => 'nullable|string',
//             'form_fields.paid_instagram' => 'nullable|string',
//             'form_fields.paid_telegram' => 'nullable|string',
//             'form_fields.paid_wechat' => 'nullable|string',
//             'form_fields.paid_imo' => 'nullable|string',
//             'form_fields.paid_passport_no' => 'nullable|string',
//             'form_fields.paid_passport_type' => 'nullable|string',
//             'form_fields.paid_passport_issue' => 'nullable|date',
//             'form_fields.paid_passport_expiry' => 'nullable|date',
//         ]);
    
//         // Store the user data in the `users` table
//         $user = new User();
//         $user->name = $validated['form_fields']['paid_firstname'] . ' ' . $validated['form_fields']['paid_lastname'];
//         $user->email = $validated['form_fields']['paid_email'];
//         $user->first_name = $validated['form_fields']['paid_firstname'];
//         $user->last_name = $validated['form_fields']['paid_lastname'];
//         $user->father_first_name = $validated['form_fields']['paid_father_firstname'] ?? null;
//         $user->father_last_name = $validated['form_fields']['paid_father_lastname'] ?? null;
//         $user->gender = $validated['form_fields']['paid_gender'] ?? null;
//         $user->phone = $validated['form_fields']['paid_phone'] ?? null;
//         $user->mobile = $validated['form_fields']['paid_mobile'] ?? null;
//         $user->whatsapp = $validated['form_fields']['paid_whatsapp'] ?? null;
//         $user->fb_url = $validated['form_fields']['paid_facebook'] ?? null;
//         $user->linkedin = $validated['form_fields']['paid_linkedin'] ?? null;
//         $user->instagram = $validated['form_fields']['paid_instagram'] ?? null;
//         $user->telegram = $validated['form_fields']['paid_telegram'] ?? null;
//         $user->wechat = $validated['form_fields']['paid_wechat'] ?? null;
//         $user->imo = $validated['form_fields']['paid_imo'] ?? null;
//         $user->cnic_passport_no = $validated['form_fields']['paid_passport_no'] ?? null;
//         $user->type_of_passport = $validated['form_fields']['paid_passport_type'] ?? null;
//         $user->date_of_issue = $validated['form_fields']['paid_passport_issue'] ?? null;
//         $user->date_of_expiry = $validated['form_fields']['paid_passport_expiry'] ?? null;
    
//         // Save the user record
//         $user->save();
    
//         return response()->json(['message' => 'User data saved successfully!'], 200);

//     }

    
}
