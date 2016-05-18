<?php
namespace Stat\Controller;
use Think\Controller;
class DishController extends Controller {
    public function dishStat() {
        $this->assign('nav', 2);
        $this->assign('subNav', 1);
        $this->display('dish_count');
    }


    public function getDishCountStat() {
        $dish = D('dish');
        $dishData = $dish->order('count desc')->getField('name, count');
        $total = 0;
        $totalPer = 0;
        $res = array();
        $res['status'] = 'ok';
        foreach ($dishData as $key => $value) {
            $total += $value;
            $res['data'][] = array('name' => $key, 'count' => $value);
        }

        foreach ($res['data'] as $key => &$value) {
            $value['percent'] = number_format($value['count'] / $total * 100, 2);
            $totalPer += $value['percent'];
        }

        $res['percentData'] = $this->formatPercentData($res['data'], 'name');

        $res['total'] = $total;
        $this->ajaxReturn($res);
    }


    public function dishStoreStat() {
        $this->assign('nav', 2);
        $this->assign('subNav', 2);
        $this->display('dish_store_count');
    }


    public function getDishStoreCount() {
        $dish = D('dish');
        $dishData = $dish->query('SELECT `store_name`, `store_id`, SUM(`count`) AS `sum_count` FROM `dishv` GROUP BY `store_id` ORDER BY `sum_count` DESC');
        $sum = 0;
        foreach ($dishData as $value) {
            $sum += $value['sum_count'];
        }

        foreach ($dishData as &$value) {
            $value['percent'] = number_format(($value['sum_count'] / $sum) * 100, 2);
        }

        $percentData = $this->formatPercentData($dishData, 'store_name');

        $this->ajaxReturn(array('status' => 'ok', 'total' => $sum, 'data' => $dishData, 'percentData' => $percentData));
    }


    public function formatPercentData($data,  $keyName) {
        $limit= 96;
        $sum = 0;
        $res = array();
        foreach ($data as $key => $value) {
            if ($sum > $limit) {
                $res[] = array('label' => '其他', 'value' => (100 - $sum));
                break;
            }
            $res[] = array('label' => $value[$keyName], 'value' => $value['percent']);
            $sum += $value['percent'];
        }
        return $res;
    }

    public function dishKindStat() {
        $this->assign('nav', 2);
        $this->assign('subNav', 3);
        $this->display('dish_kind_count');
    }

    public function getDishKindStat() {
        $dish = D('dish');
        $dishData = $dish->query('SELECT SUM(`count`) as `sum_count`, `kind_name` FROM `dishv` GROUP BY `kind_id` ORDER BY `sum_count` DESC');
        $sum = 0;
        foreach ($dishData as $value) {
            $sum += $value['sum_count'];
        }

        foreach ($dishData as &$value) {
            $value['percent'] = number_format(($value['sum_count'] / $sum) * 100, 2);
        }

        $percentData = $this->formatPercentData($dishData, 'kind_name');

        $this->ajaxReturn(array('status' => 'ok', 'total' => $sum, 'data' => $dishData, 'percentData' => $percentData));
    }




}


 ?>
