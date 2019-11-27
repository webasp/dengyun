<?php

    namespace app\http\middleware;


    use app\api\service\Token;
    use app\lib\exception\LoginException;
    use app\lib\exception\TokenException;
    use think\facade\Cache;

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

            // 获取缓存中的用户信息
            $exist = Cache::get($Token);
            $user = json_decode($exist,true);
            $request->user_id = $user['id'];
            $request->username = $user['username'];

            return $next($request);
        }
    }
