define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'banks/index' + location.search,
                    add_url: 'banks/add',
                    edit_url: 'banks/edit',
                    del_url: 'banks/del',
                    multi_url: 'banks/multi',
                    import_url: 'banks/import',
                    table: 'bank',
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
                        {field: 'name', title: __('Name'), operate: 'LIKE'},
                        // {field: 'user_id', title: __('User_id')},
                        {field: 'user.username', title: __('User.username'), operate: 'LIKE'},
                        // {field: 'bank_name', title: __('Bank_name'), operate: 'LIKE'},
                        // {field: 'bank_deposit', title: __('Bank_deposit'), operate: 'LIKE'},
                        // {field: 'card_no', title: __('Card_no'), operate: 'LIKE'},
                        {field: 'bank_name', title: '银行名称', operate: 'LIKE'},
                        {field: 'card_no', title: 'IBNA账户', operate: 'LIKE'},
                        {field: 'name', title: '全名', operate: 'LIKE'},
                        {field: 'guojia', title: '国家', operate: 'LIKE'},
                        {field: 'zhou', title: '州/区', operate: 'LIKE'},
                        {field: 'citys', title: '城市', operate: 'LIKE'},
                        {field: 'xingshi', title: '姓氏', operate: 'LIKE'},
                        {field: 'mingzi', title: '名字', operate: 'LIKE'},
                        {field: 'mobile', title: '手机号', operate: 'LIKE'},
                        {field: 'dizhis', title: '地址', operate: 'LIKE'},
                        {field: 'youbian', title: '邮编', operate: 'LIKE'},
                        {field: 'addtime', title: __('Addtime'), operate: 'LIKE',operate:'RANGE', addclass:'datetimerange', autocomplete:false, formatter: Table.api.formatter.datetime},
                        {field: 'is_del', title: '状态',searchList: {"0":__('待审核'),"1":__('已同意'),"2":__('已拒绝')}, formatter: Table.api.formatter.normal},
                        {field: 'operates', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate,buttons:[
                                {
                                    confirm: '确定通过审核吗？',
                                    name:'adopt',
                                    text:'通过',
                                    title:'通过',
                                    classname: 'btn btn-xs btn-info btn-view btn-ajax',
                                    icon: 'fa fa-check',
                                    url: 'Banks/adopt?id={id}',
                                    visible:function(row){
                                        // if(row['is_del']==0){
                                            return true;
                                        // }else{
                                        //     return false;
                                        // }
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
                                    url: 'Banks/cancel?id={id}',
                                    visible:function(row){
                                        // if(row['is_del']==0){
                                            return true;
                                        // }else{
                                        //     return false;
                                        // }
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
