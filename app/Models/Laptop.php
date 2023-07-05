<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laptop extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'manifacturer',
        'model',
        'mouse_id'
    ];

    /**
     * Get the mouse associated with the laptop
     */
    public function mouse()
    {
        return $this->hasOne(Mouse::class, 'id', 'mouse_id');
    }
}
