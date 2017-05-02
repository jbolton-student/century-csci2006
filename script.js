$(document).ready(function(){
  window.cartButton = function(){
    var val = parseInt($('#cartButton').text()) + 1;
    if(!isNaN(val)){
      $('#cartButton').text(val);
    }
    else{
      $('#cartButton').text('0');
    }
  }
});
