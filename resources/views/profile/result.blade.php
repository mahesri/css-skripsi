    @extends('Layouts.app')
    @section('title', 'Rekomendasi Karier')
    @section('content')

    <section class="bg-gray-50">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto min-h-screen lg:py-0">
            <div class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0">
                <div class="p-6 space-y-4 md:space-y-6  sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900
                    md:text-2xl mb-4">Recommendation results</h1>
                    <div class="relative overflow-x-auto bg-neutral-primary-soft shadow-xs
                    rounded-base border border-default">

    <table class="w-full text-sm text-left rtl:text-right text-body ">
    <thead class="text-sm text-body bg-neutral-secondary-soft border-b rounded-base border-default">

        <tr>
            <th scope="col" class="px-6 py-3 font-medium">No</th>
        <th scope="col" class="px-6 py-3 font-medium">Roles</th>
        <th scope="col" class="px-6 py-3 font-medium">Score</th>
        </tr>
    </thead>

        @foreach($finalResultsPaginated as $role => $score)
        <tr class="bg-neutral-primary border-b border-default">
            <td class="px-6 py-4">{{ $loop->iteration }}</td>
            <td scope="row" class="px-6 py-4 font-medium text-heading whitespace-nowrap">{{ $role }}</td>
            <td class="px-6 py-4">{{ round($score, 4) }}</td>
        </tr>
        @endforeach

    </table>

{{--                                 Paginations--}}
                                <div class="mt-6 flex justify-center">
                                <nav class="inline-flex items-center space-x-1">
{{--                                 Previous--}}

                                @if ($finalResultsPaginated->onFirstPage())
                                    <span class="px-3 py-2 text-sm text-gray-400 bg-gray-100
                                    rounded-lg cursor-not-allowed">
                                        Prev
                                    </span>
                                @else
                                    <a href="{{ $finalResultsPaginated->previousPageUrl() }}"
                                       class="px-3 py-2 text-sm text-gray-700 bg-white border rounded-lg
                                       hover:bg-indigo-500 hover:text-white transition">
                                        Prev
                                    </a>
                                @endif

{{--                                 Page Numbers--}}

                                @foreach ($finalResultsPaginated->links()->elements[0] ?? [] as $page => $url)

                                    @if ($page == $finalResultsPaginated->currentPage())

                                        <span class="px-3 py-2 text-sm font-semibold text-white bg-indigo-500 rounded-lg">
                                        {{ $page }}
                                        </span>

                                    @else
                                        <a href="{{ $url }}"
                                           class="px-3 py-2 text-sm text-gray-700 bg-white border rounded-lg hover:bg-indigo-500
                                            hover:text-white transition">
                                            {{ $page }}
                                        </a>
                                    @endif
                                @endforeach

{{--                                 Next--}}
                                @if ($finalResultsPaginated->hasMorePages())

                                    <a href="{{ $finalResultsPaginated->nextPageUrl() }}"
                                       class="px-3 py-2 text-sm text-gray-700 bg-white border rounded-lg hover:bg-indigo-500
                                       hover:text-white transition">
                                        Next
                                    </a>

                                @else
                                    <span class="px-3 py-2 text-sm text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed">
                                        Next
                                    </span>
                                @endif

                            </nav> </div> </div> </div> </div> </div>
                                </section>
                                @endsection

