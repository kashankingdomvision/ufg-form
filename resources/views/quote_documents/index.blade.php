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

</style>
    <!-- Begin shared CSS values -->
    <style class="shared-css" type="text/css" >
        .t {
            transform-origin: bottom left;
            z-index: 2;
            position: absolute;
            white-space: pre;
            overflow: visible;
            line-height: 1.5;
        }
        .text-container {
            white-space: pre;
        }
        @supports (-webkit-touch-callout: none) {
            .text-container {
                white-space: normal;
            }
        }
        </style>
        <!-- End shared CSS values -->
        
        
        <!-- Begin inline CSS -->
        <style type="text/css" >
        
        #t1_1{left:210px;bottom:580px;letter-spacing:0.01px;}
        #t2_1{left:381px;bottom:518px;letter-spacing:-0.06px;}
        #t3_1{left:358px;bottom:431px;letter-spacing:-0.04px;}
        #t4_1{left:426px;bottom:400px;letter-spacing:-0.05px;}
        
        .s1_1{font-size:29px;font-family:Helvetica, Arial, sans-serif;color:#000;font-weight:bold;}
        .s2_1{font-size:20px;font-family:Helvetica, Arial, sans-serif;color:#000;}
        .s3_1{font-size:23px;font-family:Helvetica, Arial, sans-serif;color:#000;}
        </style>
        <!-- End inline CSS -->
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
                         
        <div id="p1" style="overflow: hidden; position: relative; background-color: white; width: 909px; height: 1286px;">


    
    <!-- Begin page background -->
    {{-- <div id="pg1Overlay" style="width:100%; height:100%; position:absolute; z-index:1; background-color:rgba(0,0,0,0); -webkit-user-select: none;"></div>
    <div id="pg1" style="-webkit-user-select: none;"><object width="909" height="1286" data="1/1.svg" type="image/svg+xml" id="pdf1" style="width:909px; height:1286px; -moz-transform:scale(1); z-index: 0;"></object></div>
    <!-- End page background -->
    
    
    <!-- Begin text definitions (Positioned/styled in CSS) -->
    <div class="text-container"><span id="t1_1" class="t s1_1">Signature Cruise Split to Dubrovnik </span>
    <span id="t2_1" class="t s2_1">26th July 2021 </span>
    <span id="t3_1" class="t s3_1">Mrs Susan Wehrli </span>
    <span id="t4_1" class="t s3_1">TBA </span></div> --}}
    <!-- End text definitions -->
    
    </div>
                            @foreach ($quoteDetail as $key => $details)
                            <h2><strong>{{ date('D d M Y', strtotime($details['date'])) }}</strong></h2>
                                @foreach ($details as $detail)
                                    @if ($detail['text']??NULL)
                                        
                                        <table>
                                            <tbody>
                                                <tr>
                                                    <td >Transfer To: </td>
                                                    <td >{{ $detail['text']??NULL }}</td>
                                                </tr>
                                                <tr>
                                                    <td >Accomodation Product Name</td>
                                                    <td >{{ $detail['accomodation_product_name']??NULL }}</td>
                                                </tr>
                                                <tr>
                                                    <td >Check in: </td>
                                                    <td >{{ $detail['check_in']??NULL }}</td>
                                                </tr>
                                                <tr>
                                                    <td >Service Exucrsion </td>
                                                    <td >{{ $detail['service_exucrsion']??NULL }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    @endif
                                @endforeach
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