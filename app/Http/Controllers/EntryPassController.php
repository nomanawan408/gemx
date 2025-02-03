<?php

namespace App\Http\Controllers;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\File;
use Mpdf\Mpdf;
use Illuminate\Support\Facades\Response;

use Illuminate\Http\Request;

class EntryPassController extends Controller
{
    //
    public function generatePDF()
    {
        try {
            // Ensure the temporary directory exists
            $tempDir = storage_path('mpdf');
            if (!File::exists($tempDir)) {
                File::makeDirectory($tempDir, 0777, true, true);
            }

            // Convert images to base64 format
            $backgroundImage = 'data:image/jpeg;base64,' . base64_encode(file_get_contents(public_path('assets/img/pass-bg.jpg')));
            $logo1 = 'data:image/png;base64,' . base64_encode(file_get_contents(public_path('assets/img/gemx-logo1.png')));
            $logo2 = 'data:image/png;base64,' . base64_encode(file_get_contents(public_path('assets/img/gemx-logo2.png')));

            // Pass variables to the Blade template
            $html = View::make('entrypass.entrypass_templete', [
                'backgroundImage' => $backgroundImage,
                'logo1' => $logo1,
                'logo2' => $logo2,
            ])->render();

            // Create an instance of MPDF
            $mpdf = new Mpdf([
                'tempDir' => $tempDir, // Prevent temp directory errors
                'mode' => 'utf-8', // Ensure UTF-8 support
                'format' => 'b5', // Set paper format
                'default_font' => 'poppins', // Use a compatible font
            ]);

            // Write the HTML content to PDF
            $mpdf->WriteHTML($html);

            // Output the PDF (Download)
            return response()->streamDownload(
                fn() => $mpdf->Output(),
                'EntryPass.pdf'
            );

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
