<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UserTag
 *
 * @property int $id
 * @property int $user_id
 * @property string $tag_name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|UserTag newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserTag newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserTag query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserTag whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserTag whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserTag whereTagName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserTag whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserTag whereUserId($value)
 * @mixin \Eloquent
 */
class UserTag extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'tag_name',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
