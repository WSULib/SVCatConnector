// global variables
var obj = '';
var stack = '';
var firstORlast = '';

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
	});
}

function status(obj, num){
	// makes sure you have holdings data before it runs
	if (typeof obj.fullRecords[num].holdings !== 'undefined') {
		$('span.status').empty();
		$('span.location').empty();
		var holdings = obj.fullRecords[num].holdings.holding;

		if (typeOf(holdings) == 'array') {
			$('span.status').append(holdings[0].publicNote);
			$('span.location').append("Location: "+holdings[0].localLocation);
		}

		if (typeOf(holdings) == 'object') {
			$('span.status').append(holdings.publicNote);
			$('span.location').append("Location: "+holdings.localLocation);
		}
	}

}


function typeOf(obj) {
	// credit to https://stackoverflow.com/questions/16028680/how-do-i-determine-if-something-is-an-array-or-object?lq=1
  return {}.toString.call(obj).match(/\w+/g)[1].toLowerCase();
}
