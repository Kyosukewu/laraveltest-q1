<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all = Menu::all();
        //dd($all); //L內建除錯指令 類似var_dump
        $cols = [
            [
                'title' => '主選單',
                'grid' => '4',
            ],
            [
                'title' => '選單連結',
                'grid' => '5',
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
                    'grid' => '4'
                ],
                [
                    'tag' => '',
                    'text' => $a->href,
                    'grid' => '5'
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
            'module' => 'Menu',
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
            'action' => '/admin/menu',
            'modal_header' => "新增主選單",
            'modal_body' => [
                [
                    'label' => '主選單內容',
                    'tag' => 'input',
                    'type' => 'text',
                    'name' => 'text',
                ],
                [
                    'label' => '主選單連結',
                    'tag' => 'input',
                    'type' => 'text',
                    'name' => 'href'
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
        $menu = new Menu;
        $menu->text = $request->input('text');
        $menu->href = $request->input('href');
        $menu->save();
        return redirect('/admin/menu');
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
        $menu = Menu::find($id);
        $view = [
            'action' => '/admin/menu/' . $id,
            'method' => 'PATCH',
            'modal_header' => "編輯主選單資料",
            'modal_body' => [
                [
                    'label' => '主選單內容',
                    'tag' => 'input',
                    'type' => 'text',
                    'name' => 'text',
                    'value' => $menu->text
                ],
                [
                    'label' => '主選單連結',
                    'tag' => 'input',
                    'type' => 'text',
                    'name' => 'href',
                    'value' => $menu->href
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
        $menu = Menu::find($id); //明確只撈一筆資料可用此方式
        //$menu=menu::where('id',$id)->get(); //撈一個二維陣列的結果(fetchall)

        if ($menu->text != $request->input('text')) {
            $menu->text = $request->input('text');
        }
        if ($menu->text != $request->input('href')) {
            $menu->text = $request->input('href');
        }

        $menu->save();
        return redirect('/admin/menu');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Menu::destroy($id);
    }

    public function display($id)
    {
        $menu = Menu::find($id);
        $menu->sh=($menu->sh+1)%2;
        $menu->save();
    }
}
