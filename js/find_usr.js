$(document).on('keyup', '#user_reg', function () {
  $.ajax({
    url: 'find_usr.php',
    method: 'POST',
    data: $('#user_reg').serialize(),
    success: function (data) {
      $('#results').html(data);
    },
  });
});
