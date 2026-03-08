define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'userdina/index' + location.search,
                    add_url: 'userdina/add',
                    edit_url: 'userdina/edit',
                    del_url: 'userdina/del',
                    multi_url: 'userdina/multi',
                    import_url: 'userdina/import',
                    table: 'userfina',
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
                        {field: 'user.username', title: __('User.username'), operate: 'LIKE'},
                        {field: 'fid', title: __('Fid'), operate: 'LIKE'},
                        {field: 'moneys', title: __('Moneys'), operate: 'LIKE'},
                        {field: 'days', title: __('Days'), operate: 'LIKE'},
                        {field: 'status', title: __('Status'), searchList: {"0":__('已结束'),"1":__('进行中')}, formatter: Table.api.formatter.normal},
                        {field: 'addtime', title: __('Addtime'), operate:'RANGE', addclass:'datetimerange', autocomplete:false, formatter: Table.api.formatter.datetime},
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
