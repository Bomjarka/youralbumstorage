<x-admin-layout >
    <x-slot name="title">
        Index
    </x-slot>
     <div class="w-full h-screen overflow-x-hidden border-t flex flex-col">
        <main class="w-full flex-grow p-6">
            <h1 class="text-3xl text-black pb-6">Admin Page</h1>
            <div class="w-full mt-6">
                <p class="text-xl pb-3 flex items-center">
                    <i class="fa fa-user mr-3"></i> You are {{ Auth::user()->fullName() }}
                </p>
            </div>
            <!-- Content goes here! 😁 -->
        </main>
    </div>
</x-admin-layout>



