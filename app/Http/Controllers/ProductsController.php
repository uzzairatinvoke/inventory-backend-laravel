<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProductsController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request): JsonResponse
    {
        $this->authorize('viewAny', Product::class);

        $query = Product::with('category');

        // Search by name or description (case-insensitive)
        // kalau this request ada parameter nama 'search' dan juga ada value
        if ($request->has('search') && $request->search) {
            $searchTerm = $request->search;
            // kita akan jalankan operasi database
            // kita nak cari prodcut by nama dan juga description
            $query->where(function ($q) use ($searchTerm) {
                $q->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($searchTerm) . '%'])
                  ->orWhereRaw('LOWER(description) LIKE ?', ['%' . strtolower($searchTerm) . '%']);
            });

            // select * from table where name  = '%jacket%';
        }

        // Filter by category
        // akan dijalankan kalau ada parameter 'category_id'
        if ($request->has('category_id') && $request->category_id) {
            $query->where('category_id', $request->category_id);
        }

        $products = new ProductCollection($query->paginate());

        return response()->json($products, 200);
    }

    public function show(int $id): JsonResponse
    {
        $this->authorize('viewAny', Product::class);

        $product = Product::with('category')->find($id);

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
        $this->authorize('create', Product::class);
       
        $validated = $request->validated();

        if (! isset($validated['stock'])) {
            $validated['stock'] = 0;
        }
        // create product
        $product = $request->user()->products()->create($validated);

        // upload photo, photo is optional hence we need to do this conditional
        if($request->exists('photo') && $validated['photo']){
            
            $file = $request->file('photo');
            $original_filename = $file->getClientOriginalName();
            $file_size = $file->getSize();
            $mime_type = $file->getMimeType();
            $storage_disk = 'r2';
            $newFileName = Str::uuid().".".$file->getClientOriginalExtension();

            // ini ialah code untuk upload file
            $file_path = $file->storeAs('products/'.Auth::id(),$newFileName,'r2');

            // simpan metadata by updating the database
            $product->update([
                'file_path' => $file_path,
                'original_filename' => $original_filename,
                'file_size' => $file_size,
                'mime_type' => $mime_type,
                'storage_disk' => $storage_disk
            ]);

        }

        $product->load('category');
        $product = new ProductResource($product);
    
        return response()->json($product, 201);
    }

    public function update(ProductRequest $request, int $id): JsonResponse
    {
        $product = Product::findOrFail($id);

        $product->update($request->validated());
        $product->load('category');
        $product = new ProductResource($product);

        return response()->json($product, 200);
    }

    public function destroy(int $id): JsonResponse
    {
        $this->authorize('destroy', Product::class);

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

    public function upload(){
        
    }
}
