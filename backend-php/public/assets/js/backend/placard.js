define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'placard/index' + location.search,
                    add_url: 'placard/add',
                    edit_url: 'placard/edit',
                    del_url: 'placard/del',
                    multi_url: 'placard/multi',
                    import_url: 'placard/import',
                    table: 'placard',
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
                        {field: 'title', title: __('标题'), operate: 'LIKE'},
                        {field: 'titles', title: __('内容'), operate: 'LIKE'},
                        {field: 'image', title: __('图片'), operate: false, events: Table.api.events.image, formatter: Table.api.formatter.image},
                        {field: 'viev_num', title: __('查看次数')},
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
