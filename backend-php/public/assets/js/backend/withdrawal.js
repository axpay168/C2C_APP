define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'withdrawal/index' + location.search,
                    add_url: 'withdrawal/add',
                    edit_url: '',
                    del_url: '',
                    multi_url: 'withdrawal/multi',
                    import_url: 'withdrawal/import',
                    table: 'withdrawal',
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
                        {field: 'userinfo.username', title: '用户名'},
                        {field: 'userinfo.pid', title: '上级id'},
                        {field: 'money', title: __('金额'), operate:'BETWEEN'},
                        // {field: 'bank_id', title: __('Bank_id')},
                        {field: 'stat', title: __('状态'), searchList: {"0":__('待审核'),"1":__('已同意'),"2":__('已拒绝')}, formatter: Table.api.formatter.normal},
                        // {field: 'is_refuse', title: __('Is_refuse')},
                        // {field: 'pid', title: __('Pid')},
                        {field: 'type', title: __('备注'), searchList: {"1":'银行卡提现',"2":'USDT提现'}, formatter: Table.api.formatter.normal},
                        // {field: 'uptime', title: __('Uptime'), operate: 'LIKE'},
                        {field: 'bank.bank_name', title: '银行名称', operate: 'LIKE'},
                        {field: 'bank.card_no', title: 'IBNA账户', operate: 'LIKE'},
                        {field: 'bank.name', title: '全名', operate: 'LIKE'},
                         {field: 'usdtaddress', title: 'U地址', operate: 'LIKE'},
                        // {field: 'bank.guojia', title: '国家', operate: 'LIKE'},
                        // {field: 'bank.zhou', title: '州/区', operate: 'LIKE'},
                        // {field: 'bank.citys', title: '城市', operate: 'LIKE'},
                        // {field: 'bank.xingshi', title: '姓氏', operate: 'LIKE'},
                        // {field: 'bank.mingzi', title: '名字', operate: 'LIKE'},
                        {field: 'bank.mobile', title: '手机号', operate: 'LIKE'},
                        // {field: 'bank.dizhis', title: '地址', operate: 'LIKE'},
                        // {field: 'bank.youbian', title: '邮编', operate: 'LIKE'},
                         {field: 'addtime', title: __('添加时间'), operate:'RANGE', addclass:'datetimerange', autocomplete:false, formatter: Table.api.formatter.datetime},
                          {field: 'operate', title: __('操作'), table: table, events: Table.api.events.operate,
                            buttons:[
                                {
                                    confirm: '确定通过审核吗？',
                                    name:'adopt',
                                    text:'通过',
                                    title:'通过',
                                    classname: 'btn btn-xs btn-info btn-view btn-ajax',
                                    icon: 'fa fa-check',
                                     url: 'Withdrawal/adopt?id={id}',
                                    visible:function(row){
                                        if(row['stat']==0){
                                            return true;
                                        }else{
                                            return false;
                                        }
                                    },
                                    refresh:true
                                },
                                
                                 {
                                    name: 'click',
                                    title: __('拒绝审核'),
                                    text: '拒绝审核',
                                    classname: 'btn btn-xs btn-info btn-click',
                                    // icon: 'fa fa-leaf',
                                    // dropdown: '更多',//如果包含dropdown，将会以下拉列表的形式展示
                                    click: function (e, row) {
                                        Layer.prompt({
                                            title: "拒绝原因",
                                            success: function (layero) {
                                                $("input", layero).prop("placeholder", "填写拒绝原因");
                                            }
                                        }, function (value) {
                                            
                                            
                                            // alert(value);return;
                                            Fast.api.ajax({
                                                 url: "Withdrawal/cancel",
                                                data: {remark: value,uid: row.id},
                                            }, function (data, ret) {
                                                Layer.closeAll();
                                                $(".btn-refresh").trigger("click");
                                                //return false;
                                            });
                                            
                                        });
                                        return false;
                                    },visible:function(row){
                                        if(row['stat']==0){
                                            return true;
                                        }else{
                                            return false;
                                        }
                                    },
                                    refresh:true
                                }, 
                            ],formatter: Table.api.formatter.operate
                        }
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
