<?php

namespace App\Http\Controllers;

use App\Diary;
use Illuminate\Http\Request;

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
}
