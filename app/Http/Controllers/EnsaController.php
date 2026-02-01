<?php

namespace App\Http\Controllers;

use App\Models\Concours;
use Illuminate\Http\Request;

// app/Http/Controllers/ConcoursController.php



class EnsaController extends Controller
{
    public function index()
    {
        $concours = Concours::all();
        return view('concours.index', compact('concours'));
    }

    public function create()
    {
        return view('concours.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date',
            'etat' => 'required',
        ]);

        Concours::create($request->all());
        return redirect()->route('concours.index')->with('success', 'Concours créé avec succès.');
    }

    public function show($id)
    {
        $concours = Concours::find($id);
        return view('concours.show', compact('concours'));
    }

    public function edit($id)
    {
        $concours = Concours::findOrFail($id);
        return view('concours.edit', compact('concours'));
    }

    public function update(Request $request, $id)
    {
        $concours = Concours::findOrFail($id);

        $request->validate([
            
            'nom' => 'required|string|max:255',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date',
            'etat' => 'required|in:ouvert,fermé',
        ]);

        $concours->update($request->all());

        return redirect()->route('concours.index')->with('success', 'Concours mis à jour avec succès.');
    }


    public function destroy($id)
    {
        Concours::find($id)->delete();
        return redirect()->route('concours.index')->with('success', 'Concours supprimé avec succès.');
    }
}

