<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index(Request $request) {
        $query = Product::query();

        if ($request->has('category')) {
            $query->where('category', $request->input('category'));
        }
        if ($request->has('min_price')) {
            $query->where('price', '>=', $request->input('min_price'));
        }
        if ($request->has('max_price')) {
            $query->where('price', '<=', $request->input('max_price'));
        }

        if ($request->has('popularity')) {
            $query->withCount('comments')
                ->orderBy('comments_count', $request->input('popularity') === 'desc' ? 'desc' : 'asc');
        }

        return $query->get();
    }

    public function store(ProductRequest $request)
    {
        $data = $request->validated();

        return Product::firstOrCreate($data);
    }

    public function show($id) {

        $product = Product::find($id);

        return $product;
    }

    public function create(ProductRequest $request)
    {
        $data = $request->validated();

        $product = Product::create($data);

        return $product;
    }

    public function update(ProductRequest $request, $id)
    {
        $data = $request->validated();

        $product = Product::find($id);

        $product->update($data);

        return $product;
    }

    public function delete($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'message' => 'Product not found',
            ], 404);
        }

        $product->delete();

        return response()->json([
            'message' => 'Product deleted successfully',
        ], 200);
    }

    public function edit($id)
    {
        $product = Product::find($id);

        // Если продукт не найден, возвращаем ошибку 404
        if (!$product) {
            return response()->json([
                'message' => 'Product not found',
            ], 404);
        }

        // Возвращаем данные продукта для редактирования
        return $product;
    }
}
