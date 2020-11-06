(function() {
  const config = { childList: true, subtree: true }
  const checkoutTable = document.querySelector('.woocommerce-checkout-review-order-table')
  
  const mutation = function(mutationsList) {
    mutationsList.forEach(mutation => {
      if (mutation.type === 'childList') {
        window.setTimeout(function() {
          const shippingMethod = document.querySelector('#shipping_method_0')
          const woocommerceShipping = document.querySelector('.woocommerce-shipping-totals.shipping.afrsm_shipping')
          if (shippingMethod.value === "advanced_flat_rate_shipping:6374") {
            woocommerceShipping.style.display = 'none'
          }
        }, 5000)
      }
    })
  }

  const observer = new MutationObserver(mutation)

  observer.observe(checkoutTable, config)

})()
