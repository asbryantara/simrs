  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Versi</b> 1.0.0
    </div>
    <strong>Copyright &copy; 2019 <a href="#">DOQ-IT</a>.</strong> All rights
    reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="<?= base_url('assets/') ?>bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<!-- <script src="<?= base_url('assets/') ?>bower_components/jquery-ui/jquery-ui.min.js"></script> -->
<!-- jQuery-UI -->
<script src="<?php echo base_url('assets/') ?>custom/jquery-3.3.1.js"></script>
<script src="<?php echo base_url('assets/') ?>custom/jquery-ui.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="<?= base_url('assets/') ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="<?= base_url('assets/') ?>bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/') ?>bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- Select2 -->
<script src="<?= base_url('assets/') ?>bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- InputMask -->
<script src="<?= base_url('assets/') ?>plugins/input-mask/jquery.inputmask.js"></script>
<script src="<?= base_url('assets/') ?>plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="<?= base_url('assets/') ?>plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- daterangepicker -->
<script src="<?= base_url('assets/') ?>bower_components/moment/min/moment.min.js"></script>
<script src="<?= base_url('assets/') ?>bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="<?= base_url('assets/') ?>bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="<?= base_url('assets/') ?>plugins/iCheck/icheck.min.js"></script>
<!-- Slimscroll -->
<script src="<?= base_url('assets/') ?>bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?= base_url('assets/') ?>bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('assets/') ?>dist/js/adminlte.min.js"></script>
<script src="<?= base_url('assets/') ?>dist/js/currencyFormatter.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url('assets/') ?>bower_components/chart.js/Chart.js"></script>
<script src="<?= base_url('assets/') ?>dist/js/demo.js"></script>
<script>
	$(function () {
		window.setTimeout(function() { 
			$(".alert").fadeTo(500, 0).slideUp(500, function(){ 
				$(this).remove(); 
			}); 
		}, 3000);

		$('#example1').DataTable({
		  'ordering'    : false,
		})
		$('#example2').DataTable({
		  'paging'      : false,
		  'lengthChange': false,
		  'searching'   : true,
		  'ordering'    : false,
		  'info'        : false,
		  'autoWidth'   : true
		});

	});
</script>
</script>
</body>
</html>
