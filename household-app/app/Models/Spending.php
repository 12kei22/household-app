<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spending extends Model
{
    use HasFactory;

    const SPENDING_STATUS_STRING = [
        '食費',
        '交際費',
        '光熱費',
        '通信費',
        '雑費',
    ];

    const SPENDING_STATUS_CLASS = [
        'bg-danger',
        'bg-primary',
        'bg-success',
        'bg-secondary',
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

    public function tasks()
    {
        return $this->belongsTo(Task::class);
    }

    /**
     * 進捗のテキスト用アクセサ
     */
    public function getTaskStatusStringAttribute()
    {
        $taskStatus = $this->attributes['spending_amount'];

        if (!isset(self::SPENDING_STATUS_STRING[$taskStatus])) {
            return '';
        }

        return self::SPENDING_STATUS_STRING[$taskStatus];
    }
}
