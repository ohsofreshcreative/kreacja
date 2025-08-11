{{--
  Checkout shipping information form
  This template can be overridden by copying it to yourtheme/resources/views/woocommerce/checkout/form-shipping.blade.php.
--}}
@php defined('ABSPATH') || exit @endphp

<div class="woocommerce-shipping-fields">
  @if (true === WC()->cart->needs_shipping_address())
    <h3 id="ship-to-different-address">
      <label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox">
        <input id="ship-to-different-address-checkbox" class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox" @checked(apply_filters('woocommerce_ship_to_different_address_checked', 'shipping' === get_option('woocommerce_ship_to_destination') ? 1 : 0)) type="checkbox" name="ship_to_different_address" value="1" />
        <span>{{ esc_html_e('Ship to a different address?', 'woocommerce') }}</span>
      </label>
    </h3>
    <div class="shipping_address">
      @php do_action('woocommerce_before_checkout_shipping_form', $checkout) @endphp
      <div class="woocommerce-shipping-fields__field-wrapper">
        @foreach ($checkout->get_checkout_fields('shipping') as $key => $field)
          @php woocommerce_form_field($key, $field, $checkout->get_value($key)) @endphp
        @endforeach
      </div>
      @php do_action('woocommerce_after_checkout_shipping_form', $checkout) @endphp
    </div>
  @endif
</div>
<div class="woocommerce-additional-fields">
  @php do_action('woocommerce_before_order_notes', $checkout) @endphp
  @if (apply_filters('woocommerce_enable_order_notes_field', 'yes' === get_option('woocommerce_enable_order_comments', 'yes')))
    @if (!WC()->cart->needs_shipping() || wc_ship_to_billing_address_only())
      <h3>{{ esc_html_e('Additional information', 'woocommerce') }}</h3>
    @endif
    <div class="woocommerce-additional-fields__field-wrapper">
      @foreach ($checkout->get_checkout_fields('order') as $key => $field)
        @php woocommerce_form_field($key, $field, $checkout->get_value($key)) @endphp
      @endforeach
    </div>
  @endif
  @php do_action('woocommerce_after_order_notes', $checkout) @endphp
</div>