<?php

namespace App\Http\Controllers\API;

use Validator;
use App\Models\Shop\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str as Str;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::with('category')->get();
        return response()->json($product, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name'        => 'required|string|max:180',
            'category_id' => 'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        $product = Product::Create([
            'name'          => $request->name,
            'slug'          => Str::slug($request->slug),
            'price'         => $request->price,
            'category_id'   => $request->category_id,
            'description'   => $request->description,
        ]);

        $urlimagenes = [];


        if ($request->hasFile('imgs')) {
            $imagenes = $request->file('imgs');
            // dd($imagenes);
            foreach ($imagenes as $imagen) {
                $nombre = time().'_'.$imagen->getClientOriginalName();
                $nombre = str_replace(' ', '-', $nombre);
                $ruta = public_path().'/img/product/';
                $imagen->move($ruta , $nombre);

                $archivo = $ruta.$nombre;
                chmod($archivo, 0644);

                $urlimagenes[]['url'] = '/img/product/'.$nombre;
            }
        }

        $product->image()->createMany($urlimagenes);

        return response()->json($product, 200); 

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Shop\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return response()->json($product, 200); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Shop\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $validator = Validator::make($request->all(),[
            'name'        => 'required|string|max:180',
            'category_id' => 'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());       
        }

        $product->update($product->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shop\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json($product, 200);
    }
}
