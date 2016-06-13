<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddPhotoRequest;
use Auth;
use App\Flyer;
use App\Photo;
use App\Http\Requests\FlyerRequest;
use Illuminate\Http\Request;
use App\Http\Requests;

class FlyersController extends Controller
{
    /**
     * FlyersController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show']]);
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response('Flyers Index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('flyers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param FlyerRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(FlyerRequest $request)
    {
        Flyer::create($request->all());
        flash()->success('success', 'create flyer success');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param $zip
     * @param $street
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function show($zip, $street)
    {
        $street = str_replace('-', ' ', $street);
        $flyer = Flyer::locateAt($zip, $street);
        return view('flyers.show', compact('flyer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }

    /**
     * @param $zip
     * @param $street
     * @param AddPhotoRequest|Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function addPhoto($zip, $street, AddPhotoRequest $request)
    {
        $photo = Photo::fromFile($request->file('photo'));
        Flyer::locateAt($zip, $street)->addPhoto($photo);
        return 'Done';
    }


    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Symfony\Component\HttpFoundation\Response
     */
    public function unauthorized(Request $request)
    {
        if ($request->ajax()) {
            return response(['message' => 'No way.'], 403);
        }
        flash('No way');
        return redirect('/');
    }
}
