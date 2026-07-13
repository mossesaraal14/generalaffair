<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GetTicket extends Model
{
    protected $table = 'tb_getticket';
    protected $fillable = ['ticket_id', 'description'];

    public function tickets() {
        return $this->belongsTo(Ticket::class, 'ticket_id');
    }
}
