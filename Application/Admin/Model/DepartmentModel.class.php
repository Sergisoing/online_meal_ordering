<?php

namespace Admin\Model;
use Think\Model;

class DepartmentModel extends Model {
    protected $tableName = 'department';
    protected $_validate = array(
        array('dep_name', 'require', '部门名称不能为空'),
        array('dep_name','','该部门已经存在！',0,'unique',1),
        );


    public function getDepList() {
        return $this->select();
    }
}

 ?>
