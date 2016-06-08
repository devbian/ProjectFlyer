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
     * A flyer is composed of many photos
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function photos()
    {
        return $this->hasMany(Photo::class);
    }
}
