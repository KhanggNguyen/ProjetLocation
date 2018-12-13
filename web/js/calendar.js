/*document.addEventListener('DOMContentLoaded', function() {
    var dateNonDispo = document.querySelector('.js-date-non-dispo');
    var list = dateNonDispo.dataset.dateNonDispo;
    console.log(list);
    // or with jQuery
    //var isAuthenticated = $('.js-user-rating').data('isAuthenticated');
});

YUI().use('calendar', 'datatype-date', 'cssbutton',  function(Y) {

    // Create a new instance of calendar, placing it in
    // #mycalendar container, setting its width to 340px,
    // the flags for showing previous and next month's
    // dates in available empty cells to true, and setting
    // the date to today's date.
    var calendar = new Y.Calendar({
      contentBox: "#mycalendar",
      width:'340px',
      showPrevMonth: true,
      showNextMonth: true,
      date: new Date()}).render();

    // Get a reference to Y.DataType.Date
    var dtdate = Y.DataType.Date;

    // Listen to calendar's selectionChange event.
    calendar.on("selectionChange", function (ev) {

      // Get the date from the list of selected
      // dates returned with the event (since only
      // single selection is enabled by default,
      // we expect there to be only one date)
      var newDate = ev.newSelection[0];
      // Format the date and output it to a DOM
      // element.
      Y.one("#selecteddate").setHTML(dtdate.format(newDate));
    });
});*/