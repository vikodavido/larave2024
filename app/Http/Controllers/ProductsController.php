<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Repositories\Contracts\ProductsRepositoryContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ProductsController extends Controller
{
    public function index(Request $request, ProductsRepositoryContract $repository)
    {
        $per_page = $request->get('per_page', $repository::PER_PAGE);
        $selectedCategory = $request->get('category');

        $products = Cache::flexible("products_index_{$per_page}_{$selectedCategory}", [5, 600], fn () => $repository->paginate($request));
        $categories = Cache::flexible('products_categories', [5, 3600], fn () => Category::whereHas('products')->get());


        return view('products.index', compact('products', 'per_page', 'categories', 'selectedCategory'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $product->load(['categories', 'images']);

        $gallery = [
            $product->thumbnailUrl,
            ...$product->images->map(fn ($image) => $image->url)
        ];

        return view('products.show', compact('product', 'gallery'));
    }
}