<?php
/**
 * Created by PhpStorm.
 * User: lambert
 * Date: 2016/8/17
 * Time: 11:55
 */

namespace School\Model;


use Think\Model;

class UserModel extends Model
{
    public function addUser()
    {
        $data['name'] = I('post.name');
        $data['school'] = I('post.school');
        $data['class'] = I('post.class');
        $data['job'] = I('post.job');
        $data['company'] = I('post.company');
        $data['phone'] = I('post.phone');
        $data['label'] = I('post.label');
        $label = preg_match('/^10[0-9]{18}$/', $data['label']);
        $phone = preg_match('/^((13)|(15)|(17)|(18))+\d{9}$/', $data['phone']);
        if($label != 1) {
            return 0;
        }
        if($phone != 1) {
            return 0.0;
        }
        return $this->data($data)->add();
    }
}