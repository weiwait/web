<?php
namespace Home\Controller;

use Think\Controller;

class UserController extends Controller
{
    public $tree = null;

    function _initialize()
    {
        $user_id = session('user.id');
        if (empty($user_id)) {
            $this->redirect('Home/Index/index');
        }
    }

    public function index()
    {
        $this->display();
    }

    //我的考勤机
    public function machine_list()
    {
        $tp_appid = session('user.id');
        $bind_list = M("Bind", "", "DB_CONFIG1")->query("select tp_machineid from bind where tp_appid='" . $tp_appid . "'");
        foreach ($bind_list as $key => $item) {
            $tp_machineids .= $item['tp_machineid'] . ',';
        }
        $tp_machineids = trim($tp_machineids, ',');

        if (!empty($tp_machineids)) {
            $machine_list = M("MachineDetail", "", "DB_CONFIG2")->query("select * from machine_detail where tp_machineid in ($tp_machineids)");
            foreach ($machine_list as $key => $item) {
                if ($item['type'] == '08' || $item['type'] == '10') {
                    $list[] = $item;
                }
            }
        }
        $this->assign('list', $list);

        $active = '我的考勤机';
        $this->assign('active', $active);

        $breadcrumb = '<li class="active">' . $active . '</li>';
        $this->assign('breadcrumb', $breadcrumb);

        $this->display();
    }

    //我的下级
    public function app_list()
    {
        $tp_machineid = I('get.tp_machineid/d');
        $this->assign('tp_machineid', $tp_machineid);

        $bind_list = M("Bind", "", "DB_CONFIG1")->query("select tp_appid from bind where tp_machineid='" . $tp_machineid . "'");
        foreach ($bind_list as $key => $item) {
            $tp_appids .= $item['tp_appid'] . ',';
        }
        $tp_appids = trim($tp_appids, ',');

        $tp_appid = session('user.id');
        $list = M("App", "", "DB_CONFIG1")->query("select * from app where id in ($tp_appids) and parent_id=$tp_appid");
        $this->createtree($list);

        $this->assign('list', $this->tree);

        $active = '我的下级';
        $this->assign('active', $active);

        $breadcrumb = '<li class="active">' . $active . '</li>';
        $this->assign('breadcrumb', $breadcrumb);

        $this->display();
    }

    //添加我的下级
    public function app_add()
    {
        if (IS_POST) {
            $parent_id = session('user.id');
            $appid = I('post.appid');
            $tp_machineid = I('post.tp_machineid');

            if (empty($appid)) {
                $this->error('appid不能为空');
            }

            $app = M("App", "", "DB_CONFIG1")->query("select * from app where appid='" . $appid . "'");

            if (empty($app)) {
                $this->error('appid不存在');
            }

            $tp_appid = $app[0]['id'];

            $sql = "UPDATE app SET parent_id='$parent_id' WHERE id='$tp_appid'";
            $res = M("App", "", "DB_CONFIG1")->execute($sql);

            if ($res) {
                $url = U('User/app_list', array('tp_machineid' => $tp_machineid));
                //echo $url;exit;
                $this->success('添加成功', $url);
                exit;
            } else {

                $this->error('添加失败');
                exit;
            }
        }

        $this->display();
    }

    //删除我的下级
    public function app_del()
    {
        $tp_appid = I('get.tp_appid');

        $sql = "UPDATE app SET parent_id='0' WHERE id='$tp_appid'";
        $res = M("App", "", "DB_CONFIG1")->execute($sql);

        if ($res) {

            $this->success('删除成功', $url);
            exit;
        } else {
            echo $sql;
            exit;
            $this->error('删除失败');
        }
    }

    //这里是递归方法
    private function createtree(array $data = null, $lv = 1)
    {
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['lv'] = $lv;
            $this->tree[count($this->tree)] = $data[$i];
            $res = M("App", "", "DB_CONFIG1")->where('parent_id=' . $data[$i]['id'])->select();
            $this->createtree($res, ($lv + 1));
        }
    }

    //我的考勤
    public function punch_list()
    {
        $tp_appid = session('user.id');
        $list = M("Punch", "attendance_", "DB_CONFIG2")->query("select * from attendance_punch where tp_appid='" . $tp_appid . "'");
        $this->assign('list', $list);

        $active = '我的考勤';
        $this->assign('active', $active);

        $breadcrumb = '<li class="active">' . $active . '</li>';
        $this->assign('breadcrumb', $breadcrumb);

        $this->display();
    }


    //考勤机详情
    public function machine_detail()
    {
        $tp_machineid = I('get.tp_machineid/d');
        $machine_detail = M("MachineDetail", "", "DB_CONFIG2")->query("select * from machine_detail where tp_machineid=$tp_machineid");
        $this->assign('info', $machine_detail[0]);

        $active = '考勤机设置';
        $this->assign('active', $active);

        $breadcrumb = '<li class="active">' . $active . '</li>';
        $this->assign('breadcrumb', $breadcrumb);

        $this->display();
    }

    //考勤机编辑
    public function machine_edit()
    {
        $data = I('post.');
        $tp_machineid = intval($data['tp_machineid']);
        $machine_name = trim($data['machine_name']);
        $week = $data['week'];

        M("MachineDetail", "", "DB_CONFIG2")->execute("UPDATE machine_detail SET machine_name='$machine_name' WHERE tp_machineid='$tp_machineid'");

        $this->success('编辑成功');
    }

    //日历界面
    public function calendar()
    {
        $tp_appid = I('get.tp_appid/d');
        $tp_machineid = I('get.tp_machineid/d');
        $this->assign('tp_appid', $tp_appid);
        $this->assign('tp_machineid', $tp_machineid);

        $active = '<li><a href="' . U('User/app_list', array('tp_machineid' => $tp_machineid)) . '">我的下级</a></li>';
        $active .= '<li class="active">日历</li>';
        $this->assign('active', $active);
        $this->display();
    }

    //日历数据
    public function calendar_data()
    {
        //        $tp_appid = I('get.tp_appid/d');
        //        $tp_machineid = I('get.tp_machineid/d');
        //
        //        $sql = "select * from attendance_punch where tp_appid='" . $tp_appid . "' and tp_machineid='" . $tp_machineid . "'";
        //        $list = M("Punch", "attendance_", "DB_CONFIG2")->query($sql);
        //
        //        $list_count = count($list) - 1;
        //        foreach ($list as $key => $item) {
        //            $is_allday = false;
        //            if ($key == $list_count) {
        //                $end_time = $item['last_active_time'] ? date('Y-m-d H:i', $item['last_active_time']) : date('Y-m-d H:i', time());
        //            } else {
        //                $end_time = $item['last_active_time'] ? date('Y-m-d H:i', $item['last_active_time']) : '';
        //            }
        //
        //            $data[] = array(
        //                'id' => $item['id'],//事件id
        //                'title' => date('Y-m-d H:i', $item['createtime']) . " - " . $end_time,//事件标题
        //                'start' => date('Y-m-d H:i', $item['createtime']),//事件开始时间
        //                'end' => $end_time,//结束时间
        //                'allDay' => $is_allday, //是否为全天事件
        //                'color' => 'green' //事件的背景色
        //            );
        //        }
        //        echo json_encode($data);

        $tp_appid = I('get.tp_appid/d');
        $tp_machineid = I('get.tp_machineid/d');
        $sql = "select * from attendance_punch where tp_appid='" . $tp_appid . "' and tp_machineid='" . $tp_machineid . "'";
        $list = M("Punch", "attendance_", "DB_CONFIG2")->query($sql);
        foreach ($list as $key => $item) {
            $is_allday = false;
            $end_time = $item['last_active_time'];
            $start_time = $item['createtime'];
            $start_time_str = date('Y-m-d H:i', $start_time);
            $end_time_str = "";
            $title = $start_time_str . " - ";
            if (!$end_time) {
                $end_time = $this->get_check_in_end_time($start_time);
                $end_time_str = date('Y-m-d H:i', $end_time);
                $title = $title . $end_time_str . "-未打卡结束";
            } else {
                $end_time_str = date('Y-m-d H:i', $end_time);
                $title = $title . $end_time_str;
            }
            $data[] = array(
                'id' => $item['id'],
                'title' => $title,
                'start' => $start_time_str,
                'end' => $end_time_str,
                'allDay' => $is_allday,
                'color' => 'green'
            );
        }
        echo json_encode($data);
    }

    /**
     * 打卡记录
     */
    public function check_in()
    {
        $tp_appid = I('get.tp_appid/d');
        $tp_machineid = I('get.tp_machineid/d');
        $this->assign('tp_appid', $tp_appid);
        $this->assign('tp_machineid', $tp_machineid);
        $this->assign('active', '打卡');
        $this->display();
    }

    /**
     * 打卡数据
     */
    public function check_in_data()
    {
        $tp_appid = I('get.tp_appid/d');
        $tp_machineid = I('get.tp_machineid/d');
        $sql = "select * from attendance_punch where tp_appid='" . $tp_appid . "' and tp_machineid='" . $tp_machineid . "'";
        $list = M("Punch", "attendance_", "DB_CONFIG2")->query($sql);
        foreach ($list as $key => $item) {
            $is_allday = false;
            $end_time = $item['last_active_time'];
            $start_time = $item['createtime'];
            $start_time_str = date('Y-m-d H:i', $start_time);
            $end_time_str = "";
            $title = $start_time_str . "-";
            if (!$end_time) {
                $end_time = $this->get_check_in_end_time($start_time);
                $end_time_str = date('Y-m-d H:i', $end_time);
                $title = $title . $end_time_str . "-未打卡结束";
            } else {
                $end_time_str = date('Y-m-d H:i', $end_time);
                $title = $title . $end_time_str;
            }
            $data[] = array(
                'id' => $item['id'],
                'title' => $title,
                'start' => $start_time_str,
                'end' => $end_time_str,
                'allDay' => $is_allday,
                'color' => 'blue'
            );
        }
        echo json_encode($data);
    }

    private function get_check_in_end_time($start_time)
    {
        $hour = date("G", $start_time);
        $result_hour = 18;
        $result_minute = 0;
        $result_second = 0;
        $time = time();
        if (date('Y-m-d', $start_time) == date('Y-m-d', $time)) {
            return $time;
        } else if ($hour >= 18) {
            $result_hour = 23;
            $result_minute = 59;
            $result_second = 59;
        }
        $y = date("Y", $start_time);
        $m = date("m", $start_time);
        $d = date("d", $start_time);
        return mktime($result_hour, $result_minute, $result_second, $m, $d, $y);
    }

    private function tree($table, $p_id = '0')
    {
        $tree = array();
        foreach ($table as $row) {
            if ($row['parent_id'] == $p_id) {
                $tmp = $this->tree($table, $row['id']);
                if ($tmp) {
                    $row['children'] = $tmp;
                } else {
                    $row['leaf'] = true;
                }
                $tree[] = $row;
            }
        }
        Return $tree;
    }

    private function un_nodes($nodes, &$list)
    {
        foreach ($nodes as $v) {
            if (!empty($v['children'])) {
                $list[] = $v;
                $this->un_nodes($v['children'], $list);
            } else {
                $list[] = $v;
            }
        }

        return $list;
    }

    private function getMenuTree($arrCat, $parent_id = 0, $level = 0)
    {
        static $arrTree = array(); //使用static代替global
        if (empty($arrCat)) return FALSE;
        $level++;
        foreach ($arrCat as $key => $value) {
            if ($value['parent_id'] == $parent_id) {
                $value['level'] = $level;
                $arrTree[] = $value;
                unset($arrCat[$key]); //注销当前节点数据，减少已无用的遍历
                getMenuTree($arrCat, $value['id'], $level);
            }
        }

        return $arrTree;
    }
}