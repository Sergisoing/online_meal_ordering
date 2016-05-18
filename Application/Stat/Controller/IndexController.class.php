<?php
namespace Stat\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $this->assign('nav' , 1);
        $this->assign('subNav' , 1);
        $this->assign('date', date('Y-m'));
        $this->display();
    }

    public function getMoneyByMonth() {
        $month = I('month');
        if ($month) {
            $start_time = date('Y-m-d', strtotime($month));
            $end_time = date('Y-m-d', strtotime('+1 month', strtotime($month)));
        } else {
            $this->ajaxReturn(array('status' => 'error', 'data' => '参数错误'));
        }

        $where = array();

        $order = D('order');


        $data = $order->query('SELECT order_date as date, meal_time, SUM(`price` * `count`) as count FROM `order_menu_v` WHERE ( `order_date` >= \''. $start_time .'\' AND `order_date` < \'' . $end_time . '\' AND `status` = \'finish\' ) GROUP BY order_date, meal_time');
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
