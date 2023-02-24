<?php

namespace app\Common;

use function count;
use function is_array;
use function is_object;

class ArrUtil
{

    /**
     * 从数组中移除一个或多个元素，重新组织为连续的键.
     *
     * @param mixed $value
     */
    public static function remove(array $array, ...$value): array
    {
        foreach ($value as $item)
        {
            while (false !== ($index = array_search($item, $array)))
            {
                unset($array[$index]);
            }
        }

        return array_values($array);
    }

    /**
     * 从数组中移除一个或多个元素，保持原有键.
     *
     * @param mixed $value
     */
    public static function removeKeepKey(array $array, ...$value): array
    {
        foreach ($value as $item)
        {
            while (false !== ($index = array_search($item, $array)))
            {
                unset($array[$index]);
            }
        }

        return $array;
    }

    /**
     * 多维数组递归合并.
     *
     * @param array ...$arrays
     */
    public static function recursiveMerge(array ...$arrays): array
    {
        $merged = [];
        foreach ($arrays as $array)
        {
            if (!$array || !is_array($array))
            {
                continue;
            }
            $isAssoc = self::isAssoc($array);
            foreach ($array as $key => $value)
            {
                if ($isAssoc)
                {
                    if (is_array($value) && isset($merged[$key]) && is_array($merged[$key]))
                    {
                        $merged[$key] = static::recursiveMerge($merged[$key], $value);
                    }
                    else
                    {
                        $merged[$key] = $value;
                    }
                }
                else
                {
                    $merged[] = $value;
                }
            }
        }

        return $merged;
    }

    /**
     * 将二维数组第二纬某key变为一维的key.
     *
     * @param array      $array   原数组
     * @param int|string $column  列名
     * @param bool       $keepOld 是否保留列名，默认保留
     */
    public static function columnToKey(array $array, int|string $column, bool $keepOld = true): array
    {
        $newArray = [];
        foreach ($array as $row)
        {
            $key = $row[$column];
            if (!$keepOld)
            {
                unset($row[$column]);
            }
            $newArray[$key] = $row;
        }

        return $newArray;
    }

    /**
     * 判断数组是否为关联数组.
     */
    public static function isAssoc(array $array): bool
    {
        return array_keys($array) !== range(0, count($array) - 1);
    }

    /**
     * 随机获得数组中的值.
     */
    public static function random(array $array, int $number = 1, bool $keepKey = true): array
    {
        $result = [];
        $keys = array_rand($array, $number);
        foreach ((array) $keys as $key)
        {
            if (!isset($array[$key]))
            {
                break;
            }
            if ($keepKey)
            {
                $result[$key] = $array[$key];
            }
            else
            {
                $result[] = $array[$key];
            }
        }

        return $result;
    }

    /**
     * 列表转树形关联结构.
     */
    public static function toTreeAssoc(array $list, string $idField = 'id', string $parentField = 'parent_id', string $childrenField = 'children'): array
    {
        // 查出所有记录
        $result = $tmpArr = [];
        // 处理成ID为键名的数组
        foreach ($list as $item)
        {
            $item[$childrenField] = [];
            $tmpArr[$item[$idField]] = $item;
        }
        foreach ($tmpArr as $item)
        {
            if (isset($tmpArr[$item[$parentField]]))
            {
                $tmpArr[$item[$parentField]][$childrenField][] = &$tmpArr[$item[$idField]];
            }
            else
            {
                $result[] = &$tmpArr[$item[$idField]];
            }
        }
        return $result;
    }
    /**
     * 将第二纬某字段值放入到一个数组中
     * 功能类似array_column，这个方法也支持对象
     */
    public static function column(array $array, string $columnName): array
    {
        $result = [];
        foreach ($array as $row)
        {
            if (is_object($row))
            {
                $result[] = $row->$columnName;
            }
            else
            {
                $result[] = $row[$columnName];
            }
        }
        return $result;
    }
    public static function menus(array $list, int $pid=0,string $parentField = 'pid'): array
    {
        // 用于保存整理好的分类节点
        $node = [];
        // 循环所有分类
        foreach ($list as $value) {
            if($pid == $value [$parentField]) {
                $temp=[
                    'title'=>$value['title'],
                    'isLink'=>$value['isLink'],
                    'isHide'=>$value['isHide'],
                    'isKeepAlive'=>$value['isKeepAlive'],
                    'isAffix'=>$value['isAffix'],
                    'roles'=>$value['roles'],
                    'isIframe'=>$value['isIframe'],
                    'icon'=>$value['icon']
                ];
                $children=self::menus($list,$value ['id']);
                $data=[
                    "path"=> $value['path'],
                    "name"=> $value['name'],
                    "component"=> $value['component'],
                    "redirect"=> $value['redirect'],
                    "meta"=> $temp,
                    'children'=>$children
                ];
                $node[]=$data;
            }
        }
        return $node;
    }

    /**
     * [std_class_object_to_array 将对象转成数组]
     * @param [stdclass] $stdclass object [对象]
     * @return array [array] [数组]
     */
    public static function object_array($obj): array
    {
        $arr=[];
        $_arr = is_object($obj) ? get_object_vars($obj) :$obj;
        foreach ($_arr as $key=>$val){
            $val = (is_array($val) || is_object($val)) ? self::object_array($val):$val;
            $arr[$key] = $val;
        }
        return $arr;
    }
    public static function arrayToStr(array $arr,string $sign=',') :string
    {
        return implode($sign,$arr);
    }
    public static function strToArray(string $str,string $sign=',') :array
    {
        return  explode($sign, $str);
    }
    public static function arrToJson(array $arr=[]) :string
    {
        return json_encode($arr);
    }
    public static function jsonToArray(string $str) :array
    {
        if($str){
            return json_decode($str,true);
        }
        return  [];
    }
}