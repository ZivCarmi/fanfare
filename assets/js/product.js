(($) => {
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

  $(function ($) {
    const $price = $(".summary .price");

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
  });
})(jQuery);
