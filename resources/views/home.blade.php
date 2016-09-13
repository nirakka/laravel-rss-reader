@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    あなたはログインしています!!
		    <div>
			username: {{ Auth::user()->name }}<br>
			e-mail: {{ Auth::user()->email }}
		    </div>
                    <div>
                        <ul>
                            @foreach ($articles as $i)
                                <li><a href={{ $i->url }}>{{ $i->title  }}</a>&nbsp;{{ $i->date }}
                                    &nbsp;<a href="{{ $i->site_url }}">{{ $i->site_title }}</a>

                                </li>
                                <div>{{ $i->content }}</div>
                            @endforeach
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
