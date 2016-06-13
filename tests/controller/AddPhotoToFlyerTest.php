<?php
namespace  App;

use Mockery as m;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class AddPhotoToFlyerTest extends \TestCase
{
    /** @test */
    function it_photo_flyer()
    {
        $flyer = factory(Flyer::class)->create();

        $file = m::mock(UploadedFile::class, [
            'getClientOriginalName' => 'foo',
            'getClientOriginalExtension' => 'jpg'
        ]);

        $file->shouldReceive('move')
            ->once()
            ->with('flyer/photos', 'nowfoo.jpg');

        $thumbnail = m::mock(Thumbnail::class);
        $thumbnail->shouldReceive('make')
            ->once()
            ->with('flyer/photos/nowfoo.jpg', 'flyer/photos/tn-nowfoo.jpg');

        $form = new AddPhotoToFlyer($flyer, $file, $thumbnail);
        $form->save();
        $this->assertCount(1, $flyer->photos);
    }
}

function time()
{
    return 'now';
}

function sha1($path)
{
    return $path;
}
