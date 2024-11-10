// (($) => {
//   let currentIndex = 0;
//   const intervalTime = 4000; // 4 seconds
//   let interval;
//   const textContainer = $(".text-container");
//   const $highlightedWords = $(".highlighted-word");

//   intializePopoverHtml();

//   const popovers = $(".custom-popover");
//   const popoverIds = [
//     ...new Set(popovers.map((_, popover) => $(popover).data("popoverId"))),
//   ];

//   function showPopoversById(idToShow) {
//     const highlightedWord = $highlightedWords.filter(
//       `[data-word-id="${idToShow}"]`
//     );
//     let popoversById = $(`.custom-popover[data-popover-id="${idToShow}"]`);
//     const isMobile = screen.width <= 1023;

//     // Hide all popovers first & disable its videos & Remove active words
//     $highlightedWords.removeClass("text-secondary");
//     popovers.removeClass("opacity-100 scale-100").addClass("opacity-0 scale-0");
//     popovers.each(function () {
//       $(this)
//         .find("video")
//         .each((_, video) => {
//           video.pause();
//         });
//     });

//     // Mobile: Deselect popovers based on data attribute
//     if (isMobile) {
//       popoversById = popoversById.not(`[data-mobile-visibility="${false}"]`);
//     }

//     if (highlightedWord.length) {
//       $(highlightedWord[0]).addClass("text-secondary");
//     }

//     // Active relevant popovers
//     popoversById
//       .removeClass("opacity-0 scale-0")
//       .addClass("opacity-100 scale-100");

//     // Play popover videos
//     popoversById.each(function () {
//       $(this).find("video").trigger("play");
//     });
//   }

//   // Mobile: Start rotating popovers
//   function startPopoverRotation() {
//     showPopoversById(popoverIds[currentIndex]);
//     if (interval) clearInterval(interval);

//     interval = setInterval(function () {
//       currentIndex = (currentIndex + 1) % popoverIds.length;
//       showPopoversById(popoverIds[currentIndex]);
//     }, intervalTime);
//   }

//   // Stop popover rotation
//   function stopPopoverRotation() {
//     if (interval) clearInterval(interval);
//     popovers.each(function () {
//       hidePopoverById($(this).data("popoverId"));
//     });
//   }

//   function intializePopoverHtml() {
//     $highlightedWords.each(function () {
//       // Get the popover data
//       const $currentTarget = $(this);
//       const videosData = $currentTarget.data("videos");

//       if (videosData.videos.length === 0 || !videosData.videos[0].video) return;

//       popoverHtmlBuilder(videosData);
//     });
//   }

//   function popoverHtmlBuilder(videosData) {
//     const { id, videos } = videosData;

//     if (isNaN(id) || !videos || videos.length === 0 || !videos[0].video) return;

//     let popoverHtml = "";

//     if (videos.length === 1) {
//       const { video } = videos[0];

//       // Create the popover HTML
//       popoverHtml = `<div class="custom-popover w-7/12 h-24 absolute bottom-full right-0 z-0 opacity-0 scale-0 mix-blend-luminosity transition-all duration-700 lg:-inset-12 lg:w-auto lg:h-auto" data-popover-id="${id}" data-mobile-visibility="${true}">`;

//       if (video.type === "video") {
//         popoverHtml += `
//         <video preload="none" class="w-full h-full object-cover rounded-2px opacity-50" width="100%" height="100%" playsinline muted loop>
//             <source src="${video.url}">
//             Your browser does not support HTML video.
//         </video>`;
//       } else if (video.type === "image") {
//         popoverHtml += `<img src="${video.url}" class="h-full m-auto rounded-2px opacity-50" />`;
//       }

//       popoverHtml += "</div>";
//     } else {
//       let videosData;

//       if (videos.length <= 4) {
//         videosData = {
//           0: {
//             classes:
//               "lg:w-[228px] lg:h-[202px] lg:top-[-17vh] lg:left-[13.3vw]",
//             mobileVisibility: false,
//           },
//           1: {
//             classes:
//               "w-[140px] h-[82px] bottom-[calc(100%+1vh)] left-[16vw] lg:w-[315px] lg:h-[186px] lg:top-[-7.2vh] lg:right-[-3.5vw] lg:left-auto lg:bottom-auto",
//             mobileVisibility: true,
//           },
//           2: {
//             classes:
//               "w-[90px] h-[77px] top-[calc(100%+2.3vh)] left-0 lg:w-[191px] lg:h-[174px] lg:top-[26vh] lg:right-[10vw] lg:left-auto",
//             mobileVisibility: true,
//           },
//           3: {
//             classes:
//               "w-[154px] h-[169px] top-[calc(100%+7vh)] right-[4vw] lg:w-[172px] lg:h-[198px] lg:top-[13.3vh] lg:left-[-3.1vw] lg:right-auto",
//             mobileVisibility: true,
//           },
//         };
//       } else if (videos.length <= 9) {
//         videosData = {
//           0: {
//             classes:
//               "lg:w-[165px] lg:h-[154px] lg:bottom-[calc(100%+5.5vh)] lg:left-[32%]",
//             mobileVisibility: true,
//           },
//           1: {
//             classes:
//               "w-[140px] h-[82px] bottom-[calc(100%+1vh)] left-[16vw] lg:w-[295px] lg:h-[83px] lg:bottom-[calc(100%+2vh)] lg:right-[4vw] lg:left-auto",
//             mobileVisibility: true,
//           },
//           2: {
//             classes:
//               "w-[90px] h-[77px] top-[calc(100%+2.3vh)] left-0 lg:w-[126px] lg:h-[142px] lg:top-[-4vh] lg:left-[calc(100%+2vw)]",
//             mobileVisibility: true,
//           },
//           3: {
//             classes:
//               "w-[154px] h-[169px] top-[calc(100%+7vh)] right-[4vw] lg:w-[310px] lg:h-[91px] lg:top-[calc(100%+2vh)] lg:right-[-10vw]",
//             mobileVisibility: true,
//           },
//           4: {
//             classes:
//               "lg:w-[82px] lg:h-[114px] lg:top-[calc(100%+19vh)] lg:left-[70%]",
//             mobileVisibility: true,
//           },
//           5: {
//             classes:
//               "w-[140px] h-[82px] bottom-[calc(100%+1vh)] left-[16vw] lg:w-[383px] lg:h-[153px] lg:top-[calc(100%+4.5vh)] lg:left-[10vw] lg:bottom-auto",
//             mobileVisibility: true,
//           },
//           6: {
//             classes:
//               "w-[90px] h-[77px] top-[calc(100%+2.3vh)] left-0 lg:w-[366px] lg:h-[201px] lg:top-[calc(100%+4vh)] lg:right-[calc(100%-5.5vw)] lg:left-auto",
//             mobileVisibility: true,
//           },
//           7: {
//             classes:
//               "w-[154px] h-[169px] top-[calc(100%+7vh)] right-[4vw] lg:w-[181px] lg:h-[138px] lg:top-[2vh] lg:right-[calc(100%+3vw)]",
//             mobileVisibility: true,
//           },
//           8: {
//             classes:
//               "lg:w-[405px] lg:h-[49px] lg:bottom-[calc(100%+4vh)] lg:left-[-15%]",
//             mobileVisibility: true,
//           },
//         };
//       }

//       videos.forEach((_video, key) => {
//         const { video, visibility } = _video;

//         // Create the popover HTML
//         popoverHtml += `
//         <div class="custom-popover absolute opacity-0 scale-0 transition-all duration-700 ${
//           visibility ? "z-10" : "z-0"
//         } ${
//           videosData[key].classes
//         }" data-popover-id="${id}" data-mobile-visibility="${
//           videosData[key].mobileVisibility
//         }">`;

//         if (video.type === "video") {
//           popoverHtml += `
//           <video preload="none" class="w-full h-full absolute object-cover rounded-2px" width="100%" height="100%" playsinline muted loop>
//             <source src="${video.url}">
//             Your browser does not support HTML video.
//           </video>`;
//         } else if (video.type === "image") {
//           popoverHtml += `<img src="${video.url}" class="w-full h-full absolute" width="${video.width}" height="${video.height}" />`;
//         }

//         popoverHtml += "</div>";
//       });
//     }

//     // Pause popover videos
//     $(popoverHtml)
//       .find("video")
//       .each((_, video) => {
//         video.pause();
//       });

//     // Append the popover
//     textContainer.append(popoverHtml);
//   }

//   function hidePopoverById(idToHide) {
//     const popoversById = $(`.custom-popover[data-popover-id="${idToHide}"]`);
//     const highlightedWord = $highlightedWords.filter(
//       `[data-word-id="${idToHide}"]`
//     );

//     // Remove active word
//     if (highlightedWord.length) {
//       $(highlightedWord[0]).removeClass("text-secondary");
//     }

//     // Hide popovers
//     popoversById
//       .removeClass("opacity-100 scale-100")
//       .addClass("opacity-0 scale-0");

//     // Pause popover videos
//     popoversById.each(function () {
//       $(this)
//         .find("video")
//         .each((_, video) => {
//           video.pause();
//         });
//     });
//   }

//   // Function to check if on mobile and apply the correct behavior
//   function checkMobile() {
//     const isMobile = screen.width <= 1023;

//     if (isMobile) {
//       startPopoverRotation(); // Start popover rotation on mobile
//     } else {
//       stopPopoverRotation(); // Stop the interval on desktop
//       applyHoverBehavior(); // Enable hover behavior on desktop
//     }
//   }

//   // Desktop: Apply hover behavior to show popovers on hover
//   function applyHoverBehavior() {
//     $highlightedWords.hover(
//       function () {
//         const { id } = $(this).data("videos");
//         showPopoversById(id);
//       },
//       // Hide popover
//       function () {
//         // Get the popover data
//         const { id } = $(this).data("videos");

//         hidePopoverById(id);
//       }
//     );
//   }

//   checkMobile();

//   $(window).on("resize", () => {
//     checkMobile();
//   });

//   const swiper = new Swiper(".swiper", {
//     loop: true,
//     preventClicks: true,
//     preventClicksPropagation: false,
//     simulateTouch: true,
//     touchStartPreventDefault: true,
//     watchSlidesProgress: true,

//     // If we need pagination
//     pagination: {
//       el: ".swiper-pagination",
//     },

//     on: {
//       touchMove: function () {
//         $(".swiper-slide a").each((key, link) => {
//           $(link).css("pointer-events", "none");
//         });
//       },
//       touchEnd: function () {
//         $(".swiper-slide a").each((key, link) => {
//           $(link).css("pointer-events", "all");
//         });
//       },
//     },
//   });

//   // Slide to next button
//   $(".slide-to-next").on("click", function (e) {
//     swiper.slideNext();
//   });

//   // Slide to next when video ended
//   $(".swiper-slide video").on("ended", function () {
//     swiper.slideNext();
//   });
// })(jQuery);

(($) => {
  let currentIndex = 0;
  const intervalTime = 4000; // 4 seconds
  let interval;
  const textContainer = $(".text-container");
  const $highlightedWords = $(".highlighted-word");

  intializePopoverHtml();

  const popovers = $(".popover-group");
  const popoverIds = [
    ...popovers.map((_, popover) => $(popover).data("popoverGroup")),
  ];

  function showPopoversById(idToShow) {
    const highlightedWord = $highlightedWords.filter(
      `[data-group-id="${idToShow}"]`
    );
    const popoverGroup = $(`[data-popover-group="${idToShow}"]`);

    // Remove active words
    $highlightedWords.removeClass("text-secondary");

    // Hide all popovers first
    popovers.removeClass("popover-active");

    // Disable popover videos
    $(".popover-active video").each(function (_, video) {
      video.pause();
    });

    if (highlightedWord.length) {
      $(highlightedWord[0]).addClass("text-secondary");
    }

    // Active relevant popover group
    popoverGroup.addClass("popover-active");

    // Play popover videos
    popoverGroup.find("video").each(function () {
      $(this).trigger("play");
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
  }

  function popoverHtmlBuilder(videosData) {
    const { id, videos } = videosData;

    if (isNaN(id) || !videos || videos.length === 0 || !videos[0].video) return;

    let popoverHtml = "";

    if (videos.length === 1) {
      const { video } = videos[0];

      // Create the popover HTML
      popoverHtml = `<div class="custom-popover w-7/12 h-24 absolute bottom-full right-0 z-0 opacity-0 scale-0 mix-blend-luminosity transition-all duration-700 lg:-inset-12 lg:w-auto lg:h-auto" data-popover-id="${id}" data-mobile-visibility="${true}">`;

      if (video.type === "video") {
        popoverHtml += `
        <video preload="none" class="w-full h-full object-cover rounded-2px opacity-50" width="100%" height="100%" playsinline muted loop>
            <source src="${video.url}">
            Your browser does not support HTML video.
        </video>`;
      } else if (video.type === "image") {
        popoverHtml += `<img src="${video.url}" class="h-full m-auto rounded-2px opacity-50" />`;
      }

      popoverHtml += "</div>";
    } else {
      const isLessOrEqualToFour = videos.length <= 4;
      let videosData;

      if (isLessOrEqualToFour) {
        videosData = {
          0: {
            classes: "h-[202px] top-[-17vh] left-[10vw]",
            mobileVisibility: false,
          },
          1: {
            classes:
              "w-[140px] h-[82px] left-[50%] -translate-x-1/2 lg:w-auto lg:h-[186px] lg:top-[-7.2vh] lg:right-[-6.2vw] lg:left-auto lg:-translate-x-0",
            mobileVisibility: true,
          },
          2: {
            classes:
              "w-[90px] h-[77px] top-[15vh] left-[4%] lg:w-auto lg:h-[174px] lg:top-[26vh] lg:right-[6.3vw] lg:left-auto",
            mobileVisibility: true,
          },
          3: {
            classes:
              "w-[184px] h-[111px] top-[18vh] right-0 lg:w-auto lg:h-[198px] lg:top-[13.3vh] lg:left-[-7vw] lg:right-auto",
            mobileVisibility: true,
          },
        };
      } else if (videos.length <= 9) {
        videosData = {
          0: {
            classes:
              "h-[53px] lg:w-[165px] lg:h-[154px] lg:bottom-[calc(100%+5.5vh)] lg:left-[32%]",
            mobileVisibility: true,
          },
          1: {
            classes:
              "h-[30px] lg:w-[295px] lg:h-[83px] lg:bottom-[calc(100%+2vh)] lg:left-[60%]",
            mobileVisibility: true,
          },
          2: {
            classes:
              "h-[49px] lg:w-[126px] lg:h-[142px] lg:top-[-4vh] lg:left-[calc(100%+2vw)]",
            mobileVisibility: true,
          },
          3: {
            classes:
              "h-[29px] lg:w-[310px] lg:h-[91px] lg:top-[calc(100%+2vh)] lg:right-[-10vw]",
            mobileVisibility: true,
          },
          4: {
            classes:
              "h-[42px] lg:w-[82px] lg:h-[114px] lg:top-[calc(100%+19vh)] lg:left-[70%]",
            mobileVisibility: true,
          },
          5: {
            classes:
              "h-[55px] lg:w-[383px] lg:h-[153px] lg:top-[calc(100%+4.5vh)] lg:right-[37%]",
            mobileVisibility: true,
          },
          6: {
            classes:
              "h-[61px] lg:w-[366px] lg:h-[201px] lg:top-[calc(100%+4vh)] lg:left-[-14vw]",
            mobileVisibility: true,
          },
          7: {
            classes:
              "h-[68px] lg:w-[181px] lg:h-[138px] lg:top-[2vh] lg:right-[calc(100%+3vw)]",
            mobileVisibility: true,
          },
          8: {
            classes:
              "h-[12px] lg:w-[405px] lg:h-[49px] lg:bottom-[calc(100%+4vh)] lg:left-[-7.5vw]",
            mobileVisibility: true,
          },
        };
      }

      popoverHtml += `<div class="popover-group" data-popover-group="${id}">`;

      videos.forEach((_video, key) => {
        const { video, visibility } = _video;

        // Create the popover HTML
        popoverHtml += `
        <div class="custom-popover ${visibility ? "z-10" : "z-0"} ${
          videosData[key]?.classes
        } ${
          isLessOrEqualToFour ? "absolute" : "lg:absolute"
        } " data-mobile-visibility="${videosData[key]?.mobileVisibility}">`;

        if (video.type === "video") {
          popoverHtml += `
          <video preload="none" class="w-full h-full object-cover rounded-2px" width="100%" height="100%" playsinline muted loop>
            <source src="${video.url}">
            Your browser does not support HTML video.
          </video>`;
        } else if (video.type === "image") {
          popoverHtml += `<img src="${video.url}" class="w-full h-full" width="${video.width}" height="${video.height}" />`;
        }

        popoverHtml += "</div>";
      });

      popoverHtml += "</div>";
    }

    // Pause popover videos
    $(popoverHtml)
      .find("video")
      .each((_, video) => {
        video.pause();
      });

    return popoverHtml;
  }

  function hidePopoverById(idToHide) {
    const popoverGroup = $(`[data-popover-group="${idToHide}"]`);
    const highlightedWord = $highlightedWords.filter(
      `[data-group-id="${idToHide}"]`
    );

    // Remove active word
    if (highlightedWord.length) {
      $(highlightedWord[0]).removeClass("text-secondary");
    }

    // Hide popover
    popoverGroup.removeClass("popover-active");

    // Pause popover videos
    popoverGroup.find("video").each(function (_, video) {
      video.pause();
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

  checkMobile();

  $(window).on("resize", () => {
    checkMobile();
  });

  const swiper = new Swiper(".swiper", {
    loop: true,
    preventClicks: true,
    preventClicksPropagation: false,
    simulateTouch: true,
    touchStartPreventDefault: true,
    watchSlidesProgress: true,

    // If we need pagination
    pagination: {
      el: ".swiper-pagination",
    },

    on: {
      touchMove: function () {
        $(".swiper-slide a").each((key, link) => {
          $(link).css("pointer-events", "none");
        });
      },
      touchEnd: function () {
        $(".swiper-slide a").each((key, link) => {
          $(link).css("pointer-events", "all");
        });
      },
    },
  });

  // Slide to next button
  $(".slide-to-next").on("click", function (e) {
    swiper.slideNext();
  });

  // Slide to next when video ended
  $(".swiper-slide video").on("ended", function () {
    swiper.slideNext();
  });
})(jQuery);
