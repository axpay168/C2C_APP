define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'gorder/index' + location.search,
                    add_url: 'gorder/add',
                    edit_url: 'gorder/edit',
                    del_url: 'gorder/del',
                    multi_url: 'gorder/multi',
                    import_url: 'gorder/import',
                    table: 'gorder',
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
                        {field: 'g_id', title: __('G_id')},
                        {field: 'delivery_name', title: __('Delivery_name'), operate: 'LIKE'},
                        {field: 'delivery_number', title: __('Delivery_number'), operate: 'LIKE'},
                        {field: 'money', title: __('Money'), operate: 'LIKE'},
                        {field: 'addtime', title: __('Addtime'), operate: 'LIKE'},
                        {field: 'status', title: __('Status'), searchList: {"10":__('Status 10')}, formatter: Table.api.formatter.status},
                        {field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate}
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
