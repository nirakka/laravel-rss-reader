@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        購読ブログ
                        
                    </div>

                    <div class="panel-body">
                        
                        <div>
                            <ul>
                                @foreach ($site_reg as $site)
                                    <li style="padding:5px;">
                                        <a href={{ $site->siteInfo()->first()->site_link }} target="_blank">{{ $site->siteInfo()->first()->site_title  }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#blogSelect">
                            <span class="glyphicon glyphicon-plus"></span>新しくマイリストに追加
                        </button>
                        
                        <!-- Modal -->
                        <div class="modal fade" id="blogSelect" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                                    </div>
                                    <div class="modal-body">
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
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                                                        <button type="submit" class="btn btn-primary add_blog">追加</button>
                                                        
                                                    </div>
                                                </form>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>

                    

                </div>
            </div>
        </div>
    </div>
@endsection

@section('endbody')
    @parent
    <script>
     $(function(){
         $('.add_blog').on('click', function(){
             if ( ("#site_reg").val() != "" ){
                 $('.modal').modal('hide');
             }
         });
     });
    </script>
@endsection
