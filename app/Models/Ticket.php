<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table = 'tb_tickets';
    protected $fillable = ['ticket_id', 'user_id', 'department', 'description', 'category', 'status'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function getTicket() {
        return $this->hasOne(GetTicket::class, 'ticket_id', 'id');
    }
}
