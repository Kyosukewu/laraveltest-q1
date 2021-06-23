<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\Title;
use Tests\TestCase;

class TitleTest extends TestCase
{
    // use RefreshDatabase;
    use DatabaseTransactions;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_posts_count()
    {
        $num=5;//生成五筆假資料
        $all = Title::count()+$num;
        Title::factory()->count($num)->create(); 
        $posts = Title::get();
        $this->assertCount($all,$posts); //確認資料筆數
    }
    public function test_index_get()
    {
        $response = $this->withoutMiddleware()->get('/admin/title');
        $response->assertStatus(200); //確認狀態碼
    }
}
