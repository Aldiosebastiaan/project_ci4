<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductCategoryModel;
use CodeIgniter\HTTP\ResponseInterface;

class ProductCategoryController extends BaseController
{
    protected $product_category;

    function __construct()
    {
        $this->product_category = new ProductCategoryModel();
    }

    public function index()
{
    $product_category=$this->product_category->findAll();
    $data['product_category'] = $product_category;

    return view('v_productcategory', $data);
}

public function create()
{
    $dataForm= [
        'nama'=>$this->request->getPost('nama'),
        'model'=>$this->request->getPost('model'),
        'deskripsi'=>$this->request->getPost('deskripsi'),
        'created_at'=>date("Y-m-d H:i:s")
    ];

    $this->product_category->insert($dataForm);

    return redirect('productcategory')->with('success', 'Kategori Produk Berhasil Ditambahkan');
}


    public function edit($id)
    {
        $dataProductCategory = $this->product_category->find($id);
        $dataForm = [
        'nama'=>$this->request->getPost('nama'),
        'model'=>$this->request->getPost('model'),
        'deskripsi'=>$this->request->getPost('deskripsi'),
        'created_at'=>date("Y-m-d H:i:s")
        ];
        $this->product_category->update($id, $dataForm);
        return redirect('productcategory')->with('success', 'Kategori Produk Berhasil Diubah');
    }
    
    public function delete($id)
    {
        $dataProductCategory=$this->product_category->find($id);
        $this->product_category->delete($id);

        return redirect('productcategory')->with('success', 'Kategori Produk berhasil dihapus.');
    }
}
