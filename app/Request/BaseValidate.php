<?php

namespace app\Request;

use support\Response;


class BaseValidate
{
    public array  $rule;
    public  array $message;
    public function goCheck($params): Response|array
    {
        $validator= validator($params,$this->rule,$this->message);
        if ($validator->fails()){
            return json(['code'=>422,'message'=>$validator->errors()->first()]);
        }
        return $validator->validated();
    }
}