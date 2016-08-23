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
        $data['phone'] = I('post.company');
        $data['label'] = I('post.label');
        return $this->data($data)->add();
    }
}