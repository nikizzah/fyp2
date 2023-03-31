<script src="plugins/jQuery/jquery.min.js"></script>
   <script src="plugins/bootstrap/bootstrap.min.js" async></script>
   <script src="plugins/slick/slick.min.js"></script>

   <!-- Main Script -->
   <script src="js/script.js"></script>
   <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
   <script type="text/javascript">
      $(document).ready(function() {
         $.ajaxSetup({
               headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
         });

         $('#year').on('change', function() {
               var year = $(this).val();
               if (year) {
                  $.ajax({
                     url: '/chooseSemester/' + year,
                     type: 'GET',
                     dataType: 'json',
                     success: function(data) {
                        console.log(data);
                        $('#semester').empty();
                        $.each(data, function(value) {
                           $('#semester').append('<option value="' + value + '">' + value + '</option>');
                        });
                     }

                  });
               } else {
                  $('#semester').empty();
               }
         });
      });
   </script>


</script>

                 