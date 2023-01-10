<?php  ?>
</body>
<footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 1.0.0
    </div>
    [Telkom Akses WH Banjarmasin@2023]
    <strong>Copyright &copy; 2022-2023 <a href="<?= base_url("dashboard")?>">Simawar</a>.</strong> All rights reserved.
  
 <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="<?php echo base_url(); ?>assets/adminlte/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?php echo base_url(); ?>assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- DataTables  & Plugins -->
  <script src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/adminlte/plugins/jszip/jszip.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/adminlte/plugins/pdfmake/pdfmake.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/adminlte/plugins/pdfmake/vfs_fonts.js"></script>
  <script src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

  <!-- AdminLTE App -->
  <script src=" <?php echo base_url(); ?>assets/adminlte/dist/js/adminlte.min.js"></script>
  <script>
  $(function() {
    $("#datatable_01").DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
      "dom": 'lBfrtip',
      //buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"],
      "buttons": ["excel","pdf"],
    }).buttons().container().appendTo('#example_wrapper .col-md-6:eq(0)');
  });
</script>

<script>
  $(function() {
    $("#datatable_02").DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
      "dom": 'lfrtip',
     
    }).buttons().container().appendTo('#example_wrapper .col-md-6:eq(0)');
  });
</script>

<script>
  $(function() {
    $("#datatable_03").DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
      "dom": 'lfrtip',
     
    }).buttons().container().appendTo('#example_wrapper .col-md-6:eq(0)');
  });
</script>

<script>
    $(".custom-file-input").on("change", function() {
      var fileName = $(this).val().split("\\").pop();
      $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
</script>
  </footer>
  

  </html>