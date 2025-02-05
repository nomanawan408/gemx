<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class SalePurchaseController extends Controller
{
    public function index()
    {
        $users = User::role(['exhibitor','buyer'])->whereHas('attachment', function($query) {
            $query->whereNotNull('sale_purchase');
        })->orderByDesc('id')->get();
        return view('sale_purchase.index', compact('users'));
    }
    public function viewSales()
    {
        $users = User::role('exhibitor')->whereHas('attachment', function($query) {
            $query->whereNotNull('sale_purchase');
        })->get();
        return view('sale_purchase.view-sale', compact('users'));
    }
    public function viewPurchase()
    {
        if (auth()->user()->can('admin')) {
            $users = User::role('buyer')->whereHas('attachment', function($query) {
                $query->whereNotNull('sale_purchase');
            })->get();
        } else {
            $users = User::where('id', auth()->user()->id)->get();
        }
        return view('sale_purchase.view-purchase', compact('users'));
    }

    //
    public function create($id)
    {
        // Fetch the user by ID
        $user = User::findOrFail($id);

        // Return a view with the user details
        return view('sale_purchase.create', compact('user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'sale_purchase' => 'required|file|mimes:jpg,pdf,doc,docx,txt,jpeg,xls,xlsx,csv|max:2048', // Validate the file type and size
        ]);
    
        // Store the uploaded file
        $folder = 'uploads/sale_purchase_documents';
        $userId = $request->user_id;
        $file = $request->file('sale_purchase');
        $extension = $file->getClientOriginalExtension();
        $fileName = time() . '-' . $userId . '.' . $extension;
        $filePath = $folder . '/' . $fileName;
        $path = $file->storeAs($folder, $fileName, 'public');

        // Get the user detail by user_id
        $user = User::findOrFail($request->user_id);
       
        // Ensure the user's attachment exists
        if ($user->attachment) {
            // Update the sale_purchase field in the existing attachment
            $user->attachment->sale_purchase = $path;
            $user->attachment->save();
        } else {
            // Handle the edge case where the attachment record doesn't exist
            return redirect()->back()->with('error', 'Attachment record not found for the user!');
        }
    
        return redirect()->route('sale-purchase.index')->with('success', 'Sale/Purchase document uploaded successfully!');
    }

    public function deleteSalePurchase(Request $request)
    {
        $user = User::findOrFail($request->user_id);
        // Check if the user has an attachment and a sale_purchase document
        if ($user->attachment && $user->attachment->sale_purchase) {
            // Delete the file from storage
            
            \Storage::disk('public')->delete($user->attachment->sale_purchase);

            // Remove the sale_purchase value from the database
            $user->attachment->sale_purchase = null;
            $user->attachment->save();

            return redirect()->back()->with('success', 'Sale/Purchase document deleted successfully!');
        }

        return redirect()->back()->with('error', 'No Sale/Purchase document found to delete.');
    }

    
}
