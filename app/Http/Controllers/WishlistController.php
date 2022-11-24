<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WishlistController extends Controller
{
    public function show_wishlist(Request $request)
    {
        $cate_product = DB::table('tbl_category_product')->orderBy('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand_product')->orderBy('brand_id', 'desc')->get();
        $meta_title = "Yêu thích";
        $meta_desc = "Danh sách yêu thích";
        $meta_keywords = "yêu thích";
        $url_canonical = $request->url();
        $product = DB::table('tbl_product')->where('product_status', '1')->first();
        return view('pages.wishlist')->with(compact('cate_product', 'brand_product', 'meta_title', 'meta_desc', 'meta_keywords', 'url_canonical', 'product'));
    }
    public function add_to_wishlist(Request $request)
    {
        $data = $request->all();
        $session_id = substr(md5(microtime()), rand(0, 26), 5);
        $wishlist = Session()->get('wishlist');
        if ($wishlist == true) {
            $is_avaiable = 0;

            foreach ($wishlist as $key => $val) {
                if ($val['product_id'] == $data['cart_product_id']) {
                    $is_avaiable++;
                }
            }

            if ($is_avaiable == 0) {
                $wishlist[] = array(
                    'session_id' => $session_id,
                    'product_name' => $data['cart_product_name'],
                    'product_id' => $data['cart_product_id'],
                    'product_image' => $data['cart_product_image'],
                    'product_qty' =>  $data['cart_product_qty'],
                    'product_price' => $data['cart_product_price'],
                );


                Session()->put('wishlist', $wishlist);
            }
        } else {
            $wishlist[] = array(
                'session_id' => $session_id,
                'product_name' => $data['cart_product_name'],
                'product_id' => $data['cart_product_id'],
                'product_image' => $data['cart_product_image'],
                'product_qty' => $data['cart_product_qty'],
                'product_price' => $data['cart_product_price'],
            );


            Session()->put('wishlist', $wishlist);
        }
        Session()->save();
    }
}
