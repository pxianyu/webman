<?php

namespace app\Validate;


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
            return returnData($validator->errors()->first(),[],422);
        }
        return returnData('',$validator->validated());
    }
    public function rules(): array
    {
        $rule_action='getRulesBy'.ucfirst(request()->getAction());
        if(method_exists($this,$rule_action)){
            return $this->$rule_action();
        }
        return $this->getDefaultRules();
    }
    public function getDefaultRules(): array
    {
        return [];
    }
}