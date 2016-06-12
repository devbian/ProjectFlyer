<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flyer extends Model
{

    /**
     * fillable fields
     * @var array
     */
    protected $fillable = [
        'street',
        'city',
        'state',
        'country',
        'zip',
        'price',
        'description'
    ];

    /**
     * @param string $zip
     * @param string $street
     * @return mixed
     * @internal param $query
     */
    public static function locateAt($zip, $street)
    {
        return static::where(['zip' => $zip, 'street' => $street])->firstOrFail();
    }

    public function getPriceAttribute($price)
    {
        return '$' . number_format($price);
    }

    /**
     * attach photo model to flyers
     * @param $photo
     */
    public function addPhoto($photo)
    {
        $this->photos()->save($photo);
    }

    /**
     * A flyer is composed of many photos
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function photos()
    {
        return $this->hasMany(Photo::class);
    }


    /**
     * flyer owned by a user
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    /**
     * Determine if the given user created the flyer
     * @param User $user
     * @return bool
     */
    public function ownedBy(User $user)
    {
        return $this->user_id === $user->id;
    }
}
