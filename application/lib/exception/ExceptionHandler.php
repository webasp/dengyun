<?php
namespace app\lib\exception;
use think\exception\Handle;
use think\facade\Log;
use think\facade\Request;

class ExceptionHandler extends Handle {
    private $statusCode;
    private $msg;
    private $code;
		
	//需要返回客户端当前请求的URL路径
	public function render(\Exception $e)
	{

		if ($e instanceof BaseException) {
            $this->statusCode = $e->statusCode;
            $this->msg = $e->msg;
            $this->code = $e->code;
		} else {
			if (config('app_debug')) {
				return parent::render($e);
			} else {
                $this->statusCode = 500;
                $this->msg = '服务器内部错误';
                $this->code = 999;
			}			
		}

        $result = [
            'code' => $this->code,
            'request' => Request::method().': '.Request::url(),
            'msg' => $this->msg
        ];

        return json($result,$this->statusCode);
	}

	private function recordErrorLog(\Exception $e)
	{
		Log::init([
			'type' => 'File',
			'level' => ['error']
			]);
		Log::record($e->getMessage(),'error');
	}
}