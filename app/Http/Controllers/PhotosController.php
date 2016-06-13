<?php

namespace App\Http\Controllers;

use App\Flyer;
use App\Http\Requests;
use App\AddPhotoToFlyer;
use App\Http\Requests\AddPhotoRequest;

class PhotosController extends Controller
{

    /**
     * @param $zip
     * @param $street
     * @param AddPhotoRequest $request
     * @return string
     */
    public function store($zip, $street, AddPhotoRequest $request)
    {
        $flyer = Flyer::locateAt($zip, $street);
        $photo = $request->file('photo');

        (new AddPhotoToFlyer($flyer, $photo))->save();
    }
}
