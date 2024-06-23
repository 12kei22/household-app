<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;


    const MONTH_NAME = [

        '１月',
        '２月',
        '３月',
        '４月',
        '５月',
        '６月',
        '７月',
        '８月',
        '９月',
        '１０月',
        '１１月',
        '１２月',
    ];

    protected $fillable = [
        'user_id',
        'project_name',

    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function spendings()
    {
        return $this->hasMany(Spending::class);
    }

    public function getMonthNameAttribute()
    {
        // Check if project_name is in MONTH_NAME array
        if (in_array($this->attributes['project_name'], self::MONTH_NAME)) {
            return $this->attributes['project_name'];
        }

        return '';
    }


}
