define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'rorder/index' + location.search,
                    add_url: 'rorder/add',
                    edit_url: 'rorder/edit',
                    del_url: 'rorder/del',
                    multi_url: 'rorder/multi',
                    import_url: 'rorder/import',
                    table: 'rorder',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'id',
                sortName: 'id',
                fixedColumns: true,
                fixedRightNumber: 1,
                columns: [
                    [
                        {checkbox: true},
                        {field: 'id', title: __('Id')},
                        {field: 'username', title: __('Username'), operate: 'LIKE'},
                        {field: 'danjia', title: __('Danjia'), operate: 'LIKE'},
                        {field: 'shuliang', title: __('Shuliang'), operate: 'LIKE'},
                        {field: 'shengyu', title: __('Shengyu'), operate: 'LIKE'},
                        {field: 'mine', title: __('Mine'), operate: 'LIKE'},
                        {field: 'maxe', title: __('Maxe'), operate: 'LIKE'},
                        {field: 'xianren', title: __('Xianren'), operate: 'LIKE'},
                        {field: 'changes', title: __('Changes'), operate: 'LIKE'},
                        {field: 'xtype', title: __('Xtype'), operate: 'LIKE'},
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
