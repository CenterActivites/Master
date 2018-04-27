function toggleField(hideObj,showObj){
 hideObj.disabled=true;		
 hideObj.style.display='none';
 showObj.disabled=false;	
 showObj.style.display='inline';
 showObj.focus();
}

/*var initialText = $('.editable').val();
$('.editOption').val(initialText);

$('#test').change(function(){
var selected = $('option:selected', this).attr('class');
var optionText = $('.editable').text();

if(selected == "editable"){
  $('.editOption').show();

  
  $('.editOption').keyup(function(){
      var editText = $('.editOption').val();
      $('.editable').val(editText);
      $('.editable').html(editText);
  });

}else{
  $('.editOption').hide();
}
});*/