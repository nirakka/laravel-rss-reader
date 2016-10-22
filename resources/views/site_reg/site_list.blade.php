@extends('layouts.oishi')

@section('content')
    <div style="margin-top:300px;">
    @foreach ($site_reg as $site)
        
        {{  $site->siteInfo()->first()->site_url }}

    @endforeach
    </div>
@endsection

@section('endbody')
    @parent
    
@endsection
