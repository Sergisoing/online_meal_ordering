<?php
namespace Admin\Model;
use Think\Model;

class UserModel extends Model {
    protected $tableName = 'staff';
    protected $_validate = array(
        array('emp_no', 'require', '请输入员工编号'),
        array('name', 'require', '请输入员工姓名'),
        array('sex' ,array(0,1), '请选择正确的性别', 1, 'in'),
        array('emp_no','','帐号名称已经存在！',0,'unique',1),
        array('password', 'require', '请输入正确的密码'),
        array('phone', '/^\d{11}$/', '请输入正确的手机号码')
        );

    protected $_aut0 = array();
    public function login($userName, $password) {
        if (empty($userName) || empty($password)) {
            return 'empty_error';
        }

        $config = D('config');
        if ($userName == C('ADMIN_USER') && $config->where(array('password' => md5($password)))->count()) {
            session('type', 'admin');
            return 'ok';
        }

        $userData = $this->where(array('emp_no' => $userName, 'password' => md5($password), 'is_delete' => '0'))->join('JOIN department ON department.id = staff.dep_id')->find();
        if (false == $userData) {
            return 'password_wrong';
        }

        session('name', $userData['name']);
        session('type', 'user');
        session('phone', $userData['phone']);
        session('emp_no', $userData['emp_no']);
        session('department', $userData['dep_name']);
        session('dep_id', $userData['dep_id']);
        session('sex', $userData['sex'] ? '女' : '男');
        session('headimg', $userData['headimg']);
        session('email', $userData['email']);
        return 'ok';
    }

    public function getUserList() {
        $userList = $this->where(array('is_delete' => 0))->join('join department on department.id = staff.dep_id')->getField('staff.id,emp_no,name,phone,dep_name,sex,headimg,email');
        return $userList;
    }

    public function changePw($id, $pw) {
        $data = array();
        $data['password'] = md5($pw);
        $condition = array();
        $condition['id'] = $id;
        $this->where($condition)->save($data);
        return true;
    }

    public function deleteUser($id) {
        $condition = array();
        $condition['id'] = $id;
        $data = array();
        $data['is_delete'] = '1';
        $this->where($condition)->save($data);
        return true;
    }

    public function is_admin() {
        session('type') != 'admin' && header('Location: /online_meal_ordering/admin/user/index');
    }

    public function is_login($type) {
        if ($type == 'ajax') {
            if (session('type') != 'user') {
                die(json_encode(array('status' => 'redirect', 'data' => '/online_meal_ordering/admin/user/index/url/' . encode($_SERVER['HTTP_REFERER']))));
            } else {
                return true;
            }
        }
        session('type') != 'user' && header('Location: /online_meal_ordering/admin/user/index');
    }

}




