<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AgentModel;
use App\Models\HutangModel;
use App\Models\PaymentMethod;
use App\Models\RiwayatHutangModel;
use CodeIgniter\HTTP\ResponseInterface;

class Laporan extends BaseController
{
    protected HutangModel $hutangModel;
    protected RiwayatHutangModel $riwayatHutangModel;
    protected AgentModel $agentModel;
    protected PaymentMethod $paymentMethod;

    public function __construct()
    {
        $this->hutangModel = new HutangModel();
        $this->riwayatHutangModel = new RiwayatHutangModel();
        $this->agentModel = new AgentModel();
        $this->paymentMethod = new PaymentMethod();
    }

    public function index()
    {
        $filterTanggal = $this->request->getGet('tanggal');
        $filterAgen = $this->request->getGet('agen');
        $filterMetode = $this->request->getGet('metode');

        $hutangs = $this->hutangModel->join('agents', 'agents.id = hutangs.id_agent')
                                    ->join('payment_methods', 'payment_methods.id = hutangs.id_metode_pembayaran')
                                    ->orderBy('tanggal_hutang', 'DESC');

        if($filterTanggal){
            $hutangs->where('DATE(tanggal_hutang)', $filterTanggal);
        }
        if($filterAgen){
            $hutangs->where('hutangs.id_agent', $filterAgen);
        }
        if($filterMetode){
            $hutangs->where('hutangs.id_metode_pembayaran', $filterMetode);
        }

        $data = [
            'title' => 'Laporan',
            'hutangs' => $hutangs->findAll(),
            'riwayats' => $this->riwayatHutangModel->findAll(),
            'metode_pembayaran' => $this->paymentMethod->findAll(),
            'agents' => $this->agentModel->findAll()
        ];

        return view('laporan/index', $data);
    }

    public function filter()
    {

    }

    public function exportPdf()
    {

    }

    public function exportExcel()
    {
        
    }
}
