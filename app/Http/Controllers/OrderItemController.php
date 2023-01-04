<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderItemController extends Controller
{

    public function orderItemById($id)
    {
        $orderitems=OrderItem::where('order_id',$id)->get();
        return view('order.order_item',compact('orderitems'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show(OrderItem $orderItem)
    {
        //
    }


    public function edit(OrderItem $orderItem)
    {
        //
    }


    public function update(Request $request, OrderItem $orderItem)
    {
        //
    }


    public function destroy(OrderItem $orderItem)
    {
        //
    }
}
