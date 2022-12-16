<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Models\Products;
use Illuminate\Http\Request;
use App\DataTables\ProductsDataTable;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables as DataTables;
;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    use MediaUploadingTrait;

    /**
     * @throws \Exception
     */
    public function data(Request $request)
    {
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $model = Products::query();
//            $model->where('is_sales','=', 1);

//            if ( $request->input('keyword')) {
//                $model->where('is_sales','=', 1)
//                      ->where('product_name', 'like',$request->input('keyword'));
//            }


            return (new \Yajra\DataTables\DataTables)->eloquent($model)
                ->filter(function ($model) use ($request) {
//                    if ($request->input('product_name')) {
////                                            dd($request->input('product_name'));
////                    $model->where('is_sales','=', 1);
//                        $query =  $model->where('product_name', 'like', "%" . $request->input('product_name') . "%");
////                        dd($query->get());
////                        $query->where('is_sales', 1);
//                    }

//                    if (request()->has('keyword')) {
//                        $query->where('email', 'like', "%" . request('email') . "%");
//                    }
                }, true)
                ->toJson();
//                ->addColumn('description', function ($row) {
//                    return substr($row->description, 0, 50);
//                })
//                ->addColumn('is_sales', function ($row) {
//                    return ($row->is_sales == 1 ? 'Đang bán' : 'Ngừng bán');
//                })
//                ->addIndexColumn()
//                ->addColumn('action', function($row) {
//                    $url_edit = route('products.edit',[$row->id]);
//                    $url_del = route('products.destroy',[$row->id]);
//
//                    $btn  = '<div class="btn-toolbar mb-lg-1" role="group" >';
//                    $btn .= '<a href="' . $url_edit . '" class="btn"><i class="fa fa-pen"></i> </a>';
//
//                    $btn .= '<form action="' . $url_del .'" method="POST">
//                    '.csrf_field().'
//                    '.method_field("DELETE").'
//                    <button type="submit" onclick="return confirm(\'Bạn có muốn xoá sản phẩm ' .
//                        $row->product_name .' không?\')"
//                        class="edit btn btn-danger btn-sm" style="display: inline-list"><i class="fa fa-trash-alt"></i></a>
//                    </form>';
//                    $btn .= '</div>';
//
//                    return $btn;
//                })
//                ->rawColumns(['action'])
//                ->make(true);
        }
        $status = \App\Models\Products::getStatus()
            ->sortBy('val')
            ->pluck('status');
        return view('products.index', ['status' => $status]);
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
