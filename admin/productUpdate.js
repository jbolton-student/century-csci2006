$(document).ready(function(){

  $('#addNew').click(function(e){
    e.preventDefault();
    $('#products').hide();
    $('#addForm').show();
  });

  $('#addBack').click(function(e){
    e.preventDefault();
    $('#addForm').hide();
    $('#products').show();
  });

  $('#editBack').click(function(e){
    e.preventDefault();
    $('#editForm').hide();
    $('#products').show();
  });

  $('#saveItem').click(function(e){
    e.preventDefault();

    $.post('add_update.php', {
      name: $('#name').val(),
      cost: $('#price').val(),
      description: $('#description').val(),
      image: $('#image').val()
    }, function(data){
      data = JSON.parse(data);
      markup = "<tr id='tr"+data['id']+"'><td>" + data['name'] + "</td><td>" + data['cost'] + "</td><td>" + data['description'] + "</td><td><img src='" + data['image'] + "' height='150' width='150'></td><td>" + "<button id='" + data['id'] + "' value='" + data['id'] + "' class='btn btn-success'>Edit Item</button></td></tr>";
      script = "<script>$(document).ready(function(){$('#" + data['id'] + "').click(function(e){e.preventDefault();$('#editH2').text('Edit Item: " +data['name']+ "');$('#editId').val('"+data['id']+"');$('#editName').val('"+data['name']+"');$('#editDescription').val('"+data['description']+"');$('#editImage').val('"+data['image']+"');$('#editPrice').val('"+data['cost']+"');$('#products').hide();$('#editForm').show();});});</script>"
      markup = markup + script;
      $("#tb").append(markup);
      //console.log(data);
      $('#name').val('')
      $('#price').val('')
      $('#description').val('')
      $('#image').val('')

      $('#addForm').hide()
      $('#products').show()
    });
  });

  $('#saveEdit').click(function(e){
    e.preventDefault();

    $.post('add_update.php', {
      ID: $('#editId').val(),
      name: $('#editName').val(),
      cost: $('#editPrice').val(),
      description: $('#editDescription').val(),
      image: $('#editImage').val()
    }, function(data){
      data = JSON.parse(data);
      markup = "<td>" + data['name'] + "</td><td>" + data['cost'] + "</td><td>" + data['description'] + "</td><td><img src='" + data['image'] + "' height='150' width='150'></td><td>" + "<button id='" + data['id'] + "' value='" + data['id'] + "' class='btn btn-success'>Edit Item</button></td>";
      script = "<script>$(document).ready(function(){$('#" + data['id'] + "').click(function(e){e.preventDefault();$('#editH2').text('Edit Item: " +data['name']+ "');$('#editId').val('"+data['id']+"');$('#editName').val('"+data['name']+"');$('#editDescription').val('"+data['description']+"');$('#editImage').val('"+data['image']+"');$('#editPrice').val('"+data['cost']+"');$('#products').hide();$('#editForm').show();});});</script>"
      markup = markup + script;
      $("#tr" + data['id']).html(markup);

      //console.log(JSON.parse(data));
      $('#editId').val('')
      $('#editName').val('')
      $('#editPrice').val('')
      $('#editDescription').val('')
      $('#editImage').val('')

      $('#editForm').hide()
      $('#products').show()
    });
  });
})
