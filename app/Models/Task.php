<?php

namespace App\Models;

use App\Observers\TaskObserver;
use Carbon\Carbon;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[ObservedBy([TaskObserver::class])]
class Task extends Model
{
    use HasFactory;

    protected $levels = [
        1 => 'reminder',
        2 => 'to do',
        3 => 'important',
        4 => 'urgent',
        5 => 'critic',
    ];

    protected $guarded = [];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'due_date' => 'datetime:Y-m-d',
        ];
    }

    /**
     * Interact with the task title.
     */
    protected function title(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => ucfirst($value),
        );
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function taskList()
    {
        return $this->belongsTo('App\Models\TaskList', 'task_list_id');
    }

    /**
     * Get the task color
     */
    protected function color(): Attribute
    {
        return Attribute::make(
            get: fn () => \App\Services\PriorityLevelService::getColor($this->level),
        );
    }

    /**
     * Get the task priority name
     */
    protected function priority(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->levels[$this->level],
        );
    }

    /**
     * Get the task color
     */
    protected function isExpired(): Attribute
    {
        return Attribute::make(
            get: function () {
                if ($this->done_at) {
                    return false;
                }

                return $this->due_date?->lessThan(Carbon::today()) ?: false;
            }
        );
    }

    public function scopeExpired(Builder $query)
    {
        return $query->whereNull('done_at')
            ->whereDate('due_date', '<', Carbon::today());
    }

    public function scopeExpiring(Builder $query)
    {
        return $query->where(function ($query) {
            $query->whereNull('done_at')
                ->whereDate('due_date', Carbon::today()->subDays(1))
                ->orWhereDate('due_date', Carbon::today()->subDays(7));
        });

    }

    public function scopeValid(Builder $query)
    {
        return $query->where(function ($query) {
            $query->whereDate('due_date', '>=', Carbon::today())
                ->orWhereNull('due_date');
        });
    }

    public function scopeDone(Builder $query)
    {
        return $query->whereNotNull('done_at');
    }
}
