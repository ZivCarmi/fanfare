(($) => {
  // Play video on mouse enter
  $(".work-item").on("mouseenter", (e) => {
    $(e.currentTarget).find("video")[0].play(); // Play the video
  });

  // Pause video on mouse leave
  $(".work-item").on("mouseleave", (e) => {
    $(e.currentTarget).find("video")[0].pause(); // Pause the video
  });
})(jQuery);
