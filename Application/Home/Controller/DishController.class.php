<?php

namespace Home\Controller;
use Think\Controller;

class DishController extends Controller {

    public function index () {
        $id = I('get.id');
        $dish = D('dish');
        if (empty($id)) {
            $this->redirect('home/index/index');
        }
        $storeTypeList = $dish->getStoreDishType($id);
        $this->assign('storeTypeList', $storeTypeList);
        $this->display();
    }

    public function getDishList() {
        $storeId = I('get.id');
        $typeId = I('get.type_id', false);
        $orderType = I('get.order', false);
        $dish = D('dish');
        $data = $dish->getDishList($storeId, $typeId, $orderType);
        foreach ($data as &$value) {
            $value['price'] = number_format($value['price'], 2);
        }
        $this->ajaxReturn($data);
    }

    public function detail() {
        $id = I('get.id');
        $dish = D('dish');
        $orderDate = I('get.orderdate');
        $orderDate = $orderDate ? date('Y-m-d', strtotime($orderDate)) : date('Y-m-d');
        $detailDish = $dish->query('select * from dishV where id = ' . $id);
        $data = $detailDish[0];
        $data['score'] = number_format($dish->getDishScore($id)['score'], 1);
        $data['comment_count'] = $dish->getCommnetCount($id)['comment_count'];
        $data['price'] = number_format($data['price'], 2);
        $this->assign('noon', (D('Admin/config')->C('noon_meal_time')));
        $this->assign('night', (D('Admin/config')->C('night_meal_time')));
        $this->assign('order_date', $orderDate);
        $this->assign('dishInfo', $data);
        $this->display('detail');
    }

    public function getRankList() {
        $dish = D('dish');
        $rankList = $dish->query('SELECT `id`,`name` FROM `dish` ORDER BY count desc');
        $this->ajaxReturn(array('status' => 'ok', 'data' => $rankList));
    }


    public function getCommentByDish() {
        $id = I('post.id');
        $menu = D('menu');
        $commentData = $menu->query('select comment, comment_time,score, staff.name, staff.headimg from menu left join `order` on order.menu_id = menu.menu_id left join staff on staff.emp_no = order.staff_id where comment != \'\'  and dish_id = ' . $id . ' order by comment_time desc');
        $this->ajaxReturn(array('status' => 'ok', 'data' => $commentData));
    }

}

 ?>
