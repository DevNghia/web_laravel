<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Blog;

class BlogController extends Controller
{
    public function AuthLogin()
    {
        $admin_id = Session()->get('admin_id');
        if ($admin_id) {
            return Redirect::to('/dashboard');
        } else {
            return Redirect::to('/admin')->send();
        }
    }
    public function add_blog()
    {
        $this->AuthLogin();
        return view('admin.add_blog');
    }
    public function all_blog()
    {
        $this->AuthLogin();
        $blog = Blog::orderby('blog_id', 'DESC')->get();
        return view('admin.all_blog')->with(compact('blog'));
    }
    public function save_blog(Request $request)
    {
        $data = $request->all();
        $blog = new Blog;
        $blog->blog_title = $data['blog_title'];
        $blog->blog_content = $data['blog_content'];
        $get_image = $request->file('blog_image');

        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/product', $new_image);
            $blog->blog_image = $new_image;
            $blog->save();
            Session()->put('message', 'Thêm bài viết thành công');
            return Redirect::to('add-blog');
        }
        $blog->blog_image = '';
        $blog->save();
        Session()->put('message', 'Thêm bài viêt thành công');
        return Redirect::to('add-blog');
    }
    public function delete_blog($blog_id)
    {
        $blog = Blog::find($blog_id);
        $blog->delete();
        Session()->put('message', 'Xóa bài viết thành công');
        return Redirect::to('all-blog');
    }
    public function edit_blog($blog_id)
    {
        $this->AuthLogin();
        $edit_blog = Blog::where('blog_id', $blog_id)->get();
        $manager_blog = view('admin.edit_blog')->with('edit_blog', $edit_blog);
        return view('admin_layout')->with('admin.edit_blog', $manager_blog);
    }
    public function update_blog(Request $request, $blog_id)
    {
        $data = $request->all();
        $blog = Blog::find($blog_id);
        $blog->blog_title = $data['blog_title'];
        $blog->blog_content = $data['blog_content'];
        $get_image = $request->file('blog_image');

        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/product', $new_image);
            $blog->blog_image = $new_image;
            $blog->update();
            Session()->put('message', 'Cập nhât viết thành công');
            return Redirect::to('all-blog');
        }
        $blog->update();
        Session()->put('message', 'Cập nhật bài viêt thành công');
        return Redirect::to('all-blog');
    }
}
