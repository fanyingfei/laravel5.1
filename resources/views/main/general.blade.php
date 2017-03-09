@extends('main.floor')

@section('floor-content')
    <div class="f-content">
        @foreach ($data['list'] as $key=>$row)
            <div class="floor-one @if ( ($key + 1)%3== 0) f-three @endif">
                <div class="floor-img"><img src="{{ $row['img_url'] }}" /></div>
                <p>编号：{{ $row['name'] }}</p>
            </div>
        @endforeach
    </div>
@stop
