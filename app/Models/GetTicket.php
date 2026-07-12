<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GetTicket extends Model
{
    protected $table = 'tb_getTicket';
    protected $fillable = ['ticket_id', 'description'];

    public function getTicket() {
        $this->belongsTo(Ticket::class);
    }
}
