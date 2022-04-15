<!-- Core -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>


<script src="<?= SITE_ADMIN_URL ?>assets/vendor/@popperjs/core/dist/umd/popper.min.js"></script>
<script src="<?= SITE_ADMIN_URL ?>assets/vendor/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- Vendor JS -->
<script src="<?= SITE_ADMIN_URL ?>assets/vendor/onscreen/dist/on-screen.umd.min.js"></script>

<!-- Slider -->
<script src="<?= SITE_ADMIN_URL ?>assets/vendor/nouislider/distribute/nouislider.min.js"></script>

<!-- Smooth scroll -->
<script src="<?= SITE_ADMIN_URL ?>assets/vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js"></script>

<!-- Charts -->
<script src="<?= SITE_ADMIN_URL ?>assets/vendor/chartist/dist/chartist.min.js"></script>
<script src="<?= SITE_ADMIN_URL ?>assets/vendor/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>

<!-- Datepicker -->
<script src="<?= SITE_ADMIN_URL ?>assets/vendor/vanillajs-datepicker/dist/js/datepicker.min.js"></script>

<!-- Sweet Alerts 2 -->
<script src="<?= SITE_ADMIN_URL ?>assets/vendor/sweetalert2/dist/sweetalert2.all.min.js"></script>

<!-- Moment JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/moment.min.js"></script>

<!-- Vanilla JS Datepicker -->
<script src="<?= SITE_ADMIN_URL ?>assets/vendor/vanillajs-datepicker/dist/js/datepicker.min.js"></script>

<!-- Notyf -->
<script src="<?= SITE_ADMIN_URL ?>assets/vendor/notyf/notyf.min.js"></script>

<!-- Simplebar -->
<script src="<?= SITE_ADMIN_URL ?>assets/vendor/simplebar/dist/simplebar.min.js"></script>






<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>

<!-- Volt JS -->
<script src="<?= SITE_ADMIN_URL ?>assets/js/volt.js"></script>




<script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>


<?php

if (isset($footerData)) {
    echo $footerData;
}

if (isset($scriptTag)) {
    echo $scriptTag;
}


?>

</body>

</html>