<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
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
    public function add_banner()
    {
        $this->AuthLogin();
        return view('admin.add_banner');
    }
    public function all_banner()
    {
        $this->AuthLogin();
        $banner = Banner::orderby('banner_id', 'DESC')->get();
        return view('admin.all_banner')->with(compact('banner'));
    }
    public function save_banner(Request $request)
    {
        $data = $request->all();
        $banner = new Banner;
        $banner->banner_name = $data['banner_name'];
        $banner->banner_status = $data['banner_status'];
        $get_image = $request->file('banner_image');

        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/product', $new_image);
            $banner->banner_image = $new_image;
            $banner->save();
            Session()->put('message', 'Thêm banner thành công');
            return Redirect::to('add-banner');
        }
        $banner->banner_image = '';
        $banner->save();
        Session()->put('message', 'Thêm banner thành công');
        return Redirect::to('add-banner');
    }
    public function delete_banner($banner_id)
    {
        $banner = Banner::find($banner_id);
        $banner->delete();
        Session()->put('message', 'Xóa mã banner thành công');
        return Redirect::to('all-banner');
    }
    public function unactive_banner($banner_id)
    {
        $this->AuthLogin();
        Banner::where('banner_id', $banner_id)->update(['banner_status' => 1]);
        Session()->put('message', 'kích hoạt banner thành công');
        return Redirect::to('all-banner');
    }
    public function active_banner($banner_id)
    {
        $this->AuthLogin();
        Banner::where('banner_id', $banner_id)->update(['banner_status' => 0]);
        Session()->put('message', 'Không kích hoạt banner thành công');
        return Redirect::to('all-banner');
    }
}
