(function(undefined) {
	StackView.templates = {
		scaffold: '\
			<ul class="stack-items" />',
		
		navigation: '\
			<div class="stack-navigation<%= empty ? " empty" : ""%>">\
				<div class="upstream">Up</div>\
				<div class="num-found">\
					<span></span><br />items\
				</div>\
				<div class="downstream">Down</div>\
			</div>',
		
		book: '\
			<li class="stack-item stack-book heat<%= heat %>" style="width:<%= book_height %>; height:<%= book_thickness %>;" title="<%= title %>">\
				<a href="<%= link %>">\
					<span class="spine-text">\
						<span class="spine-title"><%= title %></span>\
					</span>\
					<span class="spine-year"><%= year %></span>\
					<span class="stack-pages" />\
					<span class="stack-cover" />\
					<!--<span class="spine-author"><%= author %></span>-->\
				</a>\
			</li>',
		
		placeholder: '<li class="stackview-placeholder"></li>'
	};
})();
