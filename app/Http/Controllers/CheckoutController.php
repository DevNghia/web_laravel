<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\City;
use App\Models\Province;
use App\Models\Wards;
use App\Models\Feeship;
use App\Models\Shipping;
use App\Models\Order;
use App\Models\Orderdetail;

class CheckoutController extends Controller
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
    public function login_checkout(Request $request)
    {
        $cate_product = DB::table('tbl_category_product')->orderBy('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand_product')->orderBy('brand_id', 'desc')->get();
        $meta_title = "Đăng nhập|Đăng ký";
        $meta_desc = "Đăng nhập khách hàng";
        $meta_keywords = "Tên, tài khoản, mật khẩu";
        $url_canonical = $request->url();
        return view('pages.checkout.login_checkout')->with('cate_product', $cate_product)->with('brand_product', $brand_product)->with(compact('meta_title', 'meta_desc', 'meta_keywords', 'url_canonical'));
    }
    public function add_customer(Request $request)
    {
        $data = array();
        $data['customer_name'] = $request->customer_name;
        $data['customer_email'] = $request->customer_email;
        $data['customer_password'] = md5($request->customer_password);
        $data['customer_phone'] = $request->customer_phone;
        $customer_id = DB::table('tbl_customers')->insertGetId($data);
        Session()->put('customer_id', $customer_id);
        Session()->put('customer_name', $request->customer_name);
        return Redirect::to('/checkout');
    }
    public function checkout(Request $request)
    {
        $cate_product = DB::table('tbl_category_product')->orderBy('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand_product')->orderBy('brand_id', 'desc')->get();
        $meta_title = "Checkout";
        $meta_desc = "Khách hàng thanh toán";
        $meta_keywords = "...";
        $url_canonical = $request->url();
        $city = City::orderby('matp', 'ASC')->get();
        return view('pages.checkout.checkout')->with('cate_product', $cate_product)->with('brand_product', $brand_product)->with(compact('meta_title', 'meta_desc', 'meta_keywords', 'url_canonical', 'city'));
    }
    public function save_checkout_customer(Request $request)
    {
        $data = array();
        $data['shipping_name'] = $request->shipping_name;
        $data['shipping_email'] = $request->shipping_email;
        $data['shipping_message'] = $request->shipping_message;
        $data['shipping_phone'] = $request->shipping_phone;
        $data['shipping_address'] = $request->shipping_address;
        $shipping_id = DB::table('tbl_shipping')->insertGetId($data);
        Session()->put('shipping_id', $shipping_id);
        return Redirect::to('/payment');
    }
    public function payment(Request $request)
    {
        $cate_product = DB::table('tbl_category_product')->orderBy('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand_product')->orderBy('brand_id', 'desc')->get();
        $meta_title = "Thanh toán";
        $meta_desc = "Khách hàng thanh toán";
        $meta_keywords = "...";
        $url_canonical = $request->url();
        return view('pages.checkout.payment')->with('cate_product', $cate_product)->with('brand_product', $brand_product)->with(compact('meta_title', 'meta_desc', 'meta_keywords', 'url_canonical'));
    }
    public function order_place(Request $request)
    {
        //insert payment_method
        $data = array();
        $data['payment_method'] = $request->payment_option;
        $data['payment_status'] = 'Đang chờ xử lý';
        $payment_id = DB::table('tbl_payment')->insertGetId($data);

        //insert order
        $order_data = array();
        $order_data['customer_id'] = Session()->get('customer_id');
        $order_data['shipping_id'] = Session()->get('shipping_id');
        $order_data['payment_id'] = $payment_id;
        $order_data['order_total'] = Cart::total();
        $order_data['order_status'] = 'Đang chờ xử lý';
        $order_id = DB::table('tbl_order')->insertGetId($order_data);
        //insert order_details
        $content = Cart::content();
        foreach ($content as $v_content) {
            $order_d_data = array();
            $order_d_data['order_id'] = $order_id;
            $order_d_data['product_id'] = $v_content->id;
            $order_d_data['product_name'] = $v_content->name;
            $order_d_data['product_price'] = $v_content->price;
            $order_d_data['product_sales_quantity'] = $v_content->qty;
            DB::table('tbl_order_details')->insert($order_d_data);
        }
        if ($data['payment_method'] == 1) {
            echo 'Thanh toán thẻ ATM';
        } elseif ($data['payment_method'] == 2) {
            $cate_product = DB::table('tbl_category_product')->orderBy('category_id', 'desc')->get();
            $brand_product = DB::table('tbl_brand_product')->orderBy('brand_id', 'desc')->get();
            $meta_title = "Order";
            $meta_desc = "Khách hàng thanh toán";
            $meta_keywords = "...";
            $url_canonical = $request->url();
            return view('pages.checkout.handcash')->with('cate_product', $cate_product)->with('brand_product', $brand_product)->with(compact('meta_title', 'meta_desc', 'meta_keywords', 'url_canonical'));
        } else {
            echo 'Thẻ ghi nợ';
        }
    }
    public function logout_checkout()
    {
        Session()->flush();
        return Redirect::to('/login-checkout');
    }
    public function login_customer(Request $request)
    {
        $email = $request->email_account;
        $password = md5($request->password_account);
        $result = DB::table('tbl_customers')->where('customer_email', $email)->where('customer_password', $password)->first();
        if ($result) {
            Session()->put('customer_id', $result->customer_id);
            return Redirect::to('/checkout');
        } else {
            return Redirect::to('/login-checkout')->with('error', 'Email hoặc mật khẩu bị sai, vui lòng nhập lại');
        }
    }
    public function manage_order()
    {
        $this->AuthLogin();
        $all_order = DB::table('tbl_order')
            ->join('tbl_customers', 'tbl_order.customer_id', '=', 'tbl_customers.customer_id')
            ->select('tbl_order.*', 'tbl_customers.customer_name')
            ->orderBy('tbl_order.order_id', 'desc')->get();
        $manager_order = view('admin.manage_order')->with('all_order', $all_order);
        return view('admin_layout')->with('admin.manage_order', $manager_order);
    }
    public function view_order($order_id)
    {
        $this->AuthLogin();
        $order_detail = DB::table('tbl_order')
            ->join('tbl_customers', 'tbl_order.customer_id', '=', 'tbl_customers.customer_id')
            ->join('tbl_shipping', 'tbl_order.shipping_id', '=', 'tbl_shipping.shipping_id')
            ->join('tbl_order_details', 'tbl_order.order_id', '=', 'tbl_order_details.order_id')->where('tbl_order.order_id', $order_id)->get();
        return view('admin.view_order')->with('order_detail', $order_detail);
    }
    public function select_delivery_home(Request $request)
    {
        $data = $request->all();
        if ($data['action']) {
            $output = '';
            if ($data['action'] == 'city') {
                $select_province = Province::where('matp', $data['matp'])->orderby('maqh', 'ASC')->get();
                $output .= '<option>-Chọn quận huyện-</option>';
                foreach ($select_province as $key => $province) {
                    $output .= '<option value="' . $province->maqh . '">' . $province->name_quanhuyen . '</option>';
                }
            } else {
                $select_wards = Wards::where('maqh', $data['matp'])->orderby('xaid', 'ASC')->get();
                $output .= '<option>-Chọn xã phường-</option>';
                foreach ($select_wards as $key => $ward) {
                    $output .= '<option value="' . $ward->xaid . '">' . $ward->name_xaphuong . '</option>';
                }
            }
            echo $output;
        }
    }
    public function calculate_delivery(Request $request)
    {
        $data = $request->all();
        if ($data['city']) {
            $feeship = Feeship::where('fee_matp', $data['city'])->where('fee_maqh', $data['province'])->where('fee_xaid', $data['wards'])->get();
            if ($feeship) {
                $count_feeship = $feeship->count();
                if ($count_feeship > 0) {
                    foreach ($feeship as $key => $fee) {
                        Session()->put('fee', $fee->fee_feeship);
                        Session()->save();
                    }
                } else {
                    Session()->put('fee', 10000);
                    Session()->save();
                }
            }
        }
    }
    public function del_fee()
    {
        Session()->forget('fee');
        return redirect()->back();
    }
    public function comfirm_order(Request $request)
    {
        $data = $request->all();
        $shipping = new Shipping();
        $shipping->shipping_name = $data['shipping_name'];
        $shipping->shipping_email = $data['shipping_email'];
        $shipping->shipping_phone = $data['shipping_phone'];
        $shipping->shipping_address = $data['shipping_address'];
        $shipping->shipping_message = $data['shipping_message'];
        $shipping->shipping_method = $data['payment_select'];
        $shipping->save();
        $shipping_id = $shipping->shipping_id;
        $checkout_code = substr(md5(microtime()), rand(0, 26), 5);
        $order = new Order();
        $order->customer_id = Session()->get('customer_id');
        $order->shipping_id =  $shipping_id;
        $order->order_status = 1;
        $order->order_code = $checkout_code;
        $order->order_total = $data['order_total'];
        $order->order_total_after = $data['order_total_after'];
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $order->created_at = now();
        $order->save();
        $content = Cart::content();
        if (Session()->get('cart') == true) {

            foreach ($content as $key => $cart) {
                $order_detail = new Orderdetail();
                $order_detail->order_code = $checkout_code;
                $order_detail->product_id = $cart->id;
                $order_detail->product_name = $cart->name;
                $order_detail->product_price = $cart->price;
                $order_detail->product_voucher = $data['order_voucher'];
                $order_detail->product_fee = $data['order_fee'];
                $order_detail->product_sales_quantity = $cart->qty;
                $order_detail->save();
            }
        }
        Session()->forget('voucher');
        Session()->forget('fee');
        Session()->forget('cart');
    }
    public function show_delivery()
    {
        $cart = Session()->get('fee');
        $output = '';
        $output .= '<span class="delivery">' . number_format($cart) . ' ' . 'vnđ' . '</span>';
        echo $output;
    }
}
