<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function status()
    {
        return $this->belongsTo(Status::class);
    }
    public function jobtitle()
    {
        return $this->belongsTo(JobTitle::class);
    }
    public function maritalstatus()
    {
        return $this->belongsTo(MaritalStatus::class);
    }
    public function faces()
    {
        return $this->hasMany(EmployeeFace::class);
    }
}
