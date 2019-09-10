<?php
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App{
/**
 * App\Follow
 *
 * @mixin \Eloquent
 * @property int $user_id_following
 * @property int $user_id_followed
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Follow whereUserIdFollowed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Follow whereUserIdFollowing($value)
 */
	class Follow extends \Eloquent {}
}

namespace App{
/**
 * App\Bought
 *
 * @property-read \App\Publication $publi
 * @property-read \App\User $user
 */
	class Bought extends \Eloquent {}
}

namespace App{
/**
 * App\Admin
 *
 * @mixin \Eloquent
 */
	class Admin extends \Eloquent {}
}

namespace App{
/**
 * App\Comment
 *
 * @property-read \App\Publication $publication
 * @property-read \App\User $user
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Comment onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Comment withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Comment withoutTrashed()
 * @mixin \Eloquent
 * @property int $id
 * @property string $content
 * @property int $user_id
 * @property int $publication_id
 * @property string|null $deleted_at
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comment whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comment whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comment wherePublicationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Comment whereUserId($value)
 */
	class Comment extends \Eloquent {}
}

namespace App{
/**
 * App\Media
 *
 * @property-read \App\Publication $publication
 * @property-read \App\User $user
 * @mixin \Eloquent
 * @property int $id
 * @property string $title
 * @property string $type_mime
 * @property string $file_path
 * @property int $publication_id
 * @property int $user_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Media whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Media whereFilePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Media whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Media wherePublicationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Media whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Media whereTypeMime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Media whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Media whereUserId($value)
 */
	class Media extends \Eloquent {}
}

namespace App{
/**
 * App\ContactRequest
 *
 * @property-read \App\User $user
 * @mixin \Eloquent
 * @property int $id
 * @property string $title
 * @property string $content
 * @property int $user_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ContactRequest whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ContactRequest whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ContactRequest whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ContactRequest whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ContactRequest whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ContactRequest whereUserId($value)
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\ContactRequest onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\ContactRequest withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\ContactRequest withoutTrashed()
 */
	class ContactRequest extends \Eloquent {}
}

namespace App{
/**
 * App\Role
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $users
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Role whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Role whereUpdatedAt($value)
 */
	class Role extends \Eloquent {}
}

namespace App{
/**
 * App\Publication
 *
 * @property-read \App\Category $category
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Comment[] $comment
 * @property-read \App\Consultation $consultation
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Media[] $media
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Publication findSimilarSlugs($attribute, $config, $slug)
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Publication onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Publication tuto()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Publication whereSlug($slug)
 * @method static \Illuminate\Database\Query\Builder|\App\Publication withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Publication withoutTrashed()
 * @mixin \Eloquent
 * @property int $id
 * @property string $type
 * @property string|null $imgpublication
 * @property float|null $price
 * @property string $title
 * @property string $slug
 * @property string|null $description
 * @property string $content
 * @property string|null $goals
 * @property string|null $required
 * @property string|null $deleted_at
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property int $category_id
 * @property int $user_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Publication whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Publication whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Publication whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Publication whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Publication whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Publication whereGoals($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Publication whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Publication whereImgpublication($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Publication wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Publication whereRequired($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Publication whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Publication whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Publication whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Publication whereUserId($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $userOwner
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Publication post()
 */
	class Publication extends \Eloquent {}
}

namespace App{
/**
 * App\Rating
 *
 */
	class Rating extends \Eloquent {}
}

namespace App{
/**
 * App\Category
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Publication[] $post
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Publication[] $publication
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Publication[] $tuto
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Category whereName($value)
 */
	class Category extends \Eloquent {}
}

namespace App{
/**
 * App\Message
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Message findConversation($userId, $otherUserId)
 * @mixin \Eloquent
 * @property int $id
 * @property int $from_user_id
 * @property int $to_user_id
 * @property string $content
 * @property string|null $read_at
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Message whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Message whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Message whereFromUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Message whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Message whereReadAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Message whereToUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Message whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Message findUnreadMessage($userId, $otherUserId)
 */
	class Message extends \Eloquent {}
}

namespace App{
/**
 * App\Consultation
 *
 * @property-read \App\Publication $publication
 * @property-read \App\User $user
 * @mixin \Eloquent
 * @property int $id
 * @property int $occurrences
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property int|null $rating
 * @property int $publication_id
 * @property int $user_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Consultation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Consultation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Consultation whereOccurrences($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Consultation wherePublicationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Consultation whereRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Consultation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Consultation whereUserId($value)
 */
	class Consultation extends \Eloquent {}
}

namespace App{
/**
 * App\User
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Comment[] $comment
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $followers
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $followings
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Media[] $media
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Publication[] $post
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Publication[] $publication
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Role[] $roles
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Publication[] $tutorial
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User findSimilarSlugs($attribute, $config, $slug)
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\User onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereSlug($slug)
 * @method static \Illuminate\Database\Query\Builder|\App\User withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\User withoutTrashed()
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property string $imgprofil
 * @property string $firstname
 * @property string $slug
 * @property \Carbon\Carbon|null $birthday
 * @property string $email
 * @property string $password
 * @property string|null $paypal
 * @property string|null $description
 * @property string|null $role
 * @property string|null $provider
 * @property string|null $provider_id
 * @property string|null $deleted_at
 * @property string|null $remember_token
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereBirthday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereFirstname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereImgprofil($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePaypal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereProvider($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereProviderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Client[] $clients
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Publication[] $postsBought
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Token[] $tokens
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Message[] $unreadMessage
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Message[] $unreadMessageByUser
 */
	class User extends \Eloquent {}
}

