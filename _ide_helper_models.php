<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
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
 * @property-read \App\Models\User|null $user
 */
	class TimerRecords extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @mixin \Eloquent
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\TimerRecords> $timerRecords
 * @property-read int|null $timer_records_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\UserTags> $userTags
 * @property-read int|null $user_tags_count
 */
	class User extends \Eloquent {}
}

namespace App\Models{
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
 * @property-read \App\Models\User|null $user
 */
	class UserTags extends \Eloquent {}
}

