<?php

namespace App\Http\Controllers;

use App\Diary;
use Illuminate\Http\Request;
use App\Http\Requests\CreateDiary;
use Illuminate\Support\Facades\Auth;

class DiaryController extends Controller
{
    public function index()
    {
        // $diaries = Diary::all();
        $diaries = Diary::orderBy('id', 'desc')->get(); // 降順(作成した順)で取得
        // dd($diaries); // ダンプ確認

        // view/diaries/index.blade.phpを表示
        return view('diaries.index', ['diaries' => $diaries]);
    }

    public function create()
    {
        // views/diaries/create.blade.phpを表示する
        return view('diaries.create');
    }

    public function store(CreateDiary $request)
    {
        $diary = new Diary();

        $diary->title = $request->title; // 画面で入力されたタイトルを代入
        $diary->body = $request->body;   // 画面で入力された本文を入力
        $diary->user_id = Auth::user()->id; // ログインしているユーザーのidを保存
        $diary->save(); // DBに保存

        return redirect()->route('diary.index'); // 一覧ページにリダイレクト
    }

    public function destroy(int $id)
    {
        $diary = Diary::find($id);

        $diary->delete();

        return redirect()->route('diary.index');
    }

    public function edit(int $id)
    {
        $diary = Diary::find($id);

        return view('diaries.edit', [
            'diary' => $diary,
        ]);
    }

    public function update(int $id, CreateDiary $request)
    {
        $diary = Diary::find($id);

        $diary->title = $request->title;
        $diary->body = $request->body;

        $diary->save();

        return redirect()->route('diary.index');
    }
}
