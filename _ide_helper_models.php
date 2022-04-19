<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App{
/**
 * App\Author
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string|null $pseudonym
 * @property string|null $birth_date
 * @property string|null $death_date
 * @property string $ol_author_key
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Book[] $books
 * @property-read int|null $books_count
 * @method static \Illuminate\Database\Eloquent\Builder|Author newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Author newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Author query()
 * @method static \Illuminate\Database\Eloquent\Builder|Author whereBirthDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Author whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Author whereDeathDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Author whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Author whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Author whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Author whereOlAuthorKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Author wherePseudonym($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Author whereUpdatedAt($value)
 */
	class Author extends \Eloquent {}
}

namespace App{
/**
 * App\Book
 *
 * @property int $id
 * @property string $title
 * @property string|null $blurb
 * @property string|null $cover
 * @property string $url
 * @property string $ol_work_key
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Author[] $authors
 * @property-read int|null $authors_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Edition[] $editions
 * @property-read int|null $editions_count
 * @method static \Illuminate\Database\Eloquent\Builder|Book newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Book newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Book query()
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereBlurb($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereCover($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereOlWorkKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Book whereUrl($value)
 */
	class Book extends \Eloquent {}
}

namespace App{
/**
 * App\Edition
 *
 * @property int $id
 * @property string|null $isbn13
 * @property string|null $isbn10
 * @property int $publisher_id
 * @property int $book_id
 * @property string|null $publish_date
 * @property int|null $pages
 * @property int $format
 * @property string|null $goodreads
 * @property string $ol_edition_key
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Book $book
 * @property-read string $format_description
 * @property-read \App\Publisher $publisher
 * @method static \Illuminate\Database\Eloquent\Builder|Edition newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Edition newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Edition query()
 * @method static \Illuminate\Database\Eloquent\Builder|Edition whereBookId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Edition whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Edition whereFormat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Edition whereGoodreads($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Edition whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Edition whereIsbn10($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Edition whereIsbn13($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Edition whereOlEditionKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Edition wherePages($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Edition wherePublishDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Edition wherePublisherId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Edition whereUpdatedAt($value)
 */
	class Edition extends \Eloquent {}
}

namespace App{
/**
 * App\Publisher
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Edition[] $editions
 * @property-read int|null $editions_count
 * @method static \Illuminate\Database\Eloquent\Builder|Publisher newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Publisher newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Publisher query()
 * @method static \Illuminate\Database\Eloquent\Builder|Publisher whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Publisher whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Publisher whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Publisher whereUpdatedAt($value)
 */
	class Publisher extends \Eloquent {}
}

namespace App{
/**
 * App\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
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
 */
	class User extends \Eloquent {}
}

