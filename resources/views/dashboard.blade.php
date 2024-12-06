<x-app-layout>
{{--    <x-slot name="header">--}}
{{--        <h2 class="font-semibold text-xl text-gray-800 leading-tight">--}}
{{--            {{ __('Dashboard') }}--}}
{{--        </h2>--}}
{{--    </x-slot>--}}
    <div class="mt-6">
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-semibold text-gray-900">Complete Images Database</h3>
                    <div class="flex gap-3">
{{--                        <button onclick="exportTableToExcel()" class="inline-flex items-center px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium rounded-md transition-colors">--}}
{{--                            <i class="bi bi-file-earmark-excel me-2"></i>--}}
{{--                            Export Excel--}}
{{--                        </button>--}}
{{--                        <button onclick="exportTableToPDF()" class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-md transition-colors">--}}
{{--                            <i class="bi bi-file-earmark-pdf me-2"></i>--}}
{{--                            Export PDF--}}
{{--                        </button>--}}
                        <button onclick="window.print()" class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white text-sm font-medium rounded-md transition-colors">
                            <i class="bi bi-printer me-2"></i>
                            Print
                        </button>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table id="imagesTable" class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Author</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Creation Date</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Source</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Main Subject</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Terms</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Comments</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @foreach(\App\Models\Image::with(['terms', 'comments'])->get() as $image)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $image->id }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="h-10 w-10 rounded-lg bg-gray-100 overflow-hidden">
                                        <img src="{{ asset('storage/' . $image->path) }}"
                                             alt="{{ $image->name }}"
                                             class="h-full w-full object-cover">
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $image->name }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $image->author }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $image->creation_date }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $image->source }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900">{{ $image->main_subject }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-wrap gap-2">
                                        @foreach($image->terms as $term)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                {{ $term->name }}
                                            </span>
                                        @endforeach
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        {{ $image->comments->count() }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Quick Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                <!-- Total Images -->
                <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl shadow-lg overflow-hidden">
                    <div class="p-4 sm:p-6">
                        <div class="flex items-center">
                            <div class="rounded-full bg-white/25 p-3">
                                <i class="bi bi-images text-2xl text-white"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-white text-lg font-semibold">Total Images</h3>
                                <p class="text-white text-2xl font-bold">{{ \App\Models\Image::count() }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Terms -->
                <div class="bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-xl shadow-lg overflow-hidden">
                    <div class="p-4 sm:p-6">
                        <div class="flex items-center">
                            <div class="rounded-full bg-white/25 p-3">
                                <i class="bi bi-tags text-2xl text-white"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-white text-lg font-semibold">Total Terms</h3>
                                <p class="text-white text-2xl font-bold">{{ \App\Models\Term::count() }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Comments -->
                <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl shadow-lg overflow-hidden">
                    <div class="p-4 sm:p-6">
                        <div class="flex items-center">
                            <div class="rounded-full bg-white/25 p-3">
                                <i class="bi bi-chat-dots text-2xl text-white"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-white text-lg font-semibold">Total Comments</h3>
                                <p class="text-white text-2xl font-bold">{{ \App\Models\Comment::count() }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pending Modifications -->
                <div class="bg-gradient-to-br from-amber-500 to-amber-600 rounded-xl shadow-lg overflow-hidden">
                    <div class="p-4 sm:p-6">
                        <div class="flex items-center">
                            <div class="rounded-full bg-white/25 p-3">
                                <i class="bi bi-pencil-square text-2xl text-white"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-white text-lg font-semibold">Pending Mods</h3>
                                <p class="text-white text-2xl font-bold">
                                    {{ \App\Models\ProposedModification::where('status', 'pending')->count() }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Recent Activity -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Recent Activity</h3>
                        <div class="flow-root">
                            <ul class="-my-5 divide-y divide-gray-200">
                                @foreach(\App\Models\Comment::with('user', 'image')->latest()->take(5)->get() as $comment)
                                    <li class="py-4">
                                        <div class="flex items-center space-x-4">
                                            <div class="flex-shrink-0">
                                                <span class="inline-flex items-center justify-center h-10 w-10 rounded-full bg-blue-100">
                                                    <span class="text-sm font-medium leading-none text-blue-700">
                                                        {{ substr($comment->user->name ?? 'A', 0, 1) }}
                                                    </span>
                                                </span>
                                            </div>
                                            <div class="min-w-0 flex-1">
                                                <p class="text-sm font-medium text-gray-900">
                                                    {{ $comment->user->name ?? 'Anonymous' }}
                                                </p>
                                                <p class="text-sm text-gray-500">
                                                    Commented on "{{ $comment->image->name }}"
                                                </p>
                                            </div>
                                            <time class="text-sm text-gray-500">
                                                {{ $comment->created_at->diffForHumans() }}
                                            </time>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Content Statistics -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Content Statistics</h3>
                        <dl class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                            <!-- Average Comments per Image -->
                            <div class="px-4 py-5 bg-gray-50 shadow rounded-lg overflow-hidden sm:p-6">
                                <dt class="text-sm font-medium text-gray-500 truncate">
                                    Avg. Comments per Image
                                </dt>
                                <dd class="mt-1 text-3xl font-semibold text-gray-900">
                                    {{ number_format(\App\Models\Comment::count() / max(\App\Models\Image::count(), 1), 1) }}
                                </dd>
                            </div>

                            <!-- Most Active Authors -->
                            <div class="px-4 py-5 bg-gray-50 shadow rounded-lg overflow-hidden sm:p-6">
                                <dt class="text-sm font-medium text-gray-500 truncate">
                                    Unique Authors
                                </dt>
                                <dd class="mt-1 text-3xl font-semibold text-gray-900">
                                    {{ \App\Models\Image::distinct('author')->count('author') }}
                                </dd>
                            </div>

                            <!-- Most Used Terms -->
                            <div class="px-4 py-5 bg-gray-50 shadow rounded-lg overflow-hidden sm:p-6">
                                <dt class="text-sm font-medium text-gray-500 truncate">
                                    Terms per Image (Avg)
                                </dt>
                                <dd class="mt-1 text-3xl font-semibold text-gray-900">
                                    {{ number_format(\DB::table('term_has_images')->count() / max(\App\Models\Image::count(), 1), 1) }}
                                </dd>
                            </div>

                            <!-- Modification Success Rate -->
                            <div class="px-4 py-5 bg-gray-50 shadow rounded-lg overflow-hidden sm:p-6">
                                <dt class="text-sm font-medium text-gray-500 truncate">
                                    Modification Success Rate
                                </dt>
                                @php
                                    $totalMods = \App\Models\ProposedModification::count();
                                    $acceptedMods = \App\Models\ProposedModification::where('status', 'accepted')->count();
                                    $rate = $totalMods > 0 ? ($acceptedMods / $totalMods) * 100 : 0;
                                @endphp
                                <dd class="mt-1 text-3xl font-semibold text-gray-900">
                                    {{ number_format($rate, 1) }}%
                                </dd>
                            </div>
                        </dl>
                    </div>
                </div>

                <!-- Latest Updates -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Latest Updates</h3>
                        <div class="space-y-4">
                            @foreach(\App\Models\Image::latest()->take(5)->get() as $image)
                                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                    <div class="flex items-center">
                                        <div class="w-12 h-12 rounded-lg bg-gray-200 flex items-center justify-center">
                                            <i class="bi bi-image text-gray-500 text-xl"></i>
                                        </div>
                                        <div class="ml-4">
                                            <h4 class="text-sm font-medium text-gray-900">{{ $image->name }}</h4>
                                            <p class="text-sm text-gray-500">By {{ $image->author }}</p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <span class="text-sm text-gray-500">
                                            {{ $image->created_at->format('M d, Y') }}
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Top Terms -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Most Used Terms</h3>
                        <div class="space-y-4">
                            @foreach(\App\Models\Term::withCount('images')->orderBy('images_count', 'desc')->take(5)->get() as $term)
                                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                    <div class="flex items-center">
                                        <span class="inline-flex items-center justify-center h-8 w-8 rounded-full bg-blue-100">
                                            <span class="text-sm font-medium text-blue-700">
                                                {{ $loop->iteration }}
                                            </span>
                                        </span>
                                        <div class="ml-4">
                                            <h4 class="text-sm font-medium text-gray-900">{{ $term->name }}</h4>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                            {{ $term->images_count }} images
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<!-- Ajoutez ces styles supplémentaires -->

