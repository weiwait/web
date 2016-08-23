<?php
/**
 * Created by PhpStorm.
 * User: weiwait
 * Date: 2016/8/17
 * Time: 11:48
 */

namespace School\Controller;


use Think\Controller;

class TeacherController extends Controller
{
    public function school()
    {
        $nav_title = M('LeftNavGenre', '', 'DB2');
        $left_nav = M('LeftNav', '', 'DB2');
        $nav_title = $nav_title->select();
        $left_nav = $left_nav->select();
        $active = '考勤后台';
        $this->assign('active', $active);
        $this->assign('nav_genre', $nav_title);
        $this->assign('left_nav', $left_nav);
        $this->display();
    }

    public function addTeacher()
    {
        if(IS_POST) {
            $teacher = M('Teacher', '', 'DB2');
            $data['name'] = I('post.teacher');
            echo $teacher->add($data);
            return;
        }
        $this->display();
    }

    public function addUser()
    {
        if(IS_POST) {
            $user = new \School\Model\UserModel('user', '', 'DB2');
            echo $user->addUser();
            return;
        }
        $this->display();
    }
}
