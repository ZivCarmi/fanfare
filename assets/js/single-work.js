(($) => {
  // Play video on mouse enter
  $("video[data-manual-play]").on("click", function () {
    $(this).closest(".video-wrapper").toggleClass("playing");

    if (this.paused) {
      this.play();
    } else {
      this.pause();
    }
  });
})(jQuery);
