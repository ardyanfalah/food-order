<?php namespace App\Controllers;

use App\Models\Dashboard_model;

class Dashboard extends BaseController
{
	public function __construct()
    {
		$this->cek_login();
		$this->dashboard_model = new Dashboard_model();
	}
	
	public function index()
	{
		// if($this->cek_login() == FALSE){
		// 	session()->setFlashdata('error_login', 'Silahkan login terlebih dahulu untuk mengakses data');
		// 	return redirect()->to('/auth/login');
		// }
		// $data['total_transaction']	= $this->dashboard_model->getCountTrx();
		// $data['total_product']		= $this->dashboard_model->getCountProduct();
		// $data['total_category']		= $this->dashboard_model->getCountCategory();
		// $data['total_user']			= $this->dashboard_model->getCountUser();
		// $data['latest_trx']			= $this->dashboard_model->getLatestTrx();

		// $chart['grafik']			= $this->dashboard_model->getGrafik();
		$data['total_transaction']	=100;
		$data['total_product']		= 100;
		$data['total_category']		= 100;
		$data['total_user']			= 100;
		$data['latest_trx']			="";
		echo view('dashboard', $data);
		// echo view('_partials/footer', $chart);
    }
    
}