@extends('layouts.app')


@section('content')

<div class="d-flex justify-content-end mb-2">
    <a href="{{route('categories.create')}}" class="btn btn-success">カテゴリーを登録</a>
</div>

<div class="card card-default">
    <div class="card-header">カテゴリー</div>
     <div class="card card-default">
         <div class="card-header">
             <div class="card-body">

                @if($categories->count()>0)
                <table class="table">
                    <thead>
                        <th>名前</th>
                        <th>投稿数</th>
                    </thead>
                    <tbody>
                        @foreach ( $categories as $category)

                        <tr>
                            <td>{{$category->name}}</td>
                             <td>{{$category->posts->count()}}</td>
                            <td>
                                <a href="{{route('categories.edit',$category->id)}}" class="btn btn-info btn-sm">
                                   編集
                                </a>
                                <button class="btn btn-danger btn-sm" onclick="handleDelete({{$category->id}})">削除</button>
                            </td>
                        </tr>
                   
                        @endforeach
                    </tbody>
                </table>

                <!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">

    <form action="" method="POST" id="deleteCategoryForm">
       @csrf
       @method('DELETE')
       <div class="modal-content">
           <div class="modal-header">
             <h5 class="modal-title" id="exampleModalLabel">カテゴリーを削除</h5>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
             </button>
           </div>
           <div class="modal-body">
              <p class="text-center text-bold">
                  カテゴリーの項目を削除してよいですか？
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
                <h5 class="text-center">カテゴリーの項目はありません</h5>
                @endif


             </div>
         </div>
     </div>


</div>

@endsection

@section('scripts')
<script>
   function handleDelete(id){
    var form=document.getElementById('deleteCategoryForm')
    form.action='/categories/'+id
    $('#deleteModal').modal('show')
   }
</script>
@endsection
