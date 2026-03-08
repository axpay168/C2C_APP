define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'product/index' + location.search,
                    add_url: 'product/add',
                    edit_url: 'product/edit',
                    del_url: 'product/del',
                    multi_url: 'product/multi',
                    import_url: 'product/import',
                    table: 'product',
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
                        {field: 'is_hot', title: __('是否最热'), searchList: {"1": __('Yes'), "0": __('No')}, formatter: Table.api.formatter.toggle},
                        {field: 'title', title: __('Title'), operate: 'LIKE'},
                        {field: 'Introduction', title: __('Introduction'), operate: 'LIKE'},
                        {field: 'scale', title: __('Scale'), operate:'BETWEEN'},
                        {field: 'product_day', title: __('Product_day')},
                        {field: 'product_endtime', title: __('Product_endtime'),formatter: Table.api.formatter.datetime, operate: 'RANGE', addclass: 'datetimerange', sortable: true},
                        {field: 'remaining', title: __('Remaining'), operate:'BETWEEN'},
                        {field: 'image', title: __('Image'), operate: false, events: Table.api.events.image, formatter: Table.api.formatter.image},
                        {field: 'day_income', title: __('Day_income'), operate:'BETWEEN'},
                        // {field: 'tags', title: __('Tags'), operate: 'LIKE', formatter: Table.api.formatter.flag},
                        {field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate}
                    ]
                ]
            });

            // 为表格绑定事件
            Table.api.bindevent(table);
        },
        add: function () {
            // Form.api.bindevent($("#demo-form"));
            
                $('input[type="checkbox"]').change(function(){
                    if(this.checked){
                        $('#text'+this.value).show();
                    }else{
                        $('#text'+this.value).hide();
                    }
              });
            Controller.api.bindevent();
        },
        edit: function () {
                $('input[type="checkbox"]').change(function(){
                    if(this.checked){
                        $('#text'+this.value).show();
                    }else{
                        $('#text'+this.value).hide();
                    }
              });
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
