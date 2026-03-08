define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'dtrecord/index' + location.search,
                    add_url: 'dtrecord/add',
                    edit_url: 'dtrecord/edit',
                    del_url: 'dtrecord/del',
                    multi_url: 'dtrecord/multi',
                    import_url: 'dtrecord/import',
                    table: 'dtrecod',
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
                        {field: 'orderid', title: "订单id"},
                        {field: 'uid', title: "用户id"},
                        {field: 'user.username', title: __('User.username'), operate: 'LIKE'},
                        {field: 'danjia', title: "单价", operate: 'LIKE'},
                        {field: 'money', title: "数量", operate: 'LIKE'},
                        {field: 'status', title: __('Status'), searchList: {"0":__('待审核'),"1":__('已同意'),"2":__('已拒绝')}, formatter: Table.api.formatter.status},
                        {field: 'user.trfals', title: '是否假人',searchList: {1: '真人', 2: '假人'}, formatter: Table.api.formatter.status},
                        {field: 'addtime', title: "日期",  operate:'RANGE', addclass:'datetimerange', autocomplete:false, formatter: Table.api.formatter.datetime},
                        {field: 'operates', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate,buttons:[
                                {
                                    confirm: '确定通过审核吗？',
                                    name:'adopt',
                                    text:'通过',
                                    title:'通过',
                                    classname: 'btn btn-xs btn-info btn-view btn-ajax',
                                    icon: 'fa fa-check',
                                    url: 'Dtrecord/adopt?id={id}',
                                    visible:function(row){
                                        if(row['status']==0){
                                            return true;
                                        }else{
                                            return false;
                                        }
                                    },
                                    refresh:true
                                },
                                {
                                    confirm: '确定拒绝审核吗？',
                                    name:'cancel',
                                    text:'拒绝',
                                    title:'拒绝',
                                    classname: 'btn btn-xs btn-success btn-view btn-ajax',
                                    // icon: 'fa fa-check',
                                    url: 'Dtrecord/cancel?id={id}',
                                    visible:function(row){
                                        if(row['status']==0){
                                            return true;
                                        }else{
                                            return false;
                                        }
                                    },
                                    refresh:true
                                }
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
