$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(function(){
    
    $(".star-button").click(function(e){
        // 多重送信を防ぐため通信完了までボタンをdisableにする
        var button = $(this);
        button.attr("disabled", true);
        e.preventDefault();
        
        var user_id = {{ Auth::user()->id }};
        var article_id = $(this).data('id');
        var art_id_sel = '#' + article_id + ' .star-button';
        $.ajax({
            dataType: 'json',
            type:'POST',
            url: '/articles',
            data:{
                user_id: user_id,
                article_id: article_id
            }
        }).done(function(){
            $('#' + article_id + ' .fav').toggle();
        }).always(function(){
            button.attr("disabled", false); 
        });
    });
    
    $(".favorited").click(function(e){
        
        var button = $(this);
        button.attr("disabled", true);
        e.preventDefault();

        var user_id = {{ Auth::user()->id }};
        var article_id = $(this).data('id');
        var art_id_sel = '#' + article_id + ' .favorited';
        $.ajax({
            dataType: 'json',
            type:'POST',
            url: '/delete-fav',
            data:{
                user_id: user_id,
                article_id: article_id
            }
        }).done(function(){
            $('#' + article_id + ' .fav').toggle(); 
        }).fail(function(){
            alert('Error occurred!');
        }).always(function(){
            button.attr("disabled", false);
        });
    });    
    

    $(".read-later").click(function(e){
        // 多重送信を防ぐため通信完了までボタンをdisableにする
        var button = $(this);
        button.attr("disabled", true);
        e.preventDefault();
        
        var user_id = {{ Auth::user()->id }};
        var article_id = $(this).data('id');
        //var art_id_sel = '#' + article_id + ' .read-later';

        $.ajax({
            dataType: 'json',
            type:'POST',
            url: '/read-later',
            data:{
                user_id: user_id,
                article_id: article_id
            }
        }).done(function(){
            $('#' + article_id + ' .read-late').toggle();
        }).always(function(){
            button.attr("disabled", false); 
        });
    });

    $(".read-later-flg").click(function(e){
        
        var button = $(this);
        button.attr("disabled", true);
        e.preventDefault();

        var user_id = {{ Auth::user()->id }};
        var article_id = $(this).data('id');

        $.ajax({
            dataType: 'json',
            type:'POST',
            url: '/delete-later',
            data:{
                user_id: user_id,
                article_id: article_id
            }
        }).done(function(){
            $('#' + article_id + ' .read-late').toggle(); 
        }).fail(function(){
            alert('Error occurred!');
        }).always(function(){
            button.attr("disabled", false);
        });
    });
    $(".has-read").click(function(){
        var article_id = $(this).parent().data('id');
        $('#' + article_id + ' .article_wrap').toggleClass('has-read-flg');

    });
});



//変数[addText]と[Num]を宣言
var Num = 1;
// var link = $articles->nextPageUrl();

$(document).ready(function() {
    $(window).bottom();
    $(window).bind("bottom", function() {

        
        var obj = $(this);

        //「loading」がfalseの時に実行する
        if (!obj.data("loading")) {

            //「loading」をtrueにする
            obj.data("loading", true);

            //「Loading」画像を表示
            $('#magazinelist').append('<li class="load-li" style="text-align: center;"><img src="/img/load.gif"></li>');

            //追加する処理を記述
            setTimeout(function() {
                $('#magazinelist li:last').remove();

                // 繰り返しfor文を記述
                for (i=0; i<5; i++, Num++) {



                    //追加するhtmlを記述
                    // ここで追加の記事を出したい
                    $('#magazinelist').append(
                        '<li><div class="article_magazine_content"><div class="article_title">追加の記事'+Num+'</div><div class="article_content"><p class="textOverflow">これは、はじめての記事に対するテストようのテキストです。これは、はじめての記事に対するテストようのテキストです。これは、はじめての記事に対するテストようのテキストです。これは、はじめての記事に対するテストようのテキストです。これは、はじめての記事に対するテストようのテキストです。これは、はじめての記事に対するテストようのテキストです。これは、はじめての記事に対するテストようのテキストです。これは、はじめての記事に対するテストようのテキストです。これは、はじめての記事に対するテストようのテキストです。これは、はじめての記事に対するテストようのテキストです。これは、はじめての記事に対するテストようのテキストです。これは、はじめての記事に対するテストようのテキストです。これは、はじめての記事に対するテストようのテキストです。これは、はじめての記事に対するテストようのテキストです。</p></div><div class="article_footer clearfix"><span class="site_title">はじめてのWEBサイト</span><span class="article_date">27/09/2015</span></div></div></li>'
                    );
                }

                //処理が完了したら「Loading...」をfalseにする
                obj.data("loading", false);
            }, 1000);
        }
    });
    $('html,body').animate({ scrollTop: 0 }, '1');
});



$('#add-sites').click(function() {
    //$('#add-sites').css( 'display', 'none');
    $('#add-sites-edit')
        .val( $( '#add-sites').text())
        .toggle('slow')
        .focus();
});

$('#add-sites-edit').blur(function() {
    $('#add-sites-edit').toggle('slow');
});

$("#search_box").keyup(function(event){
    if(event.keyCode == 13){
        var searchLink = document.getElementById("searchText").value;
        var str1= "http://homestead.app/search?searchWord=";
        var searchLink= str1.concat(searchLink);
        // console.log(searchLink);
        window.location.href= searchLink;
    }
});

