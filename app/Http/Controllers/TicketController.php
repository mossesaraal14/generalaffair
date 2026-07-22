<?php

namespace App\Http\Controllers;

use App\Models\GetTicket;
use App\Models\Ticket;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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
        $lastTicket = Ticket::whereYear('created_at', $year)->whereMonth('created_at', $month)->orderByDesc('id')->first();

        if ($lastTicket) {
            $parts = explode('/', $lastTicket->ticket_id);
            $urutan = (int) end($parts) + 1;
        } else {
            $urutan = 1;
        }

        $department = User::where('id', Auth::user()->id)->first()->department;

        return view('admin.tickets.create', compact('month', 'year', 'urutan', 'department'));
    }

    public function ticketStore(Request $request) {
        $request->validate([
            'ticket_id' => 'required|string|max:255',
            'department' => 'required|string|max:50',
            'category' => 'required|string|max:50',
            'description' => 'required|string|max:255',
        ]);

        Ticket::create([
            'ticket_id' => $request->ticket_id,
            'user_id' => Auth::user()->id,
            'department' => $request->department,
            'category' => $request->category,
            'description' => $request->description,
        ]);

        $email = Auth::user()->email;
        $name = Auth::user()->name;

        Mail::send('emails.ticket', [
            'name' => $name,
            'ticket_id' => $request->ticket_id,
            'description' => $request->description,
            'department' => $request->department,
            'status' => 'Open',
            'tanggal' => Carbon::now()->format('d/m/y'),
        ], function($message) use ($email) {
            $message->to($email)->subject('Ticket Berhasil Dibuat');
        });

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

    public function getTicketCreate($id) {
        $ticket = Ticket::where('id', $id)->first();

        return view('admin.tickets.get-create', compact('ticket'));
    }

    public function getTicketStore(Request $request, $id) {
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

        $email = Ticket::with('user')->findOrFail($id);
        // dd($email->user->email);

        Mail::send('emails.get', [
            'name' => $email->user->name,
            'ticket_id' => $request->ticket_id,
            'description' => $ticket->description,
            'department' => $email->user->department,
            'status' => $request->status,
            'tanggal' => Carbon::now()->format('d/m/y'),
        ], function($message) use ($email) {
            $message->to($email->user->email)->subject('Ticket Telah Diperbarui');
        });

        return redirect()->route('admin.tickets')->with('success', 'Ticket has been updated!');
    }
}
