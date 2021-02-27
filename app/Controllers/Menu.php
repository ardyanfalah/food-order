<?php namespace App\Controllers;
 
use CodeIgniter\Controller;
use App\Models\Menu_model;
use App\Models\Kategori_model;

class Menu extends Controller
{
    protected $helpers = [];

    public function __construct()
    {
        helper(['form']);
        $this->kategori_model  = new Kategori_model();
        $this->menu_model = new Menu_model();
    }

    public function index()
    {
        // // $category           = $this->request->getGet('category');
        // // $keyword            = $this->request->getGet('keyword');

        // // $data['category']   = $category;
        // // $data['keyword']    = $keyword;

        $categories         = $this->kategori_model ->where('status_ktgr', 'Active')->findAll();
        $data['categories'] = ['' => 'Pilih Category'] + array_column($categories, 'nama_ktgr', 'id_ktgr');

        // filter
        // $where      = [];
        // $like       = [];
        // $or_like    = [];

        // if(!empty($category)){
        //     $where = ['products.id_ktgr' => $category];
        // }

        // if(!empty($keyword)){
        //     $like   = ['products.product_name' => $keyword];
        //     $or_like   = ['products.product_sku' => $keyword, 'products.product_description' => $keyword];
        // }
        // // end filter

        // // paginate
        // $paginate = 5;
        // $data['products']   = $this->menu_model->join('categories', 'categories.id_ktgr = products.id_ktgr')->where($where)->like($like)->orLike($or_like)->paginate($paginate, 'product');
        // $data['pager']      = $this->menu_model->pager;

        // // generate number untuk tetap bertambah meskipun pindah halaman paginate
        // $nomor = $this->request->getGet('page_product');
        // // define $nomor = 1 jika tidak ada get page_product
        // if($nomor == null){
        //     $nomor = 1;
        // }
        // $data['nomor'] = ($nomor - 1) * $paginate;
        // end generate number
        
        $keyword            = $this->request->getGet('keyword');
        $data['keyword']    = $keyword;


        // filter
        $where      = [];
        $like       = [];
        $or_like    = [];

        if(!empty($keyword)){
            $like   = ['tbl_menu.nama_menu' => $keyword];
            $or_like   = ['tbl_menu.deskripsi_menu' => $keyword];
        }
        // end filter

        // paginate
        $paginate = 5;
        $data['products']   = $this->menu_model->where($where)->like($like)->orLike($or_like)->paginate($paginate, 'product');
        $data['pager']      = $this->menu_model->pager;

        // generate number untuk tetap bertambah meskipun pindah halaman paginate
        $nomor = $this->request->getGet('page_product');
        // define $nomor = 1 jika tidak ada get page_product
        if($nomor == null){
            $nomor = 1;
        }
        $data['nomor'] = ($nomor - 1) * $paginate;
        // end generate number

        echo view('product/index', $data);
    }
 
    public function getMenu()
    {
        $data = $this->menu_model->where('status_Menu','Active')->findAll();
    }

    public function create()
    {
        
        $categories = $this->kategori_model ->where('status_ktgr', 'Active')->findAll();
        $data['categories'] = ['' => 'Pilih Category'] + array_column($categories, 'nama_ktgr', 'id_ktgr');
        return view('product/create', $data);
    }

    public function store()
    {
        $validation =  \Config\Services::validation();

        // get file
        $image = $this->request->getFile('gambar_menu');
        // random name file
        $name = $image->getRandomName();

        $data = array(
            'nama_menu'          => $this->request->getPost('nama_menu'),
            'harga_menu'         => $this->request->getPost('harga_menu'),
            'id_ktgr'           => $this->request->getPost('id_ktgr'),
            'status_Menu'        => $this->request->getPost('status_Menu'),
            'gambar_menu'         => $name,
            'deskripsi_menu'   => $this->request->getPost('deskripsi_menu'),
        );


        if($validation->run($data, 'product') == FALSE){
            session()->setFlashdata('inputs', $this->request->getPost());
            session()->setFlashdata('errors', $validation->getErrors());
            return redirect()->to(base_url('product/create'));
        } else {
            // upload
            $image->move(ROOTPATH . 'public/uploads', $name);
            // insert
            $simpan = $this->menu_model->insertMenu($data);
            if($simpan)
            {
                session()->setFlashdata('success', 'Created Product successfully');
                return redirect()->to(base_url('product')); 
            }
        }
    }
 
    public function show($id)
    {  
        $data['product'] = $this->menu_model->getMenu($id);
        echo view('product/show', $data);
    }
    
    public function edit($id)
    {  
        $categories = $this->kategori_model ->where('status_ktgr', 'Active')->findAll();
        $data['categories'] = ['' => 'Pilih Category'] + array_column($categories, 'nama_ktgr', 'id_ktgr');

        $data['product'] = $this->menu_model->getMenu($id);
        echo view('product/edit', $data);
    }

    public function update()
    {
        $id = $this->request->getPost('id_menu');

        $validation =  \Config\Services::validation();

        // get file
        $image = $this->request->getFile('gambar_menu');
        // random name file
        $name = $image->getRandomName();
        
        $data = array(
            'nama_menu'          => $this->request->getPost('nama_menu'),
            'harga_menu'         => $this->request->getPost('harga_menu'),
            'id_ktgr'           => $this->request->getPost('id_ktgr'),
            'status_Menu'        => $this->request->getPost('status_Menu'),
            'gambar_menu'         => $name,
            'deskripsi_menu'   => $this->request->getPost('deskripsi_menu'),
        );

        if($validation->run($data, 'product') == FALSE){
            session()->setFlashdata('inputs', $this->request->getPost());
            session()->setFlashdata('errors', $validation->getErrors());
            return redirect()->to(base_url('product/edit/'.$id));
        } else {
            // upload
            $image->move(ROOTPATH . 'public/uploads', $name);
            // update
            $ubah = $this->menu_model->updateMenu($data, $id);
            if($ubah)
            {
                session()->setFlashdata('info', 'Updated Product successfully');
                return redirect()->to(base_url('product')); 
            }
        }
    }
 
    public function delete($id)
    {
        $hapus = $this->menu_model->deleteMenu($id);
        if($hapus)
        {
            session()->setFlashdata('warning', 'Deleted Product successfully');
            return redirect()->to(base_url('product')); 
        }
    }
}