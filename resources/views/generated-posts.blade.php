<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Generated Posts</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen p-8">

    <div class="max-w-4xl mx-auto">

        <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Generated Posts</h1>

            <a href="{{ route('generate.form') }}"
               class="px-4 py-2 bg-gray-700 text-white rounded-lg hover:bg-gray-800 transition">
                Back to Form
            </a>
        </div>

        {{-- Error Message --}}
        @if(isset($error))
            <div class="mb-4 p-4 bg-red-100 border border-red-300 text-red-700 rounded">
                {{ $error }}
            </div>
        @endif

        {{-- No Posts Found --}}
        @if(empty($posts) || !is_array($posts))
            <div class="p-6 bg-white text-gray-700 border border-gray-200 rounded-xl shadow text-center">
                No posts found.
            </div>
        @else

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                @foreach(array_slice($posts, 0, 4) as $post)
                    <div class="bg-white shadow-md rounded-xl p-6 border border-gray-200">
                        <h2 class="text-xl font-semibold mb-3 text-gray-900">
                            {{ $post['title'] ?? 'No Title' }}
                        </h2>
<p class="text-gray-700 leading-relaxed">
        {{ Str::limit($post['body'] ?? 'No content available.', 150) }}
        @if(strlen($post['body'] ?? '') > 150)
            <a href="http://127.0.0.1:8002/posts/{{ $post['id'] }}" onclick="document.getElementById('full-post-{{ $post['id'] }}').classList.toggle('hidden'); return false;" class="text-blue-600 font-semibold ml-1">
                Read more
            </a>
        @endif
    </p>
                    </div>
                @endforeach

            </div>

        @endif
 <h2 class="text-2xl font-semibold mb-4 mt-12">Nearby Businesses</h2>
    @if(empty($nearby) || !is_array($nearby))
        <div class="p-6 bg-white text-gray-700 border border-gray-200 rounded-xl shadow text-center">
            No nearby businesses found.
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($nearby as $business)
                <div class="bg-white shadow-md rounded-xl p-6 border border-gray-200">
                    <h3 class="text-xl font-semibold mb-2 text-gray-900">
                        {{ $business['name'] ?? 'No Name' }}
                    </h3>
                    <p class="text-gray-700 mb-1"><strong>Category:</strong> {{ $business['category'] ?? '-' }}</p>
                    <p class="text-gray-700 mb-1"><strong>Address:</strong> {{ $business['address'] ?? '-' }}</p>
                    <p class="text-gray-700 mb-1"><strong>Postal Code:</strong> {{ $business['postal_code'] ?? '-' }}</p>
                    <p class="text-gray-700 mb-1">
                        <strong>Phone:</strong>
                        @if(!empty($business['phone']))
                            <a href="tel:{{ $business['phone'] }}" class="text-blue-600 hover:underline">
                                {{ $business['phone'] }}
                            </a>
                        @else
                            -
                        @endif
                    </p>
                    <p class="text-gray-700 mb-1">
                        <strong>Website:</strong>
                        @if(!empty($business['website']))
                            <a href="{{ $business['website'] }}" target="_blank" class="text-blue-600 hover:underline">
                                Visit Website
                            </a>
                        @else
                            -
                        @endif
                    </p>
                    <p class="text-gray-700 mb-1">
    <strong>Email:</strong>
    @if(!empty($business['email']))
        <a href="mailto:{{ $business['email'] }}" class="text-blue-600 hover:underline">
            {{ $business['email'] }}
        </a>
    @else
        -
    @endif
</p>

                    <p class="text-gray-700 mb-1"><strong>Rating:</strong> {{ $business['rating'] ?? '-' }}</p>
                </div>
            @endforeach
        </div>
    @endif

</div>
    </div>

</body>
</html>
