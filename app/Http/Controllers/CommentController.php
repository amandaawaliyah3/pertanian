<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::where('is_approved', true)->latest()->get();
        return view('feedback', compact('comments'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:150',
            'message' => 'required|string|max:1000',
            'berita_id' => 'nullable|integer|exists:beritas,id',
        ]);

        Comment::create($validated);

        // Jika komentar dikirim dari halaman berita tertentu
        if ($request->filled('berita_id')) {
            return redirect()
                ->route('berita.show', $request->berita_id)
                ->with('success', 'Terima kasih! Komentar kamu telah dikirim untuk ditinjau.');
        }

        // Jika dikirim dari halaman lain (misal feedback umum)
        return back()->with('success', 'Terima kasih! Komentar kamu telah dikirim untuk ditinjau.');
    }
}
