@extends('admin.layouts.app')

@section('title', 'Blog Posts')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl font-bold">Blog Posts</h1>
    <a href="{{ route('admin.blog.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-semibold">
        + New Post
    </a>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Author</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Views</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Published</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($posts as $post)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $post->title }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $post->author->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $post->category->name ?? '-' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $post->status === 'published' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                            {{ ucfirst($post->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $post->view_count }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $post->published_at?->format('M d, Y') ?? '-' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm space-x-2">
                        <a href="{{ route('admin.blog.edit', $post) }}" class="text-blue-600 hover:text-blue-800">Edit</a>
                        @if($post->status === 'draft')
                            <form action="{{ route('admin.blog.publish', $post) }}" method="post" class="inline">
                                @csrf
                                <button type="submit" class="text-green-600 hover:text-green-800">Publish</button>
                            </form>
                        @endif
                        <form action="{{ route('admin.blog.destroy', $post) }}" method="post" class="inline" onsubmit="return confirm('Delete this post?')">
                            @csrf
                            @method('delete')
                            <button type="submit" class="text-red-600 hover:text-red-800">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="px-6 py-4 text-center text-gray-500">No posts found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="px-6 py-4">
        {{ $posts->links() }}
    </div>
</div>
@endsection
