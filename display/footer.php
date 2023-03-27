<div id="footerHandler">
    <footer>
        <section class="sub-footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-5">
                        Copyright © 2020 - 2021 <a href="#" target="_blank">Hindex</a>
                    </div>
                    <div class="col-md-7 text-md-right">
<!--                        <a href="https://Investment market.com/user-agreement/" target="_blank">User Agreement</a> - -->
                        <a href="#" target="_blank">Privacy Policy</a> -
                        <a href="#" target="_blank">Cookie Policy</a> -
                        <a href="#" target="_blank">Refund Policy</a>
<!--                        <a href="https://Investment market.com/website-acceptance-policy/" target="_blank">Website Acceptance Policy</a>-->
                    </div>
                </div>
            </div>
        </section>
    </footer>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/backbone.js/1.3.3/backbone-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.3/moment.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-daterangepicker/3.0.3/daterangepicker.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.min.js"></script>
<!--<script src="//cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.9.1/sweetalert2.min.js"></script>-->

<!--<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>-->
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<!--<script src="assets/js/app.js"></script>-->
<!--    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>-->

<!--<script src="../assets/js/me.js"></script>-->



<script>
    $(document).ready(function () {
        $('#myTable').DataTable();
    });
</script>
<script>
    // Get the modal
    var modal1 = document.getElementById('id01');
    var modal2 = document.getElementById('id02');

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function (event) {
        if (event.target === modal1) {
            modal1.style.display = "none";
        }

        if (event.target === modal2) {
            modal2.style.display = "none";
        }
    }
</script>

</body>
</html>
