@extends('layouts.app')


@section('content')
<div class="card card-default">
    <div class="card-header">Users</div>
    <div class="card-body">

        @if($users->count () >0)
        <table class="table">
            <thead>
                <th>画像</th>
                <th>名前</th>
                <th>メール</th>
            </thead>
            <tbody>
                <tr>
                    @foreach($users as $user)
                        <tr>
                            <td>
                           <img width="40px" height="40px" style="border-radius:50%" src=" {{Gravatar::src($user->email)}}" alt="">
                            </td>
                            <td>
                               {{$user->name}}
                            </td>
                            <td>
                                {{$user->email}}
                            </td>

                            <td>
                               @if(!$user->isAdmin())
                                <form action="{{route('user.make-admin',$user->id)}}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm" >管理者として登録</button>
                                 </form>
                               @endif
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
