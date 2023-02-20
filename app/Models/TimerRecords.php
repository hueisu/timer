<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\TimerRecords
 *
 * @property int $id
 * @property string|null $tag_name
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
 * @mixin \Eloquent
 */
class TimerRecords extends Model
{
    use HasFactory;
    protected $fillable = ['tag_name', 'duration', 'description', 'start_time'];
}
