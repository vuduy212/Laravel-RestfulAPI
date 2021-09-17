<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Requests\UpdateRequest;
use App\Models\Product;
use App\Http\Resources\ProResource;

class ProductController extends Controller
{
    protected $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = $this->product->paginate(2);
        $products = new ProResource($product);
        return $this->sendResponse($products, 'Danh sach san pham'); //chuyen sang tieng anh
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\ProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $product = $this->product->create($request->all());
        return $this->sendResponse($product, 'Them thanh cong');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = $this->product->findOrFail($id);
        return $this->sendResponse($product, 'Yeu cau thanh cong');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\UpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        $product = $this->product->findOrFail($id);
        $product->update($request->all());
        return $this->sendResponse($product, 'Cap nhat thanh cong');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = $this->product->findOrFail($id);
        $product->delete();
        return $this->sendResponse($product, 'Xoa thanh cong');
    }
}
