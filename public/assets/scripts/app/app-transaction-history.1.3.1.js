/*
|--------------------------------------------------------------------------
| Transaction History Template
|--------------------------------------------------------------------------
*/

'use strict';

(function ($) {

  // Initialize the DatePicker
  $('#transaction-history-date-range').datepicker({});

  // Initialize the Transaction History datatable.
  $('.transaction-history').DataTable({ 
  	"dom": '<"top"f>rt<"bottom"ilp><"clear">',
  	responsive: true });

})(jQuery);
