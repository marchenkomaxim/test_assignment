<?php

namespace App\Http\Controllers;



use App\Http\Requests\Purchase\PurchaseRequest;
use App\Models\Purchase;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{

    public function index(Request $request) {

        $user = $request->user();


        $purchases = $user->purchases()
            ->with('products')
            ->orderBy('purchase_date', 'desc')
            ->get();


        return response()->json($purchases);
    }

    public function store(PurchaseRequest $request)
    {
        $user = $request->user();

        $purchase = $user->purchases()->create([
            'purchase_date' => now(),
        ]);

        foreach ($request->products as $product) {
            $purchase->products()->attach($product['id'], ['quantity' => $product['quantity']]);
        }

        $purchase->load('products');

        $message = "Purchase created successfully with " . count($request->products) . " product(s).";

        return response()->json([
            'message' => $message,
            'purchase' => $purchase
        ], 201);
    }

    public function show(Purchase $purchase)
    {
        $this->authorize('view', $purchase); // Убедимся, что это покупка текущего пользователя

        return response()->json($purchase->load('products'));
    }

    public function update(PurchaseRequest $request, Purchase $purchase)
    {
        $this->authorize('update', $purchase);

        // Синхронизируем продукты (обновляем связь)
        $products = collect($request->products)->mapWithKeys(function ($item) {
            return [$item['id'] => ['quantity' => $item['quantity']]];
        });

        $purchase->products()->sync($products);

        return response()->json(['message' => 'Purchase updated successfully', 'purchase' => $purchase]);
    }

    public function delete(Request $request, Purchase $purchase)
    {
        $this->authorize('delete', $purchase);

        $purchase->delete();

        return response()->json(['message' => 'Purchase deleted successfully']);
    }

}
