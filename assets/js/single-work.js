(($) => {
  let lightboxSwiper;

  // Collect all work assets
  function getWorkAssets() {
    const assets = [];

    $(".work-content button[data-asset]").each(function () {
      const assetData = $(this).data("asset");

      if (assetData.url) {
        assets.push(assetData);
      }
    });

    return assets;
  }

  // Get the index of clicked asset among all assets (not all .work-content)
  function getAssetIndex(clickedButton) {
    const allAssetButtons = $(".work-content button[data-asset]");
    let index = -1;

    allAssetButtons.each(function (i) {
      if (this === clickedButton) {
        index = i;
        return false; // break the loop
      }
    });

    return index;
  }

  // Initialize Swiper
  function initLightboxSwiper(startIndex = 0) {
    const assets = getWorkAssets();

    if (assets.length === 0) {
      console.warn("No assets found");
      return;
    }

    const swiperWrapper = $(".slider-gallery .swiper-wrapper");

    // Clear existing slides
    swiperWrapper.empty();

    // Add slides based on asset type
    assets.forEach(function (asset) {
      let assetHtml;

      if (asset.type === "image") {
        assetHtml = `<img src="${asset.url}" alt="" />`;
      } else if (asset.type === "video") {
        assetHtml = `<video src="${asset.url}" playsinline loop>Your browser does not support the video tag.</video>`;
        if (asset.manual) {
          assetHtml += `<button class="toggle-mute hoverable absolute bottom-4 left-4 z-10 p-4">Mute</button>`;
        }
      }

      // Append all HTML assets
      swiperWrapper.append(`<div class="swiper-slide">${assetHtml}</div>`);
    });

    // Initialize or update Swiper
    if (lightboxSwiper) {
      lightboxSwiper.activeIndex = startIndex;
      lightboxSwiper.update();
    } else {
      lightboxSwiper = new Swiper(".slider-gallery .swiper", {
        initialSlide: startIndex,
        loop: assets.length > 1,
        navigation: {
          nextEl: ".slide-to-next",
          prevEl: ".slide-to-prev",
        },
        keyboard: {
          enabled: true,
          onlyInViewport: false,
        },
      });

      // Triggers the next video slide to play and pause the previous
      lightboxSwiper.on("slideChange", function (_swiper) {
        const prevSlide = _swiper.slides[_swiper.previousIndex];
        const activeSlide = _swiper.slides[_swiper.activeIndex];

        $(prevSlide).find("video")?.trigger("pause");
        $(activeSlide).find("video")?.trigger("play");
      });

      const activeSlide = lightboxSwiper.slides[lightboxSwiper.activeIndex];

      // Triggers the first video to play
      if ($(activeSlide).hasClass("swiper-slide-active")) {
        $(activeSlide).find("video").trigger("play");
      }
    }
  }

  // Open lightbox
  function openLightbox(index) {
    initLightboxSwiper(index);
    $(".slider-gallery").addClass("active").css("display", "block");
    $("body").addClass("overflow-hidden");
  }

  // Close lightbox
  function closeLightbox() {
    $(".slider-gallery").removeClass("active").css("display", "none");
    $("body").removeClass("overflow-hidden");

    // Pause all videos
    $(".slider-gallery video").each(function () {
      this.pause();
    });
  }

  // Handle work content asset clicks
  $(document).on("click", ".work-content button[data-asset]", function (e) {
    e.preventDefault();
    e.stopPropagation();

    const index = getAssetIndex(this);

    if (index !== -1) {
      openLightbox(index);
    }
  });

  // Close button handler
  $(document).on("click", ".slider-gallery .close-btn", function (e) {
    e.preventDefault();
    closeLightbox();
  });

  // ESC key to close
  $(document).keyup(function (e) {
    if (e.key === "Escape" && $(".slider-gallery").hasClass("active")) {
      closeLightbox();
    }
  });

  // Toggle sound for video slide
  $(".slider-gallery").on("click", ".toggle-mute", function () {
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
})(jQuery);
