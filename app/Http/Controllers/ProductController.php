<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Exception;
use Validator;

use App\Product;
use App\OrderProduct;

class ProductController extends Controller
{
    public function store(Request $request)
    {
        $v = Validator::make($request->all(), [
            'sku' => 'required|string|unique:products|min:10|max:13',
            'name' => 'required|string',
            'quantity' => 'required|integer',
            'price' => 'required',
            'bar_code' => 'required|string',
        ]);

        if ($v->fails()) {
            return response()->json(["errors" => $v->errors()], 400);
        }

        try {
            $product = new Product([
                'sku' =>  $request->sku,
                'name'     => $request->name,
                'quantity'     => $request->quantity,
                'price'     => $request->price,
                'bar_code'     => $request->bar_code
            ]);
            $product->save();

            $order_product = new OrderProduct([
                'order_id'=> $request->order_id,
                'product_id'=>$product->id
            ]);
            $order_product->save();

            $response = [
                'success' => true,
                'data' => $product,
                'message' => 'Successfully created product!'
            ];

            return response()->json($response, 200);
        } catch (Exception $e) {
            return response()->json('Error: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $product = Product::find($id);
            if (!$product) {
                return response()->json('Product not found!');
            }
            $order_product = OrderProduct::where('product_id', '=', $product->id)->get();

            $product->delete();

            $response = [
                'success' => true,
                'message' => 'Product successfully removed!'
            ];

            return response()->json($response, 200);
        } catch (Exception $e) {
            return response()->json('Error: ' . $e->getMessage());
        }
    }
}
