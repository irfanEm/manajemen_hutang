<?php

namespace App\Controllers;

use App\Models\AgentModel;
use App\Models\HutangModel;
use App\Models\PaymentMethod;
use App\Models\RiwayatHutangModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use Exception;

class Hutang extends ResourceController
{
    public HutangModel $hutangModel;
    public AgentModel $agentModel;
    public PaymentMethod $methodModel;
    public RiwayatHutangModel $riwayatHutangModel;

    public function __construct()
    {
        $this->hutangModel = new HutangModel();
        $this->agentModel = new AgentModel();
        $this->methodModel = new PaymentMethod();
        $this->riwayatHutangModel = new RiwayatHutangModel();
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
            $agent['sisa_hutang'] = $data['sisa_hutang'];
            $agent['tanggal_input_saldo'] = date('Y-m-d H:i:s');
            $this->agentModel->update($agent['id'], $agent);
        }

        $this->insertRiwayatHutang([
            'id_agent' => $data['id_agent'],
            'tipe_pembayaran' => $data['tipe_pembayaran'],
            'nominal' => $data['sisa_hutang'],
            'tanggal_pembayaran' => $data['tanggal_hutang'],
            'penginput' => session()->get('user_name')
        ]);
        return redirect()->to('/hutang')->with('message', 'Berhasil memproses data hutang.');
    }

    public function insertRiwayatHutang(array $data)
    {
            try{
                $this->riwayatHutangModel->save($data);
            }catch(Exception $err) {
                log_message('error', 'Gagal insert riwayat hutang : ' . $err->getMessage());
            }
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
        if(!$id) {
            return redirect()->to('/hutang')->with('error', 'Id tidak valid !');
        }

        $hutang = $this->hutangModel->find($id);

        if(!$hutang) {
            return redirect()->to('/hutang')->with('error', 'Hutang tidak ditemukan !');
        }

        return view('hutang/edit', [
            'title' => 'Edit hutang', 
            'hutang' => $hutang,
            'agents' => $this->agentModel->findAll(),
            'payments' => $this->methodModel->findAll(),
        ]);
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
        if($id === null){
            return redirect()->back()->with('error', 'ID hutang tidak valid !');
        }

        $rules = [
            'id_agent' => 'required|is_not_unique[agents.id]',
            'sisa_hutang' => 'required|numeric|min_length[1]|greater_than_equal_to[0]',
            'tanggal_hutang' => 'required|valid_date',
            'id_metode_pembayaran' => 'required|is_not_unique[payment_methods.id]'
        ];

        $messages = [
            'id_agent' => [
                'required' => 'Agen wajib dipilih !',
                'is_not_unique' => 'Agen tidak ditemukan !'
            ],
            'sisa_hutang' => [
                'required' => 'Sisa hutang wajib diisi !',
                'numeric' => 'Sisa hutang harus berupa angka !',
                'greater_than_equal_to' => 'Sisa hutang tidak boleh bernilai negatif !',
            ],
            'tanggal_hutang' => [
                'required' => 'Tanggal hutang wajib diisi !',
                'valid_date' => 'Tanggal hutang harus berupa tanggal yang valid !'
            ],
            'id_metode_pembayaran' => [
                'required' => 'Metode pembayaran wajib dipilih !',
                'is_not_unique' => 'Metode pembayaran tidak ditemukan !'
            ]
        ];

        if(!$this->validate($rules, $messages)){
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = $this->request->getPost(['id_agent', 'sisa_hutang', 'tanggal_hutang', 'id_metode_pembayaran']);
        $data['sisa_hutang'] = (float) $data['sisa_hutang'];

        try{

            $this->hutangModel->update($id, $data);

            $this->agentModel->update($data['id_agent'],[
                'sisa_hutang' => $data['sisa_hutang'],
            ]);

            return redirect()->to('/hutang')->with('message', 'Yey ! update data hutang berhasil.');
        }catch(Exception $err) {
            log_message('error', 'Gagal mengubah data hutang : ' . $err->getMessage());
            return redirect()->to('/hutang/edit/' . $id)->with('error','Duh ! sepertinya ada masalah saat mengupdate data hutang.');
        }
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
        if(!$id){
            return redirect()->back()->with('error', 'oops ! datanya ngga ada.');
        }
        
        $hutang = $this->hutangModel->find($id);
        
        if(!$hutang){
            return redirect()->back()->with('error', 'oops ! datanya ngga ada.');
        }
        $agent = $this->agentModel->find($hutang['id_agent']);

        try{
            $agent['sisa_hutang'] = (float) 0;
            $this->agentModel->update($agent['id'], $agent);
            $this->hutangModel->delete($id);
            return redirect()->to('/hutang')->with('message', 'Datanya udah kehapus, jangan nyesel yah.');
        } catch(\Exception $err) {
            log_message('error', 'Gagal menghapus data hutang : ' . $err->getMessage());
            return redirect()->to('/hutang')->with('error', 'Ops ! datanya gagal dihapus, sepertinya ada yang salah.');
        }
    }
}
