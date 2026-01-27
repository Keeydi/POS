<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Printer extends Model
{
    use HasFactory;

    protected $fillable = [
        'department_id',
        'name',
        'printer_path',
        'template_type',
        'template_config',
        'active',
    ];

    protected $casts = [
        'template_config' => 'array',
        'active' => 'boolean',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
