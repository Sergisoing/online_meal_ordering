<?php
namespace Home\Controller;
use Think\Controller;
use Home\Model;

class IndexController extends Controller {
    public function index(){
        $store = D('store');
        $kind = D('dish_kind');
        $data = $kind->select();
        $this->assign('kindList', $data);
        $this->display();
    }

    public function test() {
        $store = D('store');
        dump($store->getStoreScore());
    }

    public function getStoreList() {
        $kindId = I('post.kindId');
        $sort   = I('post.sort');
        $conditions = array();
        $where = 'where store.is_delete = 0';
        if ($kindId) {
            $where .= ' && kind_id = ' . $kindId;
        }
        $order = '';
        if ($sort) {
            switch ($sort) {
                case 'up':
                    $order = 'order by mount asc';
                    break;
                case 'down':
                    $order = 'order by mount desc';
                    break;
                case 'new':
                    $order = 'order by store.create_time desc';
                    break;
            }
        }
        $store = D('store');


        $data = $store->query('select store.id, store.name,store.phone,store.desc,adress,store.picture,sum(count) as mount from store left join dish on store.id = dish.store_id '. $where .' group by store.id ' . $order);

        $scores = $store->getStoreScore();
        foreach ($data as &$value) {
            foreach ($scores as $v) {
                if ($v['store_id'] == $value['id']) {
                    $value['score'] = number_format($v['avg'], 1);
                }
            }
        }

        $this->ajaxReturn(array('status' => 'ok', 'data' => $data));
    }
}
