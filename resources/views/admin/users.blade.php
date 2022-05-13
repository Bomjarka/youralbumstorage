<x-admin-layout>
    <x-slot name="title">
        Users
    </x-slot>
    <div class="w-full h-screen overflow-x-hidden border-t flex flex-col">
        <main class="w-full flex-grow p-6">
            <h1 class="text-3xl text-black pb-6">Users</h1>
            <div class="w-full mt-6">
                <p class="text-xl pb-3 flex items-center">
                    <i class="fas fa-list mr-3"></i> All users
                </p>
                <div class="bg-white overflow-auto">
                    <table class="min-w-full bg-white">
                        <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="text-left py-3 px-4 uppercase font-semibold text-sm">ID</th>
                            <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Full Name</th>
                            <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Login</th>
                            <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Phone</th>
                            <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Email</th>
                            <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Albums</th>
                            <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Photos</th>
                            <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Is Blocked</th>
                            </td>
                        </tr>
                        </thead>
                        <tbody class="text-gray-700">
                        @foreach($users as $user)
                            <tr>
                                <td class="text-left py-3 px-4">{{ $user->id }}</td>
                                <td class="text-left py-3 px-4"><a class="hover:text-blue-500"
                                                                         href="{{ route('adminUser', [$user]) }}">{{ $user->fullName() }}</a>
                                </td>
                                <td class="text-left py-3 px-4">{{ $user->login }}</td>
                                <td class="text-left py-3 px-4">{{ $user->phone }}</td>
                                <td class="text-left py-3 px-4"><a class="hover:text-blue-500"
                                                                   href="mailto:jonsmith@mail.com">{{ $user->email }}</a>
                                </td>
                                <td class="text-left py-3 px-4">{{ $user->albums->count() }}</td>
                                <td class="text-left py-3 px-4">{{ $user->photos->count() }}</td>
                                <td class="text-left py-3 px-4">@if ($user->isBlocked()) Blocked @else Not blocked @endif</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</x-admin-layout>




