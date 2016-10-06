@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">検索</div>

                <div class="panel-body">
                            {!! Form::open(['method'=>'GET','url'=>'/search','role'=>'searchWordFromArticle'])  !!}
                            <div class="input-group custom-search-form">

                            {!! Form::label('seachWord', 'KeyWord: ') !!}
                            {!! Form::text('searchWord', null, ['class' => 'form-control']) !!}
     
                            {!! Form::submit('Search', ['class' => 'btn btn-primary form-control']) !!}
                            </div>
                            {!! Form::close() !!}
                    
                    <div>
                        <ul>
                                <table class="table table-bordered table-hover" >
                                    <thead>
                                        <th>Found: </th>
                                    </thead>
                                    <tbody>
                                        @foreach($articles as $i)
                                        <tr>
                                            <td>{{ $i->title }}
                                                {{ date('H:i', strtotime($i->date)) }}
                                                <a href={{ $i->url }} target="_blank">{{ $i->title  }}</a>&nbsp;
                                                <a href="{{ $i->site()->first()->site_url }}" target="_blank">{{ $i->site()->first()->site_title }}
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                        </ul>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>



@endsection