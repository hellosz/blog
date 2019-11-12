@extends('frontend::layouts.default')
@section('content')
    <div class="title-article text-center">
        <h1>关于</h1>
    </div>
    <div class="text" itemprop="articleBody" style="margin-bottom: 10px;">
        <div id="md_content_2" class="md_content markdown-body editormd-html-preview" style="min-height: 50px;">
            {{$about or '这个家伙很懒，什么都没有留下。。。'}}
        </div>
    </div>
    <div class="comment-text layui-form">
        <div id="comments" data-paginate_total="{{$paginate_total}}">

        </div>
        <div class="page-navigator" id="paginate">

        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('/assets/js/frontend/about.js')}}"></script>
@endsection