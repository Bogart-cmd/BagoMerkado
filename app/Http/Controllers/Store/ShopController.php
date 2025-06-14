<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;

class ShopController extends Controller
{
public function index(Request $request)
{
    $locale = app()->getLocale();

    // Gather filters
    $filters = [
        'category' => $request->input('category', []),
        'brand' => $request->input('brand', []),
        'price_min' => $request->input('price_min', 0),
        'price_max' => $request->input('price_max', 1000),
        'color' => $request->input('color', []),
        'size' => $request->input('size', []),
    ];

    // Filtered and paginated products
    $products = Product::with('translation')
        ->when(!empty($filters['category']), fn($query) => $query->whereIn('category_id', $filters['category']))
        ->when(!empty($filters['brand']), fn($query) => $query->whereIn('brand_id', $filters['brand']))
        ->when($filters['price_min'], function ($query) use ($filters) {
            $query->whereHas('variants', function ($q) use ($filters) {
                $q->where('price', '>=', $filters['price_min']);
            });
        })
        ->when($filters['price_max'], function ($query) use ($filters) {
            $query->whereHas('variants', function ($q) use ($filters) {
                $q->where('price', '<=', $filters['price_max']);
            });
        })
        ->when(!empty($filters['color']), fn($query) => $query->whereIn('color', $filters['color']))
        ->when(!empty($filters['size']), fn($query) => $query->whereIn('size', $filters['size']))
        ->paginate(12)
        ->appends(request()->query());

    $categories = Category::with('translation')->get();
    $brands = Brand::with('translations')->get();

    if ($request->ajax()) {
        return view('themes.xylo.partials.product-list', compact('products'))->render();
    }

    return view('themes.xylo.shop', compact('products', 'categories', 'brands'));
}

}
