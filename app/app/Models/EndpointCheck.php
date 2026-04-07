<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EndpointCheck extends Model
{
    protected $fillable = [
        'endpoint_id',
        'status_code',
        'response_time_ms',
        'success',
        'error_message',
        'checked_at'
    ];

    protected $casts = [
        'success' => 'boolean',
        'checked_at' => 'datetime'
    ];

    public function endpoint()
    {
        return $this->belongsTo(Endpoint::class);
    }
}
