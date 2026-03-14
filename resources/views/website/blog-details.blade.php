@extends('layouts.website')
@section('title', $post->seo_title ?? $post->title)
@section('description', $post->seo_description ?? Str::limit(strip_tags($post->content), 160))
@section('content')

    <!-- Page Header Start -->
    <div class="page-header bg-section dark-section parallaxie">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="page-header-box">
                        <h1 class="text-anime-style-2" data-cursor="-opaque">{{ $post->title }}</h1>
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('blog.index') }}">Blog</a></li>
                                <li class="breadcrumb-item active">{{ Str::limit($post->title, 40) }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Blog Detail Start -->
    <div class="our-blog" style="padding: 80px 0;">
        <div class="container">
            <div class="row">

                <!-- Main Content -->
                <div class="col-xl-8 col-lg-8">

                    <!-- Featured Image -->
                    @if($post->featured_image)
                    <div class="post-featured-image mb-4" style="position: relative; border-radius: 16px; overflow: hidden;">
                        <figure style="margin: 0;">
                            <img src="{{ asset('uploads/' . $post->featured_image) }}" alt="{{ $post->title }}"
                                 style="width: 100%; height: 420px; object-fit: cover;" />
                        </figure>
                        @if($post->category)
                            <span style="position: absolute; top: 20px; left: 20px; background: var(--accent-secondary-color); color: var(--accent-color); font-size: 11px; font-weight: 700; padding: 6px 16px; border-radius: 20px; text-transform: uppercase; letter-spacing: 0.5px;">
                                {{ $post->category->name }}
                            </span>
                        @endif
                    </div>
                    @endif

                    <!-- Post Meta -->
                    <div class="d-flex flex-wrap gap-3 mb-4" style="font-size: 13px; color: var(--text-color);">
                        <span><i class="fas fa-user me-1" style="color: var(--primary-color);"></i>{{ $post->author->name }}</span>
                        <span><i class="fas fa-calendar-alt me-1" style="color: var(--primary-color);"></i>{{ $post->published_at->format('M d, Y') }}</span>
                        <span><i class="fas fa-clock me-1" style="color: var(--primary-color);"></i>{{ $post->getReadingTimeAttribute() }} min read</span>
                        <span><i class="fas fa-eye me-1" style="color: var(--primary-color);"></i>{{ number_format($post->view_count) }} views</span>
                    </div>

                    <!-- Post Content -->
                    <div class="blog-content mb-5" style="font-size: 15px; line-height: 1.9; color: var(--text-color);">
                        {!! $post->content !!}
                    </div>

                    <!-- Tags -->
                    @if($post->tags->count())
                    <div class="d-flex flex-wrap align-items-center gap-2 mb-5 pt-4"
                         style="border-top: 1px solid var(--divider-color);">
                        <span style="font-size: 13px; font-weight: 700; color: var(--primary-color); text-transform: uppercase; letter-spacing: 0.5px;">Tags:</span>
                        @foreach($post->tags as $tag)
                            <span style="background: var(--bg-color); color: var(--text-color); font-size: 12px; font-weight: 600; padding: 5px 14px; border-radius: 20px; border: 1px solid var(--divider-color);">
                                {{ $tag->name }}
                            </span>
                        @endforeach
                    </div>
                    @endif

                    <!-- Comments -->
                    <div class="mb-5">
                        <div class="section-title">
                            <h3 class="text-anime-style-2" style="font-size: 1.5rem;" data-cursor="-opaque">
                                Comments <span>({{ $post->comments()->approved()->count() }})</span>
                            </h3>
                        </div>

                        @foreach($post->comments()->approved()->get() as $comment)
                        <div class="mb-4 p-4" style="border-left: 3px solid var(--accent-secondary-color); background: var(--bg-color); border-radius: 0 10px 10px 0;">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span style="font-weight: 700; font-size: 14px; color: var(--primary-color);">
                                    <i class="fas fa-user-circle me-2" style="color: var(--accent-secondary-color);"></i>{{ $comment->author_name }}
                                </span>
                                <span style="font-size: 12px; color: var(--text-color);">{{ $comment->created_at->format('M d, Y') }}</span>
                            </div>
                            <p style="margin: 0; font-size: 14px; line-height: 1.7; color: var(--text-color);">{{ $comment->content }}</p>
                        </div>
                        @endforeach

                        <!-- Comment Form -->
                        <div class="mt-5 p-4" style="background: var(--bg-color); border-radius: 16px;">
                            <h4 style="font-size: 1.2rem; font-weight: 700; color: var(--primary-color); margin-bottom: 1.5rem;">Leave a Comment</h4>
                            <form action="{{ route('api.v1.comments.store', $post) }}" method="post">
                                @csrf
                                <div class="row g-3 mb-3">
                                    <div class="col-md-6">
                                        <label style="font-size: 13px; font-weight: 600; color: var(--primary-color); margin-bottom: 6px; display: block;">Name <span style="color: red;">*</span></label>
                                        <input type="text" name="author_name" required
                                               style="width: 100%; padding: 12px 16px; border: 2px solid var(--divider-color); border-radius: 8px; font-size: 14px; background: #fff; outline: none; transition: border-color 0.2s;"
                                               onfocus="this.style.borderColor='var(--primary-color)'"
                                               onblur="this.style.borderColor='var(--divider-color)'" />
                                    </div>
                                    <div class="col-md-6">
                                        <label style="font-size: 13px; font-weight: 600; color: var(--primary-color); margin-bottom: 6px; display: block;">Email <span style="color: red;">*</span></label>
                                        <input type="email" name="author_email" required
                                               style="width: 100%; padding: 12px 16px; border: 2px solid var(--divider-color); border-radius: 8px; font-size: 14px; background: #fff; outline: none; transition: border-color 0.2s;"
                                               onfocus="this.style.borderColor='var(--primary-color)'"
                                               onblur="this.style.borderColor='var(--divider-color)'" />
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label style="font-size: 13px; font-weight: 600; color: var(--primary-color); margin-bottom: 6px; display: block;">Comment <span style="color: red;">*</span></label>
                                    <textarea name="content" rows="5" required
                                              style="width: 100%; padding: 12px 16px; border: 2px solid var(--divider-color); border-radius: 8px; font-size: 14px; background: #fff; outline: none; resize: vertical; transition: border-color 0.2s;"
                                              onfocus="this.style.borderColor='var(--primary-color)'"
                                              onblur="this.style.borderColor='var(--divider-color)'"></textarea>
                                </div>
                                <button type="submit" class="btn-default">
                                    <i class="fas fa-paper-plane me-2"></i>Post Comment
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Related Posts -->
                    @if($relatedPosts->count())
                    <div class="mt-4">
                        <div class="section-title">
                            <span class="section-sub-title wow fadeInUp">Keep Reading</span>
                            <h3 class="text-anime-style-2" data-cursor="-opaque">Related <span>Posts</span></h3>
                        </div>
                        <div class="row">
                            @foreach($relatedPosts as $related)
                            <div class="col-md-6 wow fadeInUp">
                                <div class="post-item">
                                    <div class="post-featured-image">
                                        <a href="{{ route('blog.show', $related->slug) }}">
                                            <figure>
                                                <img src="{{ $related->featured_image ? asset('uploads/' . $related->featured_image) : asset('images/post-1.jpg') }}"
                                                     alt="{{ $related->title }}" />
                                            </figure>
                                        </a>
                                    </div>
                                    <div class="post-item-content">
                                        <div class="d-flex gap-3 mb-2" style="font-size: 12px; color: var(--text-color);">
                                            <span><i class="fas fa-calendar-alt me-1" style="color: var(--primary-color);"></i>{{ $related->published_at->format('M d, Y') }}</span>
                                            <span><i class="fas fa-clock me-1" style="color: var(--primary-color);"></i>{{ $related->getReadingTimeAttribute() }} min</span>
                                        </div>
                                        <h2>
                                            <a href="{{ route('blog.show', $related->slug) }}">{{ $related->title }}</a>
                                        </h2>
                                        <p style="font-size: 13px; line-height: 1.7; color: var(--text-color);">
                                            {{ Str::limit($related->excerpt ?? strip_tags($related->content), 90) }}
                                        </p>
                                        <a href="{{ route('blog.show', $related->slug) }}" class="readmore-btn">Read More</a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                </div>

                <!-- Sidebar -->
                <div class="col-xl-4 col-lg-4 mt-5 mt-lg-0">
                    <div class="page-single-sidebar">

                        <!-- About Author -->
                        <div class="page-category-list">
                            <h2>About Author</h2>
                            <ul>
                                <li style="padding-bottom: 0; border: none; margin: 0;">
                                    <div class="d-flex align-items-center gap-3">
                                        <div style="width: 52px; height: 52px; border-radius: 50%; background: var(--primary-color); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                            <i class="fas fa-user" style="color: var(--accent-secondary-color); font-size: 20px;"></i>
                                        </div>
                                        <div>
                                            <div style="font-weight: 700; font-size: 15px; color: var(--primary-color);">{{ $post->author->name }}</div>
                                            <div style="font-size: 12px; color: var(--text-color); margin-top: 2px;">Real Estate Expert</div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>

                        <!-- Share This Post -->
                        <div class="page-category-list">
                            <h2>Share This Post</h2>
                            <ul>
                                <li style="padding-bottom: 0; border: none; margin: 0;">
                                    <div class="d-flex gap-3 flex-wrap">
                                        <a href="https://facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank"
                                           style="width: 44px; height: 44px; background: var(--primary-color); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: var(--accent-secondary-color); font-size: 16px;"
                                           onmouseover="this.style.background='var(--accent-secondary-color)';this.style.color='var(--primary-color)'"
                                           onmouseout="this.style.background='var(--primary-color)';this.style.color='var(--accent-secondary-color)'">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($post->title) }}" target="_blank"
                                           style="width: 44px; height: 44px; background: var(--primary-color); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: var(--accent-secondary-color); font-size: 16px;"
                                           onmouseover="this.style.background='var(--accent-secondary-color)';this.style.color='var(--primary-color)'"
                                           onmouseout="this.style.background='var(--primary-color)';this.style.color='var(--accent-secondary-color)'">
                                            <i class="fab fa-x-twitter"></i>
                                        </a>
                                        <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(url()->current()) }}" target="_blank"
                                           style="width: 44px; height: 44px; background: var(--primary-color); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: var(--accent-secondary-color); font-size: 16px;"
                                           onmouseover="this.style.background='var(--accent-secondary-color)';this.style.color='var(--primary-color)'"
                                           onmouseout="this.style.background='var(--primary-color)';this.style.color='var(--accent-secondary-color)'">
                                            <i class="fab fa-linkedin-in"></i>
                                        </a>
                                        <a href="https://wa.me/?text={{ urlencode($post->title . ' ' . url()->current()) }}" target="_blank"
                                           style="width: 44px; height: 44px; background: var(--primary-color); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: var(--accent-secondary-color); font-size: 16px;"
                                           onmouseover="this.style.background='var(--accent-secondary-color)';this.style.color='var(--primary-color)'"
                                           onmouseout="this.style.background='var(--primary-color)';this.style.color='var(--accent-secondary-color)'">
                                            <i class="fab fa-whatsapp"></i>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </div>

                        <!-- Categories -->
                        @if($categories->count())
                        <div class="page-category-list">
                            <h2>Categories</h2>
                            <ul>
                                @foreach($categories as $cat)
                                <li>
                                    <a href="{{ route('blog.index', ['category' => $cat->slug]) }}">
                                        {{ $cat->name }}
                                        <span style="position: absolute; left: 0; top: 50%; transform: translateY(-50%); font-size: 11px; color: var(--text-color); right: 25px; text-align: right; pointer-events: none;">
                                            ({{ $cat->posts_count }})
                                        </span>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <!-- Recent Posts -->
                        @if($recentPosts->count())
                        <div class="page-category-list">
                            <h2>Recent Posts</h2>
                            <ul>
                                @foreach($recentPosts as $recent)
                                <li>
                                    <a href="{{ route('blog.show', $recent->slug) }}">
                                        {{ Str::limit($recent->title, 48) }}
                                        <div style="font-size: 11px; margin-top: 5px; font-weight: 400; color: var(--text-color);">
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
    <!-- Blog Detail End -->

@endsection
