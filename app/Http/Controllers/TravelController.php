<?php 

namespace App\Http\Controllers;

use App\Models\Travel;
use Illuminate\Http\Request;

class TravelController extends Controller
{

    public function index()
    {
        $travels = Travel::all();
        return view('travels.index', compact('travels'));
    }


    public function create()
    {
        return view('travels.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'id_tanggal_keberangkatan' => 'required|date',
            'kuota' => 'required|integer',
        ]);

        Travel::create($request->all());

        return redirect()->route('travels.index')->with('success', 'Travel created successfully.');
    }


    public function edit(Travel $travel)
    {
        return view('travels.edit', compact('travel'));
    }

    
    public function update(Request $request, Travel $travel)
    {
        $request->validate([
            'id_tanggal_keberangkatan' => 'required|date',
            'kuota' => 'required|integer',
        ]);

        $travel->update($request->all());

        return redirect()->route('travels.index')->with('success', 'Travel updated successfully.');
    }


    public function destroy(Travel $travel)
    {
        $travel->delete();

        return redirect()->route('travels.index')->with('success', 'Travel deleted successfully.');
    }
}
