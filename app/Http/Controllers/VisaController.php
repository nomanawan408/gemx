<?php

namespace App\Http\Controllers;

use App\Models\Visa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class VisaController extends Controller
{
    //
    public function index()
    {
        // get all visas if admin, otherwise get only the user's visas
        if (auth()->user()->can('admin')) {
            $visas = Visa::all();
        } else {
            $visas = Visa::where('user_id', auth()->user()->id)->get();
        }
        return view('visa.index', compact('visas'));
    }

    public function create()
    {
        return view('visa.create');
    }

    public function store(Request $request)
    {
    
        $validated = $request->validate([
            'visaFile' => 'required',
        ]);
        
        $user_id = auth()->user()->id;

        $file = $request->file('visaFile');
        $extension = $file->getClientOriginalExtension();
        $fileName = time() . '-' . $user_id . '.' . $extension;
        $filePath = 'uploads/visas' . '/' . $fileName;
        Storage::disk('public')->put($filePath, file_get_contents($file));
        
        $visaFile = $filePath;
        
        $visa = new Visa();
        $visa->user_id = $user_id;
        $visa->visa_file = $visaFile;
        $visa->save();

        return redirect()->route('visa.index');
    }

    public function destroy(Visa $visa)
    {
        $visa->delete();
        return redirect()->route('visa.index');
    }

    //visaShow
    public function visaShow(Visa $visa)
    {
        return view('visa.show', compact('visa'));
    }
    

}
