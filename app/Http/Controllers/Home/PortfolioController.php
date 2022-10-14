<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Portfolio;
use Illuminate\Support\Carbon;
use Intervention\Image\Facades\Image;

class PortfolioController extends Controller
{
    //
    public function Portfolio(){

        return view('frontend.portfolio');

    }//end method

    //
    public function PortfolioDetail(){

        return view('frontend.portfolio_details');

    }//end method

    //
    public function AllPortfolio(){

        $portfolio = Portfolio::latest()->get();
        return view('admin.portfolio_page.portfolio_all_home', compact('portfolio'));

    }//end method

    //
    public function AddPortfolio(){

        return view('admin.portfolio_page.portfolio_add');

    }//end method


    //
    public function SavePortfolio(Request $request){

        $request->validate([
            'portfolio_name' => 'required',
            'portfolio_title' => 'required',
            'portfolio_image' => 'required|image|mimes:jpeg,jpg,png,gif,csv,svg'
        ]);

        if($request->hasFile('portfolio_image')){

            $image = $request->file('portfolio_image');

                $filename = hexdec(uniqid()).'portfolio_image.'.$image->getClientOriginalExtension();
                Image::make($image)->resize(1020, 520)->save('frontend/assets/img/portfolio/'.$filename);

                $save_url = 'frontend/assets/img/portfolio/' . $filename;

                Portfolio::insert([
                    'portfolio_name' => $request->portfolio_name,
                    'portfolio_title' => $request->portfolio_title,
                    'portfolio_image' => $save_url,
                    'created_at' => Carbon::now()
                ]);

                // Toastr notification
                $notification = array(
                    'message' => 'Portfolio Inserted Successfully',
                    'alert-type' => 'success'
                );

            return redirect()->route('portfolio.all')->with($notification);

    }//end if

    }//end method

    //
    public function EditPortfolio($id){

        $portfolioData = Portfolio::findOrFail($id);
        return view('admin.portfolio_page.edit_portfolio', compact('portfolioData'));

    }//end method

    //
    public function SaveUpdatePortfolio(Request $request){

        $portfolioId = $request->id;

         //
         if($request->hasFile('portfolio_image')){

            $request->validate([
                'portfolio_image' => 'image|mimes:jpeg,png,jpg,gif,svg'
            ]);

            $portfolioData = Portfolio::findOrFail($portfolioId);
            $oldImage = $portfolioData->portfolio_image;
            unlink($oldImage);

            $image = $request->file('portfolio_image');

            $filename = hexdec(uniqid()).'portfolio_image.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(1020, 520)->save('frontend/assets/img/portfolio/'.$filename);

            $save_url = 'frontend/assets/img/portfolio/' . $filename;

            Portfolio::findOrFail($portfolioId)->update([
                'portfolio_name' => $request->portfolio_name,
                'portfolio_title' => $request->portfolio_title,
                'portfolio_image' => $save_url
            ]);

            // Toastr notification
            $notification = array(
                'message' => 'Portfolio Updated with Image Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('portfolio.all')->with($notification);


        }else {

            Portfolio::findOrFail($portfolioId)->update([
                'portfolio_name' => $request->portfolio_name,
                'portfolio_title' => $request->portfolio_title
            ]);

            // Toastr notification
            $notification = array(
                'message' => 'Portfolio Updated Without Image Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('portfolio.all')->with($notification);

        }//end if else


    }//end method


    //
    public function DeletePortfolio($id){

        $portfolioData = Portfolio::findOrFail($id);
        $image = $portfolioData->portfolio_image;
        unlink($image);

        Portfolio::findOrFail($id)->delete();
         // Toastr notification
         $notification = array(
            'message' => 'Portfolio Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }//end method
}
