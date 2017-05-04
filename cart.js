function addListeners(num) {
    console.log(num + " carts to use");
    $(document).ready(function(){
        for(var i=1; i<= num; i++) {
            $('#removeButton' + i).click(function(e){
                e.preventDefault();
                console.log('removeFromCart.php?id=' + $(this).val());
                $(this).parent().parent().fadeOut("fast");

                $.get('removeFromCart.php?id=' + $(this).val(), function(data){
                    $('#cartButton').fadeOut("slow").text(data).fadeIn("slow");
                });
            });
        }
    });
}

