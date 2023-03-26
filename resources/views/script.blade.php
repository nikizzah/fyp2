<script src="plugins/jQuery/jquery.min.js"></script>
   <script src="plugins/bootstrap/bootstrap.min.js" async></script>
   <script src="plugins/slick/slick.min.js"></script>

   <!-- Main Script -->
   <script src="js/script.js"></script>
   <script type = "text/javascript">
      $(document).ready(function(){
         $(#year).on('change', 'subject_year', function() {
            var year = $(this).val();
            if (year) {
               $.ajax({
                  url: '/chooseSemester/'+year,
                  type: 'GET';
                  dataType: 'json';
                  success: function(data) {
                     $('#semester').empty();
                     $.each(data, function(key, value){
                        $('#semester').append('<option value="'+ key +'">'+ value +'</option>');
                     });
                     }
                  });
               }else{
                  $('#semester').empty();
               }
            });
         });
</script>

                 