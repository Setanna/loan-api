<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mouse extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'mouse_type'
    ];

    /**
     * Get the laptop that owns the mouse
     */
    public function laptop()
    {
        return $this->belongsTo(Laptop::class, 'mouse_id', 'id');
    }

}
