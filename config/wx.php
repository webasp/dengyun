<?php

return [
    //  +---------------------------------
    //  微信相关配置
    //  +---------------------------------

    'APP_ID' => 'wxabe92331b095c55a',
    'APP_SECRET' => '30093e7195a7180b696f261b0882b2e1',

    // 微信使用code换取用户openid及session_key
    'LOGIN_URL' => "https://api.weixin.qq.com/sns/jscode2session?" .
        "appid=%s&secret=%s&js_code=%s&grant_type=authorization_code",

    // 微信获取 access_token
    'ACCESS_TOKEN_URL' => "https://api.weixin.qq.com/cgi-bin/token?" .
        "grant_type=client_credential&appid=%s&secret=%s",


];
