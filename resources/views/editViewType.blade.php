@extends('layouts.oishi')

@section('content')
    <div style="margin-top:100px;">
        <ul>

                
                <div style="padding:20px;">
                    <form action="/edit-view" method="post" style="display:block;">
                        {{ csrf_field() }}
                        <select name="view_type" value="1">
                            <option value="0">0</option>
                            <option value="1">1</option>

                        </select>
                        <input type="submit" value="変更">
                    </form>
                </div>

         </ul>
    </div>
@endsection

@section('endbody')
    @parent
    
@endsection
