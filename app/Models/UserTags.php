<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UserTags
 *
 * @property int $id
 * @property int $user_id
 * @property string $tag_name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|UserTags newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserTags newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserTags query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserTags whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserTags whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserTags whereTagName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserTags whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserTags whereUserId($value)
 * @mixin \Eloquent
 */
class UserTags extends Model
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
