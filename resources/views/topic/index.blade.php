@extends('layouts.app')
@section('menu')
    @parent
@endsection


@section('content')
    <div class="col-3">
        {!! Form::open(['action'=>'TopicController@search','class'=>'form']) !!}
            <div class="input-group">
                {!! Form::text('searchform','', ['class'=>'form-control','placeholder'=>'input topic','autocomplete'=>'off']) !!}
                <button type="submit" class="btn btn-success btn-sm">Search</button>
            </div>
        {!! Form::close() !!}
    {{--список топиков    --}}
        <ul class="list-unstyled">
            @foreach($topics as $topic)
                <li><a href="{{url('topic/'.$topic->id)}}" class="btn-link my-2">
                        {{$topic->topicname}}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="col-9 border border-warning">
    {{--блоки по выбранному топику --}}
    @if($id !== 0)
        <h1 class="text-center">{{$topicname}}</h1>
            <hr>
        @foreach($blocks as $block)
            <div class="p-2 border-info">
{{--                Заголовок блока--}}
            <h2 class="text-center">{{$block->title}}</h2>
{{--                Изображения--}}
            @if($block->imagepath)
                    <img src="{{asset($block->imagepath)}}" alt="block_image" class="img-fluid my-2">
{{--                @else--}}

                @endif

{{--                текст--}}
                    <p class="lead">{{$block->content}}</p>
                @if($is_admin !== 0)
                    <div class="d-flex">
{{--                Кнопка удаления--}}
                    {!! Form::open(['route'=>['block.destroy',$block->id]]) !!}
                         {!! Form::hidden('_method','DELETE') !!}
                         <button type="submit" class="btn btn-danger mt-2 w-50">Delete</button>
                    {!! Form::close() !!}
{{--                Кнопка редактирования--}}
                    <a href="{{url('block/'.$block->id.'/edit')}}" class="btn btn-success mt-2 w-50">Edit</a>
                    </div>
                    @endif
            </div>
            @endforeach
        @endif
    </div>
@endsection