<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Models\Attachment;
use App\Models\User;

class ExportController extends Controller
{
    //
    public function exportCsv()
    {
        // Fetch the users data (adjust the query as needed)
        $users = User::with('attachment')->get();

        // Define the CSV header
        $header = ['Name', 'Profession', 'Address', 'Phone', 'CNIC No', 'Status'];

        // Generate CSV content
        $rows = $users->map(function ($user) {
            return [
                $user->name,
                $user->profession,
                $user->address,
                $user->phone,
                $user->cnic_passport_no,
                ucfirst($user->status),
            ];
        });

        // Convert to a CSV string
        $csvContent = implode(',', $header) . "\n";
        foreach ($rows as $row) {
            $csvContent .= implode(',', $row) . "\n";
        }

        // Return the CSV response
        return Response::make($csvContent, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="users_data.csv"',
        ]);
    }
}
