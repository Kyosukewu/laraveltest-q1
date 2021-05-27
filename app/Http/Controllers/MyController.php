<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Title;
use App\Models\Total;
use App\Models\Bottom;

class MyController extends Controller
{
    protected $view=[]; //protected屬性宣告內容不得為有運算的東西，需要先宣告成空陣列

    public function __construct()
    {
        $this->view['title']=Title::where('sh',1)->first();
        $this->view['total']=Total::first()->total;
        $this->view['bottom']=Bottom::first()->bottom;
    }
}
