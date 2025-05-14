<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\Season;
use App\Models\ProductSeason;

class ProductController extends Controller
{
    public function products(Request $request)
    {
        if(!isset($request->sort_type) or $request->sort_type=="null") {
            $products = Product::Paginate(6);

            return view('products', compact('products'));

        } else {
            $products = Product::order($request->sort_type)->Paginate(6);
            $sort_type = $request->sort_type;

            return view('products', compact('products', 'sort_type'));
        }
    }

    public function search(Request $request)
    {
        $products = Product::ProductNameSearch($request->name)->Paginate(6);
        $request_name = $request->name;
        return view('products', compact('products', 'request_name'));
    }

    public function register() {
        return view('register');
    }

    public function store(ProductRequest $request)
    {
        $file = $request->file('img_file');
        $originalName = $file->getClientOriginalName();
        $file->storeAs('public/', $originalName);

        $image_path = 'storage/' . $originalName;

        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'image' => $image_path,
            'description' => $request->description
        ]);

        $product_id = $product->id;

        $seasons = $request->season;

        foreach($seasons as $key => $season_id) {
            ProductSeason::create(['product_id' => $product_id, 'season_id' => $season_id]);
        }

        return redirect('products');
    }

    
    public function detail($productid) {
        $product = Product::find($productid);
        $product_seasons = ProductSeason::where('product_id', $productid)->get();
        return view('detail', compact('product', 'product_seasons', 'productid'));
    }

    public function update(ProductRequest $request, $productid)
    {
        $file = $request->file('img_file');
        $originalName = $file->getClientOriginalName();
        $image_path = 'storage/' . $originalName;
        $file->storeAs('public/', $originalName);

        $product = [
            'name' => $request->name,
            'price' => $request->price,
            'image' => $image_path,
            'description' => $request->description
        ];

        Product::find($productid)->update($product);

        $seasons = $request->season;
        $old_seasons = ProductSeason::where('product_id', $productid);
        $exist_season = "0";

        foreach($seasons as $key => $season_id) {
            foreach($old_seasons as $old_season) {
                if ($season_id == $old_season) {
                    $exist_season = "1";
                    continue;
                }
            }
            if ($exist_season = "1") {
                $exist_season = "0";
                continue;
            }
            ProductSeason::create(['product_id' => $productid, 'season_id' => $season_id]);
        }

        return redirect('products');

    }

    public function destroy(Request $request)
    {
        Product::find($request->productid)->delete();
        return redirect('products');
    }
}

