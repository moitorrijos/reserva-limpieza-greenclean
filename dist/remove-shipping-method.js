(function() {
  var shippingMethod = document.querySelector('#shipping_method_0')
  var woocommerceShipping = document.querySelector('.woocommerce-shipping-totals.shipping.afrsm_shipping')
  
  if (shippingMethod && woocommerceShipping) {
    if (shippingMethod.value === "advanced_flat_rate_shipping:6374") {
      woocommerceShipping.style.display = 'none'
    }
  }
})()
