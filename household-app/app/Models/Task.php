<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Project;

class Task extends Model
{
    use HasFactory;

    const TASK_STATUS_STRING = [
        '食費',
        '交際費',
        '光熱費',
        '通信費',
        '雑費',
    ];


    protected $fillable = [
        'project_id',
        'spending_name',
        'due_date',
        'spending_amount',

    ];

    /**
     * Projectsテーブルとのリレーション
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function spendings()
    {
        return $this->hasMany(Spending::class);
    }

    /**
     * 進捗のテキスト用アクセサ
     */
    public function getTaskStatusStringAttribute()
    {
        $spendingName = array_search($this->attributes['spending_name'], self::TASK_STATUS_STRING);

        if ($spendingName === false) {
            return '';
        }

        return self::TASK_STATUS_STRING[$spendingName];
    }



}
