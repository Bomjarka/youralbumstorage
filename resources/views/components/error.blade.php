<div class="alert hidden" role="alert">
    <div class="bg-red-500 text-white font-bold rounded-t px-4 py-2 mt-3">
        <i class="fa fa-lock mr-3"></i>{{ trans('alert-blade.title') }}
    </div>
    <div class="border border-t-0 border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700">
        <p>{{ $value }}</p>
    </div>
</div>


<script>
    if (['nothing-updated'].includes('{{session('status')}}')) {
        $(function(){
            $('.alert').slideDown(300);
            $(".alert").delay(2000).slideUp(300);
        });
    }
</script>
