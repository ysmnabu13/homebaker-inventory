<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\PDF;

class OrderController extends Controller
{
    //Display Order List
    public function index()
    {   
        $user = Auth::id();
        $signedInManagerID = Auth::user()->managerID;
        $order = OrderItem::where('outlet_id', $user)->paginate(10); // Retrieve 10 records per page

        return view('order.index', [
            'orderItem' => $order
        ], compact('order','signedInManagerID'));
    }

    //Add Order to List
    public function addorder(Request $request, $id){
        if(Auth::id()){
            $user = auth()->user();
            $product = Inventory::find($id);
            $order = new OrderItem;

            $order->outlet_id = $user->id;
            $order->outlet_name = $user->name;
            $order->product_name = $product->name;
            $order->quantity = $request->quantity;
            $order->totalPrice = $product->cost;
            $order->save();

            session()->flash('success', 'Product added to cart successfully!');
            return redirect()->back();
        }
        else{
            return redirect('login');
        }
    }

        //Update Quantity and Price
        public function updateQuantity($id, Request $request){
            $order = OrderItem::findOrFail($id);
            $order->quantity = $request->input('quantity');
            $order->save();
        
            return redirect()->back();
        }

        //Delete Product from Order Cart
        public function delete($id){
            $data = OrderItem::find($id);
            $data->delete();

            session()->flash('success', 'Product removed from cart successfully!');
            return redirect()->back();
        }

        //Final Order
        public function finalOrder(){
            $user = Auth::id();
            $orderItems = OrderItem::where('outlet_id', $user)->get(); // Retrieve 10 records per page    
                        
            Order::where('outlet_id', $user)->delete();

            // Store each order item into the orders table
            foreach ($orderItems as $orderItem) {
                $order = new Order();
                $order->outlet_id = $orderItem->outlet_id;
                $order->outlet_name = $orderItem->outlet_name;
                $order->product_name = $orderItem->product_name;
                $order->quantity = $orderItem->quantity;
                $order->totalPrice = $orderItem->totalPrice;
                $order->save();
            }

        // Empty the order_items table
        OrderItem::where('outlet_id', $user)->delete();

        session()->flash('success', 'Order placed successfully!');
        return redirect()->back();
        }

        //Generate Order Report in PDF
        public function generateReport(){
            $user = Auth::id(); 
            $order = Order::where('outlet_id', $user)->get();
            $pdf = PDF::loadView('order.report', [
                'order' => $order
            ]);
            return $pdf->download('Order Report.pdf');        
        }
}