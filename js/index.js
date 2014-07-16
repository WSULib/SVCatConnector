// global variables
var obj = '';
var stack = '';

// First get stackview records
function populateStackview(query) {
	return $.ajax({
		type: "POST",
		url: "php/catalog.php",
		data: {query: query},
		dataType: "json"
	})

.done(function (response) {
	obj = response;
	if (response !== null) {
		if (typeof obj['error_response'] !== 'undefined') {
		$('.stack').html(obj['error_response']);
		}

		else if (obj['stackviewRecords'].length === 0) {
				$('.stack').html("Your search did not find any records.  Please try again.");
		}

		else {
					var json_loc = "json/temp/"+obj.tempfile;
					stack = new StackView('.stack', {url: json_loc});
					// displayFirstBook(obj);
		}
	}
	else {
		$('.stack').html("Your search did not find any records.  Please try again.");
	}
})

.fail(function (response){

	$('.stack').html("Your search did not find any records.  Please try again.");
	});

}


// Now display data for the initially selected book
function displayFirstBook(obj){
	$('span.record').empty().append("<a href="+obj.recordLinks[14].link+" target='_blank'>View Catalog Record</a>");
}

// Search for Next 30 records

function nextRecords(query) {
	obj = null;
	console.log(query);
	$.ajax({
		type: "POST",
		url: "php/catalog.php",
		data: {query: query},
		dataType: "json"
	})

.done(function (response2) {
	obj = response2;
	if (obj !== null) {
	if (typeof obj['error_response'] !== 'undefined') {
		$('.stack').html(obj['error_response']);
	}

	else if (obj['stackviewRecords'].length === 0){
		$('.stack .nores').html("Your search did not find any records.  Please try again.");
	}

	else {
		$(function () {
			var num = parseInt($('div.num-found span').html());
			for (var i = 1; i <=obj.stackviewRecords.length; i++) {
				stack.remove(1);
			}
			for (var i = 0; i<obj.stackviewRecords.length; i++) {
				stack.add(obj.stackviewRecords[i]);
			}
		stack.remove(0);
		});
	}
	}
	else {
		$('.stack').html("Your search did not find any records.  Please try again.");
	}

})

.fail(function (response2){

	$('.stack').html("Your search did not find any records.  Please try again.");
	console.log(response2);
	});
}


