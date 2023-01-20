<?php

namespace app\Exception;

class Enum
{
    const USER_NOT_FOUND='账号不存在';
    const PASSWORD_ERROR='账号或者密码不正确';
    const CAPTCHA_ERROR='验证码不正确';
    const CAPTCHA_CREATE_ERROR='验证码生成失败';
    const LOGIN_ERROR ='登录失败次数过多，请5分钟后再试';
    const SYSTEM_ERROR='内部错误';
}