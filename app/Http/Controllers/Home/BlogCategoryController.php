<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogCategory;
use Illuminate\Support\Carbon;
use Intervention\Image\Facades\Image;

class BlogCategoryController extends Controller
{
    //
    public function AllBlogCategory(){

        $blogCategory = BlogCategory::latest()->get();
        return view('admin.blog_category.blog_all_category', compact('blogCategory'));

    }//end method

    //
    public function AddBlogCategory(){

        return view('admin.blog_category.blog_add_category');

    }//end method

    //
    public function StoreBlogCategory(Request $request){

        $request->validate([
            'blog_category' => 'required'
        ]);

        BlogCategory::insert([
            'blog_category' => $request->blog_category,
            'created_at' => Carbon::now()
        ]);

        // Toastr notification
        $notification = array(
            'message' => 'Blog Category Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.blog.category')->with($notification);

    }//end method

    //
    public function EditBlogCategory($id){

        $blogCategoryData = BlogCategory::findOrFail($id);
        return view('admin.blog_category.edit_blog_category', compact('blogCategoryData'));

    }//end method

    //
    public function UpdateBlogCategory(Request $request){

        $blogCategoryId = $request->id;

        BlogCategory::findOrFail($blogCategoryId)->update([
            'blog_category' => $request->edit_blog_category
        ]);

        // Toastr notification
        $notification = array(
            'message' => 'Blog Category Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.blog.category')->with($notification);

    }//end method


     //
     public function DeleteBlogCategory($id){

        BlogCategory::findOrFail($id)->delete();

         // Toastr notification
         $notification = array(
            'message' => 'Blog Category Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }//end method
}
