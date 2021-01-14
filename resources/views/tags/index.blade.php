@extends('layouts.app')


@section('content')

<div class="d-flex justify-content-end mb-2">
    <a href="{{route('tags.create')}}" class="btn btn-success">タグを登録</a>
</div>

<div class="card card-default">
    <div class="card-header">タグ一覧</div>
     <div class="card card-default">
         <div class="card-header">
             <div class="card-body">

                @if($tags->count()>0)
                <table class="table">
                    <thead>
                        <th>名前</th>
                        <th>投稿数</th>
                    </thead>
                    <tbody>
                        @foreach ( $tags as $tag)

                        <tr>
                            <td>{{$tag->name}}</td>
                            <td>{{$tag->posts->count()}}</td>
                             <td></td>
                            <td>
                                <a href="{{route('tags.edit',$tag->id)}}" class="btn btn-info btn-sm">
                                   編集
                                </a>
                                <button class="btn btn-danger btn-sm" onclick="handleDelete({{$tag->id}})">削除</button>
                            </td>
                        </tr>
                   
                        @endforeach
                    </tbody>
                </table>

                <!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">

    <form action="" method="POST" id="deletetagForm">
       @csrf
       @method('DELETE')
       <div class="modal-content">
           <div class="modal-header">
             <h5 class="modal-title" id="exampleModalLabel">タグを削除</h5>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
             </button>
           </div>
           <div class="modal-body">
              <p class="text-center text-bold">
                  タグを削除してよいですか？
              </p>
           </div>
           <div class="modal-footer">
             <button type="button" class="btn btn-secondary" data-dismiss="modal">キャンセル</button>
             <button type="submit" class="btn btn-danger">削除</button>
           </div>
         </div>

    </form>
   </div>
 </div>
                @else
                <h5 class="text-center">登録されているタグはありません</h5>
                @endif


             </div>
         </div>
     </div>


</div>

@endsection

@section('scripts')
<script>
   function handleDelete(id){
    var form=document.getElementById('deletetagForm')
    form.action='/tags/'+id
    $('#deleteModal').modal('show')
   }
</script>
@endsection
