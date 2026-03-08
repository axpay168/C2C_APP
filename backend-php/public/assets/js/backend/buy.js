define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'buy/index' + location.search,
                    add_url: 'buy/add',
                    edit_url: 'buy/edit',
                    del_url: 'buy/del',
                    multi_url: 'buy/multi',
                    import_url: 'buy/import',
                    table: 'buy',
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
                        {field: 'uid', title: __('会员ID'), operate: 'LIKE'},
                        {field: 'nowcoin', title: __('现币'), operate: 'LIKE'},
                        {field: 'buynum', title: __('数量'), operate: 'LIKE'},
                        {field: 'daojishi', title: __('倒计时'), operate: 'LIKE'},
                        {field: 'xtype', title: __('银行账号'), operate: 'LIKE'},
                        {field: 'zuid', title: __('Zuid'), operate: 'LIKE'},
                        {field: 'mine', title: __('最小额度'), operate: 'LIKE'},
                        {field: 'maxe', title: __('最大额度'), operate: 'LIKE'},
                        {field: 'addtime', title: __('添加时间'), operate: 'LIKE'},
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
