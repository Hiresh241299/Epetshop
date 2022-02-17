paypal
  .Buttons({
    style: {
      color: "blue",
      shape: "pill",
    },
    createOrder: function (data, actions) {
      var total = document.getElementById("totalValue").value;
      return actions.order.create({
        purchase_units: [
          {
            description: "Pet accessories",
            custom_id: "CUST-Epetshop",
            soft_descriptor: "Epetshop",
            amount: {
              value: total,
            },
          },
        ],
      });
    },
    onApprove: function (data, actions) {
      return actions.order.capture().then(function (details) {
        console.log(details);
        //payment complete
        //ajax call to add Delivery Schedule
        var orderid_ = document.getElementById("orderid").value;
        var mobile_ = document.getElementById("mobile").value;
        var street_ = document.getElementById("street").value;
        var locality_ = document.getElementById("locality").value;
        var town_ = document.getElementById("town").value;
        var district_ = document.getElementById("district").value;
        var postcode_ = document.getElementById("postcode").value;
        var lng_ = document.getElementById("lng").value;
        var lat_ = document.getElementById("lat").value;

        $.ajax({
          url: "ajax/productAction.php",
          data: {
            oid: orderid_,
            mobile: mobile_,
            street: street_,
            locality: locality_,
            town: town_,
            district: district_,
            postcode: postcode_,
            lng: lng_,
            lat: lat_,
            action: "addDeliverySchedule",
          },
          type: "post",
          success: function (data) {
            if (data == 1) {
              //give message
              toastr.success("Delivery Scheduled");
              window.location.replace("customerOrder.php?p=1#paymentCompleted");
            }
          },
        });
      });
    },
    onCancel: function (data) {
      //payment cancelled
      //go to cart.php and give a message
      window.location.replace("cart.php#paymentCancelled");
      //viewPop();
    },
  })
  .render("#paypal-payment-button");
