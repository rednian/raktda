<html>
    <head>

        <script src="{{ asset('/js/mandatory.js') }}"></script>
        <script src="{{ asset('/js/plugins.js') }}"></script>
        <script src="{{ asset('/assets/js/demo1/scripts.bundle.js') }}" type="text/javascript"></script>
        <script src="{{ asset('/js/custom-pages.js') }}"></script>
        <script src="{{ asset('/assets/vendors/custom/jquery.treetable/jquery.treetable.js') }}"></script>
        <script src="{{ asset('/js/custom.js') }}" type="text/javascript"></script>

        {{-- {{ dd($sessionId) }} --}}
        <script src="https://test-rakbankpay.mtf.gateway.mastercard.com/checkout/version/52/checkout.js"
                data-cancel="cancelCallback"
                data-timeout="timeoutCallback"
                data-complete="completeCallback"
                data-error="errorCallback"
                data-beforeRedirect="Checkout.saveFormFields"
                data-afterRedirect="Checkout.restoreFormFields"
                >
        </script>

        <script type="text/javascript">

            function errorCallback(error) {
                console.log(error);
            }

            function timeoutCallback(){
                console.log('Timeout');
            }

            function completeCallback(data){
                console.log(data);
            }

            function cancelCallback(data) {
                console.log('Payment cancelled');
            }

            console.log('{{ $sessionId }}');
//            'risk' => [
//                 'bypassMerchantRiskRules' => 'ALL'
//             ],
// 'action' => [
//                     '3DSecure' => 'BYPASS'
//                 ],
            Checkout.configure({
                merchant: "NRSINFOWAYSL",
                session: {
                    id: '{{ $sessionId }}',
                },
                interaction: {
                    operation: 'PURCHASE',
                    merchant: {
                        name: "RAKTDA NRS Infoways",
                        address: {
                            line1: '200 Sample St',
                            line2: '1234 Example Town'            
                        } 
                    },
                },
                order: {
                    currency: 'AED',
                    amount: function() {
                        return 1 + 1;
                    },
                    description: "Ordered goods"
                }
            });
        </script>
    </head>
    <body>        
        <input type="button" id="btnlight" value="Pay with Lightbox" onclick="Checkout.showLightbox();" />
        <input type="button" id="btnredirect" value="Pay with Payment Page" onclick="Checkout.showPaymentPage();" />
    </body>
</html>