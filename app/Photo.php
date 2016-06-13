<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Image;

class Photo extends Model
{
    protected $table = 'flyer_photos';

    protected $fillable = ['path', 'name', 'thumbnail_path'];

    protected $baseDir = 'flyer/photos';

    /**
     * @var UploadedFile
     */
    protected $file;

    /**
     * when photo model created, boot it
     */
    protected static function boot()
    {
        static::creating(function ($photo) {
            $photo->upload();
        });
    }


    /**
     * Get photo instance from file
     * @param UploadedFile $file
     * @return static
     */
    public static function fromFile(UploadedFile $file)
    {
        $photo = new static;

        $photo->file = $file;

        $photo->fill([
            'name' => $photo->fileName(),
            'path' => $photo->filePath(),
            'thumbnail_path' => $photo->thumbnailPath()
        ]);
        return $photo;
    }

    public function fileName()
    {
        $name = sha1(time() . $this->file->getClientOriginalName());
        $extention = $this->fileExtention();
        return "{$name}.{$extention}";
    }

    public function filePath()
    {
        return $this->baseDir . '/' . $this->fileName();
    }

    public function thumbnailPath()
    {
        return $this->baseDir . '/tn-' . $this->fileName();
    }

    public function fileExtention()
    {
        return $this->file->getClientOriginalExtension();
    }

    /**
     * upload file and return this instance
     * @return $this
     */
    public function upload()
    {
        $this->file->move($this->baseDir, $this->fileName());
        Image::make($this->filePath())
            ->fit(200)
            ->save($this->thumbnailPath());
        return $this;
    }

    /**
     * relationship with flyer
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function flyer()
    {
        return $this->belongsTo(Flyer::class);
    }
}
