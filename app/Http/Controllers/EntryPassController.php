<?php

namespace App\Http\Controllers;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Illuminate\Support\Facades\View;
use Mpdf\Mpdf;


use Illuminate\Http\Request;

class EntryPassController extends Controller
{
    //
    public function generatePDF()
    {
        try {
            $data = [
                'title' => 'Entry Pass',
                'user' => auth()->user(),
            ];

            // Load the view and convert it to HTML
            $html = View::make('entrypass.entrypass_templete', compact('data'))->render();

            // Create MPDF instance
            $mpdf = new \Mpdf\Mpdf([
                'tempDir' => storage_path('mpdf'), // Prevent temp directory errors
                'mode' => 'utf-8', // Ensure UTF-8 support
                'format' => 'A4', // Adjust page format
                'default_font' => 'dejavusans', // Use a compatible font
            ]);

            // Write HTML to PDF
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
