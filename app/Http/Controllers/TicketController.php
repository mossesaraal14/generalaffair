<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    // admin
    // tickets
    public function index() {
        $data = Ticket::all();

        return view('admin.tickets.index', compact('data'));
    }

    public function ticketCreate() {
        $month = date('m');
        $year = date('Y');
        $urutan = (Ticket::max('id') ?? 0) + 1;

        return view('admin.tickets.create', compact('month', 'year', 'urutan'));
    }

    public function ticketStore(Request $request) {
        $request->validate([
            'ticket_id'   => 'required|string|max:255',
            'department'        => 'required|string|max:50',
            'category'        => 'required|string|max:50',
            'description'    => 'required|string',
        ]);

        Ticket::create([
            'ticket_id' => $request->ticket_id,
            'user_id' => Auth::user()->id,
            'department' => $request->department,
            'category' => $request->category,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.tickets')->with('success', 'Data ATK berhasil ditambahkan!');
    }

    public function getTicketIndex() {
        $data = Ticket::all();

        return view('admin.tickets.index', compact('data'));
    }

}
