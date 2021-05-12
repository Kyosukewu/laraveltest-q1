<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all = News::all();
        //dd($all); //L內建除錯指令 類似var_dump
        $cols = [
            [
                'title' => '最新消息內容',
                'grid' => '9',
            ],
            [
                'title' => '功能',
                'grid' => '3',
            ]
        ];
        $rows = [];
        foreach ($all as $a) {
            $tmp = [
                [
                    'tag' => '',
                    'text' => $a->text,
                    'grid' => '9'
                ],
                [
                    'tag' => 'button',
                    'action' => 'show',
                    'color' => ($a->sh == 1) ? 'bg-green-100' : 'bg-gray-100',
                    'hover' => 'bg-green-200',
                    'type' => 'button',
                    'id' => $a->id,
                    'text' => ($a->sh == 1) ? '顯示' : '隱藏',
                ],
                [
                    'tag' => 'button',
                    'type' => 'button',
                    'action' => 'delete',
                    'id' => $a->id,
                    'color' => 'bg-gray-100',
                    'hover' => 'bg-red-200',
                    'text' => '刪除'
                ],
                [
                    'tag' => 'button',
                    'type' => 'button',
                    'action' => 'edit',
                    'id' => $a->id,
                    'color' => 'bg-gray-100',
                    'hover' => 'bg-indigo-300',
                    'text' => '編輯'
                ]
            ];
            $rows[] = $tmp;
        }
        // dd($cols);
        $view = [
            'header' => '網站標題管理',
            'module' => 'News',
            'cols' => $cols,
            'rows' => $rows,
        ];
        // dd($view);
        return view('backend.module', $view);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $view = [
            'action' => '/admin/news',
            'modal_header' => "新增最新消息",
            'modal_body' => [
                [
                    'label' => '最新消息內容',
                    'tag' => 'input',
                    'type' => 'text',
                    'name' => 'text'
                ],
            ],
        ];


        return view("modals.base_modal", $view);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $news = new News;
        $news->text = $request->input('text');
        $news->save();

        return redirect('/admin/news'); //同header
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $news = News::find($id);
        $view = [
            'action' => '/admin/news/' . $id,
            'method' => 'PATCH',
            'modal_header' => "編輯最新消息資料",
            'modal_body' => [
                [
                    'label' => '最新消息內容',
                    'tag' => 'input',
                    'type' => 'text',
                    'name' => 'text',
                    'value' => $news->text
                ],
            ],
        ];
        return view('modals.base_modal', $view);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $news = News::find($id); //明確只撈一筆資料可用此方式
        //$news=news::where('id',$id)->get(); //撈一個二維陣列的結果(fetchall)

        if ($news->text != $request->input('text')) {
            $news->text = $request->input('text');
        }

        $news->save();
        return redirect('/admin/news');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        News::destroy($id);
    }

    public function display($id)
    {
        $news = News::find($id);
        $news->sh=($news->sh+1)%2;
        $news->save();
    }
}
