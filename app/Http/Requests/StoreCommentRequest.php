<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
{
    /**
     * 应该在这里做api拦截操作，目前不知如何使用先放行
     */
    public function authorize(): bool
    {
        #验证是否登陆
        return Auth::check();    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'issueId' => 'required',
            'userId' => 'required',
            'title' =>  'required|max:255' ,
            'content' =>  'required' ,
        ];
    }
    public function messages()
    {
        return [
            'title' => '回复标题为空',
            'content' => '回复内容为空',
        ];
    }
}
