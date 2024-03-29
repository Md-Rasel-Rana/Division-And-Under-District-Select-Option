<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;
    public function Division(){
        return $this->belongsTo(Division::class);
    }
    protected $fillable = ['name', 'division_id'];
}
