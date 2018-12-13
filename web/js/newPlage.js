jQuery(document).ready(function () {
	$('button.newPlage').on('click', function(event){
	    event.preventDefault();
	    var list = $($(this).attr('data-list'));
    	var counter = list.data('widget-counter') | list.children().lenght;

    	var newWidget = list.attr('data-prototype');

	    newWidget = newWidget.replace(/__name__/g, counter);
	    counter++;
	    list.data('widget-counter', counter);

	    var newElem = $(list.attr('data-widget-tags')).html(newWidget);
	    newElem.appendTo(list);
	});

});