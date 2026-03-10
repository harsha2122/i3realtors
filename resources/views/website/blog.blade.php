@extends('layouts.website')
@section('title', 'Blog - ' . \App\Models\Setting::get('site_name', config('app.name')))
@section('content')

    <!-- Page Header Start -->
    <div class="page-header bg-section dark-section parallaxie">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="page-header-box">
                        <h1 class="text-anime-style-2" data-cursor="-opaque">Blog</h1>
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item active">Blog</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

<div class="min-h-screen bg-white">
    <div class="container mx-auto px-4" style="padding: 80px 0;">

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <div class="lg:col-span-2">
                <div class="mb-12">
                    <form action="{{ route('blog.index') }}" method="get" class="relative">
                        <input type="text" name="q" placeholder="Search posts..."
                            class="w-full px-6 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500"
                            value="{{ request('q') }}">
                        <button type="submit" class="absolute right-3 top-3 text-gray-400">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </button>
                    </form>
                </div>

                <div class="space-y-12">
                    @forelse($posts as $post)
                        <article class="border-b pb-12 last:border-b-0">
                            @if($post->featured_image)
                                <img src="{{ Storage::url($post->featured_image) }}" alt="{{ $post->title }}"
                                    class="w-full h-64 object-cover rounded-lg mb-6">
                            @endif
                            <h2 class="text-3xl font-bold mb-3">
                                <a href="{{ route('blog.show', $post->slug) }}" class="hover:text-blue-600">
                                    {{ $post->title }}
                                </a>
                            </h2>
                            <div class="flex items-center gap-4 text-gray-600 mb-4 text-sm">
                                <span>{{ $post->author->name }}</span>
                                <span>{{ $post->published_at->format('M d, Y') }}</span>
                                <span>{{ $post->getReadingTimeAttribute() }} min read</span>
                            </div>
                            <p class="text-gray-700 mb-6">
                                {{ $post->excerpt ?? Str::limit(strip_tags($post->content), 200) }}
                            </p>
                            <div class="flex items-center justify-between">
                                <div class="flex gap-2 flex-wrap">
                                    @foreach($post->tags as $tag)
                                        <span class="inline-block bg-blue-100 text-blue-800 text-xs px-3 py-1 rounded-full">
                                            {{ $tag->name }}
                                        </span>
                                    @endforeach
                                </div>
                                <a href="{{ route('blog.show', $post->slug) }}"
                                    class="text-blue-600 hover:text-blue-800 font-semibold">
                                    Read More →
                                </a>
                            </div>
                        </article>
                    @empty
                        <div class="text-center py-12">
                            <p class="text-gray-600">No posts found</p>
                        </div>
                    @endforelse
                </div>

                <div class="mt-12">
                    {{ $posts->links() }}
                </div>
            </div>

            <aside class="lg:col-span-1">
                @if(isset($categories) && $categories->count())
                    <div class="mb-12">
                        <h3 class="text-xl font-bold mb-6">Categories</h3>
                        <ul class="space-y-2">
                            @foreach($categories as $category)
                                <li>
                                    <a href="{{ route('blog.index', ['category' => $category->slug]) }}"
                                        class="text-gray-700 hover:text-blue-600 flex items-center">
                                        <span class="mr-2">{{ $category->name }}</span>
                                        <span class="text-gray-400 text-sm">({{ $category->posts()->published()->count() }})</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if(isset($recentPosts) && $recentPosts->count())
                    <div class="mb-12">
                        <h3 class="text-xl font-bold mb-6">Recent Posts</h3>
                        <ul class="space-y-4">
                            @foreach($recentPosts->take(5) as $post)
                                <li>
                                    <a href="{{ route('blog.show', $post->slug) }}"
                                        class="text-gray-700 hover:text-blue-600 text-sm font-medium">
                                        {{ $post->title }}
                                    </a>
                                    <div class="text-gray-400 text-xs mt-1">
                                        {{ $post->published_at->format('M d, Y') }}
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </aside>
        </div>
    </div>
</div>
@endsection
