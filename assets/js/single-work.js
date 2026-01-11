(($) => {
  let swiper;
  const assets = [];

  // Push all assets to the array
  $(".image-grid .slider-asset").each((key, val) => {
    const assetData = $(val).closest("[data-asset]").data("asset");
    assets.push(assetData);
  });

  $(".image-grid button[data-asset]").on("click", function () {
    const data = $(this).data("asset");
    const index = assets.findIndex((asset) => asset.url === data.url);

    // Clear previous slides
    $(".swiper-wrapper").empty();

    // Populate Swiper with assets
    $(".image-grid button[data-asset]").each(function () {
      const asset = $(this).data("asset");
      const isClickedOnThisVideo = data.url === asset.url;
      let assetHtml;

      if (asset.type === "image") {
        assetHtml = `<img src="${asset.url}" alt="" />`;
      } else if (asset.type === "video") {
        assetHtml = `<video src="${asset.url}" playsinline loop></video>`;
        if (asset.manual) {
          assetHtml += `<button class="toggle-mute hoverable absolute bottom-4 left-4 z-10 p-4">Mute</button>`;
        }
      }

      $(".swiper-wrapper").append(
        `<div class="swiper-slide !h-auto"><div class="h-dvh flex justify-center">${assetHtml}</div></div>`
      );

      if (isClickedOnThisVideo) {
        $(".swiper-wrapper .swiper-slide-active video").trigger("play");
      }
    });

    // Show fullscreen gallery
    $(document.body).addClass("overflow-hidden");
    $(".slider-gallery").fadeIn().addClass("active");

    // Initialize or update Swiper
    if (swiper) {
      swiper.activeIndex = index;
      swiper.update();
    } else {
      swiper = new Swiper(".swiper", {
        loop: true,
        keyboard: {
          enabled: true,
        },
        initialSlide: index,
      });

      // Triggers the next video slide to play and pause the previous
      swiper.on("slideChange", function (_swiper) {
        const prevSlide = _swiper.slides[_swiper.previousIndex];
        const activeSlide = _swiper.slides[_swiper.activeIndex];

        $(prevSlide).find("video")?.trigger("pause");
        $(activeSlide).find("video")?.trigger("play");
      });

      const activeSlide = swiper.slides[swiper.activeIndex];

      // Triggers the first video to play
      if ($(activeSlide).hasClass("swiper-slide-active")) {
        $(activeSlide).find("video").trigger("play");
      }
    }
  });

  // Toggle sound for video slide
  $(".swiper").on("click", ".toggle-mute", function () {
    const video = $(this).prev("video");
    const isMuted = $(video).prop("muted");

    if (isMuted) {
      $(this).text("Mute");
      $(video).prop("muted", false);
    } else {
      $(this).text("Unmute");
      $(video).prop("muted", true);
    }
  });

  // Close gallery when clicking "X"
  $(".close-btn").on("click", function () {
    $(document.body).removeClass("overflow-hidden");
    $(".slider-gallery").fadeOut().removeClass("active");

    // Stops all videos
    $(".slider-gallery")
      .find("video")
      .each((key, video) => {
        video.pause();
      });
  });

  // Close gallery when click Esc button
  $(document).on("keydown", function (e) {
    const isSliderActive = $(".slider-gallery.active").length;

    if (e.key == "Escape" && isSliderActive) {
      $(".close-btn").trigger("click");
    }
  });

  // Slide to next button
  $(".slide-to-next").on("click", function (e) {
    swiper.slideNext();
  });

  // Slide to prev button
  $(".slide-to-prev").on("click", function (e) {
    swiper.slidePrev();
  });

  // Play video on mouse enter
  $(".manual-play-btn").on("click", function () {
    const video = $(this).next();

    $(this).closest(".video-wrapper").toggleClass("playing");

    if (video.paused) {
      video.play();
    } else {
      video.pause();
    }
  });
})(jQuery);
