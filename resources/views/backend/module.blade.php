@extends("layouts/layout")

@section("main")
@include('layouts.backend_sidebar')
<div class="main_contant col-span-9 border">
    <div class="grid grid-cols-12">
        <div class="col-span-8 text-center p-3 relative">
        @if($module != 'Total' && $module != 'Bottom')
            <button class=" absolute align-middle left-2 bg-blue-100 hover:bg-blue-200 w-14 h-7 rounded-md" id="addRow">新增</button>
        @endif
            <p>後台管理區</p>
        </div>
        <button class="col-span-4 bg-gray-100 hover:bg-gray-200 p-3 rounded-md">管理登出</button>
    </div>
    <div class="contant border w-full">
        <div class="text-sm text-center border-b bg-yellow-400 p-3">{{$header}}</div>
        <div class="grid grid-cols-12 text-center text-sm">
            @isset($cols)
            @if($module != 'Total' && $module != 'Bottom')
            @foreach($cols as $col)
            <div class="col-span-{{$col['grid']}} bg-yellow-300 py-1">{{$col['title']}}</div>
            @endforeach
            @endif
            @endisset
        </div>
        @isset($rows)
        @if($module != 'Total' && $module != 'Bottom')
        @foreach($rows as $row)
        <div class="grid grid-cols-12 text-center">
            @foreach($row as $item)
                @switch($item['tag'])
                @case('img')
                @include('layouts.img',$item)
                @break
                @case('button')
                @include('layouts.button',$item)
                @break
                @default
                @include('layouts.text',$item)
                @endswitch
            @endforeach
        </div>
        @endforeach
        @else
            <div class="grid grid-cols-12">
                <div class="col-span-{{ $cols['grid'] }} bg-yellow-200 flex justify-center items-center">{{ $cols['title'] }}</div>
                <div class="col-span-{{ $rows[0]['grid'] }} flex justify-center items-center">{{ $rows[0]['text'] }}</div>
                <div class="col-span-2">
                @include('layouts.button',$rows[1])
                </div>
            </div>
        @endif
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
    $('#addRow').on('click', function() {
        $.get("/modals/add{{ $module }}", function(modal) {
            $("#modal").html(modal)
            $("#baseModal").show()
            //尚缺清除暫存
        })
    })
    $('.edit').on('click', function() {
        let id = $(this).data('id')
        $.get(`/modals/{{ strtolower($module) }}/${id}`, function(modal) {
            $("#modal").html(modal)
            $("#baseModal").show()
        })
    })
    $('.delete').on('click', function() {
        let id = $(this).data('id')
        Swal.fire({
            title: '確定要刪除嗎？',
            icon: 'question',
            iconColor: '#ff3333',
            showDenyButton: true,
            confirmButtonText: `刪除！`,
            confirmButtonColor: 'red',
            denyButtonText: `取消`,
            denyButtonColor: 'gray'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'delete',
                    url: `/admin/{{ strtolower($module) }}/${id}`,
                    success: function() {
                        Swal.fire('已成功刪除', '', 'success')
                        location.reload()
                    }
                })
            }
        })
    })
    $('.show').on('click', function() {
        let id = $(this).data('id')

        $.ajax({
            type: 'patch',
            url: `/admin/{{ strtolower($module) }}/sh/${id}`,
            success: function() {
                location.reload()
            }
        })
    })
</script>
@endsection