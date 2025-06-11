<?php

namespace App\Http\Controllers;

use App\Models\Word;
use Illuminate\Http\Request;

class WordController extends Controller
{
    // Display list with optional search
    public function index(Request $request)
    {
        $search = $request->query('search');
        $words = Word::when($search, function($query, $search) {
            return $query->where('term', 'like', "%{$search}%")
                         ->orWhere('definition', 'like', "%{$search}%");
        })->orderBy('term')->paginate(10);

        return view('words.index-word', compact('words', 'search'));
    }

    // Show form to create new word
    public function create()
    {
        return view('words.create-word');
    }

    // Store new word
    public function store(Request $request)
    {
        $request->validate([
            'term' => 'required|unique:words,term|max:255',
            'definition' => 'required',
        ]);

        Word::create($request->only('term', 'definition'));

        return redirect()->route('words.index-word')->with('success', 'Word added successfully.');
    }

    // Show form to edit existing word
    public function edit(Word $word)
    {
        return view('words.edit-word', compact('word'));
    }

    // Update word
    public function update(Request $request, Word $word)
    {
        $request->validate([
            'term' => 'required|max:255|unique:words,term,' . $word->id,
            'definition' => 'required',
        ]);

        $word->update($request->only('term', 'definition'));

        return redirect()->route('words.index-word')->with('success', 'Word updated successfully.');
    }

    // Delete word
    public function destroy(Word $word)
    {
        $word->delete();

        return redirect()->route('words.index-word')->with('success', 'Word deleted successfully.');
    }
}

