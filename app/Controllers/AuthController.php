<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\I18n\Time;
use App\Models\DiskonModel;


class AuthController extends BaseController
{
    protected $user;
    // protected $google;

    function __construct()
    {
        helper('form');
        $this->user = new UserModel();

        // $this->google = new Google([
        //     'clientId'     => getenv('GOOGLE_CLIENT_ID'),
        //     'clientSecret' => getenv('GOOGLE_CLIENT_SECRET'),
        //     'redirectUri'  => getenv('GOOGLE_REDIRECT_URI'),
        // ]);
    }

//     public function googleLogin()
//     {
//         $authUrl = $this->google->getAuthorizationUrl();
//         session()->set('oauth2state', $this->google->getState());
//         return redirect()->to($authUrl);
//     }

//     public function googleCallback()
//     {
//         $code = $this->request->getGet('code');
//         $state = $this->request->getGet('state');

//         if (empty($code) || ($state !== session()->get('oauth2state'))) {
//             session()->remove('oauth2state');
//             return redirect()->to('login')->with('error', 'Login gagal.');
//         }

//         $token = $this->google->getAccessToken('authorization_code', ['code' => $code]);
//         $googleUser = $this->google->getResourceOwner($token);

//         $userData = $googleUser->toArray();

//         // Lakukan pengecekan user di DB, simpan session login
//        session()->set([
//     'id'       => $user['id'],
//     'username' => $user['username'],
//     'email'    => $user['email'],
//     'isLoggedIn' => true
// ]);

//         return redirect()->to('/');
//     }

    public function login()
{
    if ($this->request->getPost()) {
        $rules = [
            'username' => 'required|min_length[6]',
            'password' => 'required|min_length[6]',
        ];

        if ($this->validate($rules)) {
            $username = $this->request->getVar('username');
            $password = $this->request->getVar('password');

            $dataUser = $this->user->where(['username' => $username])->first();

            if ($dataUser) {
                if (password_verify($password, $dataUser['password'])) {
                    
                    session()->set([
                        'id'        => $dataUser['id'],
                        'username'  => $dataUser['username'],
                        'email'     => $dataUser['email'],
                        'role'      => $dataUser['role'],
                        'isLoggedIn'=> true
                    ]);

                    $diskonModel = new DiskonModel();
                    $today = date('Y-m-d');
                    $diskon = $diskonModel->where('tanggal', $today)->first();

                    if ($diskon) {
                        session()->set('diskon_nominal', $diskon['nominal']);
                    }

                    return redirect()->to(base_url('Home'));
                } else {
                    session()->setFlashdata('failed', 'Kombinasi Username & Password Salah');
                    return redirect()->back();
                }
            } else {
                session()->setFlashdata('failed', 'Username Tidak Ditemukan');
                return redirect()->back();
            }
        } else {
            session()->setFlashdata('failed', $this->validator->listErrors());
            return redirect()->back();
        }
    }

    return view('v_login');
}

    public function registerForm()
{
    return view('register');
}


public function register()
{
    $validation = \Config\Services::validation();

    $rules = [
        'name'         => 'required',
        'email'        => 'required|valid_email|is_unique[user.email]',
        'username'     => 'required|is_unique[user.username]',
        'password'     => 'required|min_length[6]',
        'confpassword' => 'required|matches[password]'
    ];

    if (!$this->validate($rules)) {
        return redirect()->back()->withInput()->with('error', implode("<br>", $validation->getErrors()));
    }

    $data = [
        'username'   => $this->request->getPost('username'),
        'email'      => $this->request->getPost('email'),
        'password'   => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        'role'       => 'guest', // default role
        'created_at' => Time::now(),
        'updated_at' => Time::now()
    ];

    // Jika kamu ingin menyimpan juga 'name', pastikan kolom 'name' tersedia di tabel user
    if ($this->request->getPost('name')) {
        $data['name'] = $this->request->getPost('name');
    }

    $userModel = new \App\Models\UserModel();
    $userModel->insert($data);

    return redirect()->to('login')->with('success', 'Akun berhasil dibuat!');
}



    public function logout()
    {
        session()->destroy();
        return redirect()->to('login');
    }
    
}
