(($) => {
  const setPopoverBodyClass = () => {
    $(document.body).toggleClass("popover-active");
  };

  // Toggle mobile menu
  $("button.hamburger").on("click", (e) => {
    let firstElToFade = ".lines";
    let lastElToFade = ".arrow";
    let temp;

    if ($(document.body).hasClass("popover-active")) {
      temp = firstElToFade;
      firstElToFade = lastElToFade;
      lastElToFade = temp;
    }

    setPopoverBodyClass();
    $(e.currentTarget)
      .find(firstElToFade)
      .fadeToggle(150, () => {
        $(e.currentTarget).find(lastElToFade).fadeToggle(150);
      });
    $("#site-navigation").fadeToggle(300);
  });

  // Reset mobile menu on resize
  $(window).on("resize", (e) => {
    if (screen.width >= 1024) {
      $(document.body).removeClass("popover-active");
      $("#site-navigation").removeAttr("style");
      return;
    }
  });

  // Set header sticky class
  $(window).on("scroll", (e) => {
    const header = document.getElementById("site-header");
    const sticky = header.offsetTop;

    if (window.scrollY > sticky) {
      document.body.classList.add("sticky-header");
    } else {
      document.body.classList.remove("sticky-header");
    }
  });
})(jQuery);
