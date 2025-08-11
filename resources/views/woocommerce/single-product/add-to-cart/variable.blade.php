{{--
  Variable product add to cart

  This template can be overridden by copying it to yourtheme/resources/views/woocommerce/single-product/add-to-cart/variable.blade.php.

  @see https://woocommerce.com/document/template-structure/
  @package WooCommerce\Templates
  @version 6.1.0
--}}

@php
  defined('ABSPATH') || exit;

  global $product;

  $attribute_keys  = array_keys($attributes);
  $variations_json = wp_json_encode($available_variations);
  $variations_attr = function_exists('wc_esc_json') ? wc_esc_json($variations_json) : _wp_specialchars($variations_json, ENT_QUOTES, 'UTF-8', true);

  do_action('woocommerce_before_add_to_cart_form');
@endphp

<form class="variations_form cart" action="{!! esc_url(apply_filters('woocommerce_add_to_cart_form_action', $product->get_permalink())) !!}" method="post" enctype='multipart/form-data' data-product_id="{{ absint($product->get_id()) }}" data-product_variations="{!! $variations_attr !!}">
  @php do_action('woocommerce_before_variations_form') @endphp

  @if (empty($available_variations) && false !== $available_variations)
    <p class="stock out-of-stock">{{ esc_html(apply_filters('woocommerce_out_of_stock_message', __('This product is currently out of stock and unavailable.', 'woocommerce'))) }}</p>
  @else
    <table class="variations" cellspacing="0" role="presentation">
      <tbody>
        @foreach ($attributes as $attribute_name => $options)
          <tr>
            <th class="label"><label for="{{ esc_attr(sanitize_title($attribute_name)) }}">{{ wc_attribute_label($attribute_name) }}</label></th>
            <td class="value">
              @php
                wc_dropdown_variation_attribute_options([
                  'options'   => $options,
                  'attribute' => $attribute_name,
                  'product'   => $product,
                ]);

                // Filters the reset variation button - @since 2.5.0
                echo end($attribute_keys) === $attribute_name ? wp_kses_post(apply_filters('woocommerce_reset_variations_link', '<a class="reset_variations" href="#" aria-label="' . esc_attr__('Clear options', 'woocommerce') . '">' . esc_html__('Clear', 'woocommerce') . '</a>')) : '';
              @endphp
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
    <div class="reset_variations_alert screen-reader-text" role="alert" aria-live="polite" aria-relevant="all"></div>
    @php do_action('woocommerce_after_variations_table') @endphp

    <div class="single_variation_wrap">
      @php
        /**
         * Hook: woocommerce_before_single_variation.
         */
        do_action('woocommerce_before_single_variation');

        /**
         * Hook: woocommerce_single_variation. Used to output the cart button and placeholder for variation data.
         *
         * @since 2.4.0
         * @hooked woocommerce_single_variation - 10 Empty div for variation data.
         * @hooked woocommerce_single_variation_add_to_cart_button - 20 Qty and cart button.
         */
        do_action('woocommerce_single_variation');

        /**
         * Hook: woocommerce_after_single_variation.
         */
        do_action('woocommerce_after_single_variation');
      @endphp
    </div>
  @endif

  @php do_action('woocommerce_after_variations_form') @endphp
</form>

@php do_action('woocommerce_after_add_to_cart_form') @endphp