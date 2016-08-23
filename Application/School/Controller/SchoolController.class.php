<?php
/**
 * Created by PhpStorm.
 * User: weiwait
 * Date: 2016/8/17
 * Time: 11:48
 */

namespace School\Controller;


use Think\Controller;

class SchoolController extends Controller
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

    public function addMachine()
    {
        if(IS_POST) {
            $mid = M('Attendance', '', 'DB2');
            $data['mid'] = trim(I('post.mid'));
            $len = strlen($data['mid']) == 20 ? true : false;
            $preg = preg_match('/^08[0-9]{18}$/', $data['mid']) == 1 ? true : false;
            if($len & $preg) {
                echo $mid->data($data)->add();
            }else {
                echo false;
            }
            return;
        }
        $this->display();
    }

    public function addCourse()
    {
        if(IS_POST) {
            $course = M('Course', '', 'DB2');
            $data['name'] = I('post.name');
            $data['teacher'] = intval(I('post.teacher'));
            echo $course->data($data)->add();
            return;
        }
        $teacher = M('Teacher', '', 'DB2');
        $data = $teacher->select();
        $this->assign('teacher', $data);
        $this->display();
    }

    public function addRoom()
    {
        if(!IS_POST) {
            $machine = M('Attendance', '', 'DB2');
            $machine = $machine->select();
            $this->assign('machine', $machine);
            $this->display();
            return;
        }
        $room = M('Room', '', 'DB2');
        $data['name'] = I('post.name');
        $data['attendance'] = I('post.attendance');
        echo $room->add($data);
    }

    public function addLesson()
    {
        if(!IS_POST) {
            $course = M('Course', '', 'DB2');
            $room = M('Room', '', 'DB2');
            $room = $room->select();
            $course = $course->select();
            $this->assign('course', $course);
            $this->assign('room', $room);
            $this->display();
            return;
        }
        $lesson = M('Lesson', '', 'DB2');
        $data['course'] = I('post.course');
        $data['room'] = I('post.room');
        $data['week'] = intval(I('post.week'));
        $data['index'] = intval(I('post.index'));
        echo $lesson->add($data);
    }

    public function addUserCourse()
    {
        if(!IS_POST) {
            $course = M('Course', '', 'DB2');
            $user = M('user', '', 'DB2');
            $user = $user->select();
            $course = $course->select();
            $this->assign('course', $course);
            $this->assign('user', $user);
            $this->display();
            return;
        }
        $usercourse = M('Usercourse', '', 'DB2');
        $data['user'] = I('post.user');
        $data['course'] = I('post.course');
        $data['notify'] = intval(I('post.notify'));
        $data['value'] = intval(I('post.value'));
        $data['score'] = intval(I('post.score'));
        echo $usercourse->add($data);
    }
}
