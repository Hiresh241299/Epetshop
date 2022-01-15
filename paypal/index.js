var total = document.getElementById("totalValue").value;
paypal.Buttons({
    style : {
        color: 'blue',
        shape: 'pill'
    },
    createOrder: function (data, actions) {
        return actions.order.create({
            purchase_units : [{
                description: "Pet accessories",
                custom_id: "CUST-Epetshop",
                soft_descriptor: "Epetshop",
                amount: {
                    value: total,
                }
            }]
        });
    },
    onApprove: function (data, actions) {
        return actions.order.capture().then(function (details) {
            console.log(details)
            //payment complete
            //go to order page
            window.location.replace("customerOrder.php?p=1")
        })
    },
    onCancel: function (data) {
        //payment cancelled
        //go to cart.php and give a message
        window.location.replace("cart.php#paymentCancelled")
        //viewPop();
    }
}).render('#paypal-payment-button');