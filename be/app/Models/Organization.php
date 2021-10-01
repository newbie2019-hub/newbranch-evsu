<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;
    public $fillable = ['college_id', 'organization', 'abbreviation'];
    public function college(){
        return $this->belongsTo(College::class, 'college_id', 'id');
    }
}
