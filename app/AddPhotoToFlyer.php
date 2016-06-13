<?php

namespace App;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class AddPhotoToFlyer
{
    protected $flyer;

    /**
     * @var UploadedFile
     */
    protected $file;

    /**
     * @var Thumbnail
     */
    protected $thumbnail;

    /**
     * AddPhotoToFlyer constructor.
     * @param Flyer $flyer
     * @param UploadedFile $file
     * @param Thumbnail $thumbnail
     */
    public function __construct(Flyer $flyer, UploadedFile $file, Thumbnail $thumbnail = null)
    {
        $this->flyer = $flyer;
        $this->file = $file;
        $this->thumbnail = $thumbnail ?: new Thumbnail();
    }

    public function save()
    {
        $photo = $this->flyer->addPhoto($this->makePhoto());

        $this->file->move($photo->baseDir(), $photo->name);

        $this->thumbnail->make($photo->path, $photo->thumbnail_path);
    }


    protected function makePhoto()
    {
        return new Photo(['name' => $this->makeFileName()]);
    }

    protected function makeFileName()
    {
        $name = sha1(
            time() . $this->file->getClientOriginalName()
        );
        $extention = $this->file->getClientOriginalExtension();
        return "{$name}.{$extention}";
    }


}

