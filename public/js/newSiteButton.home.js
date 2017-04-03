//サイト追加ボタンを押した時，
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
 