<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Claim;
use Illuminate\Http\Request;

class ClaimController extends Controller
{
    public function index(Request $request)
    {
        $query = Claim::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('student', function ($q) use ($search) {
                $q->where('full_name', 'like', "%{$search}%")
                  ->orWhere('passport_number', 'like', "%{$search}%");
            })->orWhere('claim_number', 'like', "%{$search}%");
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $claims = $query->latest()->paginate(15);
        return view('admin.claims.index', compact('claims'));
    }

    public function show(Claim $claim)
    {
        $claim->load(['student', 'application', 'application.plan', 'documents']);
        return view('admin.claims.show', compact('claim'));
    }

    public function process(Request $request, Claim $claim)
    {
        $validated = $request->validate([
            'status' => 'required|in:approved,rejected',
            'admin_notes' => 'nullable|string',
        ]);

        $claim->update([
            'status' => $validated['status'],
            'admin_notes' => $validated['admin_notes'],
            'processed_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Claim has been ' . $validated['status'] . ' successfully.');
    }

    public function destroy(Claim $claim)
    {
        $claim->delete();
        return redirect()->route('admin.claims.index')->with('success', 'Claim deleted successfully.');
    }
}
