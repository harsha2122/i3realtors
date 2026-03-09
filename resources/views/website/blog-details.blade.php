@extends('layouts.website')
@section('title', $post->seo_title ?? $post->title)
@section('description', $post->seo_description ?? Str::limit(strip_tags($post->content), 160))
@section('content')
<div class="min-h-screen bg-white">
    <div class="bg-gray-900 text-white py-16">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl">
                <div class="mb-6">
                    @if($post->category)
                        <span class="inline-block bg-blue-600 px-4 py-2 rounded text-sm font-semibold">
                            {{ $post->category->name }}
                        </span>
                    @endif
                </div>
                <h1 class="text-5xl font-bold mb-6">{{ $post->title }}</h1>
                <div class="flex items-center gap-8 text-gray-300">
                    <div class="flex items-center gap-2">
                        <span class="font-semibold">{{ $post->author->name }}</span>
                    </div>
                    <span>{{ $post->published_at->format('M d, Y') }}</span>
                    <span>{{ $post->getReadingTimeAttribute() }} min read</span>
                    <span>{{ $post->view_count }} views</span>
                </div>
            </div>
        </div>
    </div>

    @if($post->featured_image)
        <img src="{{ Storage::url($post->featured_image) }}" alt="{{ $post->title }}"
            class="w-full h-96 object-cover">
    @endif

    <div class="container mx-auto px-4 py-16">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <main class="lg:col-span-2">
                <article class="prose prose-lg max-w-none mb-12">
                    {!! $post->content !!}
                </article>

                @if($post->seo_keywords)
                    <div class="mb-12 pb-12 border-b">
                        <p class="text-sm text-gray-600 mb-2 font-semibold">Tags:</p>
                        <div class="flex flex-wrap gap-2">
                            @foreach(explode(',', $post->seo_keywords) as $keyword)
                                <span class="inline-block bg-blue-100 text-blue-800 text-xs px-3 py-1 rounded-full">
                                    {{ trim($keyword) }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if($post->tags->count())
                    <div class="mb-12 pb-12 border-b">
                        <p class="text-sm text-gray-600 mb-2 font-semibold">Categories:</p>
                        <div class="flex flex-wrap gap-2">
                            @foreach($post->tags as $tag)
                                <span class="inline-block bg-gray-200 text-gray-800 text-sm px-4 py-2 rounded">
                                    {{ $tag->name }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Comments Section -->
                <div class="mb-12">
                    <h3 class="text-2xl font-bold mb-8">Comments ({{ $post->comments()->approved()->count() }})</h3>

                    @if($post->comments()->approved()->count())
                        <div class="space-y-8 mb-12">
                            @foreach($post->comments()->approved()->get() as $comment)
                                <div class="border-l-4 border-blue-500 pl-6">
                                    <p class="font-semibold">{{ $comment->author_name }}</p>
                                    <p class="text-gray-500 text-sm mb-4">{{ $comment->created_at->format('M d, Y') }}</p>
                                    <p class="text-gray-700">{{ $comment->content }}</p>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <form action="{{ route('api.v1.comments.store', $post) }}" method="post" class="border-t pt-8">
                        @csrf
                        <h4 class="text-lg font-semibold mb-6">Leave a Comment</h4>
                        <div class="grid grid-cols-2 gap-6 mb-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Name</label>
                                <input type="text" name="author_name" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                <input type="email" name="author_email" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                            </div>
                        </div>
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Comment</label>
                            <textarea name="content" rows="5" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500"></textarea>
                        </div>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-semibold">
                            Post Comment
                        </button>
                    </form>
                </div>

                <!-- Related Posts -->
                @if($relatedPosts->count())
                    <div class="mt-16">
                        <h3 class="text-2xl font-bold mb-8">Related Posts</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            @foreach($relatedPosts as $related)
                                <div class="border rounded-lg overflow-hidden hover:shadow-lg transition">
                                    @if($related->featured_image)
                                        <img src="{{ Storage::url($related->featured_image) }}" alt="{{ $related->title }}"
                                            class="w-full h-40 object-cover">
                                    @endif
                                    <div class="p-6">
                                        <h4 class="font-bold mb-2">
                                            <a href="{{ route('blog.show', $related->slug) }}" class="hover:text-blue-600">
                                                {{ $related->title }}
                                            </a>
                                        </h4>
                                        <p class="text-gray-600 text-sm mb-4">{{ $related->published_at->format('M d, Y') }}</p>
                                        <p class="text-gray-700">{{ Str::limit(strip_tags($related->content), 100) }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </main>

            <!-- Sidebar -->
            <aside class="lg:col-span-1">
                <!-- Author Info -->
                <div class="bg-gray-100 p-6 rounded-lg mb-8">
                    <h4 class="font-bold text-lg mb-2">About Author</h4>
                    <p class="text-gray-700 text-sm">{{ $post->author->name }}</p>
                </div>

                <!-- Share -->
                <div class="mb-8">
                    <h4 class="font-bold text-lg mb-4">Share This Post</h4>
                    <div class="flex gap-4">
                        <a href="https://facebook.com/sharer/sharer.php?u={{ url()->current() }}" target="_blank"
                            class="text-blue-600 hover:text-blue-800">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                        <a href="https://twitter.com/intent/tweet?url={{ url()->current() }}&text={{ $post->title }}" target="_blank"
                            class="text-blue-400 hover:text-blue-600">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2s9 5 20 5a9.5 9.5 0 00-9-5.5c4.75 2.25 7-7 7-7"/></svg>
                        </a>
                        <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ url()->current() }}" target="_blank"
                            class="text-blue-700 hover:text-blue-900">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.475-2.236-1.986-2.236-1.081 0-1.722.722-2.006 1.413-.103.25-.129.599-.129.948v5.444h-3.554s.047-8.834 0-9.749h3.554v1.383c.43-.664 1.198-1.61 2.915-1.61 2.129 0 3.726 1.39 3.726 4.38v5.596zM5.337 9.432c-1.144 0-1.915-.759-1.915-1.71 0-.957.765-1.71 1.959-1.71 1.188 0 1.911.753 1.927 1.71 0 .951-.739 1.71-1.971 1.71zm1.581 10.02H3.656V9.704h3.262v9.748zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.225 0z"/></svg>
                        </a>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</div>
@endsection
