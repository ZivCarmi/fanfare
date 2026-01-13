(($) => {
  let hoverTimeout;
  const isMobile =
    /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(
      navigator.userAgent
    );
  const $miniCart = $(".mini-cart-dropdown");

  // Create overlay element
  if (isMobile && !$("#mini-cart-overlay").length) {
    $("body").append(
      '<div id="mini-cart-overlay" class="mini-cart-overlay"></div>'
    );
  }

  if (!isMobile) {
    // Desktop: Hover behavior
    $(".menu-item-cart").on("mouseenter", function () {
      clearTimeout(hoverTimeout);
      $("#mini-cart-dropdown").addClass("show");
    });

    $(".menu-item-cart, #mini-cart-dropdown").on("mouseleave", function () {
      hoverTimeout = setTimeout(function () {
        if (!$(".menu-item-cart:hover, #mini-cart-dropdown:hover").length) {
          $("#mini-cart-dropdown").removeClass("show");
        }
      }, 100);
    });

    $("#mini-cart-dropdown").on("mouseenter", function () {
      clearTimeout(hoverTimeout);
    });
  } else {
    // Mobile: Click behavior
    $(".menu-item-cart > a").on("click", function (e) {
      e.preventDefault();
      $("#mini-cart-dropdown").toggleClass("show");
      $("#mini-cart-overlay").toggleClass("show");
      $("body").toggleClass("mini-cart-open");
    });

    // Close mini cart when clicking overlay
    $(document).on("click", "#mini-cart-overlay", function () {
      $("#mini-cart-dropdown").removeClass("show");
      $("#mini-cart-overlay").removeClass("show");
      $("body").removeClass("mini-cart-open");
    });

    // Prevent closing when clicking inside mini cart
    $("#mini-cart-dropdown").on("click", function (e) {
      e.stopPropagation();
    });
  }

  let timeout = null;
  let pendingQty = null;
  let originalQty = null;

  $(document).on("click", ".mini-cart-qty button", function (e) {
    e.preventDefault();

    const $button = $(this);
    const $quantityDiv = $button.closest(".quantity");
    const $qty = $quantityDiv.find("input.qty");

    const min = parseFloat($qty.attr("min")) || 1;
    const max = parseFloat($qty.attr("max")) || Infinity;
    const step = parseFloat($qty.attr("step")) || 1;
    const cartItemKey = $quantityDiv.data("cart-item-key");

    // Store original quantity on first click
    if (pendingQty === null) {
      originalQty = parseInt($qty.val(), 10);
      pendingQty = originalQty;
    }

    if ($button.hasClass("plus")) {
      pendingQty = Math.min(pendingQty + step, max);
    } else if ($button.hasClass("minus")) {
      pendingQty = Math.max(pendingQty - step, min);
    }

    $qty.val(pendingQty);

    clearTimeout(timeout);

    timeout = setTimeout(() => {
      if (pendingQty !== originalQty) {
        $miniCart.addClass("loading");
        updateCartQuantity(cartItemKey, pendingQty);
      }
      pendingQty = null;
      originalQty = null;
    }, 400);
  });

  function updateCartQuantity(cartItemKey, quantity) {
    $.ajax({
      type: "POST",
      url: wc_add_to_cart_params.ajax_url,
      data: {
        action: "update_mini_cart_quantity",
        security: $("body").data("mini-cart-nonce"),
        cart_item_key: cartItemKey,
        quantity: quantity,
      },
    })
      .success(function (response) {
        if (response.success) {
          $(document.body).trigger("wc_fragment_refresh");
        }
      })
      .always(function () {
        $miniCart.removeClass("loading");
      });
  }
})(jQuery);
