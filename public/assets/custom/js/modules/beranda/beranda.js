if (typeof Swiper !== "undefined") {
	const swiper = new Swiper(".swiper", {
		autoplay: {
			delay: 5000,
		},
		speed: 1000,
		spaceBetween: 100,
		// Optional parameters
		direction: "horizontal",
		loop: true,
	});
}
$(".download_file").on("click", (event) => {
	$.ajax({
		type: "POST",
		url: `${baseUrl}beranda/counting`,
		data: {
			file: event.target.getAttribute("data-file"),
		},
		dataType: "json",
		success: function (data) {
			window.location.href = `${baseUrl}uploads/repository/${encodeURIComponent(
				data
			)}`;
		},
		error: function (xhr, status, error) {
			console.log("Terjadi kesalahan: " + error);
		},
	});
});
