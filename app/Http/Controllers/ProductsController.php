<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;

class ProductsController extends Controller
{
    use AuthorizesRequests;

    public function index(): JsonResponse
    {
        $products = new ProductCollection(Product::paginate());

        return response()->json($products, 200);
    }

    public function show(int $id): JsonResponse
    {
        $product = Product::find($id);

        if (! $product) {
            return response()->json([
                'message' => 'Product not found',
            ], 404);
        }

        $product = new ProductResource($product);

        return response()->json($product, 200);
    }

    public function create(ProductRequest $request): JsonResponse
    {
        if ($this->authorize('create', Product::class == false)) {
            return response()->json([
                'message' => 'not authorized',
            ]);
        }

        $validated = $request->validated();

        if (! isset($validated['stock'])) {
            $validated['stock'] = 0;
        }

        $product = $request->user()->products()->create($validated);

        return response()->json($product, 201);
    }

    public function update(ProductRequest $request, int $id): JsonResponse
    {
        $product = Product::findOrFail($id);

        $product->update($request->validated());

        return response()->json($product, 200);
    }

    public function destroy(int $id): JsonResponse
    {
        $product = Product::find($id);

        if (! $product) {
            return response()->json([
                'message' => 'Product not found',
            ], 404);
        }

        $product->delete();

        return response()->json([
            'message' => 'Product deleted successfully',
        ], 204);
    }
}
