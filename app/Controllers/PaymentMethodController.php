<?php

namespace App\Controllers;

use App\Models\PaymentMethod;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class PaymentMethodController extends BaseController
{
    private PaymentMethod $paymentMethod;

    public function __construct()
    {
        $this->paymentMethod = new PaymentMethod();        
    }
    
    public function index()
    {
        $paymentMethods = $this->paymentMethod->findAll();
        return view('payment-methods/index', ['paymentMethods' => $paymentMethods, 'title' => 'Data Metode Pembayaran']);
    }

    public function create()
    {
        return view('payment-methods/create', ['title' => 'Tambah Metode Pembayaran']);
    }

    public function store()
    {
        $data = $this->request->getPost(['kode_metode', 'nama_metode']);
        $this->paymentMethod->save($data);
        return redirect()->to('/payment-methods')->with('message', 'Berhasil menambah data Metode Pembayaran !');
    }

    public function edit($id)
    {
        if(!$id) {
            return redirect()->to('/payment-methods')->with('message', 'Id metode pembayaran tidak ditemukan !');
        }
        
        $metode = $this->paymentMethod->find($id);
        if(!$metode) {
            return redirect()->to('/payment-methods')->with('message', 'Metode pembayaran tidak ditemukan !');
        }
        
        return view('payment-methods/edit', ['method' => $metode]);
    }
    
    public function update($id)
    {
        $data = $this->request->getPost(['nama_metode']);
        $this->paymentMethod->update($id, $data);
        return redirect()->to('/payment-methods')->with('message', 'Metode pembayaran berhasil diperbarui');
    }

    public function delete($id)
    {
        $this->paymentMethod->delete($id);
        return redirect()->to('/payment-methods')->with('message', 'Metode pembayaran berhasil dihapus.');
    }
}
