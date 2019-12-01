layui.use('table', function(){
    var table = layui.table
        ,form = layui.form;

    table.render({
        elem: '#test'
        ,url:'/api/admin/artall'
        ,method:'post'
        ,headers:{token:window.base.getLocalStorage('token')}
        ,cols: [[
            {type:'numbers'}
            ,{type: 'checkbox'}
            ,{field:'id', title:'ID', width:100, unresize: true, sort: true}
            ,{field:'username', title:'用户名', templet: '#usernameTpl'}
            ,{field:'city', title:'城市'}
            ,{field:'wealth', title: '财富', minWidth:120, sort: true}
            ,{field:'sex', title:'性别', width:85, templet: '#switchTpl', unresize: true}
            ,{field:'lock', title:'是否锁定', width:110, templet: '#checkboxTpl', unresize: true}
        ]]
        ,page: true
    });

    //监听性别操作
    form.on('switch(sexDemo)', function(obj){
        layer.tips(this.value + ' ' + this.name + '：'+ obj.elem.checked, obj.othis);
    });

    //监听锁定操作
    form.on('checkbox(lockDemo)', function(obj){
        layer.tips(this.value + ' ' + this.name + '：'+ obj.elem.checked, obj.othis);
    });
});