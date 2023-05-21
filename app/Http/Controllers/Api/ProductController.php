<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::query()
            ->when(request()->has('random'), function ($query) {
                $query->inRandomOrder()->take(request('random'));
            })
            ->when(request()->has('categories'), function ($query) {
                $query->whereHas('category', function ($query) {
                    $query->whereIn('category_id', request('categories'));
                });
            })
            ->when(request()->has('shops'), function ($query) {
                $query->whereHas('shop', function ($query) {
                    $query->whereIn('shop_id', request('shops'));
                });
            })
            ->when(request()->has('discount'), function ($query) {
                $query->when(request()->has('min_price'), function ($query) {
                    $query->when(request()->has('max_price'), function ($query) {
                        $query->whereBetween('discount_price', [request('min_price'), request('max_price')]);
                    }, function ($query) {
                        $query->where('discount_price', '>=', request('min_price'));
                    });
                });
                $query->when(request()->has('max_price'), function ($query) {
                    $query->where('discount_price', '<=', request('max_price'));
                });
            }, function ($query) {
                $query->when(request()->has('min_price'), function ($query) {
                    $query->when(request()->has('max_price'), function ($query) {
                        $query->whereBetween('unit_price', [request('min_price'), request('max_price')]);
                    }, function ($query) {
                        $query->where('unit_price', '>=', request('min_price'));
                    });
                });
                $query->when(request()->has('max_price'), function ($query) {
                    $query->where('unit_price', '<=', request('max_price'));
                });
            })
            ->when(request()->has('search'), function ($query) {
                $query->where('name', 'like', '%' . request('search') . '%');
            })
            ->when(request()->has('sort'), function ($query) {
                $query->orderBy(request('sort'), request('order', 'asc'));
            });
        if (request()->has('paginate')) {
            return ProductResource::collection($products->paginate(request('paginate')));
        }
        return ProductResource::collection($products->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        return Product::create(['shop_id' => auth()->user()->id, ...$request->validated()]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update(['shop_id' => auth()->user()->id, ...$request->validated()]);
        return true;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        return $product->delete();
    }
}
