define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'proorder/index' + location.search,
                    add_url: 'proorder/add',
                    edit_url: 'proorder/edit',
                    del_url: 'proorder/del',
                    multi_url: 'proorder/multi',
                    import_url: 'proorder/import',
                    table: 'proorder',
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
                        {field: 'pro_id', title: __('Pro_id')},
                        {field: 'user_id', title: __('User_id')},
                        {field: 'money', title: __('Money'), operate:'BETWEEN'},
                        {field: 'day_num', title: __('Day_num')},
                        {field: 'buy_time', title: __('Buy_time'), operate: 'LIKE'},
                        {field: 'endone_time', title: __('Endone_time'), operate: 'LIKE'},
                        {field: 'added_value_all', title: __('Added_value_all'), operate:'BETWEEN'},
                        {field: 'added_value', title: __('Added_value'), operate:'BETWEEN'},
                        {field: 'addtime', title: __('Addtime'), operate: 'LIKE'},
                        {field: 'delay_day', title: __('Delay_day'), operate: 'LIKE'},
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
