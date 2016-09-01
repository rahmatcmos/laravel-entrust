@if (Session::has('success'))
    <script>
         swal("Good Job!","{!! Session::get('success') !!}", "success");
    </script>
@endif
