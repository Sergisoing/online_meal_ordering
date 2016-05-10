<?php

namespace Admin\Model;
use Think\Model;
class DishModel extends Model {
    protected $tableName = 'dish';
    protected $_validate = array(
        array('name', 'require', '请输入菜品名'),
        array('store_id','require','请选择店铺'),
        array('kind','require','请选择属于菜系'),
        array('picture', 'require', '请上传菜品示例图片'),
        array('price', '/^\d+(\.\d+)?$/', '请输入正确的价格')
        );


    public function getDishList() {
        $data = $this->query('select * from dishV');
        return $data;
    }



}

 ?>
