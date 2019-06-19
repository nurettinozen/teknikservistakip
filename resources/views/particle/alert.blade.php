<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
@if(count($errors))
    @foreach($errors->all() as $message)
        <script>
            toastr.error("{{$message}}", "", window.successOpts);
        </script>
    @endforeach
@endif

{{ $success = Session::get('success') }}
@if($success){
<script>
    toastr.success("{{$success}}", "", window.errorOpts);
</script>
@endif
