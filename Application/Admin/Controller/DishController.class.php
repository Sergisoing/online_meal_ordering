<?php
namespace Admin\Controller;
use Think\Controller;

class DishController extends Controller {



    public function index() {
        $user = D('user');
        $dish = D('dish');
        $store = D('store');
        $style = D('store_style');
        $kind = D('dish_kind');
        $user->is_admin();
        $data = $dish->getDishList();
        $storeList = $store->where(array('is_delete' => 0))->getField('id,name');
        $styleList = $style->where(array('store_id' => array_keys($storeList)[0]))->getField('id,name');
        $kindList = $kind->getField('id,name');
        $this->assign('nav', '4');
        $this->assign('dishList', $data);
        $this->assign('storeList', $storeList);
        $this->assign('styleList', $styleList);
        $this->assign('kindList', $kindList);

        $this->assign('subNav', '1');
        $this->display();
    }

    public function deleteDish() {
        $user = D('user');
        $user->is_admin();
        $dish = D('dish');
        $id = I('post.id');
        if (empty($id)) {
            $this->ajaxReturn(array('status' => 'error', 'data' => '参数错误'));
        }
        $dish->where(array('id' => $id))->save(array('is_delete' => 1));
        $this->ajaxReturn(array('status' => 'ok'));
    }

    public function getStyleListById() {
        $user = D('user');
        $user->is_admin();
        $style = D('store_style');
        $id = I('post.id');
        if (empty($id)) {
            $this->ajaxReturn(array('status' => 'error', 'data' => '参数错误'));
        }
        $styleList = $style->where(array('store_id' => $id))->getField('id,name');
        $this->ajaxReturn(array('status' => 'ok', 'data' => $styleList));
    }

    public function dishAdd() {
        $user =  D('user');
        $user->is_admin();
        $dish = D('dish');
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     3145728 ;// 设置附件上传大小
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->rootPath  =     './Public/images/dish/'; // 设置附件上传根目录
        $upload->savePath  =     ''; // 设置附件上传（子）目录
        $info   =   $upload->upload();
        if(!$info) {// 上传错误提示错误信息
            $uploadError = $upload->getError();
            $this->ajaxReturn(array('status' => 'error', 'data' => $uploadError));
        }else{// 上传成功
            $image = new \Think\Image();
            foreach ($info as $key => $value) {
                $image->open($upload->rootPath . $value['savepath'] . $value['savename']);
                if ($key == 'picture') {
                    $image->thumb(480, 290,\Think\Image::IMAGE_THUMB_FILLED)->save($upload->rootPath . $value['savepath'] . $value['savename']);
                }
            }
        }
        $picture = 'dish/' . $info['picture']['savepath'] . $info['picture']['savename'];
        $data = array();
        $data['name'] = I('post.name');
        $data['price'] = I('post.price');
        $data['picture'] = $picture;
        $data['store_id'] = I('post.storeId');
        $data['store_style_id'] = I('post.styleId');
        $data['kind_id'] = I('post.kindId');
        $data['is_delete'] = 0;
        if (!$dish->create($data)) {
            $this->ajaxReturn(array('status' => 'error', 'data' => $dish->getError()));
        }
        $dish->add();
        $this->ajaxReturn(array('status' => 'ok'));
    }

    public function dishUpdate() {
        $user =  D('user');
        $user->is_admin();
        $dish = D('dish');
        $id = I('post.id');
        if (empty($id)){
            $this->ajaxReturn(array('status' => 'error', 'data'=> '参数错误'));
        }
        $picture  = '';
        if ($_FILES['picture']['error'] != '4') {
            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize   =     3145728 ;// 设置附件上传大小
            $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
            $upload->rootPath  =     './Public/images/dish/'; // 设置附件上传根目录
            $upload->savePath  =     ''; // 设置附件上传（子）目录
            $info   =   $upload->upload();
            if(!$info) {// 上传错误提示错误信息
                $uploadError = $upload->getError();
                $this->ajaxReturn(array('status' => 'error', 'data' => $uploadError));
            }else{// 上传成功
                $image = new \Think\Image();
                foreach ($info as $key => $value) {
                    $image->open($upload->rootPath . $value['savepath'] . $value['savename']);
                    if ($key == 'picture') {
                        $image->thumb(480, 290,\Think\Image::IMAGE_THUMB_FILLED)->save($upload->rootPath . $value['savepath'] . $value['savename']);
                    }
                }
            }
            $picture = 'dish/' . $info['picture']['savepath'] . $info['picture']['savename'];
        }



        $data = array();
        $data['name'] = I('post.name');
        $data['price'] = I('post.price');
        if ($picture) {
            $data['picture'] = $picture;
        }
        $data['store_id'] = I('post.storeId');
        $data['store_style_id'] = I('post.styleId');
        $data['kind_id'] = I('post.kindId');

        $dish->where(array('id' => $id))->save($data);
        $this->ajaxReturn(array('status' => 'ok'));


    }

}
