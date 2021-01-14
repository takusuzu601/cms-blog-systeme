@extends('layouts.app')


@section('content')


<div class="card card-default">
    <div class="card-header">
        {{isset($tag) ? 'タグを編集' : 'タグを登録'}}
    </div>

    <div class="card-body">

        @include('partials.errors')
        <form action="{{isset($tag) ? route('tags.update',$tag->id) : route('tags.store')}}" method="POST">
            @csrf
            @if(isset($tag))
                @method('PUT')
            @endif
            <div class="form-group">
                <label for="name">名前</label>
                <input type="text" class="form-control" id="name" name="name" value="{{isset($tag) ? $tag->name : ''}}">
            </div>
            <div class="form-group">
                <button class="btn btn-success">
                    {{isset($tag) ? '更新する':'登録する'}}
                </button>
            </div>
        </form>
    </div>
</div>

@endsection
