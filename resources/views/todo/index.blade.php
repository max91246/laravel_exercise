@foreach ($todos as $todo)
    <p>
        {{ $todo->id . ' ' .$todo->title }} 
        <form action="todo/{{$todo->id}}" method="post">
            {{ method_field('DELETE') }}
            {{ csrf_field() }}
            <button tpye="submit">刪除</button>
        </form>
    </p> 
@endforeach


<form action="/todo" method="post">
    {{ csrf_field() }}
    <input type="text" name="title">
    <button tpye="submit">提交</button>
</form>