<?php

namespace Admin\Model;
use Think\Model;

class ConfigModel extends Model {


    public $tableName = 'config';

    public function C($key) {
        $cache = new \Think\Cache\Driver\Memcache();
        if (is_array($key)) {
            if(is_assoc($key)) {
                $user = D('user');
                $user->is_admin();
                $count = $this->where(array('id' => 1))->save($key);
                if ($count > 0) {
                    foreach ($key as $k => $v) {
                        $cache->set('config_' . $k, $v);
                    }
                    return true;
                } else {
                    return false;
                }

            } else {
                $res = array();
                $queryKeyArr = array();
                foreach ($key as $v) {
                    $mKey = 'config_'. $v;
                    $configData = $cache->get($mKey);
                    if (!$configData) {
                        $queryKeyArr[] = $v;
                    } else {
                        $res[$v] = $configData;
                    }
                }

                if ($queryKeyArr) {
                    $data = $this->where(array('id' => 1))->getField('id,' . implode(',', $queryKeyArr));
                }

                foreach ($queryKeyArr as $value) {
                    $res[$value] = $data[1][$value];
                    $cache->set('config_' . $value, $data[1][$value], 7200);
                }
                return $res;
            }
        } else {
            $mKey = 'config_' . $key;
            $configData = $cache->get($mKey);
            if (!$configData) {
                echo '1';
                $data = $this->where(array('id' => 1))->getField($key);
                $cache->set($mKey, $data, 7200);
                return $data;
            } else {
                return $configData;
            }
        }
    }
}

 ?>
