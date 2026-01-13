(($) => {
  let timeout;

  $(".woocommerce").on("click", ".qty-plus, .qty-minus", function () {
    const $button = $(this);

    if (timeout !== undefined) {
      clearTimeout(timeout);
    }

    const $qty = $button.siblings("input.qty");
    let current = parseFloat($qty.val());
    const min = parseFloat($qty.attr("min")) || 1;
    const max = parseFloat($qty.attr("max")) || Infinity;
    const step = parseFloat($qty.attr("step")) || 1;

    if ($button.hasClass("qty-plus")) {
      if (current + step <= max) {
        $qty.val(current + step).change();
      }
    } else {
      if (current - step >= min) {
        $qty.val(current - step).change();
      }
    }

    timeout = setTimeout(function () {
      $("[name='update_cart']").trigger("click");
    }, 500);
  });
})(jQuery);
