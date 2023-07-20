<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'name',
        'category',
        'cost',
        'quantity',
        'status',
        'restockPoint',
        'unit',
        'unitPerCase',
        'unitPerPortion'
    ];

    public function scopeFilter($query, array $filters){

        if($filters['search'] ?? false) {
            $query->where('name', 'like', '%'.request('search').'%')
                ->orWhere('category', 'like', '%'.request('search').'%');
        }
    }
}
