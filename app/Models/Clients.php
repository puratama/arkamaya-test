<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clients extends Model
{
    use HasFactory;

    protected $table = 'tb_m_client';

    public function project() {
        return $this->hasMany('App\Models\Projects', 'client_id', 'client_id');
    }
}
