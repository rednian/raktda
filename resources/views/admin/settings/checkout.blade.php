<html>
    <head>
        <script src="https://test-rakbankpay.mtf.gateway.mastercard.com/checkout/version/54/checkout.js"
                data-error="errorCallback"
                data-cancel="cancelCallback"
         data-beforeRedirect="Checkout.saveFormFields"
         data-afterRedirect="Checkout.restoreFormFields">
        </script>

        <script type="text/javascript">
            function errorCallback(error) {
                  console.log(JSON.stringify(error));
            }
            function cancelCallback() {
                  console.log('Payment cancelled');
            }

            Checkout.configure({
                merchant: 'NRSINFOWAYSL',
                order: {
                    amount: function() {
                        //Dynamic calculation of amount
                        return 784
                    },
                    currency: 'AED',
                    description: 'Ordered goods',
                    id: 'asdfdsge2342'
                },
                billing    : {
                    address: {
                        street       : '123 Customer Street',
                        city         : 'Metropolis',
                        postcodeZip  : '99999',
                        stateProvince: 'NY',
                        country      : 'USA'
                    }
                },
                interaction: {
                    operation: 'PURCHASE', // set this field to 'PURCHASE' for Hosted Checkout to perform a Pay Operation.
                    merchant: {
                        name: 'Chris Olivo',
                        address: {
                            line1: '200 Sample St',
                            line2: '1234 Example Town'            
                        } , 
                        email  : 'order@yourMerchantEmailAddress.com',
                        phone  : '+1 123 456 789 012', 
                    }
                }
            });
        </script>
    </head>
    <body>
        <input type="button" value="Pay with Lightbox" onclick="Checkout.showLightbox();" />
        <input type="button" value="Pay with Payment Page" onclick="Checkout.showPaymentPage();" />
    </body>
</html>