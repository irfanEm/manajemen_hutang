<?php

namespace App\Controllers;

use App\Models\AgentModel;
use App\Models\HutangModel;
use App\Models\PaymentMethod;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class Hutang extends ResourceController
{
    public HutangModel $hutangModel;
    public AgentModel $agentModel;
    public PaymentMethod $methodModel;

    public function __construct()
    {
        $this->hutangModel = new HutangModel();
        $this->agentModel = new AgentModel();
        $this->methodModel = new PaymentMethod();
    }
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        $hutangs = $this->hutangModel
                    ->select('hutangs.*, agents.nama_agen, payment_methods.nama_metode')
                    ->join('agents', 'agents.id = hutangs.id_agent')
                    ->join('payment_methods', 'payment_methods.id = hutangs.id_metode_pembayaran')
                    ->orderBy('hutangs.created_at', 'DESC')
                    ->findAll();
        return view('hutang/index', [
            'title' => 'Data Hutang',
            'hutangs' => $hutangs,
        ]);
    }

    /**
     * Return the properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function show($id = null)
    {
        $hutang = $this->hutangModel->find($id);
        if(!$hutang) {
            return redirect()->to('/hutang')->with('error', 'Data tidak ditemukan !');
        }

        return view('hutang/detail', ['title' => 'Detail Hutang', 'hutang' => $hutang]);
    }

    /**
     * Return a new resource object, with default properties.
     *
     * @return ResponseInterface
     */
    public function new()
    {
        $agents = $this->agentModel->findAll();
        $methods = $this->methodModel->findAll();
        return view('hutang/create', [
            'title' => 'Tambah Hutang', 
            'agents' => $agents, 
            'payment_methods' => $methods
        ]);
    }

    /**
     * Create a new resource object, from "posted" parameters.
     *
     * @return ResponseInterface
     */
    public function create()
    {
        $data = $this->request->getPost(['tipe_pembayaran', 'id_agent', 'sisa_hutang', 'tanggal_hutang', 'id_metode_pembayaran']);

        $data['id_hutang'] = "HT-" . date('YmdHis') . $data['id_agent'];

        $data['sisa_hutang'] = (float) $data['sisa_hutang'];

        $agent = $this->agentModel->find($data['id_agent']);
        if(!$agent){
            return redirect()->back()->withInput()->with('error', 'Agen tidak ditemukan !');
        }

        $existingHutang = $this->hutangModel
                            ->where('id_agent', $data['id_agent'])
                            ->first();
                            
        if($existingHutang) {
            if($data['tipe_pembayaran'] === 'hutang') {
                $newHutang = $existingHutang['sisa_hutang'] + $data['sisa_hutang'];

                $this->hutangModel->update($existingHutang['id'], [
                    'sisa_hutang' => $newHutang,
                    'tanggal_hutang' => $data['tanggal_hutang'],
                    'id_metode_pembayaran' => $data['id_metode_pembayaran']
                ]);

                $agent['sisa_hutang'] = $newHutang;
                $this->agentModel->update($agent['id'], $agent);
            } elseif($data['tipe_pembayaran'] === 'bayar') {
                $newHutang = $existingHutang['sisa_hutang'] - $data['sisa_hutang'];
                if($newHutang < 0) {
                    $newHutang = 0;
                }

                $this->hutangModel->update($existingHutang['id'], [
                    'sisa_hutang' => $newHutang,
                    'tanggal_hutang' => $data['tanggal_hutang'],
                    'id_metode_pembayaran' => $data['id_metode_pembayaran']
                ]);

                $agent['sisa_hutang'] = $newHutang;
                $this->agentModel->update($agent['id'], $agent);
            }
        }else{
            $this->hutangModel->save($data);
            $this->agentModel->update($agent['id'], $agent);
        }

        return redirect()->to('/hutang')->with('message', 'Berhasil memproses data hutang.');
    }

    public function bayarHutang(int $agent)
    {

    }
    /**
     * Return the editable properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function edit($id = null)
    {
        //
    }

    /**
     * Add or update a model resource, from "posted" properties.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function update($id = null)
    {
        //
    }

    /**
     * Delete the designated resource object from the model.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function delete($id = null)
    {
        //
    }
}
