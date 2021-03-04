<?php namespace App\Controllers;
 
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\Auth_model;
use App\Models\Pelanggan_model;

 
class AuthAPI extends ResourceController
{
    use ResponseTrait;
    // get all product
    public function index()
    {
        $response = [
            'success'   => true,
            'data'  => NULL,
            'messages' => 'success'
        ];
        return $this->respond($response, 200);
    }
 
    public function login_user(){
        $model = new Pelanggan_model();
        $myJson = file_get_contents("php://input");
        $data = json_decode($myJson, true);
        try{
            $login = $model->cek_login($data["email"]);
            if($login != null){
                if($login["password"] == $data["password"]){
                    $response = [
                        'success'   => true,
                        'data'  => $login ,
                        'messages' => 'success'
                    ];
                } else {
                    $response = [
                        'success'   => false,
                        'data'  => null ,
                        'messages' => 'Password tidak sesuai'
                    ];
                }
            } else {
                $response = [
                    'success'   => false,
                    'data'  => null ,
                    'messages' => 'Email tidak ditemukan'
                ];
            }
            
        } catch (\Exception $e) {
            $response = [
                'success'   => false,
                'data'  => $e->getMessage(),
                'messages' => 'failed'
            ];
        }
        return $this->respond($response, 200);

    }

    // create a product
    public function register_user()
    {
        $model = new Pelanggan_model();
        
        $myJson = file_get_contents("php://input");
        $data = json_decode($myJson,true);
        // $response = [
        //     'success'   => true,
        //     'data'    => $myJson,
        //     'messages' => 'Data Saved'
        // ];
        try{
            $model->insertPelanggan($data);
            $response = [
                'success'   => true,
                'error'    => null,
                'messages' => 'Data Saved'
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

    public function create()
    {
        $model = new Auth_model();
        
        $myJson = file_get_contents("php://input");
        $data = json_decode($myJson, true);
        
        try{
            $model->register($data);
            $response = [
                'status'   => 201,
                'error'    => null,
                'success'   => true,
                'messages' => 'Data Saved'
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
        $model = new Auth_model();
        $myJson = file_get_contents("php://input");
        $data = json_decode($myJson, true);
        

        try{
            $model->updateMenu($data, $id);
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
 
}