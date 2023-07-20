<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'user_id',
        'name',
        'price',
        'photo',
        'category',
        'ingredients',
        'recipe'
    ];

    public function scopeFilter($query, array $filters){

        if($filters['search'] ?? false) {
            $query->where('name', 'like', '%'.request('search').'%')
                ->orWhere('category', 'like', '%'.request('search').'%');
        }
    }
}
