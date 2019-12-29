<html>

<head>
    <script src="https://test-rakbankpay.mtf.gateway.mastercard.com/checkout/version/54/checkout.js"
        data-error="errorCallback" data-cancel="cancelCallback" data-complete="completeCallback">
    </script>
</head>

<body>

    <?php
    $url = 'https://test-rakbankpay.mtf.gateway.mastercard.com/api/rest/version/54/merchant/TESTNRSINFOWAYSL/session/';
    $postFields = array(
        'apiOperation' => 'CREATE_CHECKOUT_SESSION',
        'order' => array(
        'currency' => 'AED',
        'id' => '123'
        ),
        'interaction' => array(
        'operation' => 'PURCHASE'
        )
    );
    $username = 'merchant.TESTNRSINFOWAYSL';
    $password = 'aabf38b7ab511335ba2fb786206b1dc0';
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    // curl_setopt($curl, CURLOPT_HTTPHEADER, array(
    // 'Content-Type: application/json'
    // ));
    curl_setopt($curl, CURLOPT_USERPWD, $username . ":" . $password);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($postFields));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    $output = curl_exec($curl);
    curl_close($curl);
    $output = json_decode($output);
    ?>

    <input type="button" value="Pay with Lightbox" onclick="Checkout.showLightbox();" />
    <input type="button" value="Pay with Payment Page" onclick="Checkout.showPaymentPage();" />
    <script type="text/javascript">
        Checkout.configure({
                merchant: 'TESTNRSINFOWAYSL',
                order: {
                    amount: function() {
                        return 80 + 20 ;
                    },
                    currency: 'AED',
                    description: 'Permit payment',
                    id:'123'
                },
                session:{
                    id: "{{$output->session->id}}"
                },
               interaction: {
                   operation:'PURCHASE',
                   merchant: {
                       name: 'test'
                   },
                   displayControl: {
                        billingAddress :'HIDE'
                   }
               }
            });

            function errorCallback(error) {
                  console.log(JSON.stringify(error));
            }
            function cancelCallback() {
                  console.log('Payment cancelled');
            }

            

            function completeCallback(resultIndicator, sessionVersion){
                console.log(resultIndicator)
                console.log(sessionVersion)
            }   
    </script>
</body>

</html>