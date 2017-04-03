// エンターキーを押したときサイト追加が実行される
 $("#search_box").keyup(function(event){
     if(event.keyCode == 13){
         var searchLink = document.getElementById("searchText").value;
         var str1= "http://homestead.app/search?searchWord=";
         var searchLink= str1.concat(searchLink);
         window.location.href= searchLink;
     }
 });