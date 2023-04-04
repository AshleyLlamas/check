<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $config = array();
        // $config['center'] = 'auto';
        // $config['onboundschanged'] = 'if (!centreGot) {
        //         var mapCentre = map.getCenter();
        //         marker_0.setOptions({
        //             position: new google.maps.LatLng(mapCentre.lat(), mapCentre.lng())
        //         });
        //     }
        //     centreGot = true;';

        // app('map')->initialize($config);

        // // set up the marker ready for positioning
        // // once we know the users location
        // $marker = array();
        // app('map')->add_marker($marker);

        // $map = app('map')->create_map();

        //return view('home', compact('map'));

        return view('home');
    }

    public function create(Request $request)
    {
        $img =  $request->get('image');
        $folderPath = "pruebas/";
        $image_parts = explode(";base64,", $img);

        foreach ($image_parts as $key => $image){
            $image_base64 = base64_decode($image);
        }

        $fileName = uniqid() . '.png';
        $file = $folderPath . $fileName;
        file_put_contents($file, $image_base64);

        dd(':D');

        return redirect()->back()->with('success', 'Data submitted Successfully');


    }
}
