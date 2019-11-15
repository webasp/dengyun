(function () {

    var entry,
        app = {
            home : '{/}home',
            login : '{/}login'
        };

    (function(){

        var dataMain, scripts = document.getElementsByTagName('script'),
            eachScripts = function(el){
                dataMain = el.getAttribute('data-main');
                if(dataMain){
                    entry = dataMain;
                }
            };

        [].slice.call(scripts).forEach(eachScripts);

    })();

    layui.config({
        base: 'js/'
    }).extend(app).use(entry || 'home');




})();

layui.define(['element'],function(exports){
    var $ = layui.$;
    window.base={
        g_restUrl:'REST API Base URL',

        getData:function(params){

            if(!params.type){
                params.type='get';
            }
            var that=this;
            $.ajax({
                type:params.type,
                url:this.g_restUrl+params.url,
                data:params.data,
                beforeSend: function (XMLHttpRequest) {
                    if (params.tokenFlag) {
                        XMLHttpRequest.setRequestHeader('token', that.getLocalStorage('token'));
                    }
                },
                success:function(res){
                    params.sCallback && params.sCallback(res);
                },
                error:function(res){

                    params.eCallback && params.eCallback(res);
                }
            });
        },

        setLocalStorage:function(key,val){
            var exp=new Date().getTime()+2*24*60*60*100;  //令牌过期时间
            var obj={
                val:val,
                exp:exp
            };
            localStorage.setItem(key,JSON.stringify(obj));
        },

        getLocalStorage:function(key){
            var info= localStorage.getItem(key);
            if(info) {
                info = JSON.parse(info);
                if (info.exp > new Date().getTime()) {
                    return info.val;
                }
                else{
                    this.deleteLocalStorage('token');
                }
            }
            return '';
        },

        deleteLocalStorage:function(key){
            return localStorage.removeItem(key);
        },

    }
});



