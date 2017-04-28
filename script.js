$(document).ready(function(){
    $("#addToCart").click(function(e){
      e.preventDefault();
      $.post("addToCart.php", {'addToCart': e.target.value}, function(){
        console.log('blahblahblah')
      });
    });
});
