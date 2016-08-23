<?php
return array(
    //'配置项'=>'配置值'
    'URL_MODEL' => '3', //URL模式

    //数据库配置信息
    'DB_CONFIG1' => array(
        'DB_TYPE' => 'mysql', // 数据库类型
        'DB_HOST' => 'rdsiw7z9hqi3rzubgw1vi.mysql.rds.aliyuncs.com:3306', // 服务器地址
        'DB_NAME' => 'test_tp_main', // 数据库名
        'DB_USER' => 'test1', // 用户名
        'DB_PWD' => '123test', // 密码
        'DB_PORT' => 3306, // 端口
        'DB_PREFIX' => '', // 数据库表前缀
    ),

    'DB_CONFIG2' => array(
        'DB_TYPE' => 'mysql', // 数据库类型
        'DB_HOST' => 'rdsiw7z9hqi3rzubgw1vi.mysql.rds.aliyuncs.com:3306', // 服务器地址
        'DB_NAME' => 'test_tp_shard_001', // 数据库名
        'DB_USER' => 'test1', // 用户名
        'DB_PWD' => '123test', // 密码
        'DB_PORT' => 3306, // 端口
        'DB_PREFIX' => 'attendance_', // 数据库表前缀
    ),

    'DB_CONFIG_SCHOOL' => array(
        'DB_TYPE' => 'mysql',
        'DB_HOST' => 'rdsiw7z9hqi3rzubgw1vi.mysql.rds.aliyuncs.com:3306',
        'DB_NAME' => 'test_tp_school',
        'DB_USER' => 'test1',
        'DB_PWD' => '123test',
        'DB_PORT' => 3306,
        'DB_PREFIX' => 'attendance_',
    ),

    // 配置邮件发送服务器
    'MAIL_HOST' => 'smtp.exmail.qq.com',//smtp服务器的名称
    'MAIL_SMTPAUTH' => TRUE, //启用smtp认证
    'MAIL_USERNAME' => 'jufengjituan@gsjfjt.com',//你的邮箱名
    'MAIL_FROM' => 'jufengjituan@gsjfjt.com',//发件人地址
    'MAIL_FROMNAME' => '聚丰集团',//发件人姓名
    'MAIL_PASSWORD' => '******',//邮箱密码
    'MAIL_CHARSET' => 'utf-8',//设置邮件编码
    'MAIL_ISHTML' => TRUE, // 是否HTML格式邮件
);