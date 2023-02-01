<?php

namespace app\Exception;

class Enum
{
    const USER_NOT_FOUND='账号不存在';
    const PASSWORD_ERROR='账号或者密码不正确';
    const CAPTCHA_ERROR='验证码不正确';
    const CAPTCHA_CREATE_ERROR='验证码生成失败';
    const LOGIN_COUNT_ERROR ='登录失败次数过多，请5分钟后再试';
    const SYSTEM_ERROR='内部错误';
    const LOGIN_SUCCESS='登录成功';
    const LOGIN_ERROR ='登录失败';
    const ACCOUNT_ERROR='账号已经被禁用,请联系管理员';
    const LOGOUT='退出登录';
    const NOT_LOGIN='没有登录或者登录已经过期';
    const NOT_PERMISSION='没有权限';
    const NOT_FOUND_ERROR='资源不存在';
    const QUERY_ERROR='数据库异常';
}