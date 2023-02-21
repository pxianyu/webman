<?php

namespace app\Enum;

class MessageEnum
{
    public const USER_NOT_FOUND='账号不存在';
    public const PASSWORD_ERROR='账号或者密码不正确';
    public const CAPTCHA_ERROR='验证码不正确';
    public const CAPTCHA_CREATE_ERROR='验证码生成失败';
    public const LOGIN_COUNT_ERROR ='登录失败次数过多，请5分钟后再试';
    public const SYSTEM_ERROR='内部错误';
    public const LOGIN_SUCCESS='登录成功';
    public const LOGIN_ERROR ='登录失败';
    public const ACCOUNT_ERROR='账号已经被禁用,请联系管理员';
    public const LOGOUT='退出登录';
    public const NOT_LOGIN='没有登录或者登录已经过期';
    public const NOT_PERMISSION='没有权限';
    public const NOT_FOUND_ERROR='资源不存在';
    public const QUERY_ERROR='数据库异常';
}