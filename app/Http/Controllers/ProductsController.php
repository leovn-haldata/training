<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Models\Products;
use Illuminate\Http\Request;
use App\DataTables\ProductsDataTable;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    use MediaUploadingTrait;

    public function index(ProductsDataTable $dataTable)
    {
        return $dataTable->render('products.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = Products::create($request->all());

        try {

            if ($request->product_image) {
                $file = $request->product_image;
                $path = '/products/images';
                $url = $this->uploadPublic($file, $path);
                $product_image = url('/public')  . $url;
                $product->product_image = $product_image;
                $product->save();
                return redirect()->route('products.index');

            }

        } catch (Throwable $e) {
            report($e);

            return false;
        }

//        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $product = Products::where('id', $id)->first();

        return view('products.show', ['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Products::where('id', $id)->first();

        return view('products.edit', ['product' => $product]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Products $product)
    {
        try {
            $product->update($request->all());

            if ($request->file('product_image')) {
                $file = $request->file('product_image');
                $path = '/products/images';
                $url = $this->uploadFile($file,$path);
                $product->product_image = url('/public')  . $url;

            }

            if($product->save()){
                return redirect()->route('products.index');
            }
        } catch (Throwable $e) {
            report($e);

            return false;
        }

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Products::where('id', $id)->delete();

        return redirect()->route('products.index')->with('success', 'Deleted');
    }


}
