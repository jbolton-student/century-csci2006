$('document').ready(function(){

  $('#loginButton').click(function(){
    $('#loginForm').submit();
  })

  $('#regButton').click(function(){
    $('#login').hide();
    $('#register').show();
  });

  $('#back').click(function(){
    $('#register').hide();
    $('#login').show();
  })

  $('#confirmButton').click(function(){
    $('#registerForm').submit();
  })
})
