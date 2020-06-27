<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

use Exception;
use Validator;

use App\Order;
use App\Product;
use App\OrderProduct;

class OrderController extends Controller
{
    public function index()
    {
        try {
            $orders = Order::orderBy('updated_at','DESC')->get();

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
            'state' => Rule::in(['reservada', 'pendiente', 'transito', 'recoger', 'cerrada', 'cancelada']),
            'value' => 'required',
            'discount' => 'required|integer',
            'delivery' => Rule::in(['estandar', 'express']),
            'dispatch' => Rule::in(['tienda', 'domicilio'])
        ]);

        if ($v->fails()) {
            return response()->json(["errors" => $v->errors()], 400);
        }

        try {
            $order = new Order([
                'order'=>  Str::random(10),
                'channel' =>  $request->channel,
                'state' =>  $request->state,
                'value' =>  $request->value,
                'discount' =>  $request->discount,
                'delivery' =>  $request->delivery,
                'dispatch' =>  $request->dispatch,
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
            $order = Order::with('product')->where('id', $id)->get();

            if (!$order) {
                return response()->json('Order not found!');
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

    public function showProductsByOrder($id)
    {
        try {
            $order = Order::join('products', 'orders.product_id', '=', 'products.id')->where('orders.order', $id)->orderBy('updated_at', 'desc')->get();

            if (!$order) {
                return response()->json('Order not found!');
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
