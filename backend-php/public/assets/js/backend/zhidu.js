define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'zhidu/index' + location.search,
                    add_url: 'zhidu/add',
                    edit_url: 'zhidu/edit',
                    del_url: 'zhidu/del',
                    multi_url: 'zhidu/multi',
                    import_url: 'zhidu/import',
                    table: 'zhidu',
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
                        {field: 'level', title: __('级别'), operate: 'LIKE'},
                        {field: 'cishu', title: __('次数'), operate: 'LIKE'},
                        {field: 'minx', title: __('Minx'), operate: 'LIKE'},
                        {field: 'maxs', title: __('Maxs'), operate: 'LIKE'},
                        {field: 'zubie', title: '生效用户组', operate: 'LIKE'},
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
