@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">検索結果</div>

                <div class="panel-body">
                    
                    <div>
                        <ul>
                            @foreach ($articles as $i)
                                <li style="padding:5px;">
                                    {{ date('H:i', strtotime($i->date)) }}
                                    &nbsp;
                                    <a href={{ $i->url }} target="_blank">{{ $i->title  }}</a>&nbsp;<a href="{{ $i->site()->first()->site_url }}" target="_blank">{{ $i->site()->first()->site_title }}</a>

                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
