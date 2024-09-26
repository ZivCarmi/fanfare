(($) => {
  let currentIndex = 0;
  const intervalTime = 4000; // 4 seconds
  let interval;
  const textContainer = $(".text-container");
  const $highlightedWords = $(".highlighted-word");

  intializePopoverHtml();

  const popovers = $(".custom-popover");
  const popoverIds = [
    ...new Set(popovers.map((_, popover) => $(popover).data("popoverId"))),
  ];

  function showPopoversById(idToShow) {
    const highlightedWord = $highlightedWords.filter(
      `[data-word-id="${idToShow}"]`
    );
    let popoversById = $(`.custom-popover[data-popover-id="${idToShow}"]`);
    const isMobile = screen.width <= 1023;

    // Hide all popovers first & disable its videos & Remove active words
    $highlightedWords.removeClass("text-secondary");
    popovers.removeClass("opacity-100 scale-100").addClass("opacity-0 scale-0");
    popovers.each(function () {
      $(this)
        .find("video")
        .each((_, video) => {
          video.pause();
        });
    });

    // Mobile: Deselect popovers based on data attribute
    if (isMobile) {
      popoversById = popoversById.not(`[data-mobile-visibility="${false}"]`);
    }

    if (highlightedWord.length) {
      $(highlightedWord[0]).addClass("text-secondary");
    }

    // Active relevant popovers
    popoversById
      .removeClass("opacity-0 scale-0")
      .addClass("opacity-100 scale-100");

    // Play popover videos
    popoversById.each(function () {
      $(this).find("video").trigger("play");
    });
  }

  // Mobile: Start rotating popovers
  function startPopoverRotation() {
    showPopoversById(popoverIds[currentIndex]);
    if (interval) clearInterval(interval);

    interval = setInterval(function () {
      currentIndex = (currentIndex + 1) % popoverIds.length;
      showPopoversById(popoverIds[currentIndex]);
    }, intervalTime);
  }

  // Stop popover rotation
  function stopPopoverRotation() {
    if (interval) clearInterval(interval);
    popovers.each(function () {
      hidePopoverById($(this).data("popoverId"));
    });
  }

  function intializePopoverHtml() {
    $highlightedWords.each(function () {
      // Get the popover data
      const $currentTarget = $(this);
      const videosData = $currentTarget.data("videos");

      if (videosData.videos.length === 0 || !videosData.videos[0].video) return;

      popoverHtmlBuilder(videosData);
    });
  }

  function popoverHtmlBuilder(videosData) {
    const { id, videos } = videosData;

    if (isNaN(id) || !videos || videos.length === 0 || !videos[0].video) return;

    let popoverHtml = "";

    if (videos.length === 1) {
      const { video } = videos[0];
      // Combination of text height and the popover inset
      let popoverHeight = `${textContainer.height() + 48 * 2}px`;

      if (screen.width <= 1023) {
        popoverHeight = "89px";
      }

      // Create the popover HTML
      popoverHtml = `
      <div class="custom-popover w-7/12 h-24 absolute bottom-full right-0 z-0 opacity-0 scale-0 mix-blend-luminosity transition-all duration-700 lg:-inset-12 lg:w-auto lg:h-auto" data-popover-id="${id}" data-mobile-visibility="${true}">
        <video class="w-full h-full object-cover rounded-sm opacity-50" width="100%" height="100%" muted loop>
            <source src="${video.url}">
            Your browser does not support HTML video.
        </video>
      </div>
      `;
    } else {
      const videosData = {
        0: {
          classes: "lg:w-[228px] lg:h-[202px] lg:top-[-17vh] lg:left-[13.3vw]",
          mobileVisibility: false,
        },
        1: {
          classes:
            "w-[140px] h-[82px] bottom-[calc(100%+1vh)] left-[16vw] lg:w-[315px] lg:h-[186px] lg:top-[-7.2vh] lg:right-[-3.5vw] lg:left-auto lg:bottom-auto",
          mobileVisibility: true,
        },
        2: {
          classes:
            "w-[90px] h-[77px] top-[calc(100%+2.3vh)] left-0 lg:w-[191px] lg:h-[174px] lg:top-[26vh] lg:right-[10vw] lg:left-auto",
          mobileVisibility: true,
        },
        3: {
          classes:
            "w-[154px] h-[169px] top-[calc(100%+7vh)] right-[4vw] lg:w-[172px] lg:h-[198px] lg:top-[13.3vh] lg:left-[-3.1vw] lg:right-auto",
          mobileVisibility: true,
        },
      };

      videos.forEach((_video, key) => {
        const { video, visibility } = _video;

        // Create the popover HTML
        popoverHtml += `
        <div class="custom-popover absolute opacity-0 scale-0 transition-all duration-700 ${
          visibility ? "z-10" : "z-0"
        } ${
          videosData[key].classes
        }" data-popover-id="${id}" data-mobile-visibility="${
          videosData[key].mobileVisibility
        }">
          <video class="w-full h-full absolute object-cover rounded-sm" width="100%" height="100%" muted loop>
            <source src="${video.url}">
            Your browser does not support HTML video.
          </video>
        </div>
        `;
      });
    }

    // Pause popover videos
    $(popoverHtml)
      .find("video")
      .each((_, video) => {
        video.pause();
      });

    // Append the popover
    textContainer.append(popoverHtml);
  }

  function hidePopoverById(idToHide) {
    const popoversById = $(`.custom-popover[data-popover-id="${idToHide}"]`);
    const highlightedWord = $highlightedWords.filter(
      `[data-word-id="${idToHide}"]`
    );

    // Remove active word
    if (highlightedWord.length) {
      $(highlightedWord[0]).removeClass("text-secondary");
    }

    // Hide popovers
    popoversById
      .removeClass("opacity-100 scale-100")
      .addClass("opacity-0 scale-0");

    // Pause popover videos
    popoversById.each(function () {
      $(this)
        .find("video")
        .each((_, video) => {
          video.pause();
        });
    });
  }

  // Function to check if on mobile and apply the correct behavior
  function checkMobile() {
    const isMobile = screen.width <= 1023;

    if (isMobile) {
      startPopoverRotation(); // Start popover rotation on mobile
    } else {
      stopPopoverRotation(); // Stop the interval on desktop
      applyHoverBehavior(); // Enable hover behavior on desktop
    }
  }

  // Desktop: Apply hover behavior to show popovers on hover
  function applyHoverBehavior() {
    $highlightedWords.hover(
      function () {
        const { id } = $(this).data("videos");
        showPopoversById(id);
      },
      // Hide popover
      function () {
        // Get the popover data
        const { id } = $(this).data("videos");

        hidePopoverById(id);
      }
    );
  }

  checkMobile();

  $(window).on("resize", () => {
    checkMobile();
  });
})(jQuery);
