$(document).ready(function() {
  'use strict';

  $('.btn-form').click(function(event) {
  	event.preventDefault();

  	$.post( $(this).attr('href'), $(this).data(), 
      function(data, textStatus, xhr) {
    		$('.modal-content').html(data);
    		$('.modal').modal('show');
  	  }
    );
  });

});