<?php

namespace App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

/**
 * issue 的表单请求验证类
 */
class StoreIssueRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        #验证是否登陆
        return Auth::check();
    }
    /**
     * Get the validation rules that apply to the request.
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'userId' => 'required',
            'title' =>  'required|max:255' ,
            'content' =>  'required' ,
        ];
    }
    public function messages()
    {
        return [
            'title' => '文章标题为空',
            'content' => '文章内容为空',
        ];
    }
}
