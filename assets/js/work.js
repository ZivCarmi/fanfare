(($) => {
  // Play video on mouse enter
  $(".work-item").on("mouseenter", (e) => {
    if (screen.width <= 1023) return;
    $(e.currentTarget).find("video")[0].play(); // Play the video
  });

  // Pause video on mouse leave
  $(".work-item").on("mouseleave", (e) => {
    if (screen.width <= 1023) return;
    $(e.currentTarget).find("video")[0].pause(); // Pause the video
  });

  function initializeMobileObserver() {
    const videos = document.querySelectorAll(".work-item video");
    let mostCenteredVideo = null;

    // Callback function to find and play the most centered video
    const callback = () => {
      if (screen.width >= 1024) {
        $(".work-item").removeClass("active");
        return;
      }

      let closestVideo = null;
      let smallestDistance = Infinity;

      videos.forEach((video) => {
        const rect = video.getBoundingClientRect();
        // Calculate the distance from the center of the viewport
        const videoCenter = rect.top + rect.height / 2;
        const viewportCenter = window.innerHeight / 2;
        const distance = Math.abs(viewportCenter - videoCenter);

        // If this video is closer to the viewport center than the previous ones
        if (distance < smallestDistance) {
          smallestDistance = distance;
          closestVideo = video;
        }
      });

      // If a new video is closer to the center, play it and pause the previous one
      if (closestVideo !== mostCenteredVideo) {
        if (mostCenteredVideo) {
          $(mostCenteredVideo).closest(".work-item").removeClass("active");
          mostCenteredVideo.pause();
        }

        $(closestVideo).closest(".work-item").addClass("active");
        closestVideo.play();
        mostCenteredVideo = closestVideo;
      }
    };

    // Set up an observer to watch for scrolling and viewport resizing
    const observer = new IntersectionObserver(callback, {
      root: null,
      threshold: 0.5, // Trigger when at least half of the video is visible
    });

    videos.forEach((video) => observer.observe(video));

    // Listen for scroll and resize events to continually check video positions
    window.addEventListener("scroll", callback);
    window.addEventListener("resize", callback);
  }

  // Run the observer setup function on page load
  initializeMobileObserver();
})(jQuery);
