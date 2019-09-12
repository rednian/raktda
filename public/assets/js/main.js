$(document).ready(() => {
	$("span[data-lang=en]").click(function() {
		$(this).addClass("d-none");
		$("span[data-lang=ar]").removeClass("d-none");
	});

	$("span[data-lang=ar]").click(function() {
		$(this).addClass("d-none");
		$("span[data-lang=en]").removeClass("d-none");
	});
});
