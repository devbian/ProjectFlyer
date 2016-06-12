<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flyer extends Model
{

    /**
     * fillable fields
     * @var array
     */
    protected  $fillable=[
        'street',
        'city',
        'state',
        'country',
        'zip',
        'price',
        'description'
    ];

    /**
     * @param $query
     * @param string $zip
     * @param string $street
     * @return mixed
     */
    public function scopeLocateAt($query, $zip, $street)
    {
        return $query->where(['zip' => $zip, 'street' => $street]);
    }

    public function getPriceAttribute($price)
    {
        return '$'.number_format($price);
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
