<?php
namespace Admin\Controller;
use Think\Controller;
use Admin\StoreModel;
use Admin\UserModel;

class StoreController extends Controller {


    public function storeManage() {
        $user = D('user');
        $user->is_admin();
        $store = D('store');
        $lists = $store->getStoreList();
        $this->assign('storeList', $lists);
        $this->assign('nav', '3');
        $this->assign('subNav', '1');
        $this->display('store_manage');
    }

    public function updateStoreStatus($id, $status) {
        $user = D('user');
        $store = D('store');
        $user->is_admin();
        if (empty($id)) {
            $this->ajaxReturn(array('status' => 'error', 'data' => '缺少参数'));
        }
        $conditions = array();
        $conditions['id'] = $id;
        $store->where($conditions)->save(array('is_delete' => $status));
        $this->ajaxReturn(array('status' => 'ok'));
    }

    public function deleteStore () {
        $id = I('post.id');
        $this->updateStoreStatus($id, 1);
    }


    public function reupStore() {
        $id = I('post.id');
        $this->updateStoreStatus($id, 0);
    }


    public function storeAdd() {
        $user = D('user');
        $store = D('store');
        $user->is_admin();
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     3145728 ;// 设置附件上传大小
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath  =     './Public/images/store/'; // 设置附件上传根目录
        $upload->savePath  =     ''; // 设置附件上传（子）目录
        $info   =   $upload->upload();
        if(!$info) {// 上传错误提示错误信息
            $this->ajaxReturn(array('status' => 'error', 'data' => $upload->getError()));
        }else{// 上传成功
            $image = new \Think\Image();
            foreach ($info as $key => $value) {
                $image->open($upload->rootPath . $value['savepath'] . $value['savename']);
                if ($key == 'picture') {
                    $image->thumb(480, 300,\Think\Image::IMAGE_THUMB_FILLED)->save($upload->rootPath . $value['savepath'] . $value['savename']);
                } else {
                    $image->thumb(300, 300,\Think\Image::IMAGE_THUMB_FILLED)->save($upload->rootPath . $value['savepath'] . $value['savename']);
                }

            }
        }
        $picture = '';
        $detail_pics = array();
        foreach ($info as $key => $value) {
            if ($key == 'picture') {
                $picture = 'images/store/' . $value['savepath'] . $value['savename'];
            } else {
                $detail_pics[] = 'images/store/' . $value['savepath'] . $value['savename'];
            }
        }

        $data = array();
        $data['name'] = I('post.name');
        $data['phone'] = I('post.phone');
        $data['adress'] = I('post.address');
        $data['picture'] = $picture;
        $data['desc'] = I('post.desc');
        $data['is_delete'] = '0';
        $data['detail_pics'] = json_encode($detail_pics);
        if (!$store->create($data)) {
            if ($upload->getError() != '没有文件被上传！') {
                $this->ajaxReturn(array('status' => 'error', 'data' => $store->getError()));
            }
        } else {
            $store->add();
        }
        $this->ajaxReturn(array('status' => 'ok'));
    }


    public function storeUpdate() {
        $user = D('user');
        $store = D('store');
        $user->is_admin();
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     3145728 ;// 设置附件上传大小
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath  =     './Public/images/store/'; // 设置附件上传根目录
        $upload->savePath  =     ''; // 设置附件上传（子）目录
        $info   =   $upload->upload();
        if(!$info) {// 上传错误提示错误信息
            if ($upload->getError() != '没有文件被上传！') {
                $this->ajaxReturn(array('status' => 'error', 'data' => $store->getError()));
            }
        }else{// 上传成功
            $image = new \Think\Image();
            foreach ($info as $key => $value) {
                $image->open($upload->rootPath . $value['savepath'] . $value['savename']);
                if ($key == 'picture') {
                    $image->thumb(480, 300,\Think\Image::IMAGE_THUMB_FILLED)->save($upload->rootPath . $value['savepath'] . $value['savename']);
                } else {
                    $image->thumb(300, 300,\Think\Image::IMAGE_THUMB_FILLED)->save($upload->rootPath . $value['savepath'] . $value['savename']);
                }

            }
        }
        $picture = '';
        $detail_pics = array();
        foreach ($info as $key => $value) {
            if ($key == 'picture') {
                $picture = 'images/store/' . $value['savepath'] . $value['savename'];
            } else {
                $detail_pics[] = 'images/store/' . $value['savepath'] . $value['savename'];
            }
        }
        $data = array();
        $data['name'] = I('post.name');
        $data['phone'] = I('post.phone');
        $data['adress'] = I('post.address');
        $id = I('post.id');
        if (empty($id)) {
            $this->ajaxReturn(array('status' => 'error', 'data' => '参数错误'));
        }
        if ($picture) {
            $data['picture'] = $picture;
        }
        if ($detail_pics) {
            $data['detail_pics'] = json_encode($detail_pics);
        }
        $data['desc'] = I('post.desc');
        $data['is_delete'] = '0';
        if (!$store->create($data) && $store->getError() != '该店铺已经存在') {
            $this->ajaxReturn(array('status' => 'error', 'data' => $store->getError()));
        }
        $store->where(array('id' => $id))->save($data);
        $this->ajaxReturn(array('status' => 'ok'));
    }

    public function storeDishManage() {
        $user  = D('user');
        $user->is_admin();
        $store = D('store');
        $this->assign('nav', 3);
        $this->assign('subNav', 2);
        $list = $store->where(array('is_delete' => 0))->getField('id,name,is_delete');
        $this->assign('storeList', $list);
        $this->display('store_dish_manage');
    }

    public function getKindByStore() {
        $user = D('user');
        $user->is_admin();
        $storeStyle = D('store_style');
        $storeId = I('post.storeId');
        if (empty($storeId)) {
            $this->ajaxReturn(array('status' => 'error', 'data' => '参数错误'));
        }
        $styleList = $storeStyle->where(array('store_id' => $storeId))->getField('id,name');
        $this->ajaxReturn(array('status' => 'ok' , 'data' => $styleList));
    }

    public function storeKindAdd() {
        $user = D('user');
        $user->is_admin();
        $name = I('post.name');
        $storeId = I('post.storeId');
        if (!$name || !$storeId) {
            $this->ajaxReturn(array('status' => 'error', 'data' => '参数错误'));
        }
        $storeStyle = D('store_style');
        $data = array('name' => $name, 'store_id' => $storeId);
        if ($storeStyle->add($data)) {
            $this->ajaxReturn(array('status' => 'ok'));
        } else {
            $this->ajaxReturn(array('status' => 'error', 'data' => '系统错误，请稍后再试'));
        }
    }

    public function storeKindUpdate() {
        $user = D('user');
        $user->is_admin();
        $name = I('post.name');
        $storeId = I('post.storeId');
        $id = I('post.id');
        if (empty($name) || empty($storeId) || empty($id)) {
            $this->ajaxReturn(array('status' => 'error', 'data' => '参数错误'));
        }
        $storeStyle = D('store_style');
        $data = array('name' => $name);
        $storeStyle->where(array('id' =>$id,  'store_id' => $storeId))->save($data);
        $this->ajaxReturn(array('status' => 'ok'));
    }

}


 ?>
