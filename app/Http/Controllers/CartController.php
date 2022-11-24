<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Redirect;
use Gloudemans\Shoppingcart\Facades\Cart;


session_start();
class CartController extends Controller
{
    public function count_carts()
    {
        Cart::count();


        $output = '';
        $output .= '<a href="/show-cart"><i class="fa fa-shopping-cart"></i> 
									<span class="quanlity">' .
            Cart::count() . '</span>
									
									Giỏ hàng</a>';
        echo $output;
    }
    // public function gio_hang(Request $request)
    // {
    //     $cate_product = DB::table('tbl_category_product')->orderBy('category_id', 'desc')->get();
    //     $brand_product = DB::table('tbl_brand_product')->orderBy('brand_id', 'desc')->get();
    //     $meta_title = "Giỏ hàng ";
    //     $meta_desc = "Giỏ hàng của bạn";
    //     $meta_keywords = "Giỏ hàng Ajax";
    //     $url_canonical = $request->url();
    //     return view('pages.cart.cart_ajax')->with('cate_product', $cate_product)->with('brand_product', $brand_product)->with(compact('meta_title', 'meta_desc', 'meta_keywords', 'url_canonical'));
    // }
    // public function add_cart_ajax(Request $request)
    // {
    //     $data = $request->all();
    //     $session_id = substr(md5(microtime()), rand(0, 26), 5);
    //     $cart = Session()->get('cart');
    //     if ($cart == true) {
    //         $is_avaiable = 0;

    //         foreach ($cart as $key => $val) {
    //             if ($val['product_id'] == $data['cart_product_id']) {
    //                 $is_avaiable++;
    //             }
    //         }

    //         if ($is_avaiable == 0) {
    //             $cart[] = array(
    //                 'session_id' => $session_id,
    //                 'product_name' => $data['cart_product_name'],
    //                 'product_id' => $data['cart_product_id'],
    //                 'product_image' => $data['cart_product_image'],
    //                 'product_qty' =>  $data['cart_product_qty'],
    //                 'product_price' => $data['cart_product_price'],
    //             );


    //             Session()->put('cart', $cart);
    //         }
    //     } else {
    //         $cart[] = array(
    //             'session_id' => $session_id,
    //             'product_name' => $data['cart_product_name'],
    //             'product_id' => $data['cart_product_id'],
    //             'product_image' => $data['cart_product_image'],
    //             'product_qty' => $data['cart_product_qty'],
    //             'product_price' => $data['cart_product_price'],
    //         );


    //         Session()->put('cart', $cart);
    //     }
    //     Session()->save();
    // }
    public function del_cart($session_id)
    {
        $cart = Session()->get('cart');
        if ($cart == true) {
            foreach ($cart as $key => $val) {
                if ($val['session_id'] == $session_id) {
                    unset($cart[$key]);
                    Session()->forget('voucher');
                }
            }
            Session()->put('cart', $cart);
            // session()->flush();
            return redirect()->back()->with('message', 'Xóa sản phẩm thành công');
        } else {
            return redirect()->back()->with('message', 'Xóa sản phẩm thất bại');
        }
    }
    public function update_cart(Request $request)
    {
        $data = $request->all();
        $cart = Session()->get('cart');
        if ($cart == true) {
            foreach ($data['cart_quantity'] as $key => $qty) {
                foreach ($cart as $session => $val) {
                    if ($val['session_id'] == $key) {
                        $cart[$session]['product_qty'] = $qty;
                    }
                }
            }
            Session()->put('cart', $cart);
            return redirect()->back()->with('message', 'Cập nhật số lượng thành công');
        } else {
            return redirect()->back()->with('message', 'Cập nhật số lượng thất bại');
        }
    }
    public function save_to_cart(Request $request)
    {

        $datas = $request->all();
        $product_info = DB::table('tbl_product')->where('product_id', $datas['cart_product_id'])->first();
        $data['id'] = $datas['cart_product_id'];
        $data['qty'] = $datas['cart_product_qty'];
        $data['name'] = $datas['cart_product_name'];
        $data['price'] = $datas['cart_product_price'];
        $data['weight'] = '123';
        $data['options']['image'] = $datas['cart_product_image'];
        Cart::add($data);
        Cart::setGlobalTax(10);
        // cart::destroy();
        // return Redirect::to('/show-cart');
    }
    public function save_cart(Request $request)
    {
        $datas = $request->all();
        $session_id = substr(md5(microtime()), rand(0, 26), 5);
        $productId = $request->productid_hidden;
        $quantity = $request->qty;
        $product_info = DB::table('tbl_product')->where('product_id', $productId)->first();
        $data['id'] = $product_info->product_id;
        $data['qty'] = $quantity;
        $data['name'] = $product_info->product_name;
        $data['price'] = $product_info->product_price;
        $data['weight'] = '123';
        $data['options']['image'] = $product_info->product_image;
        Cart::add($data);
        Cart::setGlobalTax(10);
        // cart::destroy();
        return Redirect::to('/show-cart');
    }
    public function show_cart(Request $request)
    {
        $cate_product = DB::table('tbl_category_product')->orderBy('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand_product')->orderBy('brand_id', 'desc')->get();
        $meta_title = "Giỏ hàng";
        $meta_desc = "các sản phẩm trong giỏ";
        $meta_keywords = "điện thoại, laptop, sp4, xbox one";
        $url_canonical = $request->url();
        return view('pages.cart.show_cart')->with('cate_product', $cate_product)->with('brand_product', $brand_product)->with(compact('meta_title', 'meta_desc', 'meta_keywords', 'url_canonical'));
    }
    public function delete_cart($rowId)
    {

        Cart::remove($rowId);
        // cart::destroy();
        return Redirect::to('/show-cart');
    }
    public function update_quantity_cart(Request $request)

    {
        $rowId = $request->rowId_cart;
        $qty = $request->cart_quantity;
        Cart::update($rowId, $qty);
        return Redirect::to('/show-cart');
    }
}
