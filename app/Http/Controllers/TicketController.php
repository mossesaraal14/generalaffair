<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index() {
        $data = Ticket::all();

        return view('admin.tickets.index', compact('data'));
    }

    public function getTicketIndex() {
        $data = Ticket::all();

        return view('admin.tickets.index', compact('data'));
    }

}
