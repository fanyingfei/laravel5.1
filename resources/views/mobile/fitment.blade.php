@extends('mobile')

@section('content')
    <div class="fitment-wrapper">
         <div class="fitment-list">
              @foreach ($data['list'] as $key=>$row)
                    <div class="fitment-one @if ( ($key + 1)%3== 0) f-three @endif">
                        <a class="fitment-img" data-id="{{ $row['rec_id'] }}"><img src="{{ $row['img_url'] }}" /><div></div></a>
                        <p>{{ $row['name'] }}{{ $row['style'] }}{{ $row['house'] }}</p>
                        <p class="detail"><span class="m8"> <i>{{ $row['img_num'] }}</i>张</span></p>
                    </div>
              @endforeach
         </div>
         {!! $data['pagination'] !!}
    </div>
@stop