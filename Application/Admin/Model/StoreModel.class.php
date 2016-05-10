<?php
namespace Admin\Model;
use Think\Model;

class StoreModel extends Model {

    protected $tableName = 'store';
    protected $_validate = array(
        array('name', 'require', '请输入店铺名称'),
        array('adress' ,'require', '请填写正确的地址'),
        array('desc' ,'require', '请填写正确的店铺描述'),
        array('kind' ,'require', '请选择店铺分类'),
        array('name','','该店铺已经存在',0,'unique',1),
        array('phone', '/^\d{11}$/', '请输入正确的手机号码'),
        array('picture', 'require', '请上传店铺缩略图'),
        array('detail_pics', 'require', '请上传店铺详细图片')
        );

    public function getStoreList($kind = '') {
        $conditions = array();
        if ($kind) {
            $conditions['kind'] = $kind;
        }
        $data = $this->where($conditions)->getField('id,name,phone,adress,desc,score,picture,is_delete');
        return $data;
    }




}
