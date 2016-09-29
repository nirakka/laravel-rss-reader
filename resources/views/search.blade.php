@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">検索</div>

                <div class="panel-body">
                    
                    <div>
                        <ul>

                            It's Working <br>
							{!! Form::open() !!}
                            <div>
							    {{ Form ::label('searchWord','Search: ') }}
                                {{ Form ::text('searchWord') }}
                            </div>

                            <div>
                                {{ Form ::submit('Search') }}
                            </div>
							{!! Form::close() !!}

<!--   with if -->

                        </ul>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>



@endsection