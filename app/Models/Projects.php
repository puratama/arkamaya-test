<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
    use HasFactory;

    protected $table = 'tb_m_project';

    protected $fillable = [
        'project_id', 'project_name', 'client_id', 'project_start', 'project_end', 'project_status'
    ];

    public function client() {
        return $this->belongsTo('App\Models\Clients', 'client_id', 'client_id');
    }
}
