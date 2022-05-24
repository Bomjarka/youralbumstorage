<div class="mt-4 space-y-5">
    <div class="flex items-center space-x-3">
        <h1 class="text-xs font-medium text-gray-400 uppercase">{{ trans('add-photo-form.options') }}</h1>
        <p class="text-gray-500">{{ trans('edit-photo-form.move-photo') }}</p>
        <input type="checkbox"
               class="photo-to-album rounded border-gray-300 text-indigo-600 shadow-sm cursor-pointer focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
               name="show">
    </div>
    <select
        class="form-select hidden w-full appearance-none block text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
        <option disabled selected>{{ trans('add-photo-form.choose-album') }}</option>
        @foreach(Auth::user()->albums as $album)
            @if($album->id == $photo->album->first()->id)
                @continue
            @endif
            <option name="album_id" value="{{ $album->id }}">{{ $album->name }}</option>
        @endforeach
    </select>
</div>


