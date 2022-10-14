<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Support\Carbon;
use Intervention\Image\Facades\Image;

class BlogController extends Controller
{
    //
    public function AllBlog(){

        $blogs = Blog::latest()->get();
        return view('admin.blogs.blogs_all', compact('blogs'));

    }//end method

    //
    public function AddBlog(){

        $categories = BlogCategory::orderBy('blog_category', 'asc')->get();
        return view('admin.blogs.blogs_add', compact('categories'));

    }//end method

    //
    public function StoreBlog(Request $request){

            $request->validate([
                'blog_category_id' => 'required',
                'blog_title' => 'required',
                'blog_tags' => 'required',
                'blog_description' => 'required',
                'blog_image' => 'required|image|mimes:jpeg,jpg,png,gif,csv,svg'
            ]);

            if($request->hasFile('blog_image')){

                $image = $request->file('blog_image');

                    $filename = hexdec(uniqid()).'blog_image.'.$image->getClientOriginalExtension();
                    Image::make($image)->resize(430, 327)->save('frontend/assets/img/blog/'.$filename);

                    $save_url = 'frontend/assets/img/blog/' . $filename;

                    Blog::insert([
                        'blog_category_id' => $request->blog_category_id,
                        'blog_title' => $request->blog_title,
                        'blog_tags' => $request->blog_tags,
                        'blog_description' => $request->blog_description,
                        'blog_image' => $save_url,
                        'created_at' => Carbon::now()
                    ]);

                    // Toastr notification
                    $notification = array(
                        'message' => 'Blog Data Inserted Successfully',
                        'alert-type' => 'success'
                    );

                return redirect()->route('all.blog')->with($notification);

        }//end if

    }//end method

    //
    public function EditBlog($id){

        $blogs = Blog::findOrFail($id);
        $categories = BlogCategory::orderBy('blog_category', 'asc')->get();
        return view('admin.blogs.edit_blog', compact('blogs', 'categories'));

    }//end method


    //
    public function UpdateBlog(Request $request){

        $blogId = $request->id;

        //
        if($request->hasFile('edit_blog_image')){

            $request->validate([
                'edit_blog_image' => 'image|mimes:jpeg,jpg,png,gif,csv,svg'
            ]);

            $blogData = Blog::findOrFail($blogId);
            $oldImage = $blogData->blog_image;
            unlink($oldImage);

            $image = $request->file('edit_blog_image');

            $filename = hexdec(uniqid()).'blog_image.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(430, 327)->save('frontend/assets/img/blog/'.$filename);

            $save_url = 'frontend/assets/img/blog/' . $filename;

            Blog::findOrFail($blogId)->update([
                'blog_category_id' => $request->edit_blog_category_id,
                'blog_title' => $request->edit_blog_title,
                'blog_tags' => $request->edit_blog_tags,
                'blog_description' => $request->edit_blog_description,
                'blog_image' => $save_url
            ]);

            // Toastr notification
            $notification = array(
                'message' => 'Blog Updated with Image Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('all.blog')->with($notification);


        }else {

            Blog::findOrFail($blogId)->update([
                'blog_category_id' => $request->edit_blog_category_id,
                'blog_title' => $request->edit_blog_title,
                'blog_tags' => $request->edit_blog_tags,
                'blog_description' => $request->edit_blog_description
            ]);

            // Toastr notification
            $notification = array(
                'message' => 'Blog Updated Without Image Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('all.blog')->with($notification);

        }//end if else


   }//end method


   //
   public function DeleteBlog($id){

        $blogData = Blog::findOrFail($id);
        $Image = $blogData->blog_image;
        unlink($Image);

        Blog::findOrFail($id)->delete();

        // Toastr notification
        $notification = array(
            'message' => 'Blog Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }//end method
   //
   public function BlogDetails($id){

        $blogDetails = Blog::findOrFail($id);
        return view('frontend.blog_details', compact('blogDetails'));

    }//end method

}
