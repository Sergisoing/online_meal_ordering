<?php
namespace Admin\Controller;
use Think\Controller;
class UserController extends Controller {
    public function index () {
        $this->display('sigin');
    }

    public function login ($userName = '', $password = '') {
        $data['status'] = 'ok';
        $data['username'] = $userName;
        $data['password'] = $password;
        $this->ajaxReturn($data);
    }
}
