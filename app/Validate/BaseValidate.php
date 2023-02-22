<?php

namespace app\Validate;


use Illuminate\Validation\ValidationException;

class BaseValidate
{

    /**
     * @param $params
     * @return array
     * @throws ValidationException
     */
    public function goCheck($params): array
    {
        $validator = validator($params, $this->rules(), $this->messages());
        if ($validator->fails()) {
            return returnData($validator->errors()->first(), [], 422);
        }
        return returnData('', $validator->validated());
    }

    public function rules(): array
    {
        $rule_action = 'getRulesBy' . ucfirst(request()->getAction());
        if (method_exists($this, $rule_action)) {
            return $this->$rule_action();
        }
        return $this->getDefaultRules();
    }

    public function getDefaultRules(): array
    {
        return [];
    }

    public function messages(): array
    {
        return [];
    }
}