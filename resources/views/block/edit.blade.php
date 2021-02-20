@extends('layouts.app')
@section('menu')
    @parent
@endsection
W


@section('content')
    @if(session('errors'))
        @foreach(session('errors')->all() as $error)
            <div class="alert alert-danger">
                {{--                      {{session('errors')}}<br>--}}
                {{$error}}<br>
            </div>
        @endforeach
    @endif


    {!! Form::model($block, ['route'=>['block.update', $block->id],'method'=>'PUT','files'=>true]) !!}


    <div class="form-group">
        {!! Form::label('topicid', 'Select topic') !!}
        {!! Form::select('topicid',$topics,$block->topicid,['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('title','Edit title') !!}
        {!! Form::text('title',$block->title,['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('block_content','Edit content') !!}
        {!! Form::textarea('block_content',$block->content,['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('imagepath','Edit image') !!}
        {!! Form::file('imagepath',['class'=>'form-control']) !!}
        <img src="{{asset($block->imagepath)}}" alt="image" class="w-25">

    </div>

    {!! Form::submit('Edit and save block',['class'=>'btn btn-primary']) !!}
    {!! Form::close() !!}

@endsection