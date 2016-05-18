<?php
namespace Admin\Controller;
use Think\Controller;
use Admin\UserModel;
use Think\Image;
class UserController extends Controller {
    public function index () {
        if (session('type') == 'admin') {
            $this->redirect('admin/index/index');
        } else if (session('type') == 'user'){
            $this->redirect('home/index/index');
        }
        $this->display('sigin');
    }

    public function login () {
        $userName = I('post.userName');
        $password = I('post.password');
        $preUrl = I('post.url');
        $user = D('user');
        $info = $user->login($userName, $password);
        $res['status'] = $info;
        $res['data'] = session('type');
        if ($preUrl && $res['status'] == 'ok') {
            $res['status'] = 'redirect';
            $res['data'] = decode($preUrl);
        }
        $this->ajaxReturn($res);


        // $d = M('staff');
        // $data['emp_no'] = '2012190429';
        // $data['name'] = '杨勤川';
        // $data['phone'] = '15801094323';
        // $data['department'] = 'web';
        // $data['sex'] = '0';
        // $data['headimg'] = 'http://img.buding.cn/weiche/2016/03/25/512b85d40f4925dda15103084d60c44e.jpg';
        // $data['password'] = md5('buding');
        // $data['email'] = 'yangqinchuan_kis@163.com';
        // $d->add($data);


        // $data = $d->select(1);
        // $data = $d->select(1,2);
        // dump($data);

        // 查询单条记录
        // $data = $d->find(1);
        // dump($data);
        // $data = $d->getField('password');
        // dump($data);
        // 读取字段值

        // $user = D('User');
        // dump($user);
    }

    public function logout() {
        session(null);
        $this->redirect('home/index/index');
    }

    public function userManage() {
        $user = D('user');
        $user->is_admin();
        $userList = $user->getUserList();
        $dep = D('department');
        $depList = $dep->getDepList();
        $this->assign('nav', 2);
        $this->assign('subNav', 1);
        $this->assign('userList', $userList);
        $this->assign('depList', $depList);
        $this->display('user_manage');
    }

    public function singleAdd() {
        $user = D('user');
        $user->is_admin();
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     3145728 ;// 设置附件上传大小
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath  =     './Public/images/profile/'; // 设置附件上传根目录
        $upload->savePath  =     ''; // 设置附件上传（子）目录
        // 上传文件
        $info   =   $upload->upload();
        if(!$info) {// 上传错误提示错误信息
            $this->ajaxReturn(array('status' => 'error', 'data' => '图片上传失败， 或者没有图片上传'));
        }else{// 上传成功
            $picUrl = 'images/profile/' . $info['email']['savepath'] . $info['email']['savename'];
        }

        $image = new \Think\Image();
        $image->open($upload->rootPath . $info['email']['savepath'] . $info['email']['savename']);
        // 生成一个缩放后填充大小150*150的缩略图并保存为thumb.jpg
        $image->thumb(80, 80,\Think\Image::IMAGE_THUMB_FILLED)->save($upload->rootPath . $info['email']['savepath'] . $info['email']['savename']);

        $data = array();
        $data['emp_no']     = I('post.emp_no');
        $data['name']       = I('post.name');
        $data['phone']      = I('post.phone');
        $data['dep_id']     = I('post.dep_id');
        $data['sex']        = I('post.sex');
        $data['headimg']    = $picUrl ? $picUrl : 'images/default_headimg.jpg';
        $data['password']   = preg_match('/^\w{6,}$/', I('post.password')) ? md5(I('post.password')) : '';
        $data['email']      = I('post.email');
        $data['is_delete']  = 0;
        if (!$user->create($data)) {
            $this->ajaxReturn(array('status' => 'error', 'data' => $user->getError()));
        } else {
            $user->add();
            $this->ajaxReturn(array('status' => 'ok'));
        }

    }

    public function depManage() {
        $user = D('user');
        $user->is_admin();
        $dep = D('department');
        $depList = $dep->getDepList();
        $this->assign('nav', 2);
        $this->assign('subNav', '2');
        $this->assign('depList', $depList);
        $this->display('dep_manage');
    }

    public function resetPw() {
        $user    = D('user');
        $user->is_admin();
        $resetId = I('post.id');
        $resetPw = I('post.pw');
        $res     = array();
        if ($user->changePw($resetId, $resetPw)) {
            $res['status'] = 'ok';
        } else {
            $res['status'] = 'error';
        }
        $this->ajaxReturn($res);
    }

    public function deleteUser($id) {
        $user = D('user');
        $user->is_admin();
        $delId = I('post.id');
        $res = array();
        if ($user->deleteUser($id)) {
            $res['status'] = 'ok';
        } else {
            $res['status'] = 'error';
        }
        $this->ajaxReturn($res);
    }

    public function multiAdd() {
        $user     = D('user');
        $user->is_admin();
        $start    = I('post.start');
        $length   = I('post.length');
        $password = I('post.password');
        $dep_id   = I('post.dep_id');
        $repUser  = array();
        for ($i = 0; $i < $length; $i++) {
            $data = array();
            $data['emp_no']     = $start + $i;
            $data['name']       = $start + $i;
            $data['headimg']    = 'images/default_headimg.jpg';
            $data['password']   = md5($password);
            $data['dep_id']     = $dep_id;
            if (!$user->create($data)) {
                if ($user->getError() == '帐号名称已经存在！') {
                    $repUser[] = $data['emp_no'];
                }
            } else {
                $user->add();
            }
        }
        $this->ajaxReturn(array('status' => 'ok', 'data' => $repUser));
    }

    public function addDep() {
        $user     = D('user');
        $dep      = D('department');
        $user->is_admin();
        $depName  = I('post.depName');
        $data     = array();
        $data['dep_name'] = $depName;
        if ($dep->create($data)) {
            $dep->add();
        } else {
            $this->ajaxReturn(array('status' => 'error', 'data' => $dep->getError()));
        }
        $this->ajaxReturn(array('status' => 'ok'));
    }

}
