<?php namespace App\Controllers;
 
use CodeIgniter\Controller;
use App\Models\Tempat_model;

class Tempat extends Controller
{

    public function __construct()
    {
        helper(['form']);
        $this->tempat_model = new Tempat_model();
    }

    public function index()
    {
        $data['tempat'] = $this->tempat_model->getTempat();
        echo view('tempat/index', $data);
    }

    public function edit($id){
        $temp = $this->tempat_model->getTempat($id);
        $data['tempat'] = $temp[0];
        echo view('tempat/edit', $data);
    }

    public function update(){
        $id = $this->request->getPost('id_tmpt');
        $data = $this->request->getPost('status_tmpt');

        try{
            $this->tempat_model->updateStatusTempat($data, $id);
            session()->setFlashdata('info', 'Updated Status Table Success');
            var_dump("sukses");
        } catch(\Exception $e) {
            var_dump($e->getMessage());
            session()->setFlashdata('info', 'Updated Status Table Failed');
            session()->setFlashdata('errors', $e->getMessage());
        }
        return redirect()->to(base_url('tempat'));
    }



}