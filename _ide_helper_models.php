<?php
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\User
 *
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $facebook_id
 * @property string $facebook_token
 * @property string $token
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Event[] $events
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\EventTask[] $eventTasks
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereFacebookId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereFacebookToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereToken($value)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\EventTemplate
 *
 * @property integer $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $name
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\EventTemplateTask[] $tasks
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventTemplate whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventTemplate whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventTemplate whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventTemplate whereName($value)
 */
	class EventTemplate extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\EventTemplateTask
 *
 * @property integer $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $name
 * @property integer $event_template_id
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventTemplateTask whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventTemplateTask whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventTemplateTask whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventTemplateTask whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventTemplateTask whereEventTemplateId($value)
 */
	class EventTemplateTask extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\EventInvitee
 *
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property integer $event_id
 * @property string $user_id
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventInvitee whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventInvitee whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventInvitee whereEventId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventInvitee whereUserId($value)
 */
	class EventInvitee extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\EventTask
 *
 * @property integer $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property integer $event_id
 * @property \App\Models\User $assignee
 * @property string $name
 * @property float $cost
 * @property boolean $done
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventTask whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventTask whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventTask whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventTask whereEventId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventTask whereAssignee($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventTask whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventTask whereCost($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\EventTask whereDone($value)
 */
	class EventTask extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Event
 *
 * @property integer $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $name
 * @property \Carbon\Carbon $when
 * @property float $lat
 * @property float $long
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $invitees
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\EventTask[] $tasks
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Event whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Event whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Event whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Event whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Event whereWhen($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Event whereLat($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Event whereLong($value)
 */
	class Event extends \Eloquent {}
}

