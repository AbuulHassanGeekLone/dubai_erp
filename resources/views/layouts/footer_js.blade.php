<!-- jQuery UI 1.11.4 -->
<script src="/assets/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    // $.widget.bridge("uibutton", $.ui.button);
</script>

<script src="/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="/assets/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="/assets/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="/assets/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="/assets/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="/assets/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="/assets/plugins/moment/moment.min.js"></script>
<script src="/assets/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="/assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="/assets/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="/assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="/assets/dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
{{--<script src="/assets/dist/js/pages/dashboard.js"></script>--}}

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<!-- AdminLTE for demo purposes -->
<script src="/assets/dist/js/demo.js"></script>

<!-- Select2 -->
<script src="/assets/plugins/select2/js/select2.full.min.js"></script>

<!-- DataTables -->
<script src="/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="/assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="/assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- Bootstrap Switch -->
<script src="/assets/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<!-- custom js -->
<script src="/assets/js/city.js"></script>
<script src="/assets/js/dashb.js"></script>
<script src="/assets/js/purchaseSale.js"></script>
<script src="/assets/js/select.js"></script>
<script src="/assets/js/accountRegister.js"></script>
<script src="/assets/js/users.js"></script>
<!-- Journal 7/20/2020/ -->
<script src="/assets/js/journal.js"></script>
<script src="/assets/js/models.js"></script>
<script src="/assets/js/purchase.js"></script>
<script src="/assets/js/ledger.js"></script>
<script>
    String.prototype.toCurrency = function(){
        let num = this

        num = Number( num )
        num = num.toFixed(2)
        num = Number( num )

        return num.toLocaleString()
    };

    $(function () {
        $("#example1").DataTable({
            responsive: false,
            autoWidth: false,
            ordering: false,
            info: false,

        });
        $("#myTable").DataTable({

            autoWidth: false,
            ordering: false,
            info: false,
            lengthChange: true,
            scrollX: true,


        });
        $("#journal").DataTable({

            autoWidth: false,
            ordering: false,
            info: false,
            lengthChange: true,
            scrollX: true,
            "pageLength": 50

        });

        $("#example2").DataTable({
            paging: false,
            lengthChange: false,
            searching: false,
            ordering: false,
            info: false,
            autoWidth: false,
            responsive: true,
        });

        $("#amanager").DataTable({
            paging: false,
            lengthChange: false,
            searching: true,
            ordering: true,
            info: true,
            autoWidth: false,
            responsive: true,
        });
    });
</script>

<script>
    $(function () {
        //Initialize Select2 Elements
        $(".select2").select2();

        //Initialize Select2 Elements
        $(".select2bs4").select2({
            theme: "bootstrap4",
        });
    });
</script>
