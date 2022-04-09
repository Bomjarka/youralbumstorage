@props(['action', 'album'])

<div x-data="{ initial: true, deleting: false }" class="text-sm flex items-center">

    <button
        x-on:click="$el.form.submit()"
        x-on:deleting.window="$el.disabled = true"
        type="button"
        class="openModal mt-6 inline-flex items-center px-6 py-3 text-white font-semibold bg-red-400 hover:bg-red-700 rounded-md shadow-sm delete-photo"
    >
        {{ "Delete " . $album->id}}
    </button>
</div>
<x-albums.delete-albums-modal :action="$action" :album="$album"></x-albums.delete-albums-modal>


