<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Employee extends Model
{
    /** @use HasFactory<\Database\Factories\EmployeeFactory> */
    use HasFactory;

    protected $fillable = [
        'passport_number',
        'last_name',
        'first_name',
        'middle_name',
        'position',
        'phone',
        'address',
        'enterprise_id'
    ];


    public function enterprise()
    {
        return $this->belongsTo(Enterprise::class);
    }


}
