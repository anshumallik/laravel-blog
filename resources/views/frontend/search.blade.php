@extends('frontend.layouts.app')
@section('page-name', 'Search Product')
@section('content')
    <section class="search pt-5 pb-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="search_page">
                        <h4>Search Result For : {{ request('query') }}</h4>
                        @if ($searchResults->count() > 0)
                            <h5 class="mt-4">{{ $searchResults->count() }} results found
                                for {{ request('query') }}
                                !</h5>
                        @else
                            <div class="no-result">
                                <i class="fa fa-frown-o"></i>
                                <h3>Oops! No results found
                                </h3>
                                <p>Sorry. We couldn't find what your are looking for. Please try with different
                                    query.
                                </p>
                            </div>
                        @endif
                    </div>
                    <div class="row card-area pt-4">
                        @foreach ($searchResults->groupByType() as $type => $modelSearchResults)
                            @foreach ($modelSearchResults as $searchResult)
                                <div class="col-lg-4 col-md-6">
                                    <div class="iq-blog-box">
                                        <div class="iq-blog-image clearfix">
                                            <img src="{{ asset('images/admin/blog/' . $searchResult->searchable['image']) }}" alt="#">
                                        </div>
                                        <div class="iq-blog-detail">
                                            <div class="blog-title">
                                                <a href="{{ $searchResult->url }}">
                                                    <h4 class="mb-3">{{ $searchResult->searchable['name'] }}</h4>
                                                </a>
                                            </div>
                                            <p class="iq-desc">{!! substr($searchResult->searchable['description'], 0, 100) !!}</p>
                                            <div class="blog-footer">
                                                
                                                <div class="blog-button">
                                                    <a class="iq-link-button"
                                                        href="{{ $searchResult->url }}">Read
                                                        More</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        
    </section>
@endsection
