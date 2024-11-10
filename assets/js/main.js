(($) => {
  const cursor = $("#site-cursor");
  const cursorCircle = $("#site-cursor .cursor-circle");
  const cursorOverlayCircle = $("#site-cursor-overlay .cursor-circle");
  const cursorBigValue = 50;
  const preloader = $("#preloader");
  const hamburgerLines = $("button.hamburger .lines");
  const hamburgerArrow = $("button.hamburger .arrow");

  function shouldUseCustomCursor() {
    if (screen.width >= 1024) {
      $("html").addClass("cursor-mode");
    } else {
      $("html").removeClass("cursor-mode");
    }
  }

  // Track mouse movement
  $(document).on("mousemove", (e) => {
    $("#site-cursor, #site-cursor-overlay").css(
      "transform",
      `translate3d(${e.clientX}px, ${e.clientY}px, 0) translate(-50%, -50%)`
    );
  });

  // Cursor grow on each hovered link
  $("a").on("mouseenter", function () {
    if (screen.width <= 1024) return;

    cursorCircle.css({
      width: cursorBigValue,
      height: cursorBigValue,
    });
    setTimeout(() => {
      cursorOverlayCircle.css({
        width: cursorBigValue,
        height: cursorBigValue,
      });
    }, 10);
  });
  $("a").on("mouseleave", function () {
    if (screen.width <= 1024) return;

    $(".cursor-circle").removeAttr("style");
  });

  // Apply mouse effect for every link & button
  $(".hoverable-content a, .hoverable-content button, .hoverable").on(
    "mouseenter",
    function () {
      if (screen.width <= 1024) return;

      cursor.addClass("text");
    }
  );
  $(".hoverable-content a, .hoverable-content button, .hoverable").on(
    "mouseleave",
    function () {
      if (screen.width <= 1024) return;

      cursor.removeClass("text");
    }
  );

  // Disable cursor effect for inputs
  $("input, textarea").on("mouseenter", function () {
    if (screen.width <= 1024) return;

    cursor.css("opacity", 0);
  });
  $("input, textarea").on("mouseleave", function () {
    if (screen.width <= 1024) return;

    cursor.css("opacity", 1);
  });

  $("a[data-cursor-tooltip]").on("mouseenter", function (e) {
    const tooltipText = $(this).data("cursorTooltip");
    cursorCircle.find(".text").html(tooltipText).addClass("opacity-100");
  });

  $("a[data-cursor-tooltip]").on("mouseleave", function () {
    cursorCircle.find(".text").html("").removeClass("opacity-100");
  });

  $(window).on("resize", (e) => {
    shouldUseCustomCursor();
  });

  // Toggle mobile menu
  $("button.hamburger").on("click", (e) => {
    if ($("#site-navigation").hasClass("active")) {
      // Fade out arrow, fade in hamburger
      hamburgerArrow.fadeOut(75, function () {
        hamburgerLines.fadeIn(75);
      });
    } else {
      // Fade out hamburger, fade in arrow
      hamburgerLines.fadeOut(75, function () {
        hamburgerArrow.fadeIn(75);
      });
    }

    // Menu is closed, open the menu by sliding in from the right
    $("#site-navigation").toggleClass("active");
  });

  // Set header sticky class
  $(window).on("scroll", () => {
    const header = document.getElementById("site-header");
    const sticky = header.offsetTop;

    if (window.scrollY > sticky) {
      document.body.classList.add("sticky-header");
    } else {
      document.body.classList.remove("sticky-header");
    }
  });

  // Desktop: Show fanfare form
  $(".menu-item.lets-fanfare a").on("click", function (e) {
    if (screen.width <= 1023) return;

    e.preventDefault();

    $(".fanfare-form-popup").fadeIn();
  });

  // Close the popup if click outside of it
  $(".fanfare-form-popup").on("click", function (e) {
    $(this).fadeOut();
  });

  // Close the popup if click outside of it
  $(".fanfare-form-popup .close-btn").on("click", function (e) {
    $(".fanfare-form-popup").fadeOut();
  });

  // Prevent close if click on the popup itself
  $(".fanfare-form-popup .form-popup").on("click", (e) => {
    e.stopPropagation();
  });

  // Show copyright effect Hoo-Yeaah
  $(".copyright .year").hover(function () {
    const slideInEl = $(this).next();
    const slideInElWidth = slideInEl.width();

    $(this).css("--tw-translate-x", `calc(-${slideInElWidth}px - 8px)`);
  });

  // Reset popovers on resize
  $(window).on("resize", (e) => {
    if (screen.width >= 1024) {
      $(document.body).removeClass("popover-active");
      $("#site-navigation").removeAttr("style");
    } else {
      $(".fanfare-form-popup").hide();
    }
  });

  function delayedNavigation(url) {
    preloader.removeClass("loaded").addClass("loading");

    setTimeout(() => {
      window.location.href = url;
    }, 1250); // Delay in milliseconds
  }

  // Intercept all internal link clicks
  $("a").on("click", function (e) {
    const url = $(this).attr("href");
    const excludedLinks =
      $(this).closest(".lets-fanfare").length || url.includes("#");

    if (url && url.startsWith(window.location.origin) && !excludedLinks) {
      e.preventDefault(); // Prevent immediate navigation

      $("html").removeClass("cursor-mode");

      delayedNavigation(url); // Navigate with delay
    }
  });

  // Preloader after page load
  window.addEventListener("load", function () {
    const loadTime =
      window.performance.timing.domContentLoadedEventEnd -
      window.performance.timing.navigationStart;
    const loadingTracker = $("#loading-bar-tracker");
    const startTime = Date.now();

    preloader.addClass("loading");

    function animate() {
      const elapsed = Date.now() - startTime;
      const progress = Math.min((elapsed / loadTime) * 100, 100); // Ensure it doesn't exceed 100%
      loadingTracker.width(`${progress}%`);

      if (progress < 100) {
        requestAnimationFrame(animate);
      } else {
        setTimeout(() => {
          loadingTracker.width(0);
          preloader.addClass("loaded").removeClass("loading");
          shouldUseCustomCursor();
        }, 500);
      }
    }

    requestAnimationFrame(animate);
  });
})(jQuery);

const videos = document.querySelectorAll("video[data-lazy-load]"); // Select ALL the Videos
const observer = new IntersectionObserver(
  (entries) => {
    entries.forEach((entry) => {
      if (!entry.isIntersecting) {
        entry.target.pause(); // Pause the TARGET video
      } else {
        entry.target.play(); // Play the TARGET video
      }
    });
  },
  { threshold: 0.25 }
);

// Observe EACH video
for (const video of videos) {
  observer.observe(video);
}

const onVisibilityChange = () => {
  if (document.hidden) {
    for (const video of videos) video.pause(); // Pause EACH video
  } else {
    for (const video of videos) video.play(); // Play EACH video
  }
};
document.addEventListener("visibilitychange", onVisibilityChange);
