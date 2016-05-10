<?php
namespace Home\Controller;
use Think\Controller;
use Home\Model;

class UserController extends Controller {

    public function index() {
        $user = D('Admin/user');
        $user->is_login();
        $dep = D('Admin/Department');
        $depList = $dep->getDepList();
        $this->assign('nav', 1);
        $this->assign('depList', $depList);
        $this->display();
    }

    public function updatePersonal() {
        $user = D('Admin/user');
        $user->is_login('ajax');
        $data = array();
        $data['name'] = I('post.name');
        $data['phone'] = I('post.phone');
        $data['dep_id'] = I('post.department');
        $data['sex'] = I('post.sex');
        $data['email'] = I('post.email');
        $user->where(array('emp_no'=> session('emp_no')))->save($data);
        $dep = D('department');
        $dep_name = $dep->where(array('id' => $data['dep_id']))->getField('dep_name');
        session('name', $data['name']);
        session('department', $dep_name);
        session('phone', $data['phone']);
        session('dep_id', $data['dep_id']);
        session('sex', $data['sex'] == 0 ? '男' : '女');
        session('email', $data['email']);
        $this->ajaxReturn(array('status' => 'ok'));
    }

    public function updatePw() {
        $user = D('Admin/user');
        $user->is_login('ajax');
        $oldPw = I('post.oldPw');
        $newPw = I('post.newPw');
        $confirm = I('post.confirm');
        if ($user->where(array('emp_no' => session('emp_no'), 'password' => md5($oldPw)))->count()>0) {

            if ($confirm == $newPw) {
                $user->where(array('emp_no' => session('emp_no')))->save(array('password' => md5($newPw)));
                $this->ajaxReturn(array('status' => 'ok'));
            } else {
                $this->ajaxReturn(array('status' => 'error', 'data' => '两次密码输入不一样'));
            }


        } else {
            $this->ajaxReturn(array('status' => 'error', 'data' => '密码不正确'));
        }
    }


    public function updateImg() {
        $user = D('Admin/user');
        $user->is_login('ajax');

        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     3145728 ;// 设置附件上传大小
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath  =     './Public/images/profile/'; // 设置附件上传根目录
        $upload->savePath  =     ''; // 设置附件上传（子）目录
        // 上传文件
        $info   =   $upload->upload();
        if(!$info) {// 上传错误提示错误信息
            $this->ajaxReturn(array('status' => 'error', 'data' => $uploadError));
        }else{// 上传成功
            $picUrl = 'images/profile/' . $info['picture']['savepath'] . $info['picture']['savename'];
        }

        $image = new \Think\Image();
        $image->open($upload->rootPath . $info['picture']['savepath'] . $info['picture']['savename']);
        // 生成一个缩放后填充大小150*150的缩略图并保存为thumb.jpg
        $image->thumb(80, 80,\Think\Image::IMAGE_THUMB_FILLED)->save($upload->rootPath . $info['picture']['savepath'] . $info['picture']['savename']);

        $user->where(array('emp_no' => session('emp_no')))->save(array('headimg' => $picUrl));

        session('headimg', $picUrl);
        $this->ajaxReturn(array('status' => 'ok'));
    }


}


 ?>
