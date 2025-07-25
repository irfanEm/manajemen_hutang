<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AgentModel;
use CodeIgniter\HTTP\ResponseInterface;

class Agent extends BaseController
{
    protected $agentModel;

    public function __construct()
    {
        $this->agentModel = new AgentModel();
        helper(['form']);
    }
    public function index()
    {
        $agents = $this->agentModel->findAll();

        return view('agents/index', ['agents' => $agents, 'title' => 'Data Agen']);
    }

    public function create()
    {
        return view('agents/create', ['title' => 'Tambah Agen']);
    }

    public function store()
    {
        $data = $this->request->getPost(['kode_agen', 'nama_agen']);
        $this->agentModel->save($data);
        return redirect()->to('/agents')->with('message', 'Agen berhasil ditambahkan.');
    }

    public function edit($id)
    {
        if(!$id){
            return redirect()->to('/agents')->with('error', 'ID Agen tidak ditemukan !');
        };
        $agent = $this->agentModel->find($id);
        if(!$agent){
            return redirect()->to('/agents')->with('error', 'Agen tidak ditemukan !');
        }
        return view('agents/edit', ['agent' => $agent, 'title' => 'Edit Agen']);
    }

    public function update($id)
    {
        $data = $this->request->getPost(['kode_agen', 'nama_agen']);
        $this->agentModel->update($id, $data);
        return redirect()->to('/agents')->with('message', 'Agen berhasil diperbarui');
    }

    public function delete($id)
    {
        $this->agentModel->delete($id);
        return redirect()->to('/agents')->with('message', 'Agen berhasil dihapus.');
    }
}
