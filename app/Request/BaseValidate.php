<?php

namespace app\Request;


class BaseValidate
{

    public function goCheck($params): array
    {
        $validator= validator($params,$this->rules(),$this->messages());
        if ($validator->fails()){
            return returnData($validator->errors()->first(),[],422);
        }
        return returnData('',$validator->validated());
    }
}