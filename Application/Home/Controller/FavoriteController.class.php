<?php

namespace Home\Controller;
use Think\Controller;

class FavoriteController extends Controller {

    public function index() {
        $user = D('Admin/user');
        $user->is_login();
        $this->assign('nav', '5');
        $this->display();
    }

    public function deleteFavoriteItem() {
        $user = D('Admin/user');
        $user->is_login('ajax');
        $id = I('post.id');
        if (empty($id)) {
            $this->ajaxReturn(array('status' => 'error', 'data' =>'参数错误'));
        }
        $staff_id = session('emp_no');
        $favorite = D('favorite');
        if ($favorite->where(array('staff_id' => $staff_id, 'id' => $id))->count() < 1) {
            $this->ajaxReturn(array('status' => 'error', 'data' => '您不能删除其他人的收藏夹'));
        }
        $favorite->delete($id);
        $this->ajaxReturn(array('status' => 'ok'));

    }

    /**
    * 获取收藏夹列表API
    */
    public function getFavoriteList() {
        $user = D('Admin/user');
        $user->is_login('ajax');
        $kind = I('post.kind');
        if (!in_array($kind, array('dish', 'store'))) {
            $this->ajaxReturn(array('status' => 'error', 'data' => '参数错误'));
        }
        $staff_id = session('emp_no');
        $favorite = D('favorite');
        $list = $favorite->join('dishV on dishV.id = favorite.kind_id')->where(array('kind' => $kind, 'staff_id' => $staff_id))->getField('favorite.id,picture, name,store_name,style_name,kind_name,price');

        if ($list) {
            foreach ($list as $key => &$value) {
                $value['price'] = number_format($value['price'], 2);
            }
        }

        $this->ajaxReturn(array('status' => 'ok','data' => $list));
    }

    public function addFavorite() {
        $user = D('Admin/user');
        $user->is_login('ajax');
        $kind = I('post.kind');
        $id = I('post.id');
        $staff_id = session('emp_no');

        //判断ID是否存在
        if ($kind == 'dish') {
            $dish = D('dish');
            $count = $dish->where(array('id' => $id))->count();
            if ($count < 1) {
                $this->ajaxReturn(array('status' => 'error', 'data' => '不存在该商品'));
            }
        } else if ($kind == 'store') {
            $store = D('store');
            $count = $store->where(array('id' => $id))->count();
            if ($count < 1) {
                $this->ajaxReturn(array('status' => 'error', 'data' => '不存在该店铺'));
            }
        } else {
            $this->ajaxReturn(array('status' => 'error', 'data' => '参数错误'));
        }

        // 判断收藏夹中是否已经存在该项目
        $favorite = D('favorite');
        if ($favorite->where(array('kind' => $kind, 'kind_id' => $id, 'staff_id' => $staff_id))->count() > 0) {
            $this->ajaxReturn(array('status' => 'error', 'data' => '该项目已经在你的收藏夹中'));
        }
        $favorite->add(array('kind' => $kind, 'kind_id' => $id, 'staff_id' => $staff_id));
        $this->ajaxReturn(array('status' => 'ok'));
    }
}


 ?>
