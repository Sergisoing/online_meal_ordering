<?php
namespace Admin\Controller;
use Think\Controller;


class ConfigController extends Controller {


    public function index() {
        $user = D('user');
        $user->is_admin();
        $config = D('config');
        $data = $config->getField('id,noon_meal_time,night_meal_time');
        $this->assign('noon' ,$data[1]['noon_meal_time']);
        $this->assign('night', $data[1]['night_meal_time']);
        $this->assign('nav', '5');
        $this->assign('subNav', 1);
        $this->display('index');
    }


    public function updateMealTime() {
        $user = D('user');
        $user->is_admin();
        $noonTime = I('post.noon');
        $nightTime = I('post.night');
        if (empty($noonTime) || empty($nightTime)) {
            $this->ajaxReturn(array('status' => 'error', 'data' => '参数错误'));
        }
        $config = D('config');

        $config->C(array('noon_meal_time' => $noonTime, 'night_meal_time' => $nightTime));
        $this->ajaxReturn(array('status' => 'ok'));
    }

    public function updateAdminPw() {
        $user = D('user');
        $user->is_admin();
        $old = I('post.old');
        $new = I('post.new');
        $confirm = I('post.confirm');
        if (empty($new) || empty($old) || empty($confirm)) {
            $this->ajaxReturn(array('status' => 'error', 'data' => '参数错误'));
        }
        if ($new != $confirm) {
            $this->ajaxReturn(array('status' => 'error', 'data' => '两次输入密码不一致'));
        }

        $config = D('config');
        $count = $config->where(array('id' => 1, 'password' => md5($old)))->save(array('password' => md5($new)));
        if ($count > 0) {
            $this->ajaxReturn(array('status' => 'ok'));
        } else {
            $this->ajaxReturn(array('status' => 'error', 'data' => '原密码不正确'));
        }
    }

}
