<?php
namespace Home\Controller;
use Think\Controller;
class OrderController extends Controller {

    public function addOrder() {
        $user = D('Admin/user');
        $user->is_login('ajax');

        //首先查找是否存在已有的菜单
        $order      = D('order');
        $menu       = D('menu');
        $dishId     = I('post.id');
        $orderDate  = I('post.date');
        $orderMount = I('post.mount');
        $mealTime   = I('post.meal_time');
        $desc       = I('post.desc');
        $staff_id   = session('emp_no');
        $conditions = array();

        if (!in_array($mealTime, array('noon', 'night'))) {
            $this->ajaxReturn(array('status' => 'error', 'data' => '参数错误'));
        }

        $config = D('Admin/config');
        $dateTime = $orderDate . ' ' . $config->C($mealTime . '_meal_time');
        if (time() > strtotime($dateTime)) {
            $noticeStr =  $mealTime == 'noon' ? '今日午餐订餐时间已经过了' : '今日晚餐订餐时间已经过了';
            $this->ajaxReturn(array('status' => 'error','data' => $noticeStr));
        }
        if (strtotime($orderDate) < strtotime(date('Y-m-d'))) {
            $this->ajaxReturn(array('status' => 'error','data' => '订餐时间不能小于今天'));
        }

        $conditions['staff_id'] = $staff_id;
        $conditions['order_date'] = $orderDate;
        $conditions['meal_time'] = $mealTime;
        // dump($conditions);
        $menuId    = $order->where($conditions)->getField('menu_id');
        $data               = array();
        $data['dish_id']    = $dishId;
        $data['order_date'] = $orderDate;
        $data['count']      = $orderMount;
        $data['desc']       = $desc;
        if (!$menuId) {
            $data['menu_id']= 0;
            $menuId = $menu->add($data);
            $menu->where(array('id' => $menuId))->save(array('menu_id' => $menuId));
            $data['menu_id']    = $menuId;
            $orderData              = array();
            $orderData['order_id']  = mkOrderId($staff_id, $orderDate, $mealTime);
            $orderData['menu_id']   = $menuId;
            $orderData['staff_id']  = $staff_id;
            $orderData['order_status'] = 'new';
            $orderData['order_date'] = $orderDate;
            $orderData['update_time'] = date('Y-m-d H:i:s');
            $orderData['create_time'] = date('Y-m-d H:i:s');
            $orderData['meal_time'] = $mealTime;
            if (!$order->create($orderData)) {
                $this->ajaxReturn(array('status' => 'error', 'data' => $order->getError()));
            }
            $order->add();

            $dish = D('dish');
            $dish->where(array('id' => $dishId))->setInc('count');

            $this->ajaxReturn(array('status' => 'ok'));
        } else {
            $data['menu_id'] = $menuId;
            $menu->add($data);
            $dish = D('dish');
            $dish->where(array('id' => $dishId))->setInc('count');
            $this->ajaxReturn(array('status' => 'ok'));
        }
    }


    /**
    * 今日订单
    *@param:
    *@return:
    */
    public function todayOrder() {
        $user = D('Admin/user');
        $user->is_login();
        $this->assign('nav', 3);
        $this->display('today_order');
    }

    /**
    * 获取订单数据接口
    *@param: $orderDate String 订餐日期
    *@param: $mealTime String 订餐餐次
    *@return: $orderData Array 订单数据
    */
    public function getOrderDataByKind() {
        $orderDate = I('post.orderDate');
        $mealTime = I('post.mealTime');
        $user = D('Admin/user');
        $user->is_login('ajax');
        $staff_id = session('emp_no');
        $orderDate = $orderDate ? $orderDate : date('Y-m-d');
        if (strtotime($orderDate) < strtotime(date('Y-m-d'))) {
            $this->ajaxReturn(array('status' => 'error','data' => '订餐计划必须是今天之后的订单'));
        }
        $order = D('order');
        $orderData = $order->getOrderData($staff_id, $mealTime, $orderDate);

        if ($orderData) {
            foreach ($orderData as $key => &$value) {
                $value['price'] = number_format($value['price'], 2);
            }
        }

        $this->ajaxReturn(array('status' => 'ok', 'data' => $orderData));
    }


    /**
    * 删除订餐菜单中的项目
    *@param: post.id int 菜单id
    */
    public function deleteMenuItem() {
        $user = D('Admin/user');
        $user->is_login('ajax');
        $id = I('post.id');
        $staff_id = session('emp_no');
        if (empty($id)) {
            $this->ajaxReturn(array('status' => 'error', 'data' => '参数错误'));
        }
        $order = D('order');
        $menu = D('menu');
        $menuId = $menu->where(array('id' => $id))->getField('menu_id');
        $conditions = array();
        $conditions['staff_id'] = $staff_id;
        $conditions['menu_id'] = $menuId;
        $orderData = $order->where($conditions)->select();
        if ($orderData) {
            $menu->delete($id);
            $this->ajaxReturn(array('status' => 'ok'));
        } else {
            $this->ajaxReturn(array('status' => 'error', 'data' => '您不能删除别人的菜单'));
        }
    }


    /**
    * 订单计划页面
    */
    public function orderPlan() {
        $user = D('Admin/user');
        $user->is_login();
        $this->assign('nav', 4);
        $this->display('order_plan');
    }


    /**
    * 我的订单页面
    */
    public function myOrder() {
        $user = D('Admin/user');
        $user->is_login();
        $this->assign('nav', '2');
        $this->display('my_order');
    }

    public function getMyOrder() {
        $user = D('Admin/user');
        $user->is_login('ajax');
        $staff_id = session('emp_no');
        $order = D('order');
        $mealTime = I('post.mealTime');
        $orderDate = I('post.orderDate');

        if (strtotime($orderDate) > strtotime(date('Y-m-d'))) {
            $this->ajaxReturn(array('status' => 'error', 'data' => '我的订单只能查询今天和今天之前的订单'));
        }

        $conditions = array();
        $conditions['meal_time'] = $mealTime;
        $conditions['order_date'] = $orderDate;
        $conditions['staff_id'] = $staff_id;

        $orderData = $order->where($conditions)->getField('order_id, menu_id, order_status');

        if ($orderData) {
            $orderData = array_pop($orderData);
        }

        if (isset($orderData['menu_id'])) {
            $orderDish = $order->query('SELECT `id` as `menu_dish_id`,`picture`, `dish_name`, `store_name`, `count`,`dish_id`, `store_id`, `comment` FROM `order_menu_v` WHERE `menu_id` = '. $orderData['menu_id']);
            foreach ($orderDish as &$value) {
                $value['order_status'] = $orderData['order_status'];
            }
            $this->ajaxReturn(array('status' => 'ok', 'data' => $orderDish));
        } else {
            $this->ajaxReturn(array('status' => 'ok', 'data' => array()));
        }
    }


    public function saveComment() {
        $user = D('Admin/user');
        $user->is_login('ajax');
        $id = I('post.id');
        $comment = I('post.comment');
        $score = I('post.score');
        if (empty($id) || empty($comment) || $score > 5 || $score < 0) {
            $this->ajaxReturn(array('status' => 'error', 'data' => '参数错误'));
        }
        $menu = D('menu');
        $menu->where(array('id' => $id))->save(array('comment' => $comment, 'score' => $score, 'comment_time' => date('Y-m-d H:i:s')));
        $this->ajaxReturn(array('status' => 'ok'));
    }

}
