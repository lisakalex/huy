/**
 * HOMER - Responsive Admin Theme
 * version 1.7
 *
 */

$(document).ready(function () {
	// Add special class to minimalize page elements when screen is less than 768px
	setBodySmall();

	// Function for collapse hpanel
	$('.showhide').click(function (event) {
		event.preventDefault();
		var hpanel = $(this).closest('div.hpanel');
		var icon = $(this).find('i:first');
		var body = hpanel.find('div.panel-body');
		var footer = hpanel.find('div.panel-footer');
		body.slideToggle(300);
		footer.slideToggle(200);

		// Toggle icon from up to down
		icon.toggleClass('fa-chevron-up').toggleClass('fa-chevron-down');
		hpanel.toggleClass('').toggleClass('panel-collapse');
		setTimeout(function () {
			hpanel.resize();
			hpanel.find('[id^=map-]').resize();
		}, 50);
	});

	// Function for close hpanel
	$('.closebox').click(function (event) {
		event.preventDefault();
		var hpanel = $(this).closest('div.hpanel');
		hpanel.remove();
	});

	// Open close right sidebar
	$('.right-sidebar-toggle').click(function () {
		$('#right-sidebar').toggleClass('sidebar-open');
	});

	// Function for small header
	$('.small-header-action').click(function (event) {
		event.preventDefault();
		var icon = $(this).find('i:first');
		var breadcrumb = $(this).parent().find('#hbreadcrumb');
		$(this).parent().parent().parent().toggleClass('small-header');
		breadcrumb.toggleClass('m-t-lg');
		icon.toggleClass('fa-arrow-up').toggleClass('fa-arrow-down');
	});

	typeaheadSetup(".app-search-box", [
		{
			url: "/search/domain/%QUERY",
			header: "Domains"
		},
		{
			url: "/search/extension/%QUERY",
			header: "Extensions"
		},
		{
			url: "/search/keyword/%QUERY",
			header: "Keywords"
		}
	], {
		onset: function (o) {
			switch (o.type) {
				case "domains":
					document.location = "/" + o.id;
					break;
				case "ext":
					document.location = "/show/extension/" + o.id;
					break;
				case "tags":
					document.location = "/show/keyword/" + o.id;
					break;
			}
		}
	});

	if ($.fn.unveil) {
		$("img.lazy").unveil(200);
	}

	if (typeof $.fn.masonry !== "undefined") {
		var wait1 = setInterval(function () {
			var list = $("#data-blocks .adsbygoogle");
			// Wait for all adsense blocks under masonry are ready ...
			for (var i = 0; i < list.length; i++) {
				if (!list[i].hasAttribute("data-adsbygoogle-status")) {
					return;
				}
			}

			clearInterval(wait1);

			// ... and produce the final layout
			$("#data-blocks").masonry({
				itemSelector: ".animated-panel"
			});
		}, 50);
	}
});

$(window).bind("load", function () {
	// Remove splash screen after load
	$('.splash').css('display', 'none');
});

$(window).bind("resize click", function () {

	// Add special class to minimalize page elements when screen is less than 768px
	setBodySmall();

	// Waint until metsiMenu, collapse and other effect finish and set wrapper height
	setTimeout(function () {
		fixWrapperHeight();
	}, 300);
});

function fixWrapperHeight() {

	// Get and set current height
	var headerH = 62;
	var navigationH = $("#navigation").height();
	var contentH = $(".content").height();

	// Set new height when contnet height is less then navigation
	if (contentH < navigationH) {
		$("#wrapper").css("min-height", navigationH + 'px');
	}

	// Set new height when contnet height is less then navigation and navigation is less then window
	if (contentH < navigationH && navigationH < $(window).height()) {
		$("#wrapper").css("min-height", $(window).height() - headerH + 'px');
	}

	// Set new height when contnet is higher then navigation but less then window
	if (contentH > navigationH && contentH < $(window).height()) {
		$("#wrapper").css("min-height", $(window).height() - headerH + 'px');
	}
}


function setBodySmall() {
	if ($(this).width() < 769) {
		$('body').addClass('page-small');
	} else {
		$('body').removeClass('page-small');
		$('body').removeClass('show-sidebar');
	}
}

//typeahead 0.10.5 not higher!!
function typeaheadSetup(input, src, opt) {
	opt = opt || {};

	var bhOpt = {
		datumTokenizer: function (s) {
			return s.name ? [s.name] : [];
		},
		queryTokenizer: function (s) {
			return s ? [s] : [];
		},
		dupDetector: function (a, b) {
			return a.id === b.id;
		},
		limit: opt.limit || 7
	};

	if (!$.isArray(src)) {
		src = [{
				url: src,
				header: ""
			}];
	}

	var sources = [];
	var bh, sopt;
	for (i = 0; i < src.length; i++) {
		bhOpt.remote = {url: src[i].url};
		bh = new Bloodhound(bhOpt);
		bh.initialize();

		sopt = {
			source: bh.ttAdapter(),
			displayKey: "name",
			templates: {
				empty: "<div class='mimic-tt-suggestion'>no matches</div>"
			}
		};

		if (src[i].header) {
			sopt.templates.header = "<div class='source-header'>" + src[i].header + "</div>";
		}

		sources.push(sopt);
	}

	$(input).on("paste", function (ev) {
		try {
			var clipboard = ev.originalEvent.clipboardData || window.clipboardData;
			var search = clipboard.getData("Text");

			function paste() {
				$(ev.target).typeahead("val", search);
			}

			ev.stopPropagation();
			ev.preventDefault();

			search = search.toLowerCase();

			// Protocol
			search = search.replace(/^.*:\/\//, "");
			// Path
			search = search.replace(/\/.*$/, "");

			// Check if stripping "www." off is legit
			if (/^www\./.test(search)) {
				ev.target.disabled = true;
				var search1 = search.substr(4);

				$.ajax({
					url: "/ask/domain/" + search1,
					cache: false
				}).done(function (data) {
					if (data === "yes") {
						search = search1;
					}
				}).always(function () {
					ev.target.disabled = false;
					
					// Previously focus was lost on disabling the input.
					// Without refocusing it back no typeahead hints are shown.
					ev.target.focus();

					paste();
				});
			} else {
				paste();
			}
		} catch (ex) {
		}
	});

	$(input).typeahead(
			{
				hint: true,
				highlight: true,
				minLength: opt.minLength || 2,
				autoselect: true
			},
			sources
			).on("typeahead:selected", function (ev, d) {
		$(this).data("selected", d.id);
		if (opt.onset) {
			opt.onset(d);
		}
	}).on("typeahead:autocompleted", function (ev, d) {
		$(this).trigger("typeahead:selected", d);
	}).on("change", function () {
		if (this.value !== $(this).data("selected")) {
			$(this).data("selected", "");
			if (opt.onunset) {
				opt.onunset();
			}
		}
	});
}
