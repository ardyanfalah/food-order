<?php namespace App\Controllers;
 
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\Rating_model;
use App\Models\Pelanggan_model;
 
class RatingAPI extends ResourceController
{
    use ResponseTrait;
    // get all product
    public function index()
    {
        $model = new Rating_model();
        try{
            $data = $model->getRating();
            $response = [
                'success'   => true,
                'data'  => $data,
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

    public function getHighRating($id = null){
        $model = new Rating_model();
        $pelangganModel = new Pelanggan_model();
        $ratings = new \stdClass();
        try{
            $pelangganSelf = $pelangganModel->getPelanggan($id);
            $pelangganAll = $pelangganModel->getPelanggan();
            $counter = 0;
            foreach ($pelangganAll as $value) {
                $temp = $model->getRatingAverageByPelanggan($value["id_plgn"]);
                $temp_id = (int)$value["id_plgn"];
                $temp_menu = new \stdClass();
                foreach ($temp as $menu) {
                    $id_menu = $menu->id_menu;
                    $temp_menu->$id_menu = $menu->rating_average;
                }
                $ratings->$temp_id = $temp_menu;
                $counter= $counter + 1;
            }
            $data = $this->getRecommendations($ratings,$id);
            $response = [
                'success'   => true,
                'data'  => $data,
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
 
    public function test(){
        $books =  array(
                
            "phil" => array("my girl" => 2.5, "the god delusion" => 3.5,
                            "tweak" => 3, "the shack" => 4,
                            "the birds in my life" => 2.5,
                            "new moon" => 3.5),
            
            "sameer" => array("the last lecture" => 2.5, "the god delusion" => 3.5,
                              "the noble wilds" => 3, "the shack" => 3.5,
                              "the birds in my life" => 2.5, "new moon" => 1),
            
            "john" => array("a thousand splendid suns" => 5, "the secret" => 3.5,
                            "tweak" => 1),
            
            "peter" => array("chaos" => 5, "php in action" => 3.5),
            
            "jill" => array("the last lecture" => 1.5, "the secret" => 2.5,
                            "the noble wilds" => 4, "the host: a novel" => 3.5,
                            "the world without end" => 2.5, "new moon" => 3.5),
            
            "bruce" => array("the last lecture" => 3, "the hollow" => 1.5,
                             "the noble wilds" => 3, "the shack" => 3.5,
                             "the appeal" => 2, "new moon" => 3),
            
            "tom" => array("chaos" => 2.5)
            
            
        );
        return $books;
    }

    public function getByPemesanan($id){
        $model = new Rating_model();
        $data = $model->getWhere(['id_rating' => $id])->getResult();
        if($data){
            return $this->respond($data);
        }else{
            return $this->failNotFound('No Data Found with id '.$id);
        } 
    }

    // get single product
    public function show($id = null)
    {
        $model = new Rating_model();
        $data = $model->getWhere(['id_rating' => $id])->getResult();
        if($data){
            return $this->respond($data);
        }else{
            return $this->failNotFound('No Data Found with id '.$id);
        }
    }
 
    
    // create a product
    public function create()
    {
        $model = new Rating_model();
        
        $myJson = file_get_contents("php://input");
        $data = json_decode($myJson, true);
        
        try{
            $model->insertRating($data);
            $response = [
                'success'   => true,
                'data'    => "success",
                'messages' => "success"
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
        $model = new Rating_model();
        $myJson = file_get_contents("php://input");
        $data = json_decode($myJson, true);
        

        try{
            $model->updateRating($data, $id);
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
        $model = new Rating_model();
        $data = $model->getRating($id);
        if($data){
            $model->deleteRating($id);
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
 
    public function similarityDistance($preferences, $person1, $person2)
    {
        $similar = array();
        $sum = 0;
    
        foreach($preferences[$person1] as $key=>$value)
        {
            if(array_key_exists($key, $preferences[$person2]))
                $similar[$key] = 1;
        }
        
        if(count($similar) == 0)
            return 0;
        
        foreach($preferences[$person1] as $key=>$value)
        {
            if(array_key_exists($key, $preferences[$person2]))
                $sum = $sum + pow($value - $preferences[$person2][$key], 2);
        }
        
        return  1/(1 + sqrt($sum));     
    }
    
    
    public function matchItems($preferences, $person)
    {
        $score = array();
        
            foreach($preferences as $otherPerson=>$values)
            {
                if($otherPerson !== $person)
                {
                    $sim = $this->similarityDistance($preferences, $person, $otherPerson);
                    
                    
                    if($sim > 0)
                        $score[$otherPerson] = $sim;
                }
            }
        
        array_multisort($score, SORT_DESC);
        
        return $score;
    
    }
    
    
    public function transformPreferences($preferences)
    {
        $result = array();
        
        foreach($preferences as $otherPerson => $values)
        {
            foreach($values as $key => $value)
            {
                $result[$key][$otherPerson] = $value;
            }
        }
        
        return $result;
    }
    
    
    public function getRecommendations($preferences, $person)
    {
        $total = array();
        $simSums = array();
        $ranks = array();
        $sim = 0;
        
        foreach($preferences as $otherPerson=>$values)
        {

            if($otherPerson != $person)
            {
                $sim = $this->similarityDistance($preferences, $person, $otherPerson);
                echo "<pre>";
                    // print_r($sim); 
                    var_dump($sim);
                    echo "</pre>";
            }
            
            if($sim > 0)
            {
                foreach($preferences[$otherPerson] as $key=>$value)
                {
                    if(!array_key_exists($key, $preferences[$person]))
                    {
                        if(!array_key_exists($key, $total)) {
                            $total[$key] = 0;
                        }
                        $total[$key] += $preferences[$otherPerson][$key] * $sim;
                        
                        if(!array_key_exists($key, $simSums)) {
                            $simSums[$key] = 0;
                        }
                        $simSums[$key] += $sim;
                    }
                }
                
            }
        }

        foreach($total as $key=>$value)
        {
            $ranks[$key] = $value / $simSums[$key];
        }
        
    array_multisort($ranks, SORT_DESC);    
    return $ranks;
        
    }

}