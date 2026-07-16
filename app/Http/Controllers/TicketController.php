<?php

namespace App\Http\Controllers;

use App\Models\GetTicket;
use App\Models\Ticket;
use App\Models\User;
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
        $department = User::where('id', Auth::user()->id)->first()->department;

        return view('admin.tickets.create', compact('month', 'year', 'urutan', 'department'));
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

        return redirect()->route('admin.tickets')->with('success', 'Ticket has been created successfully!');
    }

    public function ticketDestroy($id) {
        $data = Ticket::findOrFail($id);
        $data->delete();

        return redirect()->route('admin.tickets')->with('success', 'Ticket has been deleted successfully!');
    }

    // get ticket
    public function getTicketIndex() {
        $data = GetTicket::all();

        return view('admin.tickets.get-ticket', compact('data'));
    }

    public function getTicketCreate() {
        $ticket_id = Ticket::where('status', 'open')->get();

        return view('admin.tickets.get-create', compact('ticket_id'));
    }

    public function getTicketStore(Request $request) {
        $request->validate([
            'ticket_id' => 'required|string|max:255',
            'description' => 'string|nullable',
            'status' => 'required|string',
        ]);

        GetTicket::create([
            'ticket_id' => $request->ticket_id,
            'description' => $request->description,
        ]);

        $ticket = Ticket::findOrFail($request->ticket_id);
        // dd($ticket->description);

        $ticket->update([
            'status' => $request->status,
        ]);

        return redirect()->route('admin.tickets.get')->with('success', 'Ticket has been updated!');
    }

    public function getTicketEdit($id) {
        $get = GetTicket::findOrFail($id);

        return view('admin.tickets.get-edit', compact('get'));
    }

    public function getTicketUpdate(Request $request, $id) {
        $request->validate([
            'ticket_id' => 'required|string|max:255',
            'description' => 'string|required',
            'status' => 'required|string',
        ]);

        $ticket = Ticket::findOrFail($id);
        $get = GetTicket::where('ticket_id', $ticket->id)->first();

        $ticket->update([
            'status' => $request->status,
        ]);

        $get->update([
            'description' => $request->description,
        ]);

        // dd($ticket->id);

        return redirect()->route('admin.tickets.get')->with('success', 'Ticket has been updated!');
    }
}
