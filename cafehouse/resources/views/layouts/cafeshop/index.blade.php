@extends('layouts.front')

@section('content')
    <div class="container">
        <hr color="#c0c0c0">
        @if (!is_null($headline))
            <div class="row">
                <div class="headline col-md-10 mx-auto">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="caption mx-auto">
                                <div class="title p-2">
                                    <h1>{{ str_limit($headline->name, 70) }}</h1>
                                </div>
                                <div class="title p-2">
                                    <h1>{{ str_limit($headline->address, 70) }}</h1>
                                </div>
                                <div class="title p-2">
                                    <h1>{{ str_limit($headline->phone, 70) }}</h1>
                                </div>
                                <div class="title p-2">
                                    <h1>{{ str_limit($headline->time, 70) }}</h1>
                                </div>
                                <div class="title p-2">
                                    <h1>{{ str_limit($headline->holiday, 70) }}</h1>
                                </div>
                                <div class="title p-2">
                                    <h1>{{ str_limit($headline->instagram, 70) }}</h1>
                                </div>
                                <div class="title p-2">
                                    <h1>{{ str_limit($headline->officialsite, 70) }}</h1>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-6">
                            <p class="body mx-auto">{{ str_limit($headline->body, 650) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <hr color="#c0c0c0">
        <div class="row">
            <div class="posts col-md-8 mx-auto mt-3">
                @foreach($posts as $post)
                    <div class="post">
                        <div class="row">
                            <div class="text col-md-6">
                                <div class="date">
                                    {{ $post->updated_at->format('Y年m月d日') }}
                                </div>
                                <div class="name">
                                    {{ str_limit($post->name, 150) }}
                                </div>
                                <div class="address">
                                    {{ str_limit($post->address, 150) }}
                                </div>
                                <div class="phone">
                                    {{ str_limit($post->phone, 150) }}
                                </div>
                                <div class="time">
                                    {{ str_limit($post->time, 150) }}
                                </div>
                                <div class="holiday">
                                    {{ str_limit($post->holiday, 150) }}
                                </div>
                                <div class="instagram">
                                    {{ str_limit($post->instagram, 150) }}
                                </div>
                                <div class="officialsite">
                                    {{ str_limit($post->officialsite, 150) }}
                                </div>
                                <div class="body mt-3">
                                    {{ str_limit($post->introduction, 1500) }}
                                </div>
                              </div>
                            </div>
                          </div>
                   <hr color="#c0c0c0">
                @endforeach
            </div>
        </div>
    </div>
    </div>
@endsection