<?php

namespace App\Controllers;

use App\Models\DiskonModel;

class DiskonController extends BaseController
{
    protected $diskonModel;

    public function __construct()
    {
        $this->diskonModel = new DiskonModel();
    }

    public function index()
    {
        $editData = null;
        if ($this->request->getGet('edit')) {
            $editData = $this->diskonModel->find($this->request->getGet('edit'));
        }

        $data = [
            'title' => 'Data Diskon',
            'diskon' => $this->diskonModel->orderBy('tanggal', 'ASC')->findAll(),
            'editData' => $editData
        ];

        return view('v_diskon', $data);
    }

 public function save()
{
    $id = $this->request->getPost('id');
    $tanggal = $this->request->getPost('tanggal');
    $nominal = $this->request->getPost('nominal');

    // Cek apakah tanggal sudah ada, dan abaikan data yang sedang di-edit
    $existing = $this->diskonModel
        ->where('tanggal', $tanggal)
        ->where('id !=', $id) // agar bisa update tanggal yg sama pada data sendiri
        ->first();

    if ($existing) {
        return redirect()->to('/diskon')
            ->with('error', 'Diskon untuk tanggal tersebut sudah ada.');
    }

    $data = [
        'tanggal' => $tanggal,
        'nominal' => $nominal,
    ];

    if ($id) {
        $this->diskonModel->update($id, $data);
    } else {
        $this->diskonModel->insert($data);
    }

    return redirect()->to('/diskon')->with('success', 'Diskon berhasil disimpan.');
}


    public function delete($id)
    {
        $this->diskonModel->delete($id);
        return redirect()->to('/diskon');
    }
}
