<?php namespace Config;

class Validation
{
	public $ruleSets = [
		\CodeIgniter\Validation\Rules::class,
		\CodeIgniter\Validation\FormatRules::class,
		\CodeIgniter\Validation\FileRules::class,
		\CodeIgniter\Validation\CreditCardRules::class,
	];

	public $templates = [
		'list'   => 'CodeIgniter\Validation\Views\list',
		'single' => 'CodeIgniter\Validation\Views\single',
	];

	public $category = [
        'nama_ktgr'     => 'required',
        'status_ktgr'     => 'required'
	];
	
	public $category_errors = [
        'nama_ktgr' => [
            'required'    => 'Nama category wajib diisi.',
        ],
        'status_ktgr'    => [
            'required' => 'Status category wajib diisi.'
        ]
	];
	
	public $product = [
		'nama_menu'          => 'required',
		'harga_menu'         => 'required',
		'id_ktgr'           => 'required',
		'status_Menu'        => 'required',
		'gambar_menu'         => 'uploaded[gambar_menu]|mime_in[gambar_menu,image/jpg,image/jpeg,image/gif,image/png]|max_size[gambar_menu,1000]',
		'deskripsi_menu' 	=> 'required'
	];

	public $product_errors = [
		'id_ktgr' 	=> [
			'required' 	=> 'Nama category wajib diisi.',
		],
		'nama_menu'	=> [
			'required' 	=> 'Nama product wajib diisi.'
		],
		'harga_menu' => [
			'required' 	=> 'Harga product wajib diisi.'
		],
		'status_Menu'=> [
			'required' 	=> 'Status product wajib diisi.'
		],
		'gambar_menu'=> [
			'mime_in' 	=> 'Gambar product hanya boleh diisi dengan jpg, jpeg, png atau gif.',
			'max_size'	=> 'Gambar product maksimal 1mb',
			'uploaded'	=> 'Gambar product wajib diisi'
		],
		'deskripsi_menu'   => [
			'required' 			=> 'Description product wajib diisi.'
		]
	];

	public $transaction = [
		'trx_file'         => 'uploaded[trx_file]|ext_in[trx_file,xls,xlsx]|max_size[trx_file,1000]',
	];

	public $transaction_errors = [
		'trx_file'=> [
			'ext_in' 	=> 'File Excel hanya boleh diisi dengan xls atau xlsx.',
			'max_size'	=> 'File Excel product maksimal 1mb',
			'uploaded'	=> 'File Excel product wajib diisi'
		]
	];

	public $authlogin = [
		'email'         => 'required|valid_email',
		'password' 		=> 'required'
	];

	public $authlogin_errors = [
		'email'=> [
			'required' 	=> 'Email wajib diisi.',
			'valid_email'	=> 'Email tidak valid'
		],
		'password'=> [
			'required' 	=> 'Password wajib diisi.'
		]
	];

	public $authregister = [
		'email'         	=> 'required|valid_email|is_unique[users.email]',
		'username' 			=> 'required|alpha_numeric|is_unique[users.username]|min_length[8]|max_length[35]',
		'name' 				=> 'required|alpha_numeric_space|min_length[3]|max_length[35]',
		'password' 			=> 'required|string|min_length[8]|max_length[35]',
		'confirm_password' 	=> 'required|string|matches[password]|min_length[8]|max_length[35]',
	];

	public $authregister_errors = [
		'email'=> [
			'required' 		=> 'Email wajib diisi',
			'valid_email'	=> 'Email tidak valid',
			'is_unique'		=> 'Email sudah terdaftar'
		],
		'username'=> [
			'required' 		=> 'Username wajib diisi',
			'alpha_numeric'	=> 'Username hanya boleh berisi huruf dan angka',
			'is_unique'		=> 'Username sudah terdaftar',
			'min_length'	=> 'Username minimal 3 karakter',
			'max_length'	=> 'Username maksimal 35 karakter'
		],
		'name'=> [
			'required' 				=> 'Name wajib diisi',
			'alpha_numeric_spaces'	=> 'Name hanya boleh berisi huruf, angka dan spasi',
			'min_length'			=> 'Name minimal 3 karakter',
			'max_length'			=> 'Name maksimal 35 karakter'
		],
		'password'=> [
			'required' 		=> 'Password wajib diisi',
			'string'		=> 'Password hanya boleh berisi huruf, angka, spasi dan karakter lain',
			'min_length'	=> 'Password minimal 8 karakter',
			'max_length'	=> 'Password maksimal 35 karakter'
		],
		'confirm_password'=> [
			'required' 		=> 'Konfirmasi password wajib diisi',
			'string'		=> 'Konfirmasi password hanya boleh berisi huruf, angka, spasi dan karakter lain',
			'matches'		=> 'Konfirmasi password tidak sama dengan password',
			'min_length'	=> 'Konfirmasi password minimal 8 karakter',
			'max_length'	=> 'Konfirmasi password maksimal 35 karakter'
		]
	];
}
