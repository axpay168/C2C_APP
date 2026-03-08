define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'real/index' + location.search,
                    add_url: 'real/add',
                    edit_url: 'real/edit',
                    del_url: 'real/del',
                    multi_url: 'real/multi',
                    import_url: 'real/import',
                    table: 'real',
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
                        // {field: 'name', title: __('Name'), operate: 'LIKE'},
                        {field: 'idno', title: '凭证', operate: false, events: Table.api.events.image, formatter: Table.api.formatter.image},
                        {field: 'front', title: __('正面'), operate: false, events: Table.api.events.image, formatter: Table.api.formatter.image},
                        {field: 'reverse_side', title: __('反面'), operate: false, events: Table.api.events.image, formatter: Table.api.formatter.image},
                        // {field: 'reverse_side', title: __('Reverse_side'), operate: 'LIKE'},
                        {field: 'status', title: __('状态'), searchList: {"0":'未审核',"1":'已审核',"2":'已拒绝'}, formatter: Table.api.formatter.status},
                        {field: 'addtime', title: __('添加时间'), operate:'RANGE', addclass:'datetimerange', autocomplete:false, formatter: Table.api.formatter.datetime},
                        {field: 'operates', title: __('操作'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate,buttons:[
                                {
                                    confirm: '确定通过审核吗？',
                                    name:'adopt',
                                    text:'通过',
                                    title:'通过',
                                    classname: 'btn btn-xs btn-info btn-view btn-ajax',
                                    icon: 'fa fa-check',
                                    url: 'Real/adopt?id={id}',
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
                                    url: 'Real/cancel?id={id}',
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
