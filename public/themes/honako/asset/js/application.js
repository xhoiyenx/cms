/**
 * HONAKO APPLICATION
 * By: Hoiyen
 * Ver: 0.0.1
 * Last Update: 14/07/2016
 *
 * Type:
 * Javascript
 * 
 * Description:
 * Site javascript
 */

/**
 * Show, off canvas menu
 */
$('.toggle-nav').click(function(event) {
	event.preventDefault();
  $('.wrap').toggleClass('show-mobile');
});