<x-app-layout>
    <x-slot name="header">Albums</x-slot>
    <div class="container mx-auto mt-6 p-4">
        <div class="w-full m-2 p-2">
            <a href="{{ route('albums.create') }}" class="bg-green-600 text-white p-2 m-2 font-semibold rounded-lg">Create</a>
        </div>
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50 dark:bg-gray-600 dark:text-gray-200">
                        <tr>
                            <th scope="col" class="relative px-6 py-6">Id</th>
                            <th scope="col" class="relative px-6 py-6">Title</th>
                            <th scope="col" class="relative px-6 py-6">Manage</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($albums as $album)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $album->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a class="text-indigo-500 hover:text-indigo-700 font-semibold"
                                       href="{{ route('albums.show', $album->id) }}">
                                        {{$album->title}}
                                    </a>
                                </td>

                                <td class="px-6 py-4 text-right text-sm">
                                    <div class="flex justify-center">
                                        <a href="{{ route('albums.edit', $album->id) }}"
                                           class="py-6 px-6 bg-green-500 hover:bg-green-700 rounded-lg mr-2">Edit</a>


                                        <button type="button"
                                                class="py-6 px-6 bg-green-500 hover:bg-green-700 rounded-lg mr-2"
                                                data-toggle="modal" data-target="#exampleModal{{$album->id}}"
                                                data-id="{{$album->id}}">
                                            Delete
                                        </button>


                                        <div class="modal fade" id="exampleModal{{$album->id}}" tabindex="-1" role="dialog"
                                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Delete
                                                            Options</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-footer">

                                                        <form method="POST"
                                                              action="{{ route('albums.destroy', $album->id) }}">
                                                            @csrf
{{--                                                            <input type="hidden" name="_method" value="DELETE">--}}
                                                            <button type="submit"
                                                                class="py-6 px-6 bg-green-500 hover:bg-green-700 rounded-lg mr-2"
                                                                style="margin-bottom: 30px" >Delete
                                                                album with images
                                                            </button>
                                                        </form>

                                                        <button
                                                            class="py-6 px-6 bg-green-500 hover:bg-green-700 rounded-lg mr-2"
                                                            data-toggle="modal" data-target="#exampleModalLong{{$album->id}}"
                                                            data-id="{{$album->id}}"
                                                        >Remove
                                                            images to another album and delete album
                                                        </button>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal fade" id="exampleModalLong{{$album->id}}" tabindex="-1" role="dialog"
                                             aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Choose album
                                                            to move images to it</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form method="post" action="{{ route('albums.remove', $album->id) }}">
                                                        @csrf
                                                    <div class="modal-body">
                                                        <select name="album_id"
                                                                class="js-example-placeholder-multiple col-sm-12">
                                                            @foreach($albums as $a)
                                                                <option {{$a->id==$album->id ? "hidden" : ""}}
                                                                    value="{{ $a->id }}">{{ $a->title }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Close
                                                        </button>
                                                        <button type="submit" class="btn btn-primary">Save changes
                                                        </button>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="m-2 p-2">Pagination</div>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
