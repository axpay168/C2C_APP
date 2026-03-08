define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'chongci/index' + location.search,
                    add_url: 'chongci/add',
                    edit_url: 'chongci/edit',
                    del_url: 'chongci/del',
                    multi_url: 'chongci/multi',
                    import_url: 'chongci/import',
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
                        {field: 'id', title: __('Id')},
                        {field: 'user_id', title: __('User_id')},
                        {field: 'user.username', title: __('User.username'), operate: 'LIKE'},
                        {field: 'user.nickname', title: __('User.nickname'), operate: 'LIKE'},
                        {field: 'user.avatar', title: __('User.avatar'), operate: 'LIKE', events: Table.api.events.image, formatter: Table.api.formatter.image},
                        {field: 'image', title: __('Image'), operate: false, events: Table.api.events.image, formatter: Table.api.formatter.image},
                        {field: 'stat', title: __('Stat')},
                        {field: 'money', title: __('Money'), operate:'BETWEEN'},
                        {field: 'addtime', title: __('Addtime'),formatter: Table.api.formatter.datetime, operate: 'RANGE', addclass: 'datetimerange', sortable: true},
                        {field: 'uptime', title: '处理时间',formatter: Table.api.formatter.datetime, operate: 'RANGE', addclass: 'datetimerange', sortable: true},
                        // {field: 'pid', title: __('Pid')},
                        {field: 'remark', title: __('Remark'), operate: 'LIKE'},
                        {field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate, buttons:[
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
                        // {field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate}
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
