<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check if the 'superadmin' role exists
        $role = Role::firstOrCreate(['name' => 'superadmin']);
        $hospitalityRole = Role::firstOrCreate(['name' => 'hospitality']);
        $transportRole = Role::firstOrCreate(['name' => 'transport']);


        // Create the Super Admin user
        $user = User::firstOrCreate(
            ['email' => 'superadmin@app.com'], // Update this email as needed
            [
            'name' => 'Super Admin', // Add this line
            'first_name' => 'Super',
            'last_name' => 'Admin',
            'username' => 'superadmin',
            'password' => bcrypt('password'), // Set a secure password
            ]
        );

        // Attachments for Super Admin
        $superAdminAttachments = [
            [
            'user_id' => $user->id,
            'passport_cnic_file' => 'uploads/passports/superadmin_passport.png',
            'personal_photo' => 'uploads/photos/admin-avatar.jpg',
            ],
        ];

        foreach ($superAdminAttachments as $attachment) {
            \App\Models\Attachment::create($attachment);
        }

        // Create Hospitality user
        $hospitalityUser = User::firstOrCreate(
            ['email' => 'hospitality@app.com'],
            [
            'name' => 'Hospitality User',
            'first_name' => 'Hospitality',
            'last_name' => 'User',
            'username' => 'hospitality',
            'password' => bcrypt('password'),
            ]
        );

        // Attachments for Hospitality user
        $hospitalityAttachments = [
            [
            'user_id' => $hospitalityUser->id,
            'passport_cnic_file' => 'uploads/passports/hospitality_passport.png',
            'personal_photo' => 'uploads/photos/admin-avatar.jpg',
            ],
        ];

        foreach ($hospitalityAttachments as $attachment) {
            \App\Models\Attachment::create($attachment);
        }

        // Create Transport user
        $transportUser = User::firstOrCreate(
            ['email' => 'transport@app.com'],
            [
            'name' => 'Transport User',
            'first_name' => 'Transport',
            'last_name' => 'User',
            'username' => 'transport',
            'password' => bcrypt('password'),
            ]
        );

        // Attachments for Transport user
        $transportAttachments = [
            [
            'user_id' => $transportUser->id,
            'passport_cnic_file' => 'uploads/passports/transport_passport.png',
            'personal_photo' => 'uploads/photos/admin-avatar.jpg',
            ],
        ];

        foreach ($transportAttachments as $attachment) {
            \App\Models\Attachment::create($attachment);
        }

    // Create buyer role
    $buyerRole = Role::firstOrCreate(['name' => 'buyer']);
    $visitorRole = Role::firstOrCreate(['name' => 'visitor']);
    $internationalRole = Role::firstOrCreate(['name' => 'international_visitor']);
    $exhibitorRole = Role::firstOrCreate(['name' => 'exhibitor']);

    // Create the new user
    $newUser = User::firstOrCreate(
        ['email' => 'buyer@app.com'],
        [
            'username' => 'buyer123',
            'password' => bcrypt('password'),
            'name' => 'John Buyer',
            'first_name' => 'John',
            'last_name' => 'Buyer',
            'father_first_name' => 'James',
            'father_last_name' => 'Buyer',
            'gender' => 'Male',
            'profession' => 'Gems Trader',
            'address' => '123 Buyer Street',
            'country' => 'France',
            'phone' => '+923001234567',
            'mobile' => '+923001234567',
            'whatsapp' => '+923001234567',
            'fb_url' => 'https://www.facebook.com/johnbuyer',
            'linkedin' => 'https://www.linkedin.com/in/johnbuyer',
            'instagram' => 'john_buyer',
            'telegram' => 'john_buyer_telegram',
            'wechat' => 'john_buyer_wechat',
            'imo' => 'john_buyer_imo',
            'cnic_passport_no' => '1330212345678',
            'date_of_issue' => '2020-01-01',
            'date_of_expiry' => '2030-01-01',
            'invited_way' => 'RCCI',
        ]
    );
    // assign role
    $newUser->assignRole('buyer');
    
        // add participants for this buyer
        \App\Models\UserParticipant::create([
            'user_id' => $newUser->id,
            'firstname' => 'John',
            'lastname' => 'Doe',
            'father_firstname' => 'James',
            'father_lastname' => 'Doe',
            'gender' => 'Male',
            'phone' => '+923001234567',
            'mobile' => '+923001234567',
            'whatsapp' => '+923001234567',
            'email' => 'john.doe@app.com',
            'facebook' => 'https://www.facebook.com/johndoe',
            'linkedin' => 'https://www.linkedin.com/in/johndoe',
            'instagram' => 'john_doe_instagram',
            'telegram' => 'john_doe_telegram',
            'wechat' => 'john_doe_wechat',
            'imo' => 'john_doe_imo',
            'passport_no' => '1234567890',
            'passport_issue' => '2020-01-01',
            'passport_expiry' => '2030-01-01',
            'passport_type' => 'Ordinary',
            'passport_file' => 'uploads/passports/johndoe_passport.png',
            'previous_trips' => 'Yes',
        ]);

    // Create Business Details for Buyer
    $buyerBusiness = \App\Models\Business::create([
        'user_id' => $newUser->id,
        'company_name' => 'Buyer Company Ltd',
        'address' => '123 Buyer Street',
        'company_email' => 'info@buyercompany.com',
        'position' => 'Manager',
        'company_phone' => '+92-300-1234567',
        'company_mobile' => '+92-300-1234567',
        'website_url' => 'www.buyercompany.com',
        'company_registered_number' => 'BUY123456',
        'vat_tax_number' => 'VAT123456',
        'chamber_association_member' => json_encode(['RCCI', 'Trade Association']),
        'nature_of_business' => 'Gems Trading',
        'type_of_business' => json_encode(['Import', 'Export']),
        'main_business_items' => 'Precious Stones, Gems',
        'main_import_items' => 'Raw Gems',
        'main_export_items' => 'Processed Gems',
        'main_import_countries' => 'Thailand, Sri Lanka',
        'main_export_countries' => 'UAE, USA',
        'annual_turnover' => '2000000',
        'annual_import_export' => 1500000.00,
        'national_sale' => 500000.00,
        'annual_import_from_pak' => 300000.00,
        'product_interest' => json_encode(['Gems', 'Precious Stones']),
        'amount' => '200000',
        'ntn' => 'NTN987654',
        'gst' => 'GST123456',
        'chamber_association_no' => 'CH987654'
    ]);
    // Attachments
    $attachments = [
        [
        'user_id' => $newUser->id,
        'passport_cnic_file' => 'uploads/passports/1734685892-4.png',
        'personal_photo' => 'uploads/photos/profile2.jpg',
        ],
    ];

    foreach ($attachments as $attachment) {
        \App\Models\Attachment::create($attachment);
    }

    // Create the Visitor user
    $visitorUser = User::firstOrCreate(
        ['email' => 'visitor@app.com'],
        [
            'username' => 'visitor123',
            'password' => bcrypt('password'),
            'name' => 'Visitor User',
            'first_name' => 'Visitor',
            'last_name' => 'User',
            'father_first_name' => 'John',
            'father_last_name' => 'Doe',
            'gender' => 'Female',
            'profession' => 'Tourism',
            'address' => '123 Visitor Lane',
            'phone' => '+1234567890',
            'country' => 'Pakistan',
            'mobile' => '+1234567890',
            'whatsapp' => '+1234567890',
            'fb_url' => 'https://www.fb_url.com/visitor',
            'linkedin' => 'https://www.linkedin.com/in/visitor',
            'instagram' => 'visitor_insta',
            'telegram' => 'visitor_telegram',
            'wechat' => 'visitor_wechat',
            'imo' => 'visitor_imo',
            'cnic_passport_no' => '1234567890123',
            'date_of_issue' => '1980-01-01',
            'date_of_expiry' => '2030-01-01',
            'invited_way' => 'Online',
        ]
    );
    // assign role
    $visitorUser->assignRole('visitor');

    // Create Business Details for Visitor
    $visitorBusiness = \App\Models\Business::create([
        'user_id' => $visitorUser->id,
        'company_name' => 'Visitor Enterprises',
        'address' => '456 Business Ave, City',
        'company_email' => 'info@visitorenterprises.com',
        'position' => 'CEO',
        'company_phone' => '+1-555-0123',
        'company_mobile' => '+1-555-0124',
        'website_url' => 'www.visitorenterprises.com',
        'company_registered_number' => 'REG123456',
        'vat_tax_number' => 'VAT987654',
        'chamber_association_member' => json_encode(['Chamber of Commerce', 'Business Association']),
        'nature_of_business' => 'Retail & Distribution',
        'type_of_business' => json_encode(['Import', 'Export', 'Wholesale']),
        'main_business_items' => 'Gems, Jewelry, Precious Stones',
        'main_import_items' => 'Raw Gems, Uncut Diamonds',
        'main_export_items' => 'Finished Jewelry, Polished Gems',
        'main_import_countries' => 'Thailand, India, Sri Lanka',
        'main_export_countries' => 'UAE, UK, USA',
        'annual_turnover' => '5000000',
        'annual_import_export' => 3000000.00,
        'national_sale' => 2000000.00,
        'annual_import_from_pak' => 1000000.00,
        'product_interest' => json_encode(['Precious Stones', 'Jewelry', 'Raw Materials']),
        'amount' => '100000',
        'ntn' => 'NTN123456',
        'gst' => 'GST789012',
        'chamber_association_no' => 'CH123456'
    ]);

    // Attachments
    $visitorAttachments = [
        [
            'user_id' => $visitorUser->id,
            'passport_cnic_file' => 'uploads/passports/visitor_passport.png',
            'personal_photo' => 'uploads/photos/profile2.jpg',
        ],
    ];

    
    foreach ($visitorAttachments as $attachment) {
        \App\Models\Attachment::create($attachment);
    }
        
    // Create the International Visitor user
    $internationalUser = User::firstOrCreate(
        ['email' => 'international@app.com'],
        [
            'username' => 'international123',
            'password' => bcrypt('password'),
            'name' => 'John Smith',
            'first_name' => 'John',
            'last_name' => 'Smith',
            'father_first_name' => 'Michael',
            'father_last_name' => 'Smith',
            'gender' => 'Male',
            'profession' => 'International Trade',
            'address' => '456 International Ave',
            'phone' => '+44123456789',
            'country' => 'United Kingdom',
            'mobile' => '+44123456789',
            'whatsapp' => '+44123456789',
            'fb_url' => 'https://www.fb_url.com/johnsmith',
            'linkedin' => 'https://www.linkedin.com/in/johnsmith',
            'instagram' => 'johnsmith_intl',
            'telegram' => 'johnsmith_telegram',
            'wechat' => 'johnsmith_wechat',
            'imo' => 'johnsmith_imo',
            'cnic_passport_no' => 'AB123456789',
            'date_of_issue' => '2020-01-01',
            'date_of_expiry' => '2030-01-01',
            'invited_way' => 'International Chamber',
        ]
    );
    $internationalUser->assignRole('international_visitor');

    // Create Business Details for International Visitor
    $internationalBusiness = \App\Models\Business::create([
        'user_id' => $internationalUser->id,
        'company_name' => 'International Trade Co',
        'address' => '456 Global Street, London',
        'company_email' => 'contact@internationaltrade.com',
        'position' => 'Director',
        'company_phone' => '+44-555-0123',
        'company_mobile' => '+44-555-0124',
        'website_url' => 'www.internationaltrade.com',
        'company_registered_number' => 'UK12345678',
        'vat_tax_number' => 'GB987654321',
        'chamber_association_member' => json_encode(['London Chamber of Commerce', 'International Trade Association']),
        'nature_of_business' => 'International Trade & Export',
        'type_of_business' => json_encode(['Import', 'Export', 'Wholesale']),
        'main_business_items' => 'Precious Stones, Jewelry',
        'main_import_items' => 'Raw Gems, Gold',
        'main_export_items' => 'Finished Jewelry',
        'main_import_countries' => 'Pakistan, India, Thailand',
        'main_export_countries' => 'UK, EU, Middle East',
        'annual_turnover' => '10000000',
        'annual_import_export' => 7000000.00,
        'national_sale' => 3000000.00,
        'annual_import_from_pak' => 2000000.00,
        'product_interest' => json_encode(['Gems', 'Precious Stones', 'Jewelry']),
        'amount' => '500000',
        'ntn' => 'INTL123456',
        'gst' => 'GST321654',
        'chamber_association_no' => 'ICC789012'
    ]);

    // Attachments for international visitor
    $internationalAttachments = [
        [
            'user_id' => $internationalUser->id,
            'passport_cnic_file' => 'uploads/passports/international_passport.png',
            'personal_photo' => 'uploads/photos/profile2.jpg',
        ],
    ];

    foreach ($internationalAttachments as $attachment) {
        \App\Models\Attachment::create($attachment);
    }
    
    // Create the Exhibitor user
    $exhibitorUser = User::firstOrCreate(
        ['email' => 'exhibitor@app.com'],
        [
            'username' => 'exhibitor123',
            'password' => bcrypt('password'),
            'name' => 'Sarah Johnson',
            'first_name' => 'Sarah',
            'last_name' => 'Johnson',
            'father_first_name' => 'William',
            'father_last_name' => 'Johnson',
            'gender' => 'Female',
            'country' => 'Pakistan',
            'profession' => 'Gems & Minerals',
            'address' => '789 Exhibition Street',
            'phone' => '+923001234567',
            'mobile' => '+923001234567',
            'whatsapp' => '+923001234567',
            'fb_url' => 'https://www.fb_url.com/sarahjohnson',
            'linkedin' => 'https://www.linkedin.com/in/sarahjohnson',
            'instagram' => 'sarah_exhibits',
            'telegram' => 'sarah_telegram',
            'wechat' => 'sarah_wechat',
            'imo' => 'sarah_imo',
            'cnic_passport_no' => '1330256776444',
            'date_of_issue' => '2020-01-01',
            'date_of_expiry' => '2030-01-01',
            'invited_way' => 'RCCI',
        ]
    );
    // assign role
    $exhibitorUser->assignRole('exhibitor');

    // Create Business Details for Exhibitor
    $exhibitorBusiness = \App\Models\Business::create([
        'user_id' => $exhibitorUser->id,
        'company_name' => 'Johnson Gems & Minerals',
        'address' => '789 Exhibition Street, Business District',
        'company_email' => 'info@johnsongems.com',
        'position' => 'CEO',
        'company_phone' => '+92-555-0123',
        'company_mobile' => '+92-555-0124',
        'website_url' => 'www.johnsongems.com',
        'company_registered_number' => 'EXH123456',
        'vat_tax_number' => 'VAT654321',
        'chamber_association_member' => json_encode(['Gems Association', 'Minerals Association']),
        'nature_of_business' => 'Gems & Minerals Exhibition',
        'type_of_business' => json_encode(['Exhibition', 'Retail', 'Wholesale']),
        'main_business_items' => 'Precious Stones, Minerals, Jewelry',
        'main_import_items' => 'Raw Stones, Uncut Gems',
        'main_export_items' => 'Polished Gems, Jewelry',
        'main_import_countries' => 'Afghanistan, Iran, Thailand',
        'main_export_countries' => 'UAE, USA, Europe',
        'annual_turnover' => '8000000',
        'annual_import_export' => 5000000.00,
        'national_sale' => 3000000.00,
        'annual_import_from_pak' => 1500000.00,
        'product_interest' => json_encode(['Gems', 'Minerals', 'Jewelry']),
        'amount' => '300000',
        'ntn' => 'NTN654321',
        'gst' => 'GST987654',
        'chamber_association_no' => 'CH654321'
    ]);

    // Attachments for exhibitor
    $exhibitorAttachments = [
        [
            'user_id' => $exhibitorUser->id,
            'passport_cnic_file' => 'uploads/passports/exhibitor_passport.png',
            'personal_photo' => 'uploads/photos/profile2.jpg',
        ],
    ];

    

    foreach ($exhibitorAttachments as $attachment) {
        \App\Models\Attachment::create($attachment);
    }


        // Assign the 'superadmin' role to the user
        if (!$user->hasRole('superadmin')) {
            $user->assignRole($role);
        }

        // Assign hospitality role
        if (!$hospitalityUser->hasRole('hospitality')) {
            $hospitalityUser->assignRole($hospitalityRole);
        }

        // Assign transport role
        if (!$transportUser->hasRole('transport')) {
            $transportUser->assignRole($transportRole);
        }
        

        // Output to confirm success
        echo "Super Admin created successfully with email: {$user->email}\n";
        echo "Hospitality User created successfully with email: {$hospitalityUser->email}\n";
        echo "Transport User created successfully with email: {$transportUser->email}\n";
    }}
