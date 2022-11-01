<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Libraries\Hash;
use App\Models\UserModel;
use PHPUnit\Framework\MockObject\Exception;

class Auth extends BaseController
{

    public function __construct()
    {
        helper(['url', 'form']);
    }

   
    public function getIndex()
    {
        return view('auth/login');
    }

    
    public function getRegister(){
        return view('auth/register');
    }
   
    public function postRegisterUser(){
       

        $validated = $this->validate([
            'name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Your full Name is required'
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Your email is required',
                    'valid_email' => 'Email is already used.'
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[5]|max_length[20]',
                'errors' => [
                    'required' => 'Your password is required',
                    'min_length' => 'Password must be 5 charactars long',
                    'max_length' => 'Password cannot be longer than 20 charectars'
                ]
            ],
            'passwordConf' => [
                'rules' => 'required|min_length[5]|max_length[20]|matches[password]',
                'errors' => [
                    'required' => 'Your conform password is required',
                    'min_length' => 'Password must be 5 charactars long',
                    'max_length' => 'Password cannot be longer than 20 charectars',
                    'matches' => 'Confirm password must match the password'
                ]
            ],
        ]);

        if(!$validated){
            return view('auth/register', ['validation' => $this->validator]);
        }
  

        $name = $this->request->getPost('name');
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $passwordConf = $this->request->getPost('passwordConf');

        $data = [
            'name' => $name,
            'email' => $email,
            'password' => Hash::encrypt($password)
        ];
        
        
        $userModel = new \App\Models\UserModel();
        $query = $userModel->insert($data);

        if(!$query)
        {
            return redirect()->back()->with('fail', 'Saving user failed');
        } 
        else
        {
            return redirect()->back()->with('success', 'User add successfully');
        }
    }


    public function postLoginUser(){
        

        $validated = $this->validate([
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Your email is required',
                    'valid_email' => 'Email is already used.'
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[5]|max_length[20]',
                'errors' => [
                    'required' => 'Your password is required',
                    'min_length' => 'Password must be 5 charactars long',
                    'max_length' => 'Password cannot be longer than 20 charectars'
                ]
            ]
        ]);

        if(!$validated){
            return view('auth/login', ['validation' => $this->validator]);
        }
        else
        {            

            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            $userModel = new UserModel();
            $userInfo = $userModel->where('email', $email)->first();

            $checkPassword = Hash::check($password, $userInfo['password']);

            if(!$checkPassword)
            {
                session()->setFlashdata('fail', 'Incorrect password provided');
                return redirect()->to('auth');
            }
            else
            {

                $userId = $userInfo['id'];

                session()->set('loggedInUser', $userId);
                return redirect()->to('dashboard');
            }
        }
    }

    
    public function getLogout(){
        
        if(session()->has('loggedInUser')){
            session()->remove('loggedInUser');
        }

        return redirect()->to('auth?access=loggedout')->with('fail', 
        'Você saiu');
    }
}
