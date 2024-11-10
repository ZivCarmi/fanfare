(($) => {
  const mainTab = $('[data-tab="0"]');
  const mainDescription = mainTab.find(".main-description");
  const originalMarginTop = mainDescription.css("margin-top");
  const originalHeight = mainDescription.outerHeight();
  const fadeDuration = 300;
  const slideDuration = 300;

  function playTabVideo(video) {
    if (!video) return;

    const $mainVideo = mainTab.find("video");

    $mainVideo.attr({
      width: video.width,
      height: video.height,
      src: video.url,
      autoplay: true,
    });

    if ($mainVideo.is(":hidden")) {
      $mainVideo.fadeIn(fadeDuration);
    }
  }

  function stopTabVideo() {
    const $mainVideo = mainTab.find("video");

    $mainVideo.fadeOut(fadeDuration, function () {
      $mainVideo[0].pause();
    });
  }

  // Disable hover over lets fanfare & logo
  $("#site-navigation .lets-fanfare, .site-logo-link").removeClass("hoverable");

  $(".tab-trigger").on("click", function () {
    const tab = $(this).closest("[data-tab]");
    const tabNumber = tab.data("tab");
    const tabVideo = tab.data("tabVideo");
    const isMobile = screen.width <= 1023;

    if (tabNumber === 0) return;

    if (tabVideo) {
      if (!tab.hasClass("active")) {
        playTabVideo(tabVideo);
      } else {
        stopTabVideo();
      }
    }

    if (isMobile) {
      if (tab.hasClass("active")) {
        mainDescription.animate(
          {
            marginTop: originalMarginTop,
            height: originalHeight,
            opacity: 1,
          },
          150
        );

        tab.removeClass("active").find(".tab-content").slideUp(slideDuration);
        return;
      }

      $('.active[data-tab]:not([data-tab="0"])')
        .removeClass("active")
        .find(".tab-content")
        .slideUp();

      mainDescription.animate(
        {
          marginTop: 0,
          height: 0,
          opacity: 0,
        },
        150
      );

      tab.addClass("active").find(".tab-content").slideToggle(slideDuration);
    } else {
      $(document.body).css("overflow", "hidden");

      // Reset to the default grid-template-columns
      $(".tabs-container").removeAttr("style");

      // If clicked on current active tab, exit early
      if (tab.hasClass("active")) {
        mainTab.removeClass("hidden-content");
        return tab.removeClass("active");
      }

      // Adjust grid columns dynamically based on the clicked tab
      if (tabNumber === 1) {
        $(".tabs-container").css(
          "grid-template-columns",
          "38.4% 35.6% 13% 13%"
        );
      } else if (tabNumber === 2) {
        $(".tabs-container").css(
          "grid-template-columns",
          "38.4% 13% 35.6% 13%"
        );
      } else if (tabNumber === 3) {
        $(".tabs-container").css(
          "grid-template-columns",
          "38.4% 13% 13% 35.6%"
        );
      }

      setTimeout(() => {
        $(document.body).css("overflow", "auto");

        $(".active[data-tab]").removeClass("active");

        mainTab.addClass("hidden-content");

        tab.addClass("active");
      }, 250);
    }
  });

  $(window).on("resize", () => {
    mainTab.removeClass("hidden-content");
    $(".tabs-container").removeAttr("style");
    $("[data-tab]").removeClass("active");
    $(".tab-content").removeAttr("style");
  });
})(jQuery);
