<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyProductFormRequest;
use App\Http\Requests\StoreProductFormRequest;
use App\Http\Requests\UpdateProductFormRequest;
use App\Models\Product;
use App\Models\ProductForm;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductFormController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('product_form_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productForms = ProductForm::with(['product'])->get();

        return view('admin.productForms.index', compact('productForms'));
    }

    public function create()
    {
        abort_if(Gate::denies('product_form_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $products = Product::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.productForms.create', compact('products'));
    }

    public function store(StoreProductFormRequest $request)
    {
        $productForm = ProductForm::create($request->all());

        return redirect()->route('admin.product-forms.index');
    }

    public function edit(ProductForm $productForm)
    {
        abort_if(Gate::denies('product_form_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $products = Product::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $productForm->load('product');

        return view('admin.productForms.edit', compact('productForm', 'products'));
    }

    public function update(UpdateProductFormRequest $request, ProductForm $productForm)
    {
        $productForm->update($request->all());

        return redirect()->route('admin.product-forms.index');
    }

    public function show(ProductForm $productForm)
    {
        abort_if(Gate::denies('product_form_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productForm->load('product');

        return view('admin.productForms.show', compact('productForm'));
    }

    public function destroy(ProductForm $productForm)
    {
        abort_if(Gate::denies('product_form_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $productForm->delete();

        return back();
    }

    public function massDestroy(MassDestroyProductFormRequest $request)
    {
        ProductForm::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
