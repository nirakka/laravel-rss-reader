@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">登録したいブログのURLを入力してください。</div>

                    <div class="panel-body">
                        <div class="form-group">
                            <form method="post" action="{{ url('/sites')  }}" class="form-horizontal" enctype="multipart/form-data">
                                {{ csrf_field() }}
                            <label for="site_reg" class="col-sm-2 control-label">URL</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="site_reg" name="site_reg" placeholder="" value="">
                                @if ($errors->has('site_reg'))
                                    <span class="error">{{ $errors->first('site_reg') }}</span>
                                @endif
                            </div>

                            
                            <div class="col-sm-10" style="padding-top:10px;float:right;">
                                <button type="submit" class="btn btn-default">追加</button>
                            </div>
                            
                            </form>
                        </div>
                        
                    </div>
                    

                </div>
            </div>
        </div>
    </div>
@endsection
