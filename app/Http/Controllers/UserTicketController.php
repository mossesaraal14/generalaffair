<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserTicketController extends Controller
{
    public function index() {
        $id = Auth::user()->id;
        $data = Ticket::where('user_id', $id)->get();
        // dd($data);

        return view('user.tickets.index', compact('data'));
    }

    public function ticketCreate() {
        $month = date('m');
        $year = date('Y');
        $urutan = (Ticket::max('id') ?? 0) + 1;
        $department = User::where('id', Auth::user()->id)->first()->department;

        return view('user.tickets.create', compact('month', 'year', 'urutan', 'department'));
    }

    public function ticketStore(Request $request) {
        $request->validate([
            'ticket_id' => 'required|string|max:255',
            'department' => 'required|string|max:50',
            'category' => 'required|string|max:50',
            'description' => 'required|string',
        ]);

        Ticket::create([
            'ticket_id' => $request->ticket_id,
            'user_id' => Auth::user()->id,
            'department' => $request->department,
            'category' => $request->category,
            'description' => $request->description,
        ]);

        return redirect()->route('user.tickets')->with('success', 'Ticket has been created successfully!');
    }

    public function ticketDestroy($id) {
        $data = Ticket::findOrFail($id);
        $data->delete();

        return redirect()->route('user.tickets')->with('success', 'Ticket has been deleted successfully!');
    }
}
