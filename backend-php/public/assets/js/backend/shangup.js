define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'shangup/index' + location.search,
                    add_url: 'shangup/add',
                    edit_url: 'shangup/edit',
                    del_url: 'shangup/del',
                    multi_url: 'shangup/multi',
                    import_url: 'shangup/import',
                    table: 'shangup',
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
                        {field: 'uid', title: __('Uid'), operate: 'LIKE'},
                        {field: 'images', title: __('Images'), operate: false, events: Table.api.events.image, formatter: Table.api.formatter.images},
                        {field: 'status', title: '状态', searchList: {"0":__('待审核'),"1":__('已同意'),"2":__('已拒绝')}, formatter: Table.api.formatter.normal},
                        {field: 'addtime', title: __('Addtime'),formatter: Table.api.formatter.datetime, operate: 'RANGE', addclass: 'datetimerange', sortable: true},
                        {field: 'operates', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate,buttons:[
                                {
                                    confirm: '确定通过审核吗？',
                                    name:'adopt',
                                    text:'通过',
                                    title:'通过',
                                    classname: 'btn btn-xs btn-info btn-view btn-ajax',
                                    icon: 'fa fa-check',
                                    url: 'Shangup/adopt?id={id}',
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
                                    url: 'Shangup/cancel?id={id}',
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
