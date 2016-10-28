@extends('layouts.oishi')

@section('content')
    <div style="margin-top:100px;">
        <ul>
        @foreach ($site_reg as $site)
            
            <li style="padding:20px;"><a href="{{  $site->siteInfo()->first()->site_url }}">{{ $site->siteInfo()->first()->site_title }}</a>
                <form action="/sites_regs" method="post" style="display:block;">
                    {{ csrf_field() }}
                    <input type="hidden" name="user_id" value="{{ \Auth::user()->id }}" />
                    <input type="hidden" name="site_id" value="{{ $site->site_id }}" />
                    <button type="submit" class="btn">購読をやめる</button>
                </form>
            </li>

        @endforeach
        </ul>
    </div>
@endsection

@section('endbody')
    @parent
    
@endsection
