
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="/messageboard" method="post">
    {{ csrf_field() }}
    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
    <textarea cols="50" rows="5" name="content"></textarea>
    <button tpye="submit">發送留言</button>
</form>
<div>留言順序 :</div>
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


<script src="{{asset('/js/jquery-2.2.4.min.js')}}" ></script>
<script type="text/javascript">
   
   $(function() {
        $(".return").click(function(){

        });
    });
</script>