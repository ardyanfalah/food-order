<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Kategori_model;
 
class Kategori extends Controller
{

    public function __construct()
    {
		// $this->cek_login();
	}

    // public function cek_login()
	// {
	// 	if(session()->get('level') != "Admin" && session()->get('status') != "Active"){
	// 		session()->setFlashdata('errors', ['' => 'Silahkan login terlebih dahulu untuk mengakses data.']);
	// 		return redirect()->to('/auth/login');
	// 	}
	// }

    public function index()
    {
        $model = new Kategori_model();
        $data['categories'] = $model->getKategori();
        echo view('category/index', $data);
    }
 
    public function create()
    {
        return view('category/create');
    }

    public function store()
    {
        $validation =  \Config\Services::validation();

        $data = array(
            'nama_ktgr'     => $this->request->getPost('nama_ktgr'),
            'status_ktgr'   => $this->request->getPost('status_ktgr'),
        );

        if($validation->run($data, 'category') == FALSE){
            session()->setFlashdata('inputs', $this->request->getPost());
            session()->setFlashdata('errors', $validation->getErrors());
            return redirect()->to(base_url('category/create'));
        } else {
            $model = new Kategori_model();
            $simpan = $model->insertKategori($data);
            if($simpan)
            {
                session()->setFlashdata('success', 'Created Category successfully');
                return redirect()->to(base_url('category')); 
            }
        }
    }
 
    public function edit($id)
    {  
        $model = new Kategori_model();
        $data['category'] = $model->getKategori($id)->getRowArray();
        echo view('category/edit', $data);
    }

    public function update()
    {
        $id = $this->request->getPost('category_id');

        $validation =  \Config\Services::validation();

        $data = array(
            'nama_ktgr'     => $this->request->getPost('nama_ktgr'),
            'status_ktgr'   => $this->request->getPost('status_ktgr'),
        );
        
        if($validation->run($data, 'category') == FALSE){
            session()->setFlashdata('inputs', $this->request->getPost());
            session()->setFlashdata('errors', $validation->getErrors());
            return redirect()->to(base_url('category/edit/'.$id));
        } else {
            $model = new Kategori_model();
            $ubah = $model->updateKategori($data, $id);
            if($ubah)
            {
                session()->setFlashdata('info', 'Updated Category successfully');
                return redirect()->to(base_url('category')); 
            }
        }
    }
 
    public function delete($id)
    {
        $model = new Kategori_model();
        $hapus = $model->deleteKategori($id);
        if($hapus)
        {
            session()->setFlashdata('warning', 'Deleted Category successfully');
            return redirect()->to(base_url('category')); 
        }
    }
}