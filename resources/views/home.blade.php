@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">新着記事</div>

                <div class="panel-body">
                    
                    <div>
                        <ul>
                            @foreach ($articles as $i)
                                <li style="padding:5px;">
                                    {{ date('H:i', strtotime($i->date)) }}
                                    &nbsp;
                                    <a href={{ $i->url }} target="_blank">{{ $i->title  }}</a>&nbsp;
                                    <a href="{{ $i->site()->first()->site_url }}" target="_blank">{{ $i->site()->first()->site_title }}</a>
	                            <div id="{{ $i->id }}" class="clearfix">
                                        <form method="post" action="{{ url('/follow') }}">
                                            {{ csrf_field() }}

                                            <input type="hidden" name="user_id" value="{{ \Auth::user()->id }}" id="user_id" />
		                            <input type="hidden" name="article_id" value="{{ $i->id }}" id="article_id"/>
		                            <button type="submit" alt="ストック" class="crud-submit btn btn-primary pull-right" data-id="{{ $i->id }}">ストック</button>

                                        </form>
	                            </div>
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

@section('endbody')
    @parent
    <script type="text/javascript">

     
     $(function() {
	 $.ajaxSetup({
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             }
         });
	 /* Create new Item */
         $(".crud-submit").click(function(e){
             e.preventDefault();
             var article_id = $(this).data('id');
             var form_action = $("#" + article_id).find("form").attr("action");

             var user_id = $("#" + article_id).find("input[name='user_id']").val();
             $.ajax({
                 dataType: 'json',
                 type:'POST',
                 url: form_action,
                 data:{user_id:user_id,article_id:article_id}
             }).done(function(data){


             });

         });

	
     });

    </script>


@endsection

    

