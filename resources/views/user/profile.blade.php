<x-app-layout>
    <x-slot name="title">
        Profile
    </x-slot>
    <x-slot name="header">
    </x-slot>
    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-t-lg">
                <div class="p-6 bg-white border-b border-gray-200 text-center">
                    {{ trans('view-profilepage-profile.title') }}
                </div>
            </div>
            <div class="flex flex-row flex-wrap w-full bg-white overflow-hidden shadow-sm sm:rounded-b-lg">
                <aside class="hidden md:block w-1/6 bg-gray-50 h-100% rounded dark:bg-gray-800" aria-label="Sidebar">
                    <div class="overflow-y-auto py-4 px-3 ">
                        <ul class="space-y-2">
                            <li>
                                <a href="#"
                                   class="profile flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white bg-gray-200 hover:bg-gray-200 dark:hover:bg-gray-700">
                                    <i class="fa fa-user mr-3"></i>{{ trans('view-profilepage-profile.profile-data') }}
                                </a>
                            </li>
                            <li>
                                <a href="#"
                                   class="album_and_photos flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-200 dark:hover:bg-gray-700">
                                    <i class="fa fa-user mr-3"></i>{{ trans('view-profilepage-albums-and-photos.albums-and-photos') }}
                                </a>
                            </li>
                            <li>
                                <a href="#"
                                   class="trash flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-200 dark:hover:bg-gray-700">
                                    <i class="fa fa-trash-alt mr-3"></i>{{ trans('view-profilepage-trash.trash') }}
                                </a>
                            </li>
                            <li>
                                <a href="#"
                                   class="flex items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-200 dark:hover:bg-gray-700">
                                    <i class="fa fa-star mr-3 text-amber-400"></i>{{ trans('view-profilepage-premium.premium') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </aside>
                <main role="main" class="w-5/6 pt-1 px-2">
                    <x-user.user-profile :user="$user"></x-user.user-profile>
                    <x-user.albums-and-photos :user="$user"></x-user.albums-and-photos>
                    <x-user.user-trash :user="$user"></x-user.user-trash>
                </main>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    let gender;
    if (sessionStorage.getItem('lastUri') == 'trash') {
        trash();
    } else if (sessionStorage.getItem('lastUri') == 'profile_data') {
        profileData();
    } else if (sessionStorage.getItem('lastUri') == 'albums_and_photos') {
        albumsAndPhotos();
    }


    function profileData() {
        $('.profile').addClass('bg-gray-200');
        $('.trash').removeClass('bg-gray-200');
        $('.user_data').removeClass('hidden');
        $('.user_albums').addClass('hidden');
        $('.user_albums').addClass('hidden');
        $('.user_photos').addClass('hidden');
        $('.user_trashed_albums').addClass('hidden');
        $('.user_trashed_photos').addClass('hidden');
        $('.album_and_photos').removeClass('bg-gray-200');

        sessionStorage.setItem('lastUri', 'profile_data')
    }

    function trash() {
        $('.profile').removeClass('bg-gray-200');
        $('.trash').addClass('bg-gray-200');
        $('.user_data').addClass('hidden');
        $('.user_albums').addClass('hidden');
        $('.user_photos').addClass('hidden');
        $('.user_trashed_albums').removeClass('hidden');
        $('.user_trashed_photos').removeClass('hidden');
        $('.album_and_photos').removeClass('bg-gray-200');

        sessionStorage.setItem('lastUri', 'trash')
    }

    function albumsAndPhotos() {
        $('.profile').removeClass('bg-gray-200');
        $('.trash').removeClass('bg-gray-200');
        $('.user_data').addClass('hidden');
        $('.user_trashed_albums').addClass('hidden');
        $('.user_trashed_photos').addClass('hidden');
        $('.album_and_photos').addClass('bg-gray-200');
        $('.user_albums').removeClass('hidden');
        $('.user_photos').removeClass('hidden');
        sessionStorage.setItem('lastUri', 'albums_and_photos')
    }

    $('.profile').on('click', function () {
        profileData();
    });
    $('.album_and_photos').on('click', function () {
        albumsAndPhotos();
    });
    $('.trash').on('click', function () {
        trash();
    });

    $('.edit_profile').on('click', function () {
        $('.edit_profile').addClass('hidden');
        $('.user_data').addClass('hidden');
        $('.user_input').removeClass('hidden');
    });

    $('.cancel_edit').on('click', function () {
        $('.edit_profile').removeClass('hidden');
        $('.user_data').removeClass('hidden');
        $('.user_input').addClass('hidden');
    });

    $("input").on('change', function () {
        gender = $(this).val();
    });


    $('.save_edit').on('click', function () {
        let login = document.getElementById("login").value;
        let firstName = document.getElementById("first_name").value;
        let secondName = document.getElementById("second_name").value;
        let lastName = document.getElementById("last_name").value;
        let phone = document.getElementById("phone").value;
        let email = document.getElementById("email").value;
        let birthdate = document.getElementById("birthday").value;
        let userId = document.getElementById("user_id").value;
        let url = "{{ route('editUserProfile') }}";

        $.post(url, {
            _token: '{{ csrf_token() }}',
            userId: userId,
            login: login,
            firstName: firstName,
            secondName: secondName,
            lastName: lastName,
            phone: phone,
            email: email,
            birthdate: birthdate,
            gender: gender
        })
            .success(function (response) {
                $('.edit_profile').removeClass('hidden');
                $('.user_data').removeClass('hidden');
                $('.save_edit').addClass('hidden');
                $('.cancel_edit').addClass('hidden');
                $('.user_input').addClass('hidden');
                if (!alert(response.msg)) {
                    window.location.reload();
                }
            })
    });

    $('.restore_album').on('click', function () {
        let albumId = $(this).attr('value');
        let url = "{{ route('restoreAlbum') }}";
        $.post(url, {
            _token: '{{ csrf_token() }}',
            albumId: albumId
        })
            .success(function (response) {
                if (!alert(response.msg)) {
                    window.location.reload();
                }
            })
    });

    $('.restore_photo').on('click', function () {
        let photoId = $(this).attr('value');
        let url = "{{ route('restorePhoto') }}";
        $.post(url, {
            _token: '{{ csrf_token() }}',
            photoId: photoId
        })
            .success(function (response) {
                if (!alert(response.msg)) {
                    window.location.reload();
                }
            })
    });

</script>

