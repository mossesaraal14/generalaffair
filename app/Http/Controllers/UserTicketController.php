<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class UserTicketController extends Controller
{
    public function index() {
        $id = Auth::user()->id;
        $data = Ticket::where('user_id', $id)->latest('created_at')->get();
        // dd($data);

        return view('user.tickets.index', compact('data'));
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

        $email = Auth::user()->email;
        $name = Auth::user()->name;

        // dd($email);

        Mail::send('emails.ticket', [
            'name' => $name,
            'ticket_id' => $request->ticket_id,
            'description' => $request->description,
            'department' => $request->department,
            'status' => 'Open',
            'tanggal' => Carbon::now()->format('d/m/y'),
        ], function($message) use ($email) {
            $message->to([$email, 'mosses@berkahrositamandiri.com'])->subject('Ticket Berhasil Dibuat');
        });

        return redirect()->route('user.tickets')->with('success', 'Ticket has been created successfully!');
    }

    public function ticketDestroy($id) {
        $data = Ticket::findOrFail($id);
        $data->delete();

        return redirect()->route('user.tickets')->with('success', 'Ticket has been deleted successfully!');
    }

    public function ticketShow($id) {
        $ticket = Ticket::with([
            'user',
        ])->findOrFail($id);

        return response()->json([
            'ticket_id' => $ticket->ticket_id,
            'department' => $ticket->department,
            'category' => $ticket->category,
            'status' => $ticket->status,
            'description' => $ticket->description,
            'created_at' => $ticket->created_at->format('d-m-Y H:i'),
            'updated_at' => $ticket->updated_at->format('d-m-Y H:i'),
            'user' => $ticket->user,
        ]);
    }
}
