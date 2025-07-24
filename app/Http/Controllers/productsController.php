<?php
namespace App\Http\Controllers;

use App\Models\cart_ids;
use App\Models\carts;
use App\Models\products;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ProductsController extends Controller
{
    public function res_user(Request $request)
    {
        $insert = $request->validate([
            'name' => ['required', Rule::unique('users', 'name')],
            'password' => [
                'required',
                'confirmed',
                \Illuminate\Validation\Rules\Password::min(8)
                    ->mixedCase()
                    ->letters()
                    ->numbers()
                    ->symbols(),
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users', 'email'),
            ],
        ]);

        $user = User::create($insert);

        if ($user) {
            return redirect('/login')->with('message', 'Register successfully');
        } else {
            return back()->with('message', 'Register failed');
        }
    }

    public function register()
    {
        return view('register');
    }

    public function loginverify(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('home')->with('success', 'Login successful!');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput();
    }

    public function login()
    {
        return view('login');
    }

    public function home()
    {
        $products = products::all();
        return view('index', compact('products'));
    }

    public function destroy(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('index');
    }

    public function cartlist()
    {
        $userId = Auth::id();

        $carts = carts::where('user_id', $userId)
                      ->where("c_status", "=", "pending")
                      ->where("c_id", "=", 0)
                      ->get();


        $total_price = DB::table('carts')
                        ->where('user_id', $userId)
                        ->where("c_id", "=", 0)
                        ->select(DB::raw('SUM(price * qty) as t_price'))
                        ->get();

        return view('cartlist', ['carts' => $carts, 'total_price' => $total_price]);
    }

    public function addcart(Request $request, Product $product)
    {
        $userId = Auth::id();

        // 检查购物车中是否已经存在该产品

        $cartItem = carts::where('user_id', $userId)
                        ->where('product_id', $product->id)
                        ->where('c_id', 0)
                        ->first();
                        // dd($request->input('qty', 1));
        if ($cartItem) {
            // 如果购物车中已经存在该产品，增加数量
            $cartItem->qty += $request->input('qty', 1); // 默认数量为1
            $cartItem->save();
        } else {
            // 获取最新的 cart_id 记录
            $lastRecord = cart_ids::latest()->first();
            $cartId = $lastRecord ? $lastRecord->id + 1 : 1;

            //dd($request->input('qty', 1));
            // 创建新的购物车项
            carts::create([
                'user_id' => $userId,
                'product_id' => $product->id,
                'qty' => $request->input('qty', 1),
                'price' => $product->p_price,
                'c_id' => 0,
                'c_status' => 'pending', // 设置为待处理状态
            ]);

            // 更新或创建新的 cart_ids 记录
            cart_ids::updateOrCreate(
                ['cart_id' => $cartId]
            );
        }

        return redirect()->route('cartlist')->with('success', 'Product added to cart!');
    }

    public function checkout(Request $request)
{
    // 获取勾选的购物车项ID
    $selectedCarts = $request->input('cart_ids', []);

    if (empty($selectedCarts)) {
        // 如果没有勾选任何项目，默认选择所有未结账的项目
        $selectedCarts = carts::where('user_id', Auth::id())
                              ->where('c_status', 'pending')
                              ->pluck('id')
                              ->toArray();
    }

    foreach ($selectedCarts as $cartId) {
        $cart = carts::find($cartId);

        if ($cart) {
            // 获取最新的 cart_id 记录
            $lastRecord = cart_ids::create(["cart_id" => $cartId]);

            // 更新购物车状态
            $cart->update([
                'c_id' => $lastRecord->id,
                'c_status' => 'checked out',
            ]);
        }
    }

    return back()->with('message', 'Checkout successful');
}


    public function delete($id)
    {
        // 查找并删除购物车项目
        $cartItem = carts::find($id);

        if ($cartItem) {
            $cartItem->delete();
            return back()->with(['message' => 'Cart item deleted successfully.']);
        } else {
            return back()->with(['message' => 'Cart item not found.'], 404);
        }
    }

    public function checkbox(Request $request){
        // 获取选中的购物车项的ID
        $cartIds = $request->input('cart_ids', []);

        // 检查是否有选中的购物车项
        if (empty($cartIds)) {
            return back()->with('error', 'No items selected for checkout');
        }

        // 计算总金额
        $totalAmount = 0;

        foreach ($cartIds as $cartId) {
            $cart = carts::find($cartId);
            if ($cart) {
                $totalAmount += $cart->qty * $cart->price;
            }
        }

        // 处理结账逻辑（例如保存订单，更新购物车状态等）

        // 返回确认页面或提示结账成功
        return back()->with('success', 'Checkout successful. Total Amount: $' . $totalAmount);
    }
}
