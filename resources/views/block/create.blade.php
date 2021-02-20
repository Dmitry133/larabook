@extends('layouts.app')

@section('menu')
    @parent
@endsection

@section('content')
    <div class="col-12">
        @if(session('errors'))
            @foreach(session('errors')->all() as $error)
                <div class="alert alert-danger">
                    {{--                      {{session('errors')}}<br>--}}
                    {{$error}}<br>
                </div>
            @endforeach
        @endif

        @if(session('message'))
            <div class="alert alert-success">
                {{session('message')}}
            </div>
        @endif
        {!! Form::model($block, ['action'=>'BlockController@store','method'=>'post', 'files'=>true,'class'=>'form']) !!}
        <div class="form-group row">
            <label for="topicid" class="col-2">Select topic:
                <select name="topicid" id="topicid" class="col-8">
                    @foreach($topics as $id => $topic)
{{--   тут будут option   --}}
                        <option value="{{$id}}">{{$topic}}</option>
                    @endforeach
                </select>
            </label>
            <a href="{{url('topic/create')}}" class="btn btn-info col-2">Add new topic</a>
        </div>

            <div class="form-group row">
                <label for="title" class="col-2">Block tittle</label>
                <input type="text" name="title" id="title" class="form-inline col-10" placeholder="Enter block name">
            </div>

            <div class="form-inline row">
                <label for="block_content" class="col-2">Block text</label>
                <textarea name="block_content" id="block_content" cols="30" rows="10" class="form-inline col-10" placeholder="Enter block text">
                    </textarea>
            </div>
            <div class="form-inline row">
                <label for="imagepath" class="col-2">Add image</label>
                <input type="file" name="imagepath" id="imagepath" class="col-10">
            </div>
            <button type="submit" class="btn btn-primary">Create block</button>



        {!! Form::close() !!}
    </div>
@endsection