<script>
// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {
    scrollFunction()
};

function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        document.getElementById("movetop").style.display = "block";
    } else {
        document.getElementById("movetop").style.display = "none";
    }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}
</script>
<!-- /move top -->


<script src="adminassets/js/jquery-3.3.1.min.js"></script>
<script src="adminassets/js/jquery-1.10.2.min.js"></script>

<!-- chart js -->
<script src="adminassets/js/Chart.min.js"></script>
<script src="adminassets/js/utils.js"></script>
<!-- //chart js -->

<!-- Different scripts of charts.  Ex.Barchart, Linechart -->
<script src="adminassets/js/bar.js"></script>
<script src="adminassets/js/linechart.js"></script>
<!-- //Different scripts of charts.  Ex.Barchart, Linechart -->
<script>
$(document).ready(function() {
    $('#example').DataTable();
});
</script>
<script>
$(document).ready(function() {
    $('#RecentlyJoinedUsers').DataTable();
});
</script>
<script>
$(document).ready(function() {
    $('#PetshopRequests').DataTable();
});
</script>
<script src="adminassets/js/jquery.dataTables.min.js"></script>

<script src="adminassets/js/jquery.nicescroll.js"></script>
<script src="adminassets/js/scripts.js"></script>

<!-- close script -->
<script>
var closebtns = document.getElementsByClassName("close-grid");
var i;

for (i = 0; i < closebtns.length; i++) {
    closebtns[i].addEventListener("click", function() {
        this.parentElement.style.display = 'none';
    });
}
</script>
<!-- //close script -->

<!-- disable body scroll when navbar is in active -->
<script>
$(function() {
    $('.sidebar-menu-collapsed').click(function() {
        $('body').toggleClass('noscroll');
    })
});
</script>
<!-- disable body scroll when navbar is in active -->

<!-- loading-gif Js -->
<script src="adminassets/js/modernizr.js"></script>
<script>
$(window).load(function() {
    // Animate loader off screen
    $(".se-pre-con").fadeOut("slow");;
});
</script>
<!--// loading-gif Js -->

<!-- Bootstrap Core JavaScript -->
<script src="adminassets/js/bootstrap.min.js"></script>

<!--Update notification status-->
<script>

function UpdateNotif(aid) {
    //alert("Update Notif Status");
    $.ajax({
        url: 'ajax/adminAction.php',
        data: {
            UpdateNotif: 2,
            adminID: aid
        },
        type: 'post',
        success: function(data) {
            $('#notifbadge').text(data);
        }
    });
}
</script>