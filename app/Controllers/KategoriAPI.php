<?php namespace App\Controllers;
 
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\Kategori_model;
 
class KategoriAPI extends ResourceController
{
    use ResponseTrait;
    // get all product
    public function index()
    {
        $model = new Kategori_model();
        $data = $model->findAll();
        $response = [
            'success'   => true,
            'data'  => $data,
            'messages' => 'success'
        ];
        return $this->respond($response, 200);
    }
 
    // get single product
    public function show($id = null)
    {
        $model = new Kategori_model();
        $data = $model->getWhere(['id_ktgr' => $id])->getResult();
        if($data){
            return $this->respond($data);
        }else{
            return $this->failNotFound('No Data Found with id '.$id);
        }
    }
 
    // create a product
    public function create()
    {
        $model = new Kategori_model();
        
        $myJson = file_get_contents("php://input");
        $data = json_decode($myJson, true);
        
        try{
            $model->insertKategori($data);
            $response = [
                'status'   => 201,
                'error'    => null,
                'messages' => [
                    'success' => 'Data Saved'
                ]
            ];
        } catch (\Exception $e) {
            $response = [
                'success'   => false,
                'data'  => $e->getMessage(),
                'messages' => 'failed'
            ];
        }
         
        return $this->respondCreated($response, 201);
    }
 
    // update product
    public function update($id = null)
    {
        $model = new Kategori_model();
        $myJson = file_get_contents("php://input");
        $data = json_decode($myJson, true);
        

        try{
            $model->updateKategori($data, $id);
            $response = [
                'status'   => 201,
                'error'    => null,
                'messages' => [
                    'success' => 'Data Updated'
                ]
            ];
        } catch (\Exception $e) {
            $response = [
                'success'   => false,
                'data'  => $e->getMessage(),
                'messages' => 'failed'
            ];
        }
        
        return $this->respond($response, 201);

    }
 
    // delete product
    public function delete($id = null)
    {
        $model = new Kategori_model();
        $data = $model->getKategori($id);
        if($data){
            $model->deleteKategori($id);
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'Data Deleted'
                ]
            ];
             
            return $this->respondDeleted($response);
        }else{
            return $this->failNotFound('No Data Found with id '.$id);
        }
         
    }
 
}