(($) => {
  const cursor = $("#site-cursor");
  const cursorCircle = $("#site-cursor .cursor-circle");
  const cursorOverlayCircle = $("#site-cursor-overlay .cursor-circle");
  const cursorBigValue = 50;
  const cursorTooltip = cursor.find(".tooltip");
  const cursorProjectName = cursor.find(".project-name");
  const preloader = $("#preloader");

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
      `translate3d(${e.clientX}px, ${e.clientY}px, 0) translate(-50%, -50%)`,
    );
  });

  // Cursor grow on each hovered link
  $("a").on("mouseenter", function () {
    if (screen.width <= 1024) return;

    const tooltipData = $(this).data("cursorTooltip");
    const projectData = $(this).data("cursorProject");

    // Hover over project
    if (projectData) {
      cursor.addClass("project");

      cursorProjectName.find("div").html(projectData);

      const projectNameWidth = cursor.find(".project-name div").outerWidth();
      cursorProjectName.width(projectNameWidth);

      return;
    }

    // Hover over tooltip
    if (tooltipData) {
      cursor.addClass("tooltip");

      cursor.find(".tooltip").html(tooltipData).addClass("opacity-100");
    }

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

    // Remove all classes
    cursor.removeClass("project tooltip");

    $(".cursor-circle").removeAttr("style");
    cursorProjectName.removeAttr("style");
    cursorProjectName.find("div").html("");
    cursorTooltip.html("");
  });

  // Apply mouse effect for every link & button
  $(document.body).on("mouseenter", ".hoverable", function () {
    if (screen.width <= 1024) return;
    cursor.addClass("text");
  });
  $(document.body).on("mouseleave", ".hoverable", function () {
    if (screen.width <= 1024) return;
    cursor.removeClass("text");
  });

  // Disable cursor effect for inputs
  $("input, textarea").on("mouseenter", function () {
    if (screen.width <= 1024) return;
    cursor.css("opacity", 0);
  });
  $("input, textarea").on("mouseleave", function () {
    if (screen.width <= 1024) return;
    cursor.css("opacity", 1);
  });

  $(window).on("resize", () => {
    shouldUseCustomCursor();
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
  $(".menu-item.contact-form a").on("click", function (e) {
    e.preventDefault();
    $(document.body).addClass("overflow-hidden");
    $(".fanfare-form-popup").fadeIn();
  });

  // Close the popup if click outside of it
  $(".fanfare-form-popup").on("click", function (e) {
    $(document.body).removeClass("overflow-hidden");
    $(this).fadeOut();
  });

  // Close the popup if click outside of it
  $(".fanfare-form-popup .close-btn").on("click", function (e) {
    $(document.body).removeClass("overflow-hidden");
    $(".fanfare-form-popup").fadeOut();
  });

  // Prevent close if click on the popup itself
  $(".fanfare-form-popup .form-popup").on("click", (e) => {
    e.stopPropagation();
  });

  // Show copyright effect: Congratulations!
  $(".copyright .year").hover(function () {
    const slideInEl = $(this).next();
    const slideInElWidth = slideInEl.width();

    $(this).css("--tw-translate-x", `calc(-${slideInElWidth}px - 8px)`);
  });

  // Reset popovers on resize
  $(window).on("resize", (e) => {
    if (screen.width >= 1024) {
      $(document.body).removeClass("popover-active");
      $(document.body).removeClass("mobile-menu-open");
      $("#mobile-menu-toggle").attr("aria-expanded", "false");
    }
  });

  // Mobile menu toggle
  const mobileMenuToggle = $("#mobile-menu-toggle");
  const mobileMenuScrim = $("#mobile-menu-scrim");

  function closeMobileMenu() {
    $(document.body).removeClass("mobile-menu-open");
    mobileMenuToggle.attr("aria-expanded", "false").attr("aria-label", "Open menu");
  }

  function openMobileMenu() {
    $(document.body).addClass("mobile-menu-open");
    mobileMenuToggle.attr("aria-expanded", "true").attr("aria-label", "Close menu");
  }

  mobileMenuToggle.on("click", function () {
    if ($(document.body).hasClass("mobile-menu-open")) {
      closeMobileMenu();
    } else {
      openMobileMenu();
    }
  });

  mobileMenuScrim.on("click", closeMobileMenu);

  $(document).on("keydown", function (e) {
    if (e.key === "Escape" && $(document.body).hasClass("mobile-menu-open")) {
      closeMobileMenu();
    }
  });

  function delayedNavigation(url) {
    $(document.body).removeClass("mobile-menu-open");
    $("#mobile-menu-toggle").attr("aria-expanded", "false");
    preloader.removeClass("loaded").addClass("loading");

    setTimeout(() => {
      window.location.href = url;
    }, 1250); // Delay in milliseconds
  }

  // Intercept all internal link clicks
  $("a").on("click", function (e) {
    const url = $(this).attr("href");
    const windowHref = window.location.href;
    const location = windowHref.substring(0, windowHref.lastIndexOf("/"));
    const isHomeWhileAtHome =
      $(document.body).hasClass("home") && url === location;
    const contactLink = $(this).closest(".contact-form").length;
    const excludedLinks = !url || contactLink || url.includes("#");

    // Mainly for logo link while at homepage
    if (isHomeWhileAtHome) {
      e.preventDefault();
      return;
    }

    if (url && url.startsWith(window.location.origin) && !excludedLinks) {
      e.preventDefault(); // Prevent immediate navigation
      $("html").removeClass("cursor-mode");
      if ($(this).closest("#mobile-menu-panel").length) {
        closeMobileMenu();
      }
      delayedNavigation(url); // Navigate with delay
    }
  });

  // Preloader after page load
  window.addEventListener("load", function () {
    preloader.addClass("loading");

    setTimeout(() => {
      preloader.addClass("loaded").removeClass("loading");
      shouldUseCustomCursor();
    }, 500);
  });

  $(document.body).on("added_to_cart", function () {
    $(".mini-cart-dropdown").addClass("show");

    setTimeout(() => {
      $(".mini-cart-dropdown").removeClass("show");
    }, 4000);
  });
})(jQuery);

const videos = document.querySelectorAll("video[data-lazy-load]"); // Select ALL the Videos
if (videos.length > 0) {
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
    { threshold: 0.075 },
  );

  // Observe EACH video
  for (const video of videos) {
    observer.observe(video);
  }

  const onVisibilityChange = () => {
    if (document.hidden) {
      for (const video of videos) video.pause(); // Pause EACH video
    } else {
      for (const video of videos) {
        video.play();
      } // Play EACH video
    }
  };
  document.addEventListener("visibilitychange", onVisibilityChange);
}
