<?php

namespace Home\Model;
use Think\Model;
use Think\Cache\Driver;

class OrderModel extends Model {

    protected $_validate = array(
        array('order_id', 'require', '系统错误，请稍后再试'),
        array('order_id','','订单id已存在',0,'unique',1),
        array('menu_id', 'require', '菜单错误'),
        array('staff_id' ,'require', '员工信息有误'),
        array('order_status','require','订单状态'),
        array('order_date', 'require', '订餐日期有误'),
        array('meal_time', array('noon', 'night'), '餐次不正确', 1, 'in')
        );


    public function getOrderData($staff_id, $meal_time, $order_date) {
        $orderData = $this->query('select * from order_menu_V where staff_id = \'' . $staff_id . '\' and meal_time = \'' . $meal_time . '\' and order_date = \'' . $order_date . '\'');
        return $orderData;
    }
}

 ?>
