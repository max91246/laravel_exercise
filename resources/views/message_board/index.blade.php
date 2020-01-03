
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="/messageboard" class="post_form" method="post">
    {{ csrf_field() }}
    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
    <textarea cols="50" rows="5" name="content"></textarea>
    <button tpye="submit">發送留言</button>
</form>

<!--
@foreach ($MessageBoards as $val)
    <p>
         {{ $val->id . ' ' .$val->content }} 
         @foreach ($val->data_array as $data)
            <br>&nbsp;&nbsp;&nbsp;&nbsp;{{ $data->id . ' ' .$data->content }} 
         @endforeach
         <form action="/messageboard/{{$val->id}}" method="post">
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            {{ method_field('PATCH') }}
            {{ csrf_field() }}
            <textarea cols="50" rows="5" name="content" ></textarea>
            <button tpye="submit"  class="return">回覆留言</button>
        </form>
    </p> 
@endforeach
-->
<style>
body{
    font-size: 14px;
}
form a{
    cursor: pointer;
    border: 1px solid #666;
    width: 90px;
    display: inline-block;
    text-align: center;
    border-radius: 10px;
    vertical-align: top;
}
form button{
    cursor: pointer;
    border: 1px solid #666;
    width: 90px;
    display: inline-block;
    text-align: center;
    border-radius: 10px;
    vertical-align: top;
    background: #FFF;   
}
.error{
    color: red;
}
</style>
<div class="loading" stlye="display:block;">loading....</div>
<div class="error" stlye="display:none;"></div>
<div>留言順序 :</div>
<div class="MessageBoards"></div>

<script src="{{URL::asset('/')}}js/jquery-1.10.1.min.js" ></script>
<script type="text/javascript">
   
   $(function() {
    load_message();

    function load_message(){
        $.ajax({
            type: 'GET',
            url: "/api/MessageBoardApi",
            success: function (data) {
                var MessageBoards = '';
                $.each(data , function(key , value) {
                    MessageBoards += '<p>' + value.id + ' ' + value.content;
                    if ($.isArray(value.data_array)){
                        $.each(value.data_array , function(k , v){
                            MessageBoards += '<br>&nbsp;&nbsp;&nbsp;&nbsp;' + v.id + ' ' + v.content; 
                        })
                    }

                    MessageBoards += '<form action="/messageboard/'+value.id+'" id="messageboard_'+value.id+'">';
                    MessageBoards += '<input type="hidden" name="user_id" value="{{ Auth::user()->id }}">';
                    MessageBoards += '<input type="hidden" name="_method" value="PUT">';
                    MessageBoards +=  '<textarea cols="50" rows="5" name="content" ></textarea>';
                    MessageBoards +=  '<a tpye="button"  class="return" attr-value="'+value.id+'">回覆留言</a>';
                    MessageBoards += '</form>';

                    MessageBoards += '</p>';
                });
                $(".MessageBoards").html('');
                $(".MessageBoards").html(MessageBoards);
                $(".loading").hide();


                $( ".post_form" ).on( "submit", function( event ) {
                    var user_id = $(".post_form input[name='user_id']").val();
                    var content = $(".post_form textarea[name='content']").val();
                    var _token = $(".post_form input[name='_token']").val();
                    
                    $.ajax({
                        type: 'POST',
                        url: "/api/MessageBoardApi",
                        data:{'user_id' : user_id , 'content' : content , '_token':_token},
                        success: function (data) {
                            $(".error").hide();
                            $(".post_form textarea[name='content']").val('');
                            load_message();
                        },
                        error: function (data) {
                            var error = '';
                            var errors = $.parseJSON(data.responseText);
                            $.each(errors.errors , function(key , value) {
                                error += value + ' ';
                            });
                            $(".error").html(error).show();
                        }
                    });
                    return false;
                });

                $(".return").click(function(){
                    let return_id = $(this).attr('attr-value');
                    var user_id = $("#messageboard_" + return_id + " input[name='user_id']").val();
                    var content = $("#messageboard_" + return_id + " textarea[name='content']").val();
                    var _method = $("#messageboard_" + return_id + " input[name='_method']").val();
                    var _token = $("#messageboard_" + return_id + " input[name='_token']").val();
                    
                    $.ajax({
                        type: 'POST',
                        url: "/api/MessageBoardApi/"+ return_id,
                        data:{'user_id' : user_id , 'content' : content , '_token':_token , '_method':_method},
                        success: function (data) {
                                $(".error").hide();
                                $("#messageboard_" + return_id + " textarea[name='content']").val('');
                                load_message();
                        },
                        error: function (data) {
                            var error = '';
                            var errors = $.parseJSON(data.responseText);
                            $.each(errors.errors , function(key , value) {
                                error += value + ' ';
                            });
                            $(".error").html(error).show();
                        }
                    });
                    return false;
                });
            }
        });
    }


    });
</script>