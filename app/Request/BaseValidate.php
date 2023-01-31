<?php

namespace app\Request;


use Dotenv\Exception\ValidationException;

class BaseValidate
{

    /**
     * @param $params
     * @return array
     * @throws \Illuminate\Validation\ValidationException
     */
    public function goCheck($params): array
    {
        $validator= validator($params,$this->rules(),$this->messages());
        if ($validator->fails()){
            throw new ValidationException($validator->errors()->first(),422);
        }
        return returnData('',$validator->validated());
    }
}