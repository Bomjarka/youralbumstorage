<div class="success hidden" role="alert">
    <div class="bg-green-500 text-white font-bold rounded-t px-4 py-2 mt-3">
        <i class="fa fa-check mr-3"></i>{{ trans('approving-blade.title') }}
    </div>
    <div class="flex flex-col border border-t-0 border-green-400 rounded-b bg-green-100 px-4 py-3 text-green-700 font-bold">
        <p>
            {{ $value }}
        </p>
    </div>
</div>

<script>
    if (['verification-link-sent','role-created', 'role-updated'].includes('{{session('status')}}')) {
        $(function(){
            $('.success').slideDown(300);
            $(".success").delay(2000).slideUp(300);
        });
    }
</script>
