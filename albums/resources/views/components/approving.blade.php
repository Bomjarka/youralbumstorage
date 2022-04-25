<div class="success" role="alert">
    <div class="bg-green-500 text-white font-bold rounded-t px-4 py-2 mt-3">
        <i class="fa fa-check mr-3"></i>Success
    </div>
    <div class="flex flex-col border border-t-0 border-green-400 rounded-b bg-green-100 px-4 py-3 text-green-700 font-bold">
        <p>
            {{ $value }}
        </p>
    </div>
</div>

<script>
    $(function(){
        $(".success").delay(3000).slideUp(300);
    });
</script>