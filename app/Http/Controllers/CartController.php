<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use App\Models\CartModel;
use App\Models\CartItemModel;
use App\Models\ProductModel;
use App\Models\OrderModel;

class CartController extends Controller
{
    public function index()
    {
        $cartId = Cookie::get('cart_id');
        if (!$cartId) {
            return view('index', ['cartItems' => [], 'totalAmount' => 0]);
        }
        
        $cartItems = CartItemModel::getItems($cartId);
        $totalAmount = CartItemModel::getTotalAmount($cartId);
        
        return view('index', ['cartItems' => $cartItems, 'totalAmount' => $totalAmount]);
    }

    public function addToCart(Request $request, $productId)
    {
        $cartId = Cookie::get('cart_id');
        
        // Create or get cart
        $cart = CartModel::getOrCreateCart($cartId);
        $cartId = $cart->id;
        
        // Set cookie if needed
        if (!Cookie::get('cart_id')) {
            Cookie::queue('cart_id', $cartId, 60 * 24 * 30); // 30 days
        }
        
        // Check if product exists
        $product = ProductModel::find($productId);
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found.');
        }
        
        // Add to cart
        CartItemModel::addItem($cartId, $productId);
           
        return redirect()->route('cart.index')->with('success', "{$product->name} has been added to your cart!");
    }
    
    public function update(Request $request, $itemId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);  
        
        CartItemModel::updateItem($itemId, $request->input('quantity'));
        
        return redirect()->route('cart.index')->with('success', 'Cart updated!');
    }
    
    public function removeFromCart($itemId)
    {
        CartItemModel::removeItem($itemId);
        
        return redirect()->route('cart.index')->with('success', 'Item removed from the cart');
    }
    
    public function checkout(Request $request)
    {
        $cartId = Cookie::get('cart_id');
        if (!$cartId) {
            return redirect()->back()->with('error', 'No cart found.');
        }
        
        $cartItems = CartItemModel::getItems($cartId);
        if (empty($cartItems)) {
            return redirect()->back()->with('error', 'Your cart is empty.');
        }

        $totalAmount = CartItemModel::getTotalAmount($cartId);
        $itemsArray = CartItemModel::getItemsForOrder($cartId);

        DB::beginTransaction();

        try {
            // Customer info
            $customerInfo = [
                'fullname' => $request->input('fullname'),
                'address' => $request->input('address'),
                'city' => $request->input('city')
            ];
            
            // Create order
            OrderModel::placeOrder($cartId, $itemsArray, $totalAmount, $customerInfo);

            // Update product stock
            foreach ($cartItems as $item) {
                ProductModel::decreaseStock($item->product_id, $item->quantity);
            }

            // Clear cart
            CartItemModel::clearCart($cartId);
            CartModel::deleteCart($cartId);
            
            DB::commit();

            return redirect()->route('orders')->with('success', 'Order placed successfully!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Error placing the order: ' . $e->getMessage());
        }
    }
}