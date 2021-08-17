@extends('layouts.app')

@section('title','Dashboard')

@section('content')


<style>
.mt-300{
    margin-top: 300px;
}

.mb-300{
    margin-bottom: 300px;
}

.m-0{
    
}

</style>
<div class="content-wrapper">
                    {{-- <a href="{{ route('pdf') }}" class="btn btn-dark">pdf</a> --}}
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid bd-dark">
        <div class="container">
        
            <form method="POST" action="{{ route('quotes.document.pdf', $quote_id) }}" id="generate-pdf">
            @csrf
            
              
     
                <div class="row">
                    <div class="col-md-12" >
                        <div id="document-editor__toolbar"></div>
                        <div id="toolbar-container"></div>
                        <div id="editor">
                           
                            <figure class="image ck-widget ck-widget_with-resizer image_resized ck-widget_selected" contenteditable="false" style="width:55.15%;"><img src="http://localhost/ufg-form/public/img/logo.png"><div class="ck ck-reset_all ck-widget__type-around"><div class="ck ck-widget__type-around__button ck-widget__type-around__button_before" title="Insert paragraph before block"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 10 8"><path d="M9.055.263v3.972h-6.77M1 4.216l2-2.038m-2 2 2 2.038"></path></svg></div><div class="ck ck-widget__type-around__button ck-widget__type-around__button_after" title="Insert paragraph after block"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 10 8"><path d="M9.055.263v3.972h-6.77M1 4.216l2-2.038m-2 2 2 2.038"></path></svg></div><div class="ck ck-widget__type-around__fake-caret"></div></div><div class="ck ck-reset_all ck-widget__resizer" style="height:288px;left:0px;top:0px;width:569px;"><div class="ck-widget__resizer__handle ck-widget__resizer__handle-top-left"></div><div class="ck-widget__resizer__handle ck-widget__resizer__handle-top-right"></div><div class="ck-widget__resizer__handle ck-widget__resizer__handle-bottom-right"></div><div class="ck-widget__resizer__handle ck-widget__resizer__handle-bottom-left"></div><div class="ck ck-size-view ck-orientation-bottom-right" style="display: none;">55.15%</div></div></figure>
                            <hr />
                            @foreach ($documents as $key => $details)
                                <h2><strong>{{ $details['day_date'] }}</strong></h2>
                                <div>
                                    <p style="margin: 0px !important;" >1. {{  $details['transfer'] }}</p>
                                    <p style="margin: 0px !important;" >2. {{  $details['accommodation'] }}</p>
                                    <p style="margin: 0px !important;" >Check in : {{  $details['check_in'] }}</p>
                                    <p style="margin: 0px !important;" >3. {{  $details['transfer_to'] }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col">
                        <button type="submit" class="btn btn-block btn-outline-dark">Genereate PDF</button>
                    </div>
                </div>
            </form>
        </div>
        
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

@endsection

@push('scripts')
    <script>DecoupledDocumentEditor
        .create( document.querySelector( '#editor' ), {
            
        toolbar: {
            items: [
                'exportPdf',
                'exportWord',
                '|',
                'heading',
                'fontFamily',
                'fontSize',
                'fontColor',
                'fontBackgroundColor',
                '|',
                'bold',
                'italic',
                'underline',
                'strikethrough',
                '|',
                'alignment',
                '|',
                'numberedList',
                'bulletedList',
                '|',
                'outdent',
                'indent',
                '|',
                'todoList',
                'link',
                'blockQuote',
                'imageInsert',
                'imageUpload',
                'insertTable',
                'mediaEmbed',
                '|',
                'highlight',
                'pageBreak',
                'findAndReplace',
                'undo',
                'redo',
                'CKFinder',
                'codeBlock',
                // 'htmlEmbed'
            ]
        },
        language: 'en',
        image: {
            toolbar: [
                'imageTextAlternative',
                'imageStyle:inline',
                'imageStyle:block',
                'imageStyle:side'
            ]
        },
        table: {
            contentToolbar: [
                'tableColumn',
                'tableRow',
                'mergeTableCells',
                'tableCellProperties',
                'tableProperties'
            ]
        },
            licenseKey: '',
            
            
            
        } )
        .then( editor => {
            window.editor = editor;
            document.querySelector( '#document-editor__toolbar' ).appendChild( editor.ui.view.toolbar.element );
            document.querySelector( '#toolbar-container' ).classList.add( 'ck-reset_all' );
        } )
        .catch( error => {
            console.error( 'Oops, something went wrong!' );
            console.error( 'Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:' );
            console.warn( 'Build id: 3jsrijwq6ra6-nmur7pivyya9' );
            console.error( error );
        } );
</script>
@endpush