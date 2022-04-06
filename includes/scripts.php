	  <script src="<?php echo $server; ?>/js/jquery.js"></script>
    <script src="<?php echo $server; ?>/js/popper.js"></script>
    
    <?php if($filename2 == "loqbox" || ($filename2 != "loqbox" && $filename2 == "")) { ?>
        <script src="<?php echo $server; ?>/lib/bootstrap/bootstrap.js"></script>
    <?php } ?>
    
    <?php if($filename2 == "user_info" || $filename2 == "change_password") { ?>
        <script src="<?php echo $server; ?>/lib/jquery-ui/jquery-ui.js"></script>
        <script src="<?php echo $server; ?>/lib/bootstrap/bootstrap.js"></script>
        <script src="<?php echo $server; ?>/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js"></script>
        <script src="<?php echo $server; ?>/lib/jquery-switchbutton/jquery.switchButton.js"></script>
        <script src="<?php echo $server; ?>/lib/peity/jquery.peity.js"></script>
        <script src="<?php echo $server; ?>/lib/highlightjs/highlight.pack.js"></script>
    <?php } ?>

    <?php if($filename2 == "app" || $filename2 == "transactions" || $filename2 == "classes" || $filename2 == "add_student" || $filename2=="view_students" || $filename2 == "edit_student" || $filename2 == "scores" || $filename2 == "view_reports" || $filename2 == "notifications") { ?>
        <script src="<?php echo $server; ?>/lib/jquery-ui/jquery-ui.js"></script>
        <script src="<?php echo $server; ?>/lib/bootstrap/bootstrap.js"></script>
        <script src="<?php echo $server; ?>/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js"></script>
        <script src="<?php echo $server; ?>/lib/moment/moment.js"></script>
        <script src="<?php echo $server; ?>/lib/jquery-switchbutton/jquery.switchButton.js"></script>
        <script src="<?php echo $server; ?>/lib/peity/jquery.peity.js"></script>
        <script src="<?php echo $server; ?>/lib/highlightjs/highlight.pack.js"></script>
        <script src="<?php echo $server; ?>/lib/select2/js/select2.min.js"></script>
        <script src="<?php echo $server; ?>/lib/jt.timepicker/jquery.timepicker.js"></script>
        <script src="<?php echo $server; ?>/lib/datatables/jquery.dataTables.js"></script>
        <script src="<?php echo $server; ?>/lib/datatables-responsive/dataTables.responsive.js"></script>
    <?php } ?>

    <script language="javascript">

        window.setInterval("checkalerts();", 5000);

        function checkalerts() {

          $.ajax({
				   
           type : 'GET',
           url : '<?php echo $server; ?>/app/checkalerts.php',
           success:function(response) { 

            var myarr = response.split("|");

            if(myarr[0] == 'new') {

              $('#red').css('display','inline');
              $('#al_photo,#al_photo2').html('<img src="<?php echo $server; ?>/img/users/'+myarr[1]+'" class="wd-32 rounded-circle" alt="" style="height: 40px">');
              $('#al_desc,#al_desc2').html(myarr[2]);
              $('#al_date,#al_date2').html(myarr[3]);
              $('#tweet').slideUp('slow').then($('#tweet').slideDown('slow'));

            }
          
          }

          });


          // alert('yes');

        }

        function red() {

          $.ajax({
				   
           type : 'GET',
           url : '<?php echo $server; ?>/app/red.php',
           success:function(response) { $('#red').hide(); }

          });

        }

        /*** AJAX FORM ***/ 
        $('#form').submit(function(){
            var action = $(this).attr('action');
            var data = $(this).serializeArray();            
            $("#message").slideUp(750,function() {
            $('#message').hide();
                $('#submit')
                .after('<img src="<?php echo $server; ?>/img/ajax-loader.gif" class="loader" style="margin-left:10px" />')
                .attr('disabled','disabled');
            $.post(action, data,
                function(data){
                    document.getElementById('message').innerHTML = data;
                    $('#message').slideDown('slow');
                    $('#form img.loader').fadeOut('slow',function(){$(this).remove()});
                    $('#submit').removeAttr('disabled');
                    if(data.match('success') != null) { 

                        <?php if($filename2 == "loqbox" || ($filename2 != "loqbox" && $filename2 == "")) { ?>
                            $('#form').slideUp('slow'); 
                            window.location = "<?php echo $server; ?>/app";
                        <?php } ?>

                        <?php if($filename2 == "user_info") { ?>
                            $('#form').slideUp('slow');
                            $('#ch_first_name').html($('#first_name').val());
                        <?php } ?>

                        <?php if($filename2 == "change_password") { ?>
                            $('#form').slideUp('slow');
                        <?php } ?>

                        <?php if($filename2 == "transactions") { ?>
                          setTimeout(function(){
                              window.location.href = '<?php echo $server; ?>/app/transactions/?sec=done';
                          }, 7000);
                        <?php } ?>
   
					          }
                }
            );
            });
            return false;
        });
    </script>

	<script src="<?php echo $server; ?>/js/loqbox.js"></script>

  <?php if($filename2 == "app" || $filename2 == "transactions" || $filename2 == "classes" || $filename2 == "add_student" || $filename2=="view_students" || $filename2 == "edit_student" || $filename2 == "scores" || $filename2 == "view_reports" || $filename2 == "notifications") { ?>

		<script>
          $(function(){

    
              // showing modal with effect
              $('.modal-effect').on('click', function(){
                var effect = $(this).attr('data-effect');
                $('#modaldemo8').addClass(effect, function(){
                  $('#modaldemo8').modal('show');
                });
                return false;
              });
      
              // hide modal with effect
              $('#modaldemo8').on('hidden.bs.modal', function (e) {
                $(this).removeClass (function (index, className) {
                    return (className.match (/(^|\s)effect-\S+/g) || []).join(' ');
                });
              });
      
              $('#datatable').DataTable({
                responsive: true,
                language: {
                  searchPlaceholder: 'Search...',
                  sSearch: '',
                  lengthMenu: '_MENU_ per page',
                }
              });
              
              $('#datatable2').DataTable({
                bLengthChange: false,
                searching: false,
                responsive: true,
                paging: false,
                info: false
              });

              <?php if($filename2 == "add_student") { ?>

                // Default Values
                $('#year').val('<?php echo date('Y'); ?>').trigger('change');

              <?php } ?>

              <?php if($filename2 == "edit_student") { ?>

                // Default Values
                $('#year').val('<?php echo $row_student['year']; ?>').trigger('change');

              <?php } ?>

              <?php if($filename2 == "view_reports" && isset($_GET['no'])) { ?>

                // Default Values
                $('#student_no').val('<?php echo $_GET['no']; ?>').trigger('change');

              <?php } ?>

              // Select2
              $('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });

              $('#birth_date,#log_date').datepicker({
                  showOtherMonths: true,
                  selectOtherMonths: true,
                  changeYear: true,
                  changeMonth: true,
                  numberOfMonths: 1
              });
                        
              // Time Picker
              $('#tpBasic').timepicker();
              $('#tp2').timepicker({'scrollDefault': 'now'});
              $('#tp_time').timepicker();
      
              $('#log_time').on('click', function (){
                $('#tp_time').timepicker('setTime', new Date());
              });
               
          });
    </script>
  <?php } ?>