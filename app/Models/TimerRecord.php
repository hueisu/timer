<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\TimerRecord
 *
 * @property int $id
 * @property int $user_id
 * @property int|null $user_tag_id
 * @property int $duration
 * @property string|null $description
 * @property string $start_time
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|TimerRecord newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TimerRecord newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TimerRecord query()
 * @method static \Illuminate\Database\Eloquent\Builder|TimerRecord whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TimerRecord whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TimerRecord whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TimerRecord whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TimerRecord whereStartedTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TimerRecord whereTagName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TimerRecord whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TimerRecord whereStartTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TimerRecord whereUserTagId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TimerRecord whereUserId($value)
 * @mixin \Eloquent
 */
class TimerRecord extends Model
{
    use HasFactory;
    protected $fillable = ['user_tag_id', 'user_id', 'duration', 'description', 'start_time'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
