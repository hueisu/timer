<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\TimerRecords
 *
 * @property int $id
 * @property int $user_id
 * @property int|null $user_tag_id
 * @property int $duration
 * @property string|null $description
 * @property string $start_time
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|TimerRecords newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TimerRecords newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TimerRecords query()
 * @method static \Illuminate\Database\Eloquent\Builder|TimerRecords whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TimerRecords whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TimerRecords whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TimerRecords whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TimerRecords whereStartedTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TimerRecords whereTagName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TimerRecords whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TimerRecords whereStartTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TimerRecords whereUserTagId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TimerRecords whereUserId($value)
 * @mixin \Eloquent
 */
class TimerRecords extends Model
{
    use HasFactory;
    protected $fillable = ['user_tag_id', 'user_id', 'duration', 'description', 'start_time'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
