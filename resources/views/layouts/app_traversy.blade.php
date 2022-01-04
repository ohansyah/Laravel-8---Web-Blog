<!DOCTYPE html>
<html lang="{{config('app.locale')}}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
        <link rel="stylesheet" href="{{asset('css/custom.css')}}">
        
        <script src="{{ asset('js/app.js') }}"></script>

        <title>{{config('app.name', 'LSAPP')}}</title>
    </head>

    {{-- @stack('scripts') --}}

    <body>
        @include('inc.navbar')
        <div class="container">
            @include('inc.messages')
            @yield('content')
        </div>
        @stack('scripts')
    </body>
    
    <script src="/ckeditor4-standard/ckeditor.js"></script>
    <script type="text/javascript">
        CKEDITOR.replace('body', {
            filebrowserUploadUrl: "{{route('ckeditor.image-upload', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'
        });
    </script>

    {{-- <script src="/ckeditor5-build-classic/ckeditor.js"></script>
    <script>
        // version 5
        ClassicEditor
            .create( document.querySelector( '#ckeditor' ), {
                // plugins: [ CKFinder, ... ],
                // removePlugins: [ 'Heading', 'Link' ],
                // toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]

            } )
            .then( editor => {
                console.log( 'Editor was initialized', editor );
                window.editor = editor;
            } )
            .catch( err => {
                console.error( err.stack );
            } );
    </script> --}}
</html>
