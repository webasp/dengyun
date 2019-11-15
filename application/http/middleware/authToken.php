<?php

    namespace app\http\middleware;


    use app\api\service\Token;
    use app\lib\exception\LoginException;
    use app\lib\exception\TokenException;

    class authToken
    {
        public function handle($request, \Closure $next)
        {
            // 判断 Token 是否存在
            $Token= $request->header('Token');
            if(empty($Token)){
                throw new TokenException([
                    'msg' => 'Token 不存在'
                ]);
            }

            // 判断 Token 是否登录
           if(!Token::verifyToken($Token)){
               throw new LoginException();
           }

            return $next($request);
        }
    }
