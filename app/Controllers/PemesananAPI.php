<?php namespace App\Controllers;
 
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\Pemesanan_model;
 
class PemesananAPI extends ResourceController
{
    use ResponseTrait;
    // get all product
    public function index()
    {
        $model = new Pemesanan_model();
        
        $data = $model->getPemesanan();
        try
        {
            $data = $model->getPemesanan();
            $response = [
                'success'   => true,
                'data'  => $data,
                'messages' => 'success'
            ];
        }
        catch (\Exception $e)
        {
            $response = [
                'success'   => false,
                'data'  => null,
                'messages' => $e->getMessage()
            ];
        }
    
        
        return $this->respond($response, 200);
    }

    // get single product
    public function show($id = null)
    {
        $model = new Pemesanan_model();
        $data = $model->getWhere(['id_pmsn' => $id])->getResult();
        if($data){
            return $this->respond($data);
        }else{
            return $this->failNotFound('No Data Found with id '.$id);
        }
    }
 
    public function test(){
        
        $data = [
            'Id_Trx'          => 0,
            'Id_Admin'         => $this->request->getPost('Id_Admin'),
            'Id_Pelanggan'           => $this->request->getPost('Id_Pelanggan'),
            'Id_Menu'        => $this->request->getPost('Id_Menu'),
            'Jumlah_Makanan'         => $this->request->getPost('Jumlah_Makanan'),
            'Harga_Menu'         => $this->request->getPost('Harga_Menu'),
            'Tanggal_Trx'   => $this->request->getPost('Tanggal_Trx'),
        ];

        $response = [
            'success'   => true,
            'data'  => $data,
            'messages' => 'failed'
        ];
        return $this->respond($response, 200);
    }


    // create a product
    public function create()
    {
        $model = new Pemesanan_model();
        $myJson = file_get_contents("php://input");
        $myArray = json_decode($myJson, true);
        try{
            $data = $model->insertBatch($myArray);
            $response = [
                'success'   => true,
                'data'  => null,
                'messages' => 'success'
            ];
        } catch (\Exception $e) {
            $response = [
                'success'   => false,
                'data'  => $e->getMessage(),
                'messages' => 'failed'
            ];
        }
        return $this->respond($response, 200);
    }
 
    // update product
    public function update($id = null)
    {
        $model = new Pemesanan_model();
        $json = $this->request->getJSON();
        if($json){
            $data = [
                'product_name' => $json->product_name,
                'product_price' => $json->product_price
            ];
        }else{
            $input = $this->request->getRawInput();
            $data = [
                'product_name' => $input['product_name'],
                'product_price' => $input['product_price']
            ];
        }
        // Insert to Database
        $model->update($id, $data);
        $response = [
            'status'   => 200,
            'error'    => null,
            'messages' => [
                'success' => 'Data Updated'
            ]
        ];
        return $this->respond($response);
    }
 
    // delete product
    public function delete($id = null)
    {
        $model = new Pemesanan_model();
        $data = $model->find($id);
        if($data){
            $model->delete($id);
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