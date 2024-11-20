<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Clock extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'clock_in',
        'clock_out',
        'break_start',
        'break_end',
    ];

    /**
     * Get the user that owns the clock record.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Calculate the total work time excluding break time.
     *
     * @return string|null
     */
    public function getTotalTimeAttribute(): ?string
    {
        if ($this->clock_in && $this->clock_out) {
            $workDuration = $this->clock_out->diffInMinutes($this->clock_in);

            if ($this->break_start && $this->break_end) {
                $breakDuration = $this->break_end->diffInMinutes($this->break_start);
                $workDuration -= $breakDuration;
            }

            $hours = floor($workDuration / 60);
            $minutes = $workDuration % 60;

            return sprintf('%02d:%02d', $hours, $minutes);
        }

        return null;
    }
}
