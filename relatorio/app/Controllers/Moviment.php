<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MovimentModel;
use App\Models\UserModel;

class Moviment extends BaseController
{

    private $movimentModel;

    public function __construct()
    {
        $this->movimentModel = new MovimentModel();
    }
    public function getIndex()
    {
        $userModel = new UserModel();
        $loggedInUserId = session()->get('loggedInUser');
        $userInfo = $userModel->find($loggedInUserId);

        $dados = [
            'title' => 'Moviments',
            'userInfo' => $userInfo,
            'moviments' => $this->movimentModel->orderBy('id', 'DESC')->findAll(),
        ];

        return view('moviments/index', $dados);
    }

    public function getDelete($id) {
        if($this->movimentModel->delete($id)) {
            echo view('messages', [
                'message' => 'Movimento excluído com sucesso'
            ]);
        } else {
            echo 'erro.';
        }
    }

    public function getCreate() {
        $userModel = new UserModel();
        $loggedInUserId = session()->get('loggedInUser');
        $userInfo = $userModel->find($loggedInUserId);

        $data = [
            'title' => 'Novo Movimento',
            'userInfo' => $userInfo,

        ];

        return view('moviments/form', $data);
    }

    public function postStore(){
        $params = [
            'description' => $this->request->getPost('description'),
            'value' => $this->request->getPost('value'),
            'type' => $this->request->getPost('type'),
            'user_id' => session()->get('loggedInUser')
        ];

        $db = db_connect();
        $db->query("INSERT INTO moviment VALUES (DEFAULT, :description:, NOW(), :value:, :type:, :user_id:)", $params);
        $db->close();

        return view('messages', [
            'message' => 'Movimento salvo com sucesso'
        ]);
    }

    public function getGeneratePdf()
    {
       $userModel = new UserModel();
       $loggedInUserId = session()->get('loggedInUser');
       $userInfo = $userModel->find($loggedInUserId);

        $data = [
            'userInfo' => $userInfo,
           'moviments' => $this->movimentModel->findAll(),
        ];
       $dompdf = new \Dompdf\Dompdf();
        $dompdf->loadHtml(view('relatorio/index', $data));
        $dompdf->setPaper('A4','portrait');
       $dompdf->render();
       $dompdf->stream("Relatório de Movimentos");
    }
}