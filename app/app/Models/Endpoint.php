<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Endpoint extends Model
{
    protected $fillable = [
        'project_id',
        'name',
        'url',
        'method',
        'headers',
        'body',
        'expected_status',
        'timeout_ms',
        'interval_seconds',
        'is_active',
        'last_checked_at',
        'last_status',
        'last_response_time',
    ];

    protected $casts = [
        'headers' => 'array',
        'body' => 'array',
        'is_active' => 'boolean',
        'last_status' => 'boolean',
        'last_checked_at' => 'datetime',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function checks()
    {
        return $this->hasMany(EndpointCheck::class);
    }
}
