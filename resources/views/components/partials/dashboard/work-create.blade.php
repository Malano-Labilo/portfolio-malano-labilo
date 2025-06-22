<form action="{{ route('dashboard') }}" method="POST" enctype="multipart/form-data"
    class="w-full py-[48px] px-[80px] flex flex-col items-center gap-[16px] ">
    @csrf

    <div class="w-full max-w-[720px]">
        <label for="title" class="w-fit max-w-[720px] block mb-2 text-sm font-medium text-dark-first">Title :
        </label>
        <input id="title" name="title" placeholder="Type title..."
            class="w-full max-w-[720px] bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
            required />
    </div>

    <div class="w-full max-w-[720px]">
        <label for="category" class="w-fit max-w-[720px] block mb-2 text-sm font-medium text-dark-first">Category :
        </label>
        <select id="category" name="category" placeholder="Type category..."
            class="w-full max-w-[720px] cursor-pointer bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
            required>
            <option value="">Choose Category</option>
            @foreach (App\Models\Category::get() as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="w-full max-w-[720px]">
        <label for="thumbnail" class="w-fit max-w-[720px] block mb-2 text-sm font-medium text-dark-first">Thumbnail
            : </label>
        <input id="thumbnail" name="thumbnail" type="file" placeholder="Type thumbnail..." class="cursor-pointer"
            required />
    </div>

    <div class="w-full max-w-[720px]">
        <label for="excerpt" class="w-fit max-w-[720px] block mb-2 text-sm font-medium text-dark-first">Excerpt :
        </label>
        <input id="excerpt" name="excerpt" placeholder="Type excerpt..."
            class="w-full max-w-[720px] bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"
            required />
    </div>

    <div class="w-full max-w-[720px]">
        <label for="link" class="w-fit max-w-[720px] block mb-2 text-sm font-medium text-dark-first">Link :
        </label>
        <input id="link" name="link" placeholder="Type link..."
            class="w-full max-w-[720px] bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow" />
    </div>

    <div class="w-full max-w-[720px]">
        <label for="">Has Detail Page Or Not : </label><br>
        <label><input type="radio" name="has_page" value="1" required> Yes</label>
        <label><input type="radio" name="has_page" value="0" required> No</label>
    </div>

    <div class="w-full max-w-[720px]">
        <label for="description" class="w-fit max-w-[720px] block mb-2 text-sm font-medium text-dark-first">Description
            : </label>
        <textarea id="description" name="description" placeholder="Type description..."
            class="w-full max-w-[720px] bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow"></textarea>
    </div>
    <div class="flex gap-[16px]">
        <button type="submit" id="createProductModalButton" data-modal-target="createProductModal"
            data-modal-toggle="createProductModal"
            class="flex items-center justify-center cursor-pointer bg-blue-second text-white-first bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 focus:outline-none ">
            <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"
                aria-hidden="true">
                <path clip-rule="evenodd" fill-rule="evenodd"
                    d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
            </svg>
            Add New Project
        </button>
        <a href="{{ route('dashboard') }}" id="createProductModalButton" data-modal-target="createProductModal"
            data-modal-toggle="createProductModal"
            class="flex items-center justify-center cursor-pointer bg-red-blue text-white-first bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 focus:outline-none ">
            Cancel
        </a>
    </div>
</form>
