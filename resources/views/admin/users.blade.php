<x-admin-layout>
    <x-slot name="title">
        {{ trans('admin-menu.users') }}
    </x-slot>
    <div class="w-full h-screen overflow-x-hidden border-t flex flex-col">
        <main class="w-full flex-grow p-6">
            <h1 class="text-3xl text-black pb-6">{{ trans('admin-menu.users') }}</h1>
            <div class="w-full mt-6">
                <p class="text-xl pb-3 flex items-center">
                    <i class="fas fa-list mr-3"></i> {{ trans('admin-users.allusers') }}
                </p>
                <div class="bg-white overflow-auto">
                    <table class="min-w-full bg-white">
                        <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="text-left py-3 px-4 uppercase font-semibold text-sm">ID</th>
                            <th class="text-left py-3 px-4 uppercase font-semibold text-sm">{{ trans('admin-users.fullname') }}</th>
                            <th class="text-left py-3 px-4 uppercase font-semibold text-sm">{{ trans('view-profilepage-profile.login') }}</th>
                            <th class="text-left py-3 px-4 uppercase font-semibold text-sm">{{ trans('view-profilepage-profile.phone') }}</th>
                            <th class="text-left py-3 px-4 uppercase font-semibold text-sm">{{ trans('view-profilepage-profile.email') }}</th>
                            <th class="text-left py-3 px-4 uppercase font-semibold text-sm">{{ trans('view-profilepage-albums-and-photos.albums') }}</th>
                            <th class="text-left py-3 px-4 uppercase font-semibold text-sm">{{ trans('view-profilepage-albums-and-photos.photos') }}</th>
                            <th class="text-left py-3 px-4 uppercase font-semibold text-sm">{{ trans('admin-users.blocked') }}</th>
                            <th class="text-left py-3 px-4 uppercase font-semibold text-sm">{{ trans('admin-users.verified') }}</th>
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
                                <td class="text-center py-3 px-4">{{ $user->albums->count() }}</td>
                                <td class="text-center py-3 px-4">{{ $user->photos->count() }}</td>
                                <td class="text-center py-3 px-4">@if ($user->isBlocked()) {{ trans('base-phrases.yes') }} @else {{ trans('base-phrases.no') }} @endif</td>
                                <td class="text-center py-3 px-4">@if ($user->isVerified()) {{ trans('base-phrases.yes') }} @else {{ trans('base-phrases.no') }} @endif</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</x-admin-layout>




