(($) => {
  const textContainer = $(".text-container");
  const $highlightedWords = $(".highlighted-word");

  intializePopoverHtml();
  applyHoverBehavior();

  function intializePopoverHtml() {
    let html = '<div class="home-popovers">';

    $highlightedWords.each(function () {
      // Get the popover data
      const videosData = $(this).data("videos");

      if (videosData.videos.length === 0 || !videosData.videos[0].video) return;

      html += popoverHtmlBuilder(videosData);
    });

    html += "</div>";

    // Append the popovers
    textContainer.append(html);

    // Wrap each text in span
    $(".hero-text")
      .contents()
      .each(function () {
        // Check if it's a text node and has content
        if (this.nodeType === Node.TEXT_NODE && $.trim(this.nodeValue) !== "") {
          // Wrap the text node in a span
          $(this).replaceWith($("<span>").text(this.nodeValue));
        }
      });
  }

  function popoverHtmlBuilder(videosData) {
    const { id, videos } = videosData;

    if (isNaN(id) || !videos || videos.length === 0 || !videos[0].video) return;

    let popoverHtml = "";
    let videosProps;
    const isLessOrEqualToFour = videos.length <= 4;

    if (isLessOrEqualToFour) {
      videosProps = {
        0: {
          classes: "h-[202px] top-[-17vh] left-0",
          hiddenInMobile: true,
        },
        1: {
          classes:
            "w-[140px] h-[82px] top-[-12vh] left-[50%] -translate-x-1/2 lg:w-auto lg:h-[186px] lg:top-[-7.2vh] lg:right-[-10vw] lg:left-auto lg:-translate-x-0",
        },
        2: {
          classes:
            "w-[90px] h-[77px] top-[15vh] left-[4%] lg:w-auto lg:h-[174px] lg:top-[26vh] lg:right-[6.3vw] lg:left-auto",
        },
        3: {
          classes:
            "w-[184px] h-[111px] top-[18vh] right-0 lg:w-auto lg:h-[198px] lg:top-[13.3vh] lg:left-[-7vw] lg:right-auto",
        },
      };
    } else if (videos.length <= 9) {
      videosProps = {
        0: {
          classes:
            "w-[100px] h-[20px] bottom-[calc(100%+1vh)] left-[2%] lg:w-[234px] lg:h-[28px] lg:bottom-[calc(100%+5vh)]",
        },
        1: {
          classes:
            "w-[90px] h-[26px] bottom-[calc(100%+10vh)] left-[10%] lg:w-[159px] lg:h-[45px] lg:bottom-[calc(100%+14.5vh)] lg:left-[14%]",
        },
        2: {
          classes:
            "h-[49px] bottom-[calc(100%+2.5vh)] left-[43%] lg:w-[101px] lg:h-[95px] lg:bottom-[calc(100%+7.5vh)] lg:left-[43%]",
        },
        3: {
          classes:
            "h-[58px] bottom-[calc(100%+10vh)] left-[62%] lg:w-[79px] lg:h-[88px] lg:bottom-[calc(100%+15.5vh)] lg:left-[62%]",
        },
        4: {
          classes:
            "w-[90px] h-[42px] bottom-[calc(100%+1vh)] left-[73%] lg:w-[188px] lg:h-[55px] lg:bottom-[calc(100%+2.5vh)] lg:left-[73%]",
        },
        5: {
          classes:
            "h-[55px] top-[calc(100%+2vh)] left-[4%] lg:w-[119px] lg:h-[90px] lg:top-[calc(100%+6vh)] lg:left-[4%]",
        },
        6: {
          classes:
            "h-[61px] top-[calc(100%+14vh)] left-[28%] lg:w-[50px] lg:h-[69px] lg:top-[calc(100%+16vh)] lg:left-[28%]",
        },
        7: {
          classes:
            "h-[68px] top-[calc(100%+3.5vh)] left-[45%] lg:w-[185px] lg:h-[74px] lg:top-[calc(100%+7vh)] lg:left-[45%]",
        },
        8: {
          classes:
            "w-[100px] h-[60px] top-[calc(100%+17vh)] left-[74%] lg:w-[172px] lg:h-[95px] lg:top-[calc(100%+15vh)] lg:left-[74%]",
        },
      };
    }

    popoverHtml += `<div class="popover-group" data-popover-group="${id}">`;

    videos.forEach((_video, key) => {
      const { video, visibility } = _video;

      // Create the popover HTML
      popoverHtml += `
        <div class="custom-popover absolute ${visibility ? "z-10" : "z-0"} ${
          videosProps[key].classes
        }" data-mobile-visibility="${!!videosProps[key].hiddenInMobile}">`;

      if (video.type === "video") {
        popoverHtml += `
          <video preload="metadata" class="w-full h-full object-cover rounded-2px" width="100%" height="100%" playsinline muted loop>
            <source src="${video.url}">
            Your browser does not support HTML video.
          </video>`;
      } else if (video.type === "image") {
        const isSvg = video.mime_type === "image/svg+xml";

        popoverHtml += `<img src="${video.url}" class="w-full h-full${
          isSvg ? " style-svg" : ""
        }" width="${video.width}" height="${video.height}" />`;
      }

      popoverHtml += "</div>";
    });

    popoverHtml += "</div>";

    return popoverHtml;
  }

  function showPopoversById(idToShow) {
    const highlightedWord = $highlightedWords.filter(
      `[data-group-id="${idToShow}"]`
    );
    const popoverGroup = $(`[data-popover-group="${idToShow}"]`);

    $(document.body).addClass("hero-hover");

    if (highlightedWord.length) {
      $(highlightedWord[0]).addClass("word-active");
    }

    // Active relevant popover group
    popoverGroup.addClass("popover-active");

    // Play popover videos
    popoverGroup.find("video").each(function () {
      $(this).trigger("play");
    });
  }

  function hidePopoverById(idToHide) {
    const highlightedWord = $highlightedWords.filter(
      `[data-group-id="${idToHide}"]`
    );
    const popoverGroup = $(`[data-popover-group="${idToHide}"]`);

    $(document.body).removeClass("hero-hover");

    // Remove active word
    if (highlightedWord.length) {
      $(highlightedWord[0]).removeClass("word-active");
    }

    // Hide popover
    popoverGroup.removeClass("popover-active");

    // Pause popover videos
    popoverGroup.find("video").each(function () {
      $(this).trigger("pause");
    });
  }

  // Desktop: Apply hover behavior to show popovers on hover
  function applyHoverBehavior() {
    $highlightedWords.hover(
      // Show popover
      function () {
        const { id } = $(this).data("videos");
        showPopoversById(id);
      },
      // Hide popover
      function () {
        const { id } = $(this).data("videos");
        hidePopoverById(id);
      }
    );
  }

  // Play video on mouse enter
  $(".work-item").on("mouseenter", (e) => {
    if (screen.width <= 1023) return;
    $(e.currentTarget).find("video")[0]?.play(); // Play the video
  });

  // Pause video on mouse leave
  $(".work-item").on("mouseleave", (e) => {
    if (screen.width <= 1023) return;
    $(e.currentTarget).find("video")[0]?.pause(); // Pause the video
  });

  function initializeMobileObserver() {
    const videos = document.querySelectorAll(".work-item");
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
          $(mostCenteredVideo).find("video")[0]?.pause();
        }

        $(closestVideo).closest(".work-item").addClass("active");
        $(closestVideo).find("video")[0]?.play();
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
