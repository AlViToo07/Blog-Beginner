<x-app-layout>
    @php
        $alertMessage = '';

        if (session('create')) {
            $alertMessage = session('create');
        } elseif (session('edit')) {
            $alertMessage = session('edit');
        } elseif (session('delete')) {
            $alertMessage = session('delete');
        }
    @endphp

    @if ($alertMessage)
        <div class="flex items-center p-4 mb-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 max-w-7xl mx-auto mt-6"
            role="alert">
            <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <span class="sr-only">Info</span>
            <div>
                <span class="font-medium">{{ $alertMessage }}
            </div>
        </div>
    @endif

    <div class="bg-white max-w-7xl mx-auto border-2 rounded-md mt-6 p-6">
        <div class="mb-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <h1 class="text-5xl text-gray-900">
                    My Posts
                </h1>
            </div>
        </div>
        <hr class="max-w-7xl mx-auto border-2">


        <a href="{{ route('post.create') }}">
            <button type="button"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 my-4 mx-8 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 focus:outline-none">New
                Post</button>
        </a>


        <div class="mb-4">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <form class="w-full mx-auto">
                    <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only ">Search</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                        </div>
                        <input type="search" id="default-search"
                            class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Search..." name="search" required value="{{ request('search') }}" />
                        <button type="submit"
                            class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2">Search</button>
                    </div>
                </form>
            </div>
        </div>

        @if ($articles->isEmpty())
            <h1 class="text-center text-2xl mt-4">Anda tidak memiliki post</h1>
        @else
            <div class="relative overflow-x-auto max-w-7xl mx-auto px-8">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 border-2">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 w-1/12 text-center">
                                No
                            </th>
                            <th scope="col" class="px-6 py-3 w-6/12">
                                Title
                            </th>
                            <th scope="col" class="px-6 py-3 w-2/12">
                                Category
                            </th>
                            <th scope="col" class="px-6 py-3 w-2/12 text-center">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($articles as $index => $article)
                            <tr class="bg-white border-b">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap text-center">
                                    {{ $index + 1 + ($articles->currentPage() - 1) * $articles->perPage() }}
                                </th>
                                <td class="px-6 py-4 font-medium text-xl text-black ">
                                    {{ $article->title }}
                                </td>
                                <td class="px-6 py-4 font-medium text-xl text-black ">
                                    {{ $article->category->name }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <a href="{{ route('post', $article->slug) }}">
                                        <button type="button"
                                            class="text-white bg-blue-500 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm p-2 me-2 mb-2 focus:outline-none">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="size-4">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                            </svg>
                                        </button>
                                    </a>
                                    <a href="{{ route('post.edit', $article->slug) }}">
                                        <button type="button"
                                            class="text-white bg-yellow-500 hover:bg-yellow-600 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm p-2 me-2 mb-2 focus:outline-none">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="size-4">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                            </svg>
                                        </button>
                                    </a>
                                    <form action="{{ route('post.delete', $article->slug) }}" method="post"
                                        class="inline">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" onclick="return confirm('Yakin menghapus post ?')"
                                            class="text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm p-2 me-2 mb-2 focus:outline-none"><svg
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="size-4">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5m6 4.125 2.25 2.25m0 0 2.25 2.25M12 13.875l2.25-2.25M12 13.875l-2.25 2.25M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="py-4">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="flex justify-between items-center mt-4 bg-white rounded-lg p-4 border-2">
                            <div class="text-sm text-gray-600">
                                <!-- Display current page item range -->
                                Menampilkan artikel {{ $articles->firstItem() }} hingga {{ $articles->lastItem() }}
                                dari
                                {{ $articles->total() }} artikel
                            </div>

                            <!-- Custom Pagination -->
                            <nav class="pagination">
                                {{ $articles->onEachSide(1)->links('components.pagination') }}
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

</x-app-layout>