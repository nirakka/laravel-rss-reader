@extends('layouts.oishi')

@section('content')
    @foreach ($site_reg as $site)
        
        {{  $site->siteInfo()->first()->site_url }}

    @endforeach
@endsection

@section('endbody')
    @parent
    
@endsection
