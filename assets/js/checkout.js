(($) => {
  // Copy the inputed coupon code to WooCommerce hidden default coupon field
  $(document.body).on(
    "input change",
    '.coupon-form input[name="coupon_code"]',
    function () {
      $('form.checkout_coupon input[name="coupon_code"]').val($(this).val());
      console.log(123555);
    },
  );

  // On button click, submit WooCommerce hidden default coupon form
  $(document.body).on(
    "click",
    '.coupon-form button[name="apply_coupon"]',
    function () {
      $("form.checkout_coupon").submit();
      console.log(1234);
    },
  );

  function syncCouponNotice() {
    const $ui = $(".coupon-form");
    const $input = $ui.find('input[name="coupon_code"]');

    // נקה notices קודמים
    $ui.find(".coupon-notice").remove();

    // 1. שגיאה
    const $error = $("form.checkout_coupon .coupon-error-notice");
    if ($error.length) {
      $ui.append(
        '<div class="coupon-notice coupon-error checkout-inline-error-message" role="alert">' +
          $error.text() +
          "</div>",
      );
      return;
    }

    // 2. success / removed
    const $message = $(".woocommerce-message")
      .filter(function () {
        return /coupon/i.test($(this).text());
      })
      .first();

    if ($message.length) {
      const text = $message.text();
      const isRemoved = /removed/i.test(text);

      $ui.append(
        '<div class="coupon-notice coupon-' +
          (isRemoved ? "removed" : "success") +
          '" role="alert">' +
          text +
          "</div>",
      );

      // נקה input אחרי success / removed
      $input.val("");

      // ודא שגם הפורם המקורי נקי
      $('form.checkout_coupon input[name="coupon_code"]').val("");
    }
  }

  $(document.body).on("updated_checkout checkout_error", syncCouponNotice);

  $("form.checkout_coupon").on("submit", function () {
    setTimeout(syncCouponNotice, 120);
  });

  document.addEventListener(
    "click",
    function (e) {
      const link = e.target.closest(".woocommerce-terms-and-conditions-link");
      if (!link) return;

      e.preventDefault();
      e.stopImmediatePropagation();

      const modal = document.getElementById("terms-modal");
      modal.classList.add("active");
      document.body.style.overflow = "hidden";
    },
    true,
  );

  // סגירה
  document.addEventListener("click", function (e) {
    if (
      e.target.matches("#terms-modal .close-modal") ||
      e.target.matches("#terms-modal")
    ) {
      closeModal();
    }
  });

  document.addEventListener("keyup", function (e) {
    if (e.key === "Escape") {
      closeModal();
    }
  });

  function closeModal() {
    const modal = document.getElementById("terms-modal");
    modal.classList.remove("active");
    document.body.style.overflow = "";
  }
})(jQuery);
