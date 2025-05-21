<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enterprise extends Model
{
    /** @use HasFactory<\Database\Factories\EnterpriseFactory> */
    use HasFactory;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'name',
        'director_name',
        'address',
        'email',
        'website',
        'phone',
        'owner_id'
    ];

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }


}
