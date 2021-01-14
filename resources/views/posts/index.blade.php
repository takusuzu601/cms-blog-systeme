@extends('layouts.app')


@section('content')
<div class="d-flex justify-content-end mb-2">
    <a href="{{route('posts.create')}}" class="btn btn-success">新規投稿</a>
</div>

<div class="card card-default">
    <div class="card-header">記事の投稿</div>
    <div class="card-body">

        @if($posts->count () >0)
        <table class="table">
            <thead>
                <th>画像</th>
                <th>タイトル</th>
                <th>カテゴリー</th>
            </thead>
            <tbody>
                <tr>
                    @foreach($posts as $post)
                        <tr>
                            <td>
                               <img src="{{ asset('storage/'.$post->image) }}" alt="" class="img-thumbnail" width="90" height="60">
                            </td>
                            <td>
                               {{$post->title}}
                            </td>
                            <td>
                        
                             <a href="{{route('categories.edit',$post->category->id)}}">
                                {{$post->category->name}}
                             </a>
                            </td>

                            @if($post->trashed())
                            <td>
                               <form action="{{route('restore-posts',$post->id)}}" method="POST">
                                   @csrf
                                   @method('PUT')
                                   <button type="submit" class="btn btn-info btn-sm">元に戻す</button>
                               </form>
                            </td>
                            @else
                            <td>
                                <a href="{{route('posts.edit',$post->id)}}" class="btn btn-info btn-sm">編集</a>
                            </td>
                            @endif
                            <td>
                               <form action="{{route('posts.destroy',$post->id)}}" method="POST">
                                   @csrf
                                   @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    {{$post->trashed() ? '削除' : 'ゴミ箱へ'}}
                                </button>
                               </form>
                            </td>
                        </tr>
                    @endforeach
                    
                </tr>
            </tbody>
        </table>
        @else 
            <h5 class="text-center">投稿はありません</h5>
        @endif
    </div>
</div>
@endsection

@section('scripts')

@endsection
