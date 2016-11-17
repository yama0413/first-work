<!DOCTYPE html>
<html lang="en">
    <title>TODOリスト</title>
    <head>
        <link rel="stylesheet" href="/bower_components/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="/js/tasks.css">
        <link rel="stylesheet" href="/js/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css">
        <script src="/bower_components/jquery/dist/jquery.min.js"></script>
        <script src="/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="/js/jquery-tmpl/jquery.tmpl.min.js"></script>
        <script src="/js/moment/moment.js"></script>
        <script src="/js/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>

        <script id="template_todoitem" type="text/x-query-tmpl">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <div class="checkbox"><label><input name="state" type="checkbox" class="check_icon check_${id}" @{{if state==1}}checked="checked"@{{else}}false@{{/if}}>達成</label></div>
                    <button id="btnupd_${id}" name="update" type="button" class="btn btnupd btn-default navbar-btn">更新</button>
                    <button id="btndel_${id}" name="delete" type="button" class="btn btndel btn-default navbar-btn">削除</button>
                    ${title}
                    ${scheduling_date}
                    <button id="btn_detail_${id}" name="detail" type="button" class="btn btndetail btn-default navbar-btn">詳細</button>
                </div>
                <div class="panel-body">
                    <div class="msgform">
                        <textarea name="message" id="textarea_${id}" class="textarea form-control" rows="4">${message}</textarea>
                    </div>
                </div>
            </div>
            <input id="token2" type="hidden" name="_token" value="{{ csrf_token() }}">
        </script>

        <script type="text/javascript">
        <!--
        $(document).ready(function(){
            reload_todolist();

            var taskName = $("#modal_taskname").val()
            var message = $("#modal_message").val()
            var scheduling_date = $("#modal_scheduling_date").val()

            // 新規ボタン押下時にモーダルフォームの内容をクリア
            $("#newbutton").on("click", function(){
                $("#modal_taskname").val("");
                $("#modal_message").val("");
                $("#modal_scheduling_date").val("");
            });

            function update_show_achieve(item){
                if($(item).hasClass("active")){
                    console.log("active");
                    // 完了済み項目を表示 = OFF
                    for(var i=0; i<$(".check_icon").length; i++){
                        if($(".check_icon:eq(" + i + ")").prop('checked'))
                        {
                            $(".check_icon:eq(" + i + ")").parent().parent().parent().parent().addClass("hidden");
                        }
                    }
                    $(item).html("完了済み項目を表示");
                }else{
                    console.log("no-active");
                    // 完了済み項目を表示 = ON
                    $(".check_icon").parent().parent().parent().parent().removeClass("hidden");
                    $(item).html("完了済み項目を非表示");
                }
            }

            $("#btn_show_achieve").on("click", function(){
                update_show_achieve(this);
            });

            $("body").on("click", ".check_icon", function(){
                if($("#btn_show_achieve").hasClass("active")){
                    $("#btn_show_achieve").removeClass("active");
                }
                else
                {
                    $("#btn_show_achieve").addClass("active");
                }
                update_show_achieve("#btn_show_achieve");
                if($("#btn_show_achieve").hasClass("active")){
                    $("#btn_show_achieve").removeClass("active");
                }
                else
                {
                    $("#btn_show_achieve").addClass("active");
                }
            });

            $("body").on("click", "#modal_newbutton", function(event){
                event.preventDefault();
                loading_on()

                 $.ajaxSetup({
                     headers: {
                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     }
                 });
                 $.ajax({
                     url: "/new",
                     type: "POST",
                     data: {
                         "taskname":$("#modal_taskname").val(),
                         "message" :$("#modal_message").val(),
                         "scheduling_date" : $("#modal_scheduling_date").val()
                     },
                     success:function(data){
                        // NOTE: POST -> GET
                        reload_todolist()
                        $("#myModal").modal("hide")
                     },
                     error:function(XMLHttpRequest, textStatus, errorThrown){
                        alert("Error:" + textStatus);
                        loading_off()
                     },
                     complete:function(){
                     },
                 });
            });


            $("body").on("click", ".btnupd", function(e){
                var id = $(this).attr("id").slice(7)
                $(this).prop("disabled",true);
                loading_on()

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "/updtask/" + id,
                    type: "POST",
                    data: {
                        "message": $("#textarea_" + id).val(),
                        "state": $(".check_" + id).prop('checked')
                    },
                    beforeSend:function(XMLHttpRequest){
                        $(this).prop("disabled",true);
                    },
                    success:function(data){
                        // NOTE: POST -> GET
                        reload_todolist()
                    },
                    error:function(XMLHttpRequest, textStatus, errorThrown){
                        alert("Error:" + textStatus);
                        loading_off()
                    },
                    complete:function(){
                        $(this).prop("disabled",false);
                    },
                });
            });

            $("body").on("click", ".btndetail", function(){
                var detail_info = $(this).parent().siblings(".panel-body");

                if((detail_info).is(":hidden")){
                    detail_info.slideDown();
                }else{
                    detail_info.slideUp();
                }
            });



            $("body").on("click", ".btndel", function(e){
                var id = $(this).attr("id").slice(7)
                $(this).prop("disabled",true);
                loading_on()

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "/remove/" + id,
                    type: "POST",
                    data: {},

                    beforeSend:function(XMLHttpRequest){
                        $(this).prop("disabled",true);
                    },
                    success:function(data){
                        reload_todolist()
                    },
                    error:function(XMLHttpRequest, textStatus, errorThrown){
                        alert("Error:" + textStatus);
                        loading_off()
                    },
                    complete:function(){
                    },
                });
            });

            $(function (){
                $('#modal_scheduling_date').datetimepicker();
            });

            // ウィンドウを閉じる際に処理を行う
            $(window).on("beforeunload", function(e){
                ;
            });
            function reload_todolist (){
                $.get("/tasklist", function(items){
                   // JSON形式のデータをtmplに渡す
                   var data = items;
                   $("#todoitems").empty();
                   $("#template_todoitem").tmpl(data).appendTo("#todoitems");
                   loading_off()
                });
            }
            function loading_on(){
                $("#todolist_body").fadeOut();
                $("#loading").fadeIn();
            }
            function loading_off(){
                $("#loading").fadeOut();
                $("#todolist_body").fadeIn();
            }

            $("#btn_show_achieve").trigger("click");
        });

        //-->
        </script>
        <title>TODOリスト</title>
    </head>

    <body>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <div id="todolist_body">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="container-header">
                    <button data-toggle="modal" data-target="#myModal" type="button" id="newbutton" class="btn btn-default navbar-btn">
                        新規
                    </button>
                    <button id="btn_show_achieve" class="btn btn-default" data-toggle="button">
                    </button>
                </div>
            </div>
        </nav>

        <div id="todo_container" class="container">
            <h4>TODOリスト一覧</h4>
            <div id="todoitems">
            </div> <!-- end todoitems-->
 
            <!-- モーダルウィンドウの中身 -->
            <div class="modal fade" id="myModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h2 class="modal-title">新規作成</h2>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>タスク名</label>
                                <input id="modal_taskname" type="text" name="title" class="form-control">
                            </div>
                            
                            <div class="form-group">
                                <label>締切日</label>
                                <input "display" id="modal_scheduling_date" type="text" class="form-control">
                                <p></p>
                                <label>本文</label>
                                <textarea id="modal_message" rows=8 cols=40  class="form-control"></textarea>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button id="modal_newbutton" type="button" class="btn btn-default  navbar-btn">新規作成</button>
                            <button type="button" class="btn btn-primary" data-dismiss="modal">閉じる</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- ローディング画面 -->
    <div id="loading"><img src="./gif-load.gif"></div>

    </body>
</html>

