<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebsiteFormController extends Controller
{
    //

public function submitBuyerForm(Request $request){
       
    $validated = $request->validate([
            'form_fields.paid_firstname' => 'nullable|string',
            'form_fields.paid_lastname' => 'nullable|string',
            'form_fields.paid_father_firstname' => 'nullable|string',
            'form_fields.paid_father_lastname' => 'nullable|string',
            'form_fields.paid_gender' => 'nullable|string',
            'form_fields.paid_phone' => 'nullable|string',
            'form_fields.paid_mobile' => 'nullable|string',
            'form_fields.paid_whatsapp' => 'nullable|string',
            'form_fields.paid_email' => 'nullable|email',
            'form_fields.paid_facebook' => 'nullable|string',
            'form_fields.paid_linkedin' => 'nullable|string',
            'form_fields.paid_instagram' => 'nullable|string',
            'form_fields.paid_telegram' => 'nullable|string',
            'form_fields.paid_wechat' => 'nullable|string',
            'form_fields.paid_imo' => 'nullable|string',
            'form_fields.paid_passport_no' => 'nullable|string',
            'form_fields.paid_passport_type' => 'nullable|string',
            'form_fields.paid_passport_issue' => 'nullable|date',
            'form_fields.paid_passport_expiry' => 'nullable|date',
        ]);
    
        // Store the user data in the `users` table
        $user = new User();
        $user->name = $validated['form_fields']['paid_firstname'] . ' ' . $validated['form_fields']['paid_lastname'];
        $user->email = $validated['form_fields']['paid_email'];
        $user->first_name = $validated['form_fields']['paid_firstname'];
        $user->last_name = $validated['form_fields']['paid_lastname'];
        $user->father_first_name = $validated['form_fields']['paid_father_firstname'] ?? null;
        $user->father_last_name = $validated['form_fields']['paid_father_lastname'] ?? null;
        $user->gender = $validated['form_fields']['paid_gender'] ?? null;
        $user->phone = $validated['form_fields']['paid_phone'] ?? null;
        $user->mobile = $validated['form_fields']['paid_mobile'] ?? null;
        $user->whatsapp = $validated['form_fields']['paid_whatsapp'] ?? null;
        $user->fb_url = $validated['form_fields']['paid_facebook'] ?? null;
        $user->linkedin = $validated['form_fields']['paid_linkedin'] ?? null;
        $user->instagram = $validated['form_fields']['paid_instagram'] ?? null;
        $user->telegram = $validated['form_fields']['paid_telegram'] ?? null;
        $user->wechat = $validated['form_fields']['paid_wechat'] ?? null;
        $user->imo = $validated['form_fields']['paid_imo'] ?? null;
        $user->cnic_passport_no = $validated['form_fields']['paid_passport_no'] ?? null;
        $user->type_of_passport = $validated['form_fields']['paid_passport_type'] ?? null;
        $user->date_of_issue = $validated['form_fields']['paid_passport_issue'] ?? null;
        $user->date_of_expiry = $validated['form_fields']['paid_passport_expiry'] ?? null;
    
        // Save the user record
        $user->save();
    
        return response()->json(['message' => 'User data saved successfully!'], 200);

    }

    
}
