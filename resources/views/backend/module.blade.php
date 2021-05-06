@extends("layouts/layout")

@section("main")
@include('layouts.backend_sidebar')
<div class="main_contant col-span-9 border">
    <div class="grid grid-cols-12">
        <div class="col-span-8 text-center p-3 relative">
        <button class=" absolute align-middle left-2 bg-blue-100 hover:bg-blue-200 w-14 h-7 rounded-md" id="addRow">新增</button>
        <p>後台管理區</p>
        </div>
        <button class="col-span-4 bg-gray-100 hover:bg-gray-200 p-3 rounded-md">管理登出</button>
    </div>
    <div class="contant border w-full">
    <div class="text-sm text-center border-b bg-yellow-400 p-3">{{$header}}</div>
    <div class="grid grid-cols-12 text-center text-sm">
        <div class="col-span-5 bg-yellow-300 py-1">網站標題</div>
        <div class="col-span-4 bg-yellow-300 ml-0.5 py-1">替代文字</div>
        <div class="col-span-3 bg-yellow-300 ml-0.5 py-1">功能</div>
    </div>
    @isset($rows)
    @foreach($rows as $row)
    <div class="grid grid-cols-12 text-center">
        <div class="col-span-5 py-1"><img src="{{ asset('storage/'.$row->img) }}" alt="" class="w-full"></div>
        <div class="col-span-4 py-1 ml-0.5">
        <div class="w-full h-full bg-gray-100 flex items-center justify-center">{{$row->text}}</div>
        </div>
        <div class="col-span-1 py-1 ml-0.5"><button class="show @if($row->sh==1) bg-green-100 @else bg-gray-100 @endif w-full h-full rounded-md hover:bg-green-200 shadow-sm" data-id="{{$row->id}}">
        @if($row->sh==1)
        顯示
        @else
        隱藏
        @endif
        </button></div>
        <div class="col-span-1 py-1 ml-0.5"><button class="delete bg-gray-100 w-full h-full rounded-md hover:bg-red-200 shadow-sm" data-id="{{$row->id}}">刪除</button></div>
        <div class="col-span-1 py-1 ml-0.5"><button class="edit bg-gray-100 w-full h-full rounded-md hover:bg-indigo-300 shadow-sm" data-id="{{$row->id}}">編輯</button></div>
    </div>
    @endforeach
    @endisset
    </div>
</div>
@endsection

@section("script")
<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$('#addRow').on('click',function(){
    $.get("/modals/add{{ $module }}",function(modal){
        $("#modal").html(modal)
        $("#baseModal").show()
        //尚缺清除暫存
    })
})
$('.edit').on('click',function(){
    let id=$(this).data('id')
    $.get(`/modals/title/${id}`,function(modal){
        $("#modal").html(modal)
        $("#baseModal").show()
    })
})
$('.delete').on('click',function(){
    let id=$(this).data('id')
    $.ajax({
        type:'delete',
        url:`/admin/title/${id}`,
        success:function(){
            location.reload()
        }
    })
})
$('.show').on('click',function(){
    let id=$(this).data('id')
    
    $.ajax({
        type:'patch',
        url:`/admin/title/sh/${id}`,
        success:function(){
            location.reload()
        }
    })
})
</script>
@endsection