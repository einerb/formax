<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Exception;
use Validator;

use App\Order;

class OrderController extends Controller
{
    public function index()
    {
        try {
            $orders = Order::all();

            $response = [
                'success' => true,
                'data' => $orders,
                'message' => 'Successful orders listing!'
            ];

            return response()->json($response, 200);
        } catch (Exception $e) {
            return response()->json('Error: ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        $v = Validator::make($request->all(), [
            'channel' => 'required|string',
            'state' => 'required|string',
            'value' => 'required',
            'discount' => 'required|integer',
            'delivery' => 'required|string',
            'dispatch' => 'required|string',
            'product_id' => 'required|integer'
        ]);

        if ($v->fails()) {
            return response()->json(["errors" => $v->errors()], 400);
        }

        try {
            $order = new Order([
                'channel' =>  $request->channel,
                'state' =>  $request->state,
                'value' =>  $request->value,
                'discount' =>  $request->discount,
                'delivery' =>  $request->delivery,
                'dispatch' =>  $request->dispatch,
                'product_id' =>  $request->product_id,
            ]);
            $order->save();

            $response = [
                'success' => true,
                'data' => $order,
                'message' => 'Successfully created order!'
            ];

            return response()->json($response, 200);
        } catch (Exception $e) {
            return response()->json('Error: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $order = Order::find($id);

            if (!$order) {
                return response()->json('order not found!');
            }

            $response = [
                'success' => true,
                'data' => $order,
                'message' => 'Successful order listing!'
            ];

            return response()->json($response, 200);
        } catch (Exception $e) {
            return response()->json('Error: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $order = Order::find($id);

            if (!$order) {
                return response()->json('Order not found!');
            }

            $v = Validator::make($request->all(), [
                'state' => 'required|string',
                'value' => 'required',
            ]);
    
            if ($v->fails()) {
                return response()->json(["errors" => $v->errors()], 400);
            }

            $order->state    = $request->state;
            $order->value    = $request->value;
            $order->save();

            $response = [
                'success' => true,
                'data' => $order,
                'message' => 'Successfully updated order!'
            ];

            return response()->json($response, 200);
        } catch (Exception $e) {
            return response()->json('Error: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $order = Order::find($id);
            if (!$order) {
                return response()->json('Order not found!');
            }

            $order->delete();

            $response = [
                'success' => true,
                'message' => 'Order successfully removed!'
            ];

            return response()->json($response, 200);
        } catch (Exception $e) {
            return response()->json('Error: ' . $e->getMessage());
        }
    }
}
