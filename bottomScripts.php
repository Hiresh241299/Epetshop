<script src="assets/js/jquery-3.3.1.min.js"></script>
<script src="assets/js/jquery-2.1.4.min.js"></script>
<script src="assets/js/parsley.js"></script>
<!--/login
<script>
$(document).ready(function() {
    $(".button-log a").click(function() {
        $(".overlay-login").fadeToggle(200);
        $(this).toggleClass('btn-open').toggleClass('btn-close');
    });
});
$('.overlay-close1').on('click', function() {
    $(".overlay-login").fadeToggle(200);
    $(".button-log a").toggleClass('btn-open').toggleClass('btn-close');
    open = false;
});
</script>-->
<!--//login-->

<!--/register
<script>
$(document).ready(function() {
    $(".button-register a").click(function() {
        $(".overlay-register").fadeToggle(200);
        $(this).toggleClass('btn-open2').toggleClass('btn-close2');
    });
});
$('.overlay-close2').on('click', function() {
    $(".overlay-register").fadeToggle(200);
    $(".button-register a").toggleClass('btn-open2').toggleClass('btn-close2');
    open = false;
});
</script>-->
<!--//register-->

<script>
function cart() {
    window.location.href = 'cart.php';
}
</script>

<script type="text/javascript">
$(document).ready(function() {

    show_mycart();

    function show_mycart() {
        $.ajax({
            url: "ajax/show_mycart.php",
            method: "POST",
            dataType: "JSON",
            success: function(data) {
                $(".get_cart").html(data.out);
                $("#cart").text(data.da);
            }
        });
    }

    setInterval(show_mycart, 1000);

});
</script>

<script>
// optional
$('#customerhnyCarousel').carousel({
    interval: 5000
});
</script>
<!-- cart-js 
<script src="assets/js/minicart.js"></script>
<script>
transmitv.render();

transmitv.cart.on('transmitv_checkout', function(evt) {
    var items, len, i;

    if (this.subtotal() > 0) {
        items = this.items();

        for (i = 0, len = items.length; i < len; i++) {}
    }
});
</script>-->
<!-- //cart-js -->
<!--pop-up-box
<script src="assets/js/jquery.magnific-popup.js"></script>-->
<!--//pop-up-box
<script>
$(document).ready(function() {
    $('.popup-with-zoom-anim').magnificPopup({
        type: 'inline',
        fixedContentPos: false,
        fixedBgPos: true,
        overflowY: 'auto',
        closeBtnInside: true,
        preloader: false,
        midClick: true,
        removalDelay: 300,
        mainClass: 'my-mfp-zoom-in'
    });

});
</script>-->
<!--//search-bar-->
<!-- disable body scroll which navbar is in active -->

<script>
$(function() {
    $('.navbar-toggler').click(function() {
        $('body').toggleClass('noscroll');
    })
});
</script>
<!-- disable body scroll which navbar is in active -->
<script src="assets/js/bootstrap.min.js"></script>

<!-- Select role -->
<script src="//code.jquery.com/jquery.min.js"></script>
<script src="assets/js/jquery.twbs-toggle-buttons.min.js"></script>
<script>
$(".btn-group-toggle").twbsToggleButtons();
</script>

<!--cart.php-->
<script type="text/javascript">
$(document).ready(function() {

    show_mycart();

    function show_mycart() {
        $.ajax({
            url: "ajax/show_mycart.php",
            method: "POST",
            dataType: "JSON",
            success: function(data) {
                $("#get_cart").html(data.out);
                $("#cart").text(data.da);
                $("#total").text(data.total);
                $("#totalValue").val(data.totalValue);
            }
        });
    }

    setInterval(show_mycart, 1000);

});

$(document).on("click", ".remove", function() {
    var id = $(this).attr("id");

    var action = "delete";

    $.ajax({
        url: "ajax/cart_action.php",
        method: "POST",
        data: {
            id: id,
            action: action
        },
        dataType: "JSON",
        success: function(data) {

        }
    });
    toastr.warning('Product removed');
});

$(document).on("click", ".clearall", function() {
    var id = $(this).attr("id");

    var action = "clearall";

    $.ajax({
        url: "ajax/cart_action.php",
        method: "POST",
        data: {
            id: id,
            action: action
        },
        dataType: "JSON",
        success: function(data) {

        }
    });
    toastr.warning('Cart cleared');
});
</script>
<!--cart.php-->