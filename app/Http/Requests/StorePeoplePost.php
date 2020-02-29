<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePeoplePost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *是否授权
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *规则
     * @return array
     */
    public function rules()
    {
        return [
              'username'=>[
                                'regex:/^[\x{4e00}-\x{9fa5}A-Za-z0-9_-]{2,12}$/u',
                                 Rule::unique('people')->ignore(request()->id,'p_id'),
                                ],
                'age'=>'required|integer|between:1,130',
        ];
    }
    /**
     *中文信息提示
    */
   public function messages(){
        return [
               'username.required'=>'名字不能为空',
                'username.unique'=>'名字已存在',
               'username,max'=>'名字最大长度支持12位',
                'username.min'=>'名字最小长度支持2位',
                'age.required'=>'年龄不能为空',
                'age.integer'=>'年龄必须为数字',
                'age.min'=>'年龄规范不合法',
                'age.max'=>'年龄规范不合法',
        ];
   }
}
