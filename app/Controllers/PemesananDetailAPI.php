<?php namespace App\Controllers;
 
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\PemesananDetail_model;
 
class PemesananDetailAPI extends ResourceController
{
    use ResponseTrait;
    // get all product
    public function index()
    {
        $model = new PemesananDetail_model();
        
        $data = $model->getDetailPemesanan();
        try
        {
            $data = $model->getDetailPemesanan();
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
        $model = new PemesananDetail_model();
        $data = $model->getWhere(['id_detail_pmsn' => $id])->getResult();
        if($data){
            return $this->respond($data);
        }else{
            return $this->failNotFound('No Data Found with id '.$id);
        }
    }
 
    // create a product
    public function create()
    {
        $response = [
            'success'   => true,
            'data'  => "Detail",
            'messages' => 'success'
        ];
        // return $this->respond($response, 200);
        return $this->respond($response, 200);;
    }
    // update product
    public function update($id = null)
    {
        $model = new PemesananDetail_model();
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
        $model = new PemesananDetail_model();
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