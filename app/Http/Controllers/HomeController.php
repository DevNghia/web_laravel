<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Product;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $banner = Banner::where('banner_status', '1')->get();
        $meta_desc = "Chuyên bán những phụ kiện điện tử";
        $meta_keywords = "điện thoại, laptop, máy tính bảng, phụ kiện điện tử";
        $meta_title = "Fptshop.com.vn | Điện thoại, Laptop, Tablet, Phụ kiện chính hãng giá tốt nhất";
        $url_canonical = $request->url();
        //seo
        $cate_product = DB::table('tbl_category_product')->where('category_status', '1')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status', '1')->get();
        $product = DB::table('tbl_product')->where('product_status', '1')->orderBy('product_id', 'DESC')->limit(6)->get();
        // return view('pages.home')->with('cate_product', $cate_product)->with('brand_product', $brand_product)->with('product', $product);
        return view('pages.home')->with(compact('cate_product', 'brand_product', 'product', 'meta_desc', 'meta_keywords', 'meta_title', 'url_canonical', 'banner'));
    }
    public function search_product(Request $request)
    {
        $keywords = $_GET['keyword_submit'];
        $cate_product = DB::table('tbl_category_product')->where('category_status', '1')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status', '1')->get();
        $search = DB::table('tbl_product')->where('product_status', '1')->where('product_name', 'like', '%' . $keywords . '%')->get();
        $meta_title = $keywords;
        $meta_desc = "Tìm kiếm sản phẩm";
        $meta_keywords = "Tìm kiếm sản phẩm";
        $url_canonical = $request->url();
        return view('pages.product.search', compact('keywords'))->with('cate_product', $cate_product)->with('brand_product', $brand_product)->with('search', $search)->with(compact('meta_title', 'meta_desc', 'meta_keywords', 'url_canonical'));
    }
    public function show_404()
    {
        return view('pages.404');
    }
    public function contact_us(Request $request)
    {
        $meta_title = "Contact Us";
        $meta_desc = "Contact Us";
        $meta_keywords = "Contact Us";
        $url_canonical = $request->url();
        return view('pages.contact_us')->with(compact('meta_title', 'meta_desc', 'meta_keywords', 'url_canonical'));;
    }
    public function shop(Request $request)
    {
        $meta_title = "Tất cả sản phẩm";
        $meta_desc = "Tất cả sản phẩm";
        $meta_keywords = "Tất cả sản phẩm";
        $url_canonical = $request->url();
        $cate_product = DB::table('tbl_category_product')->where('category_status', '1')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status', '1')->get();
        $product = Product::where('product_status', '1')->paginate(5);
        return view('pages.shop')->with(compact('meta_title', 'meta_desc', 'meta_keywords', 'url_canonical', 'cate_product', 'brand_product', 'product'));
    }
    public function blog(Request $request)
    {
        $blog = Blog::orderby('blog_id', 'DESC')->paginate(2);
        $meta_title = "Bài viết";
        $meta_desc = "Bài viết";
        $meta_keywords = "Bài viết";
        $url_canonical = $request->url();
        $cate_product = DB::table('tbl_category_product')->where('category_status', '1')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status', '1')->get();
        return view('pages.blog')->with(compact('meta_title', 'meta_desc', 'meta_keywords', 'url_canonical', 'cate_product', 'brand_product', 'blog'));
    }
    public function blog_detail(Request $request, $blog_id)
    {
        $blog = Blog::where('blog_id', $blog_id)->first();
        $meta_title = $blog->blog_title;
        $meta_desc = "Bài viết";
        $meta_keywords = "Bài viết";
        $url_canonical = $request->url();
        $cate_product = DB::table('tbl_category_product')->where('category_status', '1')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status', '1')->get();
        return view('pages.blog_detail')->with(compact('meta_title', 'meta_desc', 'meta_keywords', 'url_canonical', 'cate_product', 'brand_product', 'blog'));
    }
}
