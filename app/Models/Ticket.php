<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table = 'tb_tickets';
    protected $fillable = ['ticket_id', 'user_id', 'department', 'description', 'category'];

    public function user() {
        $this->belongsTo(User::class);
    }
}
