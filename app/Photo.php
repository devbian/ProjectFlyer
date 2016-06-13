<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Image;
use File;

class Photo extends Model
{
    protected $table = 'flyer_photos';

    protected $fillable = ['path', 'name', 'thumbnail_path'];

    public function setNameAttribute($name)
    {
        $this->attributes['name'] = $name;

        $this->path = $this->baseDir() . '/' . $name;
        $this->thumbnail_path = $this->baseDir() . '/tn-' . $name;
    }

    public function baseDir()
    {
        return 'flyer/photos';
    }

    /**
     * relationship with flyer
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function flyer()
    {
        return $this->belongsTo(Flyer::class);
    }


    /**
     * delete photo in disk and delete it from db
     * @throws \Exception
     */
    public function delete()
    {
        File::delete([
            $this->path,
            $this->thumbnail_path
        ]);

        parent::delete();
    }
}
