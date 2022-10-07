<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\About;
use App\Models\MultiImage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Carbon;

class AboutPageController extends Controller
{

    //
    public function AboutDetail(){

        return view('frontend.about');

    }//end method

    //
    public function AboutPage(){

        $aboutpage = About::find(1);
        return view('admin.about_page.about_page_all', compact('aboutpage'));

    }//end method

    //
    public function UpdateAbout(Request $request){

        $about_id = $request->id;

        //
        if($request->hasFile('about_image')){

            $request->validate([
                'about_image' => 'image|mimes:jpeg,png,jpg,gif,svg'
            ]);

            $image = $request->file('about_image');

            $filename = hexdec(uniqid()).'about_img.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(523, 605)->save('frontend/assets/img/images/'.$filename);

            $save_url = $filename;

            About::findOrFail($about_id)->update([
                'title' => $request->title,
                'short_title' => $request->short_title,
                'short_description' => $request->short_description,
                'long_description' => $request->long_description,
                'about_image' => $save_url
            ]);

            // Toastr notification
            $notification = array(
                'message' => 'About Page Updated With Image Successfully',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);


        }else {
            About::findOrFail($about_id)->update([
                'title' => $request->title,
                'short_title' => $request->short_title,
                'short_description' => $request->short_description,
                'long_description' => $request->long_description
            ]);

            // Toastr notification
            $notification = array(
                'message' => 'About Page Updated Without Image Successfully',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);

        }//end if else

    }//end method

    //
    public function MultiImage(){

        return view('admin.about_page.add_multi_image');

    }//end method


    //
    public function StoreMultiImage(Request $request){

        $request->validate([
            'multi_image' => 'required',
            'multi_image.*' => 'image|mimes:jpeg,jpg,png,gif,csv,svg'
        ]);

        if($request->hasFile('multi_image')){

            $image = $request->file('multi_image');

            foreach ($image as $multi_image) {

                $filename = hexdec(uniqid()).'multiimage.'.$multi_image->getClientOriginalExtension();
                Image::make($multi_image)->resize(220, 220)->save('frontend/assets/img/multi-images/'.$filename);

                $save_url = 'frontend/assets/img/multi-images/' . $filename;

                MultiImage::insert([
                    'multi_image' => $save_url,
                    'created_at' => Carbon::now()
                ]);

            }//end foreach
                // Toastr notification
                $notification = array(
                    'message' => 'Multi Image Inserted Successfully',
                    'alert-type' => 'success'
                );

            return redirect()->back()->with($notification);

    }//end if

    }//end method


    //
    public function AllMultiImage(){

        $allMultiImage = MultiImage::all();
        return view('admin.about_page.all_multi_image', compact('allMultiImage'));

    }//end method


    //
    public function EditMultiImage($id){

        $multiImageData = MultiImage::findOrFail($id);
        return view('admin.about_page.edit_multi_image', compact('multiImageData'));

    }//end method


    //
    public function UpdateMultiImage(Request $request){

        $multiImageData = $request->id;

        //
        if($request->hasFile('update_multi_image')){

            $request->validate([
                'update_multi_image' => 'image|mimes:jpeg,png,jpg,gif,svg'
            ]);

            $image = $request->file('update_multi_image');

            $filename = hexdec(uniqid()).'multiimage.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(220, 220)->save('frontend/assets/img/multi-images/'.$filename);

            $save_url = 'frontend/assets/img/multi-images/' . $filename;

            MultiImage::findOrFail($multiImageData)->update([
                'multi_image' => $save_url
            ]);

            // Toastr notification
            $notification = array(
                'message' => 'Multi Image Updated Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('all.multi.image')->with($notification);


        }else {
            // Toastr notification
            $notification = array(
                'message' => 'No Image Updated',
                'alert-type' => 'warning'
            );

            return redirect()->route('all.multi.image')->with($notification);

        }//end if else

    }//end method

    //
    public function DeleteMultiImage($id){

        $multiImageData = MultiImage::findOrFail($id);
        $image = $multiImageData->multi_image;
        unlink($image);

        MultiImage::findOrFail($id)->delete();
         // Toastr notification
         $notification = array(
            'message' => 'Multi Image Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }//end method
}
