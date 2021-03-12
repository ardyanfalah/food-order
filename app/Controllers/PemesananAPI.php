<?php namespace App\Controllers;
 
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\Pemesanan_model;
use App\Models\PemesananDetail_model;
use App\Models\Tempat_model;
use App\Models\TempatDetail_model;

 
class PemesananAPI extends ResourceController
{
    use ResponseTrait;
    // get all product
    public function index()
    {
        $model = new Pemesanan_model();
        $modelDetail = new PemesananDetail_model();
        $modelTempatPemesanan = new TempatDetail_model();
        try
        {
            $data = $model->getPemesanan();
            foreach($data as $i => $item) {
                $data[$i]["menu"] = $modelDetail->getDetailByPemesanan($data[$i]["id_pmsn"]);
                $tempTempat = $modelTempatPemesanan->getTempatByPemesanan($data[$i]["id_pmsn"]);
                $data[$i]["tempat"] = $tempTempat[0]->no_tempat;
            }

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

    public function getByAccount($id = null)
    {
        $model = new Pemesanan_model();
        $modelDetail = new PemesananDetail_model();
        $modelTempatPemesanan = new TempatDetail_model();

        try
        {
            $data = $model->getByAccount($id);
            foreach($data as $i => $item) {
                $data[$i]["menu"] = $modelDetail->getDetailByPemesanan($data[$i]["id_pmsn"]);
                $tempTempat = $modelTempatPemesanan->getTempatByPemesanan($data[$i]["id_pmsn"]);
                $data[$i]["tempat"] = $tempTempat[0]->no_tempat;
            }
            $response = [
                'success'   => true,
                'data'  => $data,
                'messages' => "success"
            ];
            return $this->respond($response, 200);
        }catch(\Exception $e){
            $response = [
                'success'   => false,
                'data'  => null,
                'messages' => $e->getMessage()
            ];
            return $this->respond($response, 200);
        }
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
        $model = new Pemesanan_model();
        $modelDetail = new PemesananDetail_model();
        $dataPemesanan = $model->getPemesanan();
        foreach($dataPemesanan as $i => $item) {
            $dataPemesanan[$i]["menu"] = $modelDetail->getDetailByPemesanan($dataPemesanan[$i]["id_pmsn"]);
        }
        $response = [
            'success'   => true,
            'data'  => $dataPemesanan,
            'messages' => 'success'
        ];
        return $this->respond($response, 200);
    }
    
    public function testCheck(){
        $model = new Pemesanan_model();
        $myJson = file_get_contents("php://input");
        $image = $this->request->getFile('Image_Menu');
        $temp = $this->request->getVar('data');
        $jsontemp = json_decode($temp);
        // random name file
        $name = $image->getRandomName();
        try{
            // foreach($arr as $i => $item) {
            //     $item->id_pmsn = 77;
            // }
            $response = [
                'success'   => true,
                'data'  => $jsontemp,
                'messages' => 'success'
            ];
        } catch(\Exception $e){
            $response = [
                'success'   => false,
                'data'  => $e->getMessage(),
                'messages' => 'success'
            ];
        }
        
        return $this->respond($response, 200);
    }

    public function createPemesanan()
    {
        $model = new Pemesanan_model();
        $modelTempat = new Tempat_model();
        $modelDetailTempat = new TempatDetail_model();

        $image = $this->request->getFile('image');
        $name = $image->getRandomName();
        $image->move(ROOTPATH . 'public/uploads', $name);

        $tempdata = $this->request->getVar('data');
        $temp = json_decode($tempdata);
        if(is_array($temp)){
            $data = $temp;
        } else {
            $data = json_decode($temp);
        }
        $obj = $data[0];
        $obj->gambar_bukti_pembayaran = $name;
        $header = json_decode(json_encode($obj),true);
        $arr = $data[1];
        if($obj->is_takeout == 'False'){
            $seat = $data[2];
        } else {
            $seat = null;
        }
        try{
            
            $post = $model->insertPemesanan($header);
            $id = $model->getLastId();
            foreach($arr as $i => $item) {
                $item->id_pmsn = $id;
            }
            
            $postDetail = $model->insertBatchDetailPemesanan($arr);

            //tambah for loop ganti status dan hit modelnya
            if($seat != null){
                foreach($seat as $i => $item) {
                    $item->id_pmsn = $id;
                    $tempat = $modelTempat->updateStatusTempat( 'Reserved',$item->id_tmpt );
                } 
                $detailTempat = $modelDetailTempat->insertBatchDetailPemesananTempat($seat);
            }
            //

            $response = [
                'success'   => true,
                'data'  => null,
                'messages' => 'success'
            ];
        } catch(\Exception $e) {
            $response = [
                'success'   => false,
                'data'  => $e->getMessage(),
                'messages' => 'failed'
            ];
        }
        
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
                $detail[$i]['id_pmsn'] = 77;
            }

            
            $postDetail = $model->insertBatchDetailPemesanan($detail);
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