define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'recharge/index' + location.search,
                    add_url: 'recharge/add',
                    edit_url: '',
                    del_url: '',
                    multi_url: 'recharge/multi',
                    import_url: 'recharge/import',
                    table: 'recharge',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'id',
                sortName: 'id',
                columns: [
                    [
                        {checkbox: true},
                        // {field: 'id', title: __('Id')},
                        {field: 'user.username', title: '当前登录账号', operate: 'LIKE'},
                         {field: 'topname', title: '上级登录账号', operate: 'LIKE'},
                        // {field: 'user_id', title: '用户id'},
                        // {field: 'user.pid', title: '上级id', operate: 'LIKE'},
                       
                        // {field: 'user.username', title: '用户名', operate: 'LIKE'},
                      
                        // {field: 'user.mobile', title: '手机号', operate: 'LIKE'},
                        {field: 'image', title: __('凭证'), operate: false, events: Table.api.events.image, formatter: Table.api.formatter.image},
                        {field: 'money', title: __('金额'), operate:'BETWEEN'},
                        {field: 'stat', title: __('状态'), searchList: {"0":__('待审核'),"1":__('已同意'),"2":__('已拒绝')}, formatter: Table.api.formatter.normal},
                         {field: 'user.trfals', title: __('是否真人'), searchList: {"1":__('真人'),"2":__('假人')}, formatter: Table.api.formatter.normal,operate: 'LIKE'},
                        
                        
                        // {field: 'money', title: __('Money'), operate:'BETWEEN'},
                        {field: 'addtime', title: __('充值时间'),  operate:'RANGE', addclass:'datetimerange', autocomplete:false, formatter: Table.api.formatter.datetime},
                        {field: 'wallte.address', title: '钱包地址'},
                        // {field: 'uptime', title: __('Uptime'), operate: 'LIKE'},
                        // {field: 'pid', title: __('Pid')},
                        {field: 'remark', title: __('备注'), operate: 'LIKE'},
                        {field: 'operate', title: __('操作'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate, buttons:[
                                 {
                                    confirm: '确定通过审核吗？',
                                    name:'adopt',
                                    text:'通过',
                                    title:'通过',
                                    classname: 'btn btn-xs btn-info btn-view btn-ajax',
                                    icon: 'fa fa-check',
                                    url: 'Recharge/adopt?id={id}',
                                    visible:function(row){
                                        if(row['stat']==0){
                                            return true;
                                        }else{
                                            return false;
                                        }
                                    },
                                    refresh:true
                                },
                                 {
                                    name: 'click',
                                    title: __('拒绝审核'),
                                    text: '拒绝审核',
                                    classname: 'btn btn-xs btn-info btn-click',
                                    // icon: 'fa fa-leaf',
                                    // dropdown: '更多',//如果包含dropdown，将会以下拉列表的形式展示
                                    
                                      click: function (e, row) {
                                        Layer.prompt({
                                            title: "拒绝原因",
                                            success: function (layero) {
                                                $("input", layero).prop("placeholder", "填写拒绝原因");
                                            }
                                        }, function (value) {
                                            
                                         Fast.api.ajax({
                                                url: "Recharge/cancel",
                                                   data: {remark: value,uid: row.id},
                                            }, function (data, ret) {
                                                Layer.closeAll();
                                                $(".btn-refresh").trigger("click");
                                                //return false;
                                            });
                                            
                                        });
                                        return false;
                                    },
                                    
                                  visible:function(row){
                                        if(row['stat']==0){
                                            return true;
                                        }else{
                                            return false;
                                        }
                                    },
                                    refresh:true
                                },
                                
                                
                                ]}
                    ]
                ]
            });

            // 为表格绑定事件
            Table.api.bindevent(table);
        },
        add: function () {
            Controller.api.bindevent();
        },
        edit: function () {
            Controller.api.bindevent();
        },
        api: {
            bindevent: function () {
                Form.api.bindevent($("form[role=form]"));
            }
        }
    };
    return Controller;
});
