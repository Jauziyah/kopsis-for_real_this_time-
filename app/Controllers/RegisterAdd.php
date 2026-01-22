<?php 

namespace App\Controllers;

use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\Shield\Controllers\RegisterController;
use App\Models\PelangganModel_register;
use App\Models\UsersModel_register;

class RegisterAdd extends RegisterController{

    protected $pelanggan_model;
    protected $user_model;
    protected $helpers = ['form']; 
    public function __construct()
    {
        $this->pelanggan_model = new PelangganModel_register();
        $this->user_model = new UsersModel_register();
    }  

    public function index(){
        return view('register');
    }

    public function registerAction(): RedirectResponse
    {
        $response =  parent::registerAction();;
        if(auth()->loggedIn()){
            $this->user_model->save([
                'nama_user' => $this->request->getVar('username'),
                'username' => $this->request->getVar('username'),
                'role' => 'pelanggan',
                'alamat' => $this->request->getVar('alamat'),
                'users_id' => auth()->id()
            ]);

            $this->pelanggan_model->save([
                'nama_pelanggan' => $this->request->getVar('username'),
                'username' => $this->request->getVar('username'),
                'alamat' => $this->request->getVar('alamat'),
            ]);
        }

        return $response;
    }
}
?>