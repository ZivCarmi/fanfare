(($) => {
  const $price = $(".summary .price");
  let swiper;
  let lightboxSwiper;

  $("form.variations_form")
    .on("show_variation", function (event, variation) {
      if (variation && variation.price_html) {
        $price.html(variation.price_html);
      }
    })
    .on("hide_variation", function () {
      // חזרה ל־FROM מחיר מינימלי אם אין וריאציה נבחרת
      $price.html($price.data("from-price"));
    });

  // שמירת מחיר ה־FROM המקורי
  if (!$price.data("from-price")) {
    $price.data("from-price", $price.html());
  }

  $("form.cart").on("click", ".qty-plus, .qty-minus", function () {
    const $qty = $(this).siblings("input.qty");
    let current = parseFloat($qty.val());
    const min = parseFloat($qty.attr("min")) || 1;
    const max = parseFloat($qty.attr("max")) || Infinity;
    const step = parseFloat($qty.attr("step")) || 1;

    if ($(this).hasClass("qty-plus")) {
      if (current + step <= max) {
        $qty.val(current + step).change();
      }
    } else {
      if (current - step >= min) {
        $qty.val(current - step).change();
      }
    }
  });

  // so links can have the cursor effect
  $(".description a").addClass("hoverable");

  // Collect all product images
  function getProductImages() {
    const images = [];

    $(
      ".woocommerce-product-gallery__wrapper .woocommerce-product-gallery__image",
    ).each(function () {
      const $link = $(this).find("a");
      const imageUrl = $link.attr("href") || $link.attr("data-original-href");
      const imageAlt = $link.find("img").attr("alt") || "Product Image";

      if (imageUrl) {
        images.push({ url: imageUrl, alt: imageAlt });
      }
    });

    return images;
  }

  // Initialize Swiper
  function initLightboxSwiper(startIndex = 0) {
    const images = getProductImages();
    const swiperWrapper = $(".slider-gallery .swiper-wrapper");

    // Clear existing slides
    swiperWrapper.empty();

    // Add slides
    images.forEach(function (image) {
      swiperWrapper.append(
        `<div class="swiper-slide"><img src="${image.url}" alt="${image.alt}"></div>`,
      );
    });

    // Destroy existing swiper if it exists
    if (lightboxSwiper) {
      lightboxSwiper.destroy(true, true);
    }

    // Initialize new Swiper
    lightboxSwiper = new Swiper(".slider-gallery .swiper", {
      initialSlide: startIndex,
      loop: images.length > 1,
      navigation: {
        nextEl: ".slide-to-next",
        prevEl: ".slide-to-prev",
      },
      keyboard: {
        enabled: true,
        onlyInViewport: false,
      },
    });
  }

  // Open lightbox
  function openLightbox(index) {
    initLightboxSwiper(index);
    $(".slider-gallery").addClass("active").css("display", "block");
    $(document.body).addClass("overflow-hidden");
  }

  // Close lightbox
  function closeLightbox() {
    $(".slider-gallery").removeClass("active").css("display", "none");
    $(document.body).removeClass("overflow-hidden");

    setTimeout(function () {
      if (lightboxSwiper) {
        lightboxSwiper.destroy(true, true);
      }
    }, 300);
  }

  // CRITICAL: Use native event listener with capture to intercept before any other handlers
  function attachLightboxHandlers() {
    // Get all image links
    const imageLinks = document.querySelectorAll(
      ".woocommerce-product-gallery__wrapper .woocommerce-product-gallery__image a",
    );

    imageLinks.forEach(function (link, index) {
      // Remove href temporarily to prevent default navigation
      const originalHref = link.getAttribute("href");
      link.setAttribute("data-original-href", originalHref);
      link.removeAttribute("href");

      // Add click handler
      link.addEventListener(
        "click",
        function (e) {
          e.preventDefault();
          e.stopPropagation();
          e.stopImmediatePropagation();

          openLightbox(index);

          return false;
        },
        true,
      );

      // Also add to the parent div
      link.parentElement.addEventListener(
        "click",
        function (e) {
          e.preventDefault();
          e.stopPropagation();
          e.stopImmediatePropagation();

          openLightbox(index);

          return false;
        },
        true,
      );
    });
  }

  // Wait for gallery to be fully loaded
  if ($(".woocommerce-product-gallery__wrapper").length) {
    attachLightboxHandlers();
  } else {
    setTimeout(attachLightboxHandlers, 500);
  }

  // Also listen for any dynamically added images
  const observer = new MutationObserver(function (mutations) {
    attachLightboxHandlers();
  });

  const gallery = document.querySelector(".woocommerce-product-gallery");
  if (gallery) {
    observer.observe(gallery, { childList: true, subtree: true });
  }

  // Close button handler
  $(document).on("click", ".slider-gallery .close-btn", function (e) {
    e.preventDefault();
    closeLightbox();
  });

  // ESC key to close
  $(document).on("keyup", function (e) {
    if (e.key === "Escape" && $(".slider-gallery").hasClass("active")) {
      closeLightbox();
    }
  });
})(jQuery);
