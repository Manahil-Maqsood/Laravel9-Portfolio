<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomeSlide;
use Intervention\Image\Facades\Image;

class HomeSliderController extends Controller
{
    //
    public function HomeSlider(){

        $homeslide = HomeSlide::find(1);
        return view('admin.home_slide.home_slide_all', compact('homeslide'));

    }//end method


    //
    public function UpdateSlider(Request $request){

        $slide_id = $request->id;

        //
        if($request->hasFile('slide_image')){

            $request->validate([
                'slide_image' => 'image|mimes:jpeg,png,jpg,svg|max:2048'
            ]);

            $image = $request->file('slide_image');

            $filename = hexdec(uniqid()).'banner.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(636, 852)->save('frontend/assets/img/banner/'.$filename);

            $save_url = $filename;

            HomeSlide::findOrFail($slide_id)->update([
                'title' => $request->title,
                'short_title' => $request->short_title,
                'video_url' => $request->video_url,
                'slide_img' => $save_url
            ]);

            // Toastr notification
            $notification = array(
                'message' => 'Home Slider Updated With Image Successfully',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);


        }else {
            HomeSlide::findOrFail($slide_id)->update([
                'title' => $request->title,
                'short_title' => $request->short_title,
                'video_url' => $request->video_url
            ]);

            // Toastr notification
            $notification = array(
                'message' => 'Home Slider Updated Without Image Successfully',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);

        }//end if else

    }//end method
}

