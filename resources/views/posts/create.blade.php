@extends('layouts.app')

@section('content')
<div class="card card-default">
    <div class="card-header">
       {{isset($post)?'投稿　編集　ページ':'投稿ページ'}}
    </div>
    <div class="card-body">
        @include('partials.errors')
        <form action="{{isset($post)? route('posts.update',$post->id) : route('posts.store')}}" method="POST" enctype="multipart/form-data">
            @csrf 

            @if(isset($post))
                @method('PUT')
            @endif
            <div class="form-group">
                <label for="title">タイトル</label>
                    <input type="text" class="form-control" name="title" id="title" value="{{isset($post) ? $post->title : ''}}">
            </div>
            <div class="form-group">
                <label for="description">説明文</label>
                    <textarea class="form-control" name="description" id="description" col="5" row="5">{{isset($post) ? $post->description:''}}</textarea>
            </div>
            <div class="form-group">
                <label for="content">本文</label>
                <input type="hidden" id="content" name="content" value="{{isset($post) ? $post->content : ''}}">
                <trix-editor input="content"></trix-editor>
            </div>
            <div class="form-group">
                <label for="published_at">日時</label>
                    <input type="text" class="form-control" name="published_at" id="published_at" value="{{isset($post) ? $post->published_at : ''}}">
            </div>

            @if(isset($post))
            <img src="{{ asset('storage/'.$post->image) }}" alt="" class="img-thumbnail" >
            @endif

            <div class="form-group">
                <label for="image">画像</label>
                    <input type="file" class="form-control" name="image" id="image">
            </div>

            <div class="form-group">
                <label for="category">カテゴリー</label>
                    <select name="category" class="form-control" id="category">
                        @foreach( $categories as $category)
                        <option value="{{$category->id}}"
                            @if(isset($post))
                                @if($category->id === $post->category_id)
                                selected
                                @endif 
                            @endif
                            >
                            {{$category->name}}
                        </option>
                        @endforeach
                    </select>
              </div>
                @if($tags->count()>0)
                <div class="form-group"><label for="tags">tags</label>
                    <select name="tags[]" id="tags" class="form-control tags-selector" multiple>
                    @foreach($tags as $tag)
                    <option value="{{$tag->id}}"
                        @if(isset($post))
                            @if($post->hasTag($tag->id))
                                selected
                            @endif
                        @endif
                        >
                        {{$tag->name}}
                    </option>
                    @endforeach
                    </select>
                </div>
                @endif
     

            <div class="form-group">
                <button class="btn btn-success">
                    {{isset($post) ? '編集':'投稿'}}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.0.0/trix.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/ja.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script>
//flatpickr
flatpickr('#published_at', {
  "locale": "ja",
  "enableTime":"true"
});
// select2
$(document).ready(function() {
    $('.tags-selector').select2();
});
</script>
@endsection

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.0.0/trix.css" crossorigin="anonymous" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

@endsection