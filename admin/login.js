layui.define(['element','form'],function(exports){
    var $ = layui.$;
    var form = layui.form;

    $('.input-field').on('change',function(){
        var $this = $(this),
            value = $.trim($this.val()),
            $parent = $this.parent();
        if(value !== '' && !$parent.hasClass('field-focus')){
            $parent.addClass('field-focus');
        }else{
            $parent.removeClass('field-focus');
        }
    });

    //监听提交
    form.on('submit(login)', function(data){

        var params={
            url:'token/app',
            type:'post',
            data:data.field,
            sCallback:function(res){
                if(res){
                    window.base.setLocalStorage('token',res.token);
                    window.location.href = 'index.html';
                }
            },
            eCallback:function(e){
                if(e.status==401){
                    $('.error-tips').text('帐号或密码错误').show().delay(2000).hide(0);
                }
            }
        };

        window.base.getData(params);
        return false;
    });


    exports('login');
});