<div class="mt-4">
    <div class="mt-4 space-y-5">
        <div
            class="photo-to-album flex items-center space-x-3 cursor-pointer"
            x-data="{ show: false }" @click="show =!show"><h1 class="text-xs font-medium text-gray-400 uppercase">Options</h1>
            <p class="text-gray-500">Add photo to album</p>
            <div
                class="relative w-10 h-5 transition duration-200 ease-linear rounded-full"
                :class="[show ? 'bg-indigo-500' : 'bg-gray-300']">
                <label for="show"
                       @click="show =!show"
                       class="absolute left-0 w-5 h-5 mb-2 transition duration-100 ease-linear transform bg-white border-2 rounded-full cursor-pointer"
                       :class="[show ? 'translate-x-full border-indigo-500' : 'translate-x-0 border-gray-300']"></label>
                <input type="checkbox" name="show"
                       class="hidden w-full h-full rounded-full appearance-none active:outline-none focus:outline-none"/>
            </div>
        </div>
        <select
            class="form-select invisible appearance-none block text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
            <option selected>Choose album</option>
            @foreach(Auth::user()->albums as $album)
                <option name="album_id" value="{{ $album->id }}">{{ $album->name }}</option>
            @endforeach
        </select>
    </div>
</div>
