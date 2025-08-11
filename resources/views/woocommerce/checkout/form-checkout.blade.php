{{--
  Checkout Form
  This template can be overridden by copying it to yourtheme/resources/views/woocommerce/checkout/form-checkout.blade.php.
--}}
@php
  if (!defined('ABSPATH')) { exit; }
  do_action('woocommerce_before_checkout_form', $checkout);

  // If checkout registration is disabled and not logged in, the user cannot checkout.
  if (!$checkout->is_registration_enabled() && $checkout->is_registration_required() && !is_user_logged_in()) {
    echo esc_html(apply_filters('woocommerce_checkout_must_be_logged_in_message', __('You must be logged in to checkout.', 'woocommerce')));
    return;
  }
@endphp

<form name="checkout" method="post" class="checkout woocommerce-checkout" action="{!! esc_url(wc_get_checkout_url()) !!}" enctype="multipart/form-data">
  @if ($checkout->get_checkout_fields())
    @php do_action('woocommerce_checkout_before_customer_details') @endphp
    <div class="col2-set" id="customer_details">
      <div class="col-1">
        @php do_action('woocommerce_checkout_billing') @endphp
      </div>
      <div class="col-2">
        @php do_action('woocommerce_checkout_shipping') @endphp
      </div>
    </div>
    @php do_action('woocommerce_checkout_after_customer_details') @endphp
  @endif

  @php do_action('woocommerce_checkout_before_order_review_heading') @endphp
  <h3 id="order_review_heading">{{ esc_html_e('Your order', 'woocommerce') }}</h3>
  @php do_action('woocommerce_checkout_before_order_review') @endphp

  <div id="order_review" class="woocommerce-checkout-review-order">
    @php do_action('woocommerce_checkout_order_review') @endphp
  </div>

  @php do_action('woocommerce_checkout_after_order_review') @endphp
</form>

@php do_action('woocommerce_after_checkout_form', $checkout) @endphp