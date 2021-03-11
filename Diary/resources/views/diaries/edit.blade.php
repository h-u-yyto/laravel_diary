@extends('layout')

@section('title')
編集
@endsection

@section('content')
<section class="container m-5">
    <div class="row justify-content-center">
        <div class="col-8">
            @if($errors->any())
                <ul>
                    @foreach($errors->all() as $message)
                        <li class="alert alert-danger">{{ $message }}</li>
                    @endforeach
                </ul>
            @endif()

            <form action="{{ route('diary.update', ['id' => $diary->id]) }}" method="POST">
                @csrf
                @method('put')
                <div class="form-group">
                    <label for="title">タイトル</label>
                    <!-- old() 第一引数は、バリデーションの入力保持　第二引数は、デフォルト値(編集画面のときにDBのデータ)-->
                    <input type="text" class="form-control" name="title" id="title" value="{{ old('title', $diary->title) }}">
                </div>
                <div class="form-group">
                    <label for="body">本文</label>
                    <textarea name="body" id="body" cols="30" rows="10" class="form-control">{{ old('body', $diary->body) }}</textarea>
                </div>
                <div class="text-right">
                    <button type="submit" class="btn btn-primary">更新</button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection