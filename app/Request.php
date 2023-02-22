<?php

namespace app;
use support\Log;
use support\Request as BaseRequest;

class Request extends BaseRequest
{

    public function input($name = null, $default = null)
    {
        return $this->filter(parent::input($name, $default));
    }

    public function get($name = null, $default = null)
    {
        return $this->filter(parent::get($name, $default));
    }

    public function post($name = null, $default = null)
    {
        return $this->filter(parent::post($name, $default));
    }

    public function all()
    {
        return $this->filter(parent::all());
    }

    public function filter($value)
    {
        if ( ! $value) {
            return $value;
        }
        if (is_array($value)) {
            array_walk_recursive($value, function (&$item) {
                if (is_string($item)) {
                    $item = htmlspecialchars($item);
                }
            });
        } else {
            $value = htmlspecialchars($value);
        }

        return $value;
    }
    /**
     * 当前是否ssl
     * @access public
     * @return bool
     */
    public function isSsl(): bool
    {
        if ($this->server('HTTPS') && ('1' == $this->server('HTTPS') || 'on' == strtolower($this->server('HTTPS')))) {
            return true;
        } elseif ('https' == $this->server('REQUEST_SCHEME')) {
            return true;
        } elseif ('443' == $this->server('SERVER_PORT')) {
            return true;
        } elseif ('https' == $this->server('HTTP_X_FORWARDED_PROTO')) {
            return true;
        }

        return false;
    }

    /**
     * 当前URL地址中的scheme参数
     * @access public
     * @return string
     */
    public function scheme(): string
    {
        return $this->isSsl() ? 'https' : 'http';
    }
    public function server($name = null)
    {
        return $name ? ($_SERVER[$name] ?? null) : $_SERVER;
    }

    /**
     * 是否为GET请求
     * @access public
     * @return bool
     */
    public function isGet(): bool
    {
        return $this->method() == 'GET';
    }

    /**
     * 是否为POST请求
     * @access public
     * @return bool
     */
    public function isPost(): bool
    {
        return $this->method() == 'POST';
    }

    /**
     * 是否为PUT请求
     * @access public
     * @return bool
     */
    public function isPut(): bool
    {
        return $this->method() == 'PUT';
    }
    /**
     * 获取应用
     * @return string
     */
    public function getApp(): string
    {
        return '/' . request()->app;
    }

    /**
     * 获取控制器
     * @return string|string[]|null
     */
    public function getController(bool $lower = true): array|string|null
    {
        $controller = str_replace(["app\\$this->app\\controller\\", '\\'], ['', '/'], request()->controller);
        return $lower ? strtolower($controller) : $controller;
    }

    /**
     * 获取控制器方法
     * @return string
     */
    public function getAction(): string
    {
        return request()->action ?? 'null';
    }

    /**
     * 检测是否使用手机访问
     * @access public
     * @return bool
     */
    public function isMobile(): bool
    {
        if (request()->header('HTTP_VIA') && stristr(request()->header('HTTP_VIA'), "wap")) {
            return true;
        }

        if (request()->header('accept') && strpos(strtoupper(request()->header('accept')), "VND.WAP.WML")) {
            return true;
        }

        if (request()->header('HTTP_X_WAP_PROFILE') || request()->header('HTTP_PROFILE')) {
            return true;
        }

        if (request()->header('user-agent') && preg_match('/(blackberry|configuration\/cldc|hp |hp-|htc |htc_|htc-|iemobile|kindle|midp|mmp|motorola|mobile|nokia|opera mini|opera |Googlebot-Mobile|YahooSeeker\/M1A1-R2D2|android|iphone|ipod|mobi|palm|palmos|pocket|portalmmm|ppc;|smartphone|sonyericsson|sqh|spv|symbian|treo|up.browser|up.link|vodafone|windows ce|xda |xda_)/i', request()->header('user-agent'))) {
            return true;
        }

        return false;
    }
    /**
     * 获取客户端IP
     * @param bool $save_mode
     * @return string
     * Author: fudaoji<fdj@kuryun.cn>
     */
    public function ip(bool $save_mode = true): string
    {
        return $this->getRealIp($save_mode);
    }
}