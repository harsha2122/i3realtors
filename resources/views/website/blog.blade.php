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

    <!-- Blog Section Start -->
    <div class="our-blog" style="padding: 80px 0;">
        <div class="container">

            <!-- Blog Section Intro -->
            <div class="row section-row mb-5">
                <div class="col-xl-7">
                    <div class="section-title">
                        <span class="section-sub-title wow fadeInUp">Our Blog</span>
                        <h2 class="text-anime-style-2" data-cursor="-opaque">
                            Real Estate Insights & <span>Market Updates</span>
                        </h2>
                    </div>
                </div>
                <div class="col-xl-5">
                    <div class="section-title-content wow fadeInUp" data-wow-delay="0.2s">
                        <p>Stay updated with the latest real estate market insights, investment opportunities, and developer stories. Our blog provides strategic perspectives on property markets, project marketing, investment trends, and real estate developments across India.</p>
                    </div>
                </div>
            </div>

            <div class="row">

                <!-- Main Content -->
                <div class="col-xl-8 col-lg-8">

                    <!-- Search Bar -->
                    <form action="{{ route('blog.index') }}" method="get" class="mb-5">
                        <div class="input-group" style="border: 2px solid var(--divider-color); border-radius: 50px; overflow: hidden;">
                            <input type="text" name="q" class="form-control border-0 shadow-none"
                                   placeholder="Search articles..."
                                   value="{{ request('q') }}"
                                   style="padding: 14px 24px; font-size: 15px; background: transparent;" />
                            <button type="submit" class="btn-default"
                                    style="border-radius: 0 50px 50px 0; padding: 12px 28px; font-size: 14px;">
                                Search
                            </button>
                        </div>
                    </form>

                    <!-- Posts Grid -->
                    <div class="row">
                        @forelse($posts as $post)
                        <div class="col-md-6 wow fadeInUp">
                            <div class="post-item">
                                <div class="post-featured-image">
                                    <a href="{{ route('blog.show', $post->slug) }}">
                                        <figure>
                                            <img src="{{ $post->featured_image ? asset('uploads/' . $post->featured_image) : asset('images/post-' . ((($loop->index % 3) + 1)) . '.jpg') }}"
                                                 alt="{{ $post->title }}" />
                                        </figure>
                                    </a>
                                    @if($post->category)
                                        <span style="position: absolute; top: 16px; left: 16px; background: var(--accent-secondary-color); color: var(--primary-color); font-size: 11px; font-weight: 700; padding: 5px 14px; border-radius: 20px; text-transform: uppercase; letter-spacing: 0.5px;">
                                            {{ $post->category->name }}
                                        </span>
                                    @endif
                                </div>
                                <div class="post-item-content">
                                    <div class="d-flex gap-3 mb-2" style="font-size: 12px; color: var(--text-color);">
                                        <span><i class="fas fa-user me-1" style="color: var(--accent-secondary-color);"></i>{{ $post->author->name }}</span>
                                        <span><i class="fas fa-calendar-alt me-1" style="color: var(--accent-secondary-color);"></i>{{ $post->published_at->format('M d, Y') }}</span>
                                        <span><i class="fas fa-clock me-1" style="color: var(--accent-secondary-color);"></i>{{ $post->getReadingTimeAttribute() }} min read</span>
                                    </div>
                                    <h2>
                                        <a href="{{ route('blog.show', $post->slug) }}">
                                            {{ $post->title }}
                                        </a>
                                    </h2>
                                    <p style="font-size: 14px; line-height: 1.8; color: var(--text-color); margin-top: 10px;">
                                        {{ Str::limit($post->excerpt ?? strip_tags($post->content), 110) }}
                                    </p>
                                </div>
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="d-flex flex-wrap gap-1">
                                        @foreach($post->tags->take(2) as $tag)
                                            <span style="background: var(--bg-color); color: var(--text-color); font-size: 11px; font-weight: 600; padding: 4px 12px; border-radius: 20px; border: 1px solid var(--divider-color);">
                                                {{ $tag->name }}
                                            </span>
                                        @endforeach
                                    </div>
                                    <a href="{{ route('blog.show', $post->slug) }}" class="readmore-btn">Read Article</a>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="col-12 text-center py-5">
                            <i class="fas fa-newspaper fa-3x mb-3" style="color: var(--primary-color); opacity: 0.3;"></i>
                            <h4 style="margin-top: 16px;">No articles found</h4>
                            <p style="color: var(--text-color);">Try a different search or check back later.</p>
                            <a href="{{ route('blog.index') }}" class="btn-default" style="margin-top: 16px;">View All Articles</a>
                        </div>
                        @endforelse
                    </div>

                    <!-- Pagination -->
                    <div class="mt-5">
                        {{ $posts->links() }}
                    </div>

                </div>

                <!-- Sidebar -->
                <div class="col-xl-4 col-lg-4 mt-5 mt-lg-0">
                    <div class="page-single-sidebar">

                        @if(isset($categories) && $categories->count())
                        <div class="page-category-list">
                            <h2>Categories</h2>
                            <ul>
                                @foreach($categories as $category)
                                <li>
                                    <a href="{{ route('blog.index', ['category' => $category->slug]) }}">
                                        <strong>{{ $category->name }}</strong>
                                        @if($category->description)
                                            <span style="display: block; font-size: 12px; font-weight: 400; opacity: 0.7; margin-top: 3px; line-height: 1.5;">{{ $category->description }}</span>
                                        @endif
                                        <span style="float: right; font-size: 11px; opacity: 0.5; margin-top: -18px;">({{ $category->posts()->published()->count() }})</span>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        @if(isset($recentPosts) && $recentPosts->count())
                        <div class="page-category-list">
                            <h2>Recent Articles</h2>
                            <ul>
                                @foreach($recentPosts->take(5) as $recent)
                                <li>
                                    <a href="{{ route('blog.show', $recent->slug) }}">
                                        {{ Str::limit($recent->title, 50) }}
                                        <div style="font-size: 11px; margin-top: 5px; opacity: 0.6; font-weight: 400;">
                                            <i class="fas fa-calendar-alt me-1"></i>{{ $recent->published_at->format('M d, Y') }}
                                        </div>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Blog Section End -->

@endsection
