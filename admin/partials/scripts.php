<script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="../assets/js/jquery.min.js"></script>

    <script type="text/javascript">
        $("#printPDF").live("click", function () {
            var divContents = $("#printContainer").html();
            var printWindow = window.open('', '', 'height=600,width=1000');
            printWindow.document.write('<html><head><title>Application</title>');
            printWindow.document.write('</head><body >');
            printWindow.document.write(divContents);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        });
    </script>

    <script src="../assets/js/bootstrap.bundle.min.js"></script>

    <script src="../assets/js/jquery.magnific-popup.min.js"></script>

    <script src="../assets/js/odometer.min.js"></script>

    <script src="../assets/js/jquery.appear.min.js"></script>

    <script src="../assets/js/meanmenu.min.js"></script>

    <script src="../assets/js/metismenu.min.js"></script>

    <script src="../assets/js/simplebar.min.js"></script>

    <script src="../assets/js/dropzone.min.js"></script>

    <script src="../assets/js/sticky-sidebar.min.js"></script>

    <script src="../assets/js/tweenMax.min.js"></script>

    <script src="../assets/js/owl.carousel.min.js"></script>

    <script src="../assets/js/wow.min.js"></script>

    <script src="../assets/js/jquery.ajaxchimp.min.js"></script>

    <script src="../assets/js/form-validator.min.js"></script>

    <script src="../assets/js/contact-form-script.js"></script>

    <script src="../assets/js/custom.js"></script>
    
    <!-- <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script> -->

    