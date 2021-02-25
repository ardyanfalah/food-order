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
 
    public function testCheck(){
        $model = new Pemesanan_model();
        // $id = $model->getNextId();
        $myJson = file_get_contents("php://input");
        $data = json_decode($myJson);
        $tempheader =json_encode($data[0]);
        $header=json_decode($tempheader,true);
        $tempdetail =json_encode($data[1]);
        $detail=json_decode($tempdetail,true);
        $response = [
            'success'   => true,
            'data'  => $header,
            'messages' => 'success'
        ];
        return $this->respond($response, 200);
    }

    // create a product
    public function create()
    {
        // $model = new Pemesanan_model();
        // $myJson = file_get_contents("php://input");
        // $myArray = json_decode($myJson, true);
        // try{
        //     $data = $model->insertBatch($myArray);
        //     $response = [
        //         'success'   => true,
        //         'data'  => null,
        //         'messages' => 'success'
        //     ];
        // } catch (\Exception $e) {
        //     $response = [
        //         'success'   => false,
        //         'data'  => $e->getMessage(),
        //         'messages' => 'failed'
        //     ];
        // }
        // return $this->respond($response, 200);
        $model = new Pemesanan_model();
        $myJson = file_get_contents("php://input");
        $data = json_decode($myJson);
        $tempheader =json_encode($data[0],true);
        $header=json_decode($tempheader,true);
        $tempdetail =json_encode($data[1]);
        $detail=json_decode($tempdetail,true);
        try{
            $post = $model->insertPemesanan($header);
            $id = $model->getLastId();
            // array_walk ( $detail, function (&$key) { 
            //     $key["id_pmsn"] = $id; 
            // });
            // array_walk($detail, array($this ,'_handle'), array('id_pmsn'=>77));
            foreach($detail as $i => $item) {
                $detail[$i]['id_pmsn'] = $id;
            }

            
            // $postDetail = $model->insertBatchDetailPemesanan($detail);
            $response = [
                'success'   => true,
                'data'  => $detail,
                'messages' => 'success'
            ];
        } catch(\Exception $e) {
            $response = [
                'success'   => false,
                'data'  => $e->getMessage(),
                'messages' => 'failed'
            ];
        }
        
        // return $this->respond($response, 200);
        return $this->respond($response, 200);;
    }
    function _handle($detail, $data){
        $key["id_pmsn"] = $data['id_pmsn']; 
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