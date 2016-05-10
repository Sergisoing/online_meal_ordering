<?php
namespace Home\Model;
use Think\Model;
use Think\Cache\Driver;

class StoreModel extends Model {
    protected $tableName = 'store';


    /**
    * 获取店铺列表
    *@param:
    *@return: Array $data
    */
    public function getStoreList() {
        $cache = new \Think\Cache\Driver\Memcache();
        $mKey = 'StoreList';
        $data = $cache->get($mKey);
        if ($data) {
            return $data;
        }
        $data = $this->select();
        $cache->set($mKey, $data);
        return $data;
    }

    public function getStoreScore() {
        $data = $this->query('SELECT AVG(`score`) as `avg`, `store_id` FROM `order_menu_v` WHERE `score` != 0 GROUP BY `store_id`');
        return $data;
    }



}



 ?>
