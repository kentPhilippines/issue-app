<?php
namespace App\Exceptions;
use Exception;
use Illuminate\Http\Request;
use App\Extends\Helpers\Result;
class ServerExceptionHandler extends Exception
{
// 自定义数据
  protected $data;
     //自定义异常 渲染
     public function render(Request $request){
      Result::error($this->getMessage(),$this->getCode());
  }
}