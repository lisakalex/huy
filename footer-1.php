<footer>
    <section class="sub-footer">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    Copyright © 2020 - 2021
<!--                    <a href="https://sevio.com" target="_blank">Sevio</a> --->
<!--                    <a href="user-agreement/index.html">User Agreement</a> --->
                    <a href="privacy-policy/index.html">Privacy Policy</a> -
                    <a href="cookie-policy/index.html">Cookie Policy</a> -
                    <a href="refund-policy/index.html">Refund Policy</a> -
<!--                    <a href="website-acceptance-policy/index.html">Website Acceptance Policy</a> --->
                    <?= $newpayment ?> - <?= $all_usd ?>
                </div>
            </div>
        </div>
    </section>
</footer>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.amcharts.com/lib/4/core.js"></script>
<script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
<script src="https://cdn.amcharts.com/lib/4/themes/material.js"></script>
<script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="assets/js/api.js" async defer></script>
<script src="assets/js/me.js"></script>
<script>
    $(document).ready(function () {
        $('#myTable').DataTable();
    });
</script>
</body>
</html>
