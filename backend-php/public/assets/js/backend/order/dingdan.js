define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'order/dingdan/index' + location.search,
                    add_url: 'order/dingdan/add',
                    edit_url: 'order/dingdan/edit',
                    del_url: 'order/dingdan/del',
                    multi_url: 'order/dingdan/multi',
                    import_url: 'order/dingdan/import',
                    table: 'order',
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
                        {field: 'username', title: __('用户'), operate: 'LIKE'},
                        {field: 'danjia', title: '单价', operate: 'LIKE'},
                        {field: 'shuliang', title: '数量', operate: 'LIKE'},
                        {field: 'shengyu', title: '剩余数量', operate: 'LIKE'},
                        {field: 'mine', title: '最小交易额', operate: 'LIKE'},
                        {field: 'maxe', title: '最大交易额', operate: 'LIKE'},
                        {field: 'xianren', title: '人数限制', operate: 'LIKE'},
                        {field: 'changes', title: '变化幅度%', operate: 'LIKE'},
                        {field: 'xtype', title: '类型', operate: 'LIKE'},
                        {field: 'operate', title: __('操作'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate}
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
