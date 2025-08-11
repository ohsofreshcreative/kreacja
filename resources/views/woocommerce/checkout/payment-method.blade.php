{{--
  Output a single payment method
  This template can be overridden by copying it to yourtheme/resources/views/woocommerce/checkout/payment-method.blade.php.
--}}
@php defined('ABSPATH') || exit @endphp

<li class="wc_payment_method payment_method_{{ esc_attr($gateway->id) }}">
  <input id="payment_method_{{ esc_attr($gateway->id) }}" type="radio" class="input-radio" name="payment_method" value="{{ esc_attr($gateway->id) }}" @checked($gateway->chosen) data-order_button_text="{!! esc_attr($gateway->order_button_text) !!}" />
  <label for="payment_method_{{ esc_attr($gateway->id) }}">
    {!! $gateway->get_title() !!} {!! $gateway->get_icon() !!}
  </label>
  @if ($gateway->has_fields() || $gateway->get_description())
    <div class="payment_box payment_method_{{ esc_attr($gateway->id) }}" @if (!$gateway->chosen) style="display:none;" @endif>
      {!! $gateway->payment_fields() !!}
    </div>
  @endif
</li>