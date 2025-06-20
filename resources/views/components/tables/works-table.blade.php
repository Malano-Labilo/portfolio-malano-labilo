<section class="bg-gray-50  p-3 sm:p-5 font-aleo antialiased">
    <div class="mx-auto max-w-screen-xl">
        <div class="bg-white-first  relative shadow-md sm:rounded-lg overflow-hidden">
            <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 ">
                <div class="w-full md:w-1/2">
                    <form class="flex items-center" action="" method="GET">
                        <label for="simple-search" class="sr-only">Search Works</label>
                        <div class="relative w-full">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 " fill="currentColor"
                                    viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input type="text" id="simple-search" name="keyword"
                                class="bg-gray-50 border border-gray-300 text-dark-first text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 "
                                placeholder="Search Work">
                        </div>
                    </form>
                </div>
                <div
                    class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                    <a href="{{ route('dashboard.work.create') }}" id="createProductModalButton"
                        data-modal-target="createProductModal" data-modal-toggle="createProductModal"
                        class="flex items-center justify-center text-dark-first bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 focus:outline-none ">
                        <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path clip-rule="evenodd" fill-rule="evenodd"
                                d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                        </svg>
                        Add Project
                    </a>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 ">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50  ">
                        <tr>
                            <th scope="col" class="px-4 py-4">No</th>
                            <th scope="col" class="px-4 py-4">Title</th>
                            <th scope="col" class="px-4 py-3">Slug</th>
                            <th scope="col" class="px-4 py-3">Category</th>
                            <th scope="col" class="px-4 py-3">Thumbnail</th>
                            <th scope="col" class="px-4 py-3">Excerpt</th>
                            <th scope="col" class="px-4 py-3">Link</th>
                            <th scope="col" class="px-4 py-3">Has Page Or Not</th>
                            <th scope="col" class="px-4 py-3">Description</th>
                            <th scope="col" class="px-4 py-3">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($works as $work)
                            <tr class="border-b ">
                                <th scope="row" class="px-4 py-3 font-medium text-dark-first whitespace-nowrap ">
                                    #</th>
                                <td class="px-4 py-3">{{ $work->title }}</td>
                                <td class="px-4 py-3">{{ $work->slug }}</td>
                                <td class="px-4 py-3 max-w-[12rem] truncate">{{ $work->category->name }}</td>
                                <td class="px-4 py-3">{{ $work->thumbnail }}</td>
                                <td class="px-4 py-3">{{ $work->expert }}</td>
                                <td class="px-4 py-3">{{ $work->link }}</td>
                                <td class="px-4 py-3">{{ $work->has_page }}</td>
                                <td class="px-4 py-3">{{ $work->Description }}</td>
                                <td class="px-4 py-3 flex gap-[16px] items-center justify-end">
                                    @if ($work->has_page)
                                        <a href="{{ route('dashboard.work', $work->slug) }}" class="w-fit">
                                        @elseif($work->link)
                                            <a href="{{ $work->link }}" target="_blank" rel="noopener noreferrer"
                                                class="w-fit">
                                            @else
                                                <span class="w-fit opacity-50 cursor-not-allowed">
                                    @endif
                                    <button type="submit" class="">show project</button>
                                    @if ($work->has_page || $work->link)
                                        </a>
                                    @endif
                                    <a href=""><button id="{{ $work->id }}"
                                            class="inline-flex items-center cursor-pointer text-sm font-medium hover:bg-gray-100  p-1.5 text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none "
                                            type="button">
                                            Edit
                                        </button></a>
                                    <a href=""><button id="{{ $work->id }}"
                                            class="inline-flex items-center cursor-pointer text-sm font-medium hover:bg-gray-100  p-1.5 text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none "
                                            type="button">
                                            Delete
                                        </button></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if ($works->hasPages())
                {{ $works->links() }}>
            @endif
        </div>
    </div>
</section>
<!-- End block -->
</div>
