<?php
namespace App\Extends;
use App\Extends\Helpers\Result;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
class BaseController extends Controller
{
/**
     * 控制器名称
     * @var string
     */
    protected string $controller;

    /**
     * 方法名称
     * @var string
     */
    protected string $action;
      /**
     * Request实例
     * @var Request
     */
    protected Request $request;

    /**
     * 构造函数
     * BaseController constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->__initialize();
    }
    /**
     * 自定义的初始化方法
     */
    public function __initialize(): void
    {
        $routeName = $this->request->route()->getActionName();
        list($controller, $action) = explode('@', $routeName);
        $controller = str_replace('Controller', '', class_basename($controller));
        $this->controller = strtolower($controller);
        $this->action = $action;
    }
    /**
     * 跳转到错误页
     * @param string $msg
     * @param int $code
     * @return View|JsonResponse
     */
    public function toError(string $msg = '发生错误了', int $code = 400): View|JsonResponse
    {
            return Result::error($msg,$code);
    }

    /**
     * 简化toError
     * @param string $msg
     * @param int $code
     * @return View|JsonResponse
     */
    public function error(string $msg = '发生错误了', int $code = 400): View|JsonResponse
    {
        return $this->toError($msg,$code);
    }

    /**
     * 成功或者成功页
     * @param string $msg
     * @param array $data
     * @param array $extend
     * @return View|JsonResponse
     */
    public function success(string $msg = '操作成功', array $data = [], array $extend = []): View|JsonResponse
    {
            return Result::success($msg,$data,$extend);
    }

}