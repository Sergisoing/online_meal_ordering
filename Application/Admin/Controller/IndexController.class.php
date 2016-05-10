<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        if (session('type') != 'admin') {
            $this->redirect('home/index/index');
        }
        $config = D('config');
        $this->assign('noon', $config->C('noon_meal_time'));
        $this->assign('night', $config->C('night_meal_time'));
        $this->assign('nav', '1');
        $this->display();
    }


    public function getTodayOrderStore() {
        $user = D('user');
        $user->is_admin();
        $mealTime = I('post.meal_time');
        if (!in_array($mealTime, array('noon', 'night'))) {
            $this->ajaxReturn(array('status' => 'error', 'data' => '参数错误'));
        }

        $date = date('Y-m-d');
        $memK = $date . '-' . $mealTime . 'order-status';
        $cache = new \Think\Cache\Driver\Memcache();
        $storeOrderStatus = $cache->get($memK);
        // 检查是否存在店铺状态缓存
        if ($storeOrderStatus) {
            $this->ajaxReturn(array('status' => 'ok', 'data' => $storeOrderStatus));
        }

        $order = D('order');
        $data = $order->query('SELECT DISTINCT(`store_id`), `store_name` FROM `order_menu_v` WHERE `order_date` = \'' . $date .'\' AND `meal_time` = \'' . $mealTime . '\'');
        $storeOrderStatus = array();
        if ($data) {
            foreach ($data as $key => $value) {
                $storeOrderStatus[$value['store_id']] = array('store_name' => $value['store_name'], 'status' => 'new');
            }
        }
        $cache->set($memK, $storeOrderStatus, 3600 * 24);
        $this->ajaxReturn(array('status' => 'ok', 'data' => $storeOrderStatus));
    }


    public function getOrderDataByStore() {
        $user = D('user');
        $user->is_admin();
        $id = I('post.id');
        $mealTime = I('post.meal_time');
        if (!in_array($mealTime, array('noon', 'night'))) {
            $this->ajaxReturn(array('status' => 'error', 'data' => '参数错误'));
        }
        if (empty($id)) {
            $this->ajaxReturn(array('status' => 'error', 'data' => '参数错误'));
        }
        $order = D('order');
        $date = date('Y-m-d');
        $orderData = $order->query('SELECT `store`.`name`, `store`.`phone`, `store`.`adress`,`dish_id`, `dish_name`, `count`, `order_menu_v`.`desc` FROM `order_menu_v` LEFT JOIN `store` ON `order_menu_v`.`store_id` = `store`.`id` WHERE `order_menu_v`.`order_date` = \''. $date . '\' AND `meal_time` = \'' . $mealTime . '\' AND `store_id` = ' . $id);

        $memK = $date . '-' . $mealTime . 'order-status';
        $cache = new \Think\Cache\Driver\Memcache();
        $data = $cache->get($memK);

        $res = array();
        $res['name'] = $orderData[0]['name'];
        $res['phone'] = $orderData[0]['phone'];
        $res['adress'] = $orderData[0]['adress'];
        $res['status'] = $data[$id]['status'];

        foreach ($orderData as $value) {
            $res['dish'][$value['dish_id']]['dish_name'] = $value['dish_name'];
            if (isset($res['dish'][$value['dish_id']]['count'])) {
                $res['dish'][$value['dish_id']]['count'] += $value['count'];
            } else {
                $res['dish'][$value['dish_id']]['count'] = $value['count'];
            }
            $res['dish'][$value['dish_id']]['desc'][] =  $value['desc'];
        }

        $this->ajaxReturn(array('status' => 'ok', 'data' => $res));

    }


    public function updateStoreStatus() {
        $user = D('user');
        $user->is_admin();
        $action = I('post.action');
        $id = I('post.id');
        $mealTime = I('post.meal_time');
        if (!in_array($mealTime, array('noon', 'night')) || empty($id) || !in_array($action, array('order', 'send'))) {
            $this->ajaxReturn(array('status' => 'error', 'data' => '参数错误'));
        }
        $date = date('Y-m-d');
        $memK = $date . '-' . $mealTime . 'order-status';
        $cache = new \Think\Cache\Driver\Memcache();
        $data = $cache->get($memK);

        if (!isset($data[$id]) ) {
            $this->ajaxReturn(array('status' => 'error', 'data' => '不存在该店铺'));
        }

        if ($action == 'send') {
            $data[$id]['status'] = 'send_success';
        } else {
            $data[$id]['status'] = 'order_success';
        }
        $cache->set($memK, $data);
        $this->updateUserOrderStatus($meal_time);
        $this->ajaxReturn(array('status' => 'ok'));
    }


    public function updateUserOrderStatus($meal_time) {
        $date = date('Y-m-d');
        $memK = $date . '-' . $mealTime . 'order-status';
        $cache = new \Think\Cache\Driver\Memcache();
        $data = $cache->get($memK);
        $orderFlag = true;
        $sendFlag = true;
        foreach ($data as $value) {
            if ($value['status'] == 'new') {
                $orderFlag = false;
                $sendFlag = false;
                break;
            }
            if ($value['status'] == 'order_success') {
                $sendFlag = false;
                break;
            }
        }

        $order = D('order');
        if ($sendFlag) {
            $order->where(array('meal_time' => $mealTime, 'order_date' => $date))->save(array('order_status' => 'finish', 'update_time' => date('Y-m-d H:i:s')));
        } else if ($orderFlag) {
            $order->where(array('meal_time' => $mealTime, 'order_date' => $date))->save(array('order_status' => 'ordering', 'update_time' => date('Y-m-d H:i:s')));
        }
    }
}
