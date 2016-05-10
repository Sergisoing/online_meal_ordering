<?php

namespace Home\Model;
use Think\Model;
use Think\Cache\Driver;

class DishModel extends Model {

    //表名
    protected $tableName = 'dish';

    public function getStoreDishType($storeId) {
        $cache = new \Think\Cache\Driver\Memcache();
        $memK = 'getStoreDishType_' . $storeId;
        $data = $cache->get($memK);
        if (!$data) {
            $data = $this->query('select * from store_style where store_id = ' . $storeId);
            if (empty($data)) {
                return false;
            }
            $cache->set($memK, $data);
        }
        return $data;
    }


    public function getDishScore($dishId) {
        $data = $this->query('SELECT AVG(`score`) as `score` FROM `order_menu_v` WHERE `score` != 0 AND `dish_id` = ' . $dishId);
        return $data[0];
    }


    public function getCommnetCount($dishId) {
        $data = $this->query('SELECT COUNT(*) as `comment_count` FROM `menu` WHERE `comment` != \'\' AND `dish_id` = ' . $dishId);
        return $data[0];
    }

    public function getDishList($storeId, $typeId = false, $order = false) {
        $memK  = 'getDishList_s' . $storeId;
        $memK  = $typeId ? $memK . '_t' . $typeId : $memK;
        $memK = $order ? $memK . '_o' . $order : $memK;
        $cache = new \Think\Cache\Driver\Memcache();
        $data  = $cache->get($memK);
        if (!$data) {
            switch ($order) {
                case 'new' : $orderStr = 'create_time desc'; break;
                case 'up'  : $orderStr = 'count asc'; break;
                case 'down': $orderStr = 'count desc'; break;
                default    : $orderStr = '';
            }

            if ($typeId) {
                $data = $this->where(array('is_delete' => 0,'store_id' => $storeId, 'store_style_id' => $typeId))->order($orderStr)->getField('id,name,price,picture,count');
            } else {
                $data = $this->where(array('is_delete' => 0, 'store_id' => $storeId))->order($orderStr)->getField('id,name,price,picture,count');
            }
            // $cache->set($memK, $data);
        }
        $res = array();
        foreach ($data as $k => $v) {
            $res[] = $v;
        }
        return $res;
    }
}
