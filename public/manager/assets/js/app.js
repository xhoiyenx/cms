$(document).ready(function() {
  'use strict';

  /*
  *		Show modal with content from href
  */
  $('.btn-form').click(function(event) {
  	event.preventDefault();

  	$.post( $(this).attr('href'), {param1: 'value1'}, function(data, textStatus, xhr) {
  		$('.modal-content').html(data);
  		$('.modal').modal('show');
  	});
  });
});