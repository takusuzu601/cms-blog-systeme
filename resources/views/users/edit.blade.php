@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">ユーザー情報</div>

                <div class="card-body">

                    @include('partials.errors')
                    <form action="{{route('users.update-profile')}}" method="POST">
                        @csrf 
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">名前</label>
                            <input type="text" class="form-control" name="name" id="name" value="{{$user->name}}">
                        </div>

                        <div class="form-group">
                            <label for="about">ユーザーについて
                            </label>
                        <textarea name="about" id="about" cols="5" rows="5" class="form-control">{{$user->about}}</textarea>
                        </div>

                        <button type="submit" class="btn btn-scuccess">情報を更新</button>
                    </form>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
