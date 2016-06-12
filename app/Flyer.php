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
}
