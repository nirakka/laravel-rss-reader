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
                                    <form method="post" action="{{ url('/follow') }}">
                                        {{ csrf_field() }}
	                                <div id="article_stock">
                                            <input type="hidden" name="user_id" value="{{ \Auth::user()->id }}" id="user_id" />
		                            <input type="hidden" name="article_id" value="{{ $i->id }}" id="article_id"/>
		                            <button type="submit" alt="ストック" class="crud-submit" id="send"/>
	                                </div>
                                    </form>
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
	 
	 /* Create new Item */
         $(".crud-submit").click(function(e){
             e.preventDefault();
             var form_action = $("#article_stock").find("form").attr("action");
             var article_id = $("#article_stock").find("input[name='article_id']").val();
             var user_id = $("#article_stock").find("input[name='user_id']").val();
             $.ajax({
                 dataType: 'json',
                 type:'POST',
                 url: form_action,
                 data:{user_id:user_id,article_id:article_id}
             }).done(function(data){
                 alert(data);

             });

         });

	
     });

    </script>


@endsection

    

