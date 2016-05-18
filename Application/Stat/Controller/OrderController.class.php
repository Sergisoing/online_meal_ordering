<?php
namespace Stat\Controller;
use Think\Controller;
class OrderController extends Controller {
    public function orderDayStat() {
        $this->assign('nav', 3);
        $this->assign('subNav', 2);
        $this->assign('start', date('Y-m-d', strtotime('-30 days')));
        $this->assign('end', date('Y-m-d', strtotime('-1 days')));
        $this->display('order_day_stat');
    }

    public function orderMonthStat() {
        $this->assign('nav', 3);
        $this->assign('subNav', 1);
        $this->assign('date', date('Y-m'));
        $this->display('order_month_stat');
    }


    public function getOrderStat() {

        $order = D('order');
        $start_time = I('start_time') ? I('start_time') : date('Y-m-d', strtotime('-30 days'));
        $end_time = I('end_time') ? I('end_time') : date('Y-m-d');

        $month = I('month');
        if ($month) {
            $start_time = date('Y-m-d', strtotime($month));
            $end_time = date('Y-m-d', strtotime('+1 month', strtotime($month)));
        }

        $where = array();

        if ($start_time && $end_time) {
            $where['create_time'] = array(array('gt',$start_time),array('lt',date('Y-m-d', strtotime($end_time) + 24 * 3600)));
            ;
        }


        $data = $order->query('SELECT DATE(create_time) as date, meal_time,count(*) as count FROM `order` WHERE ( `create_time` > \''. $start_time .'\' AND `create_time` < \'' . $end_time . '\' ) GROUP BY date(create_time), meal_time');
        $tmp = array();
        foreach($data as $value) {
            $tmp[$value['date'] . $value['meal_time']] = $value;
        }
        $total = 0;
        $res = array();
        while(strtotime($start_time) < strtotime($end_time)) {

            $tmp1 = array();
            $tmp1['date'] = $start_time;
            if (array_key_exists($start_time . 'noon', $tmp)) {
                $tmp1['noon'] = $tmp[$start_time . 'noon']['count'];
                $total += $tmp[$start_time . 'noon']['count'];
            } else {
                $tmp1['noon'] = 0;
            }

            if (array_key_exists($start_time . 'night', $tmp)) {
                $tmp1['night'] = $tmp[$start_time . 'night']['count'];
                $total += $tmp[$start_time . 'night']['count'];
            } else {
                $tmp1['night'] = 0;
            }

            $tmp1['total'] = $tmp1['noon'] + $tmp1['night'];
            $res[] = $tmp1;

            $start_time = date('Y-m-d', strtotime($start_time) + 3600 * 24);
        }
        $this->ajaxReturn(array('status' => 'ok', 'data' => $res, 'total' => $total));
    }
}
