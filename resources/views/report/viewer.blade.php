@extends('layouts.adminlte.master')

@section('title')
    @lang('report.viewer.title')
@endsection

@section('custom_css')
    <style>
        .pdfobject-container {
            height: 500px;
        }

        .pdfobject {
            border: 1px solid #888;
        }
    </style>
@endsection

@section('page_title')
    <span class="fa fa-table"></span>&nbsp;@lang('report.viewer.page_title')
@endsection

@section('page_title_desc')
    @lang('report.viewer.page_title_desc')
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12 pull-right">
            <div class="btn-toolbar">
                <a id="excelButton" href="{{ asset('storage/reports/' . $fileName . '.xlsx') }}"
                   target="_blank" class="btn btn-primary pull-right"><span class="fa fa-file-excel-o fa-lg"></span> @lang('buttons.download_excel_button')</a>
                <a id="pdfButton" href="{{ asset('storage/reports/' . $fileName . '.pdf') }}"
                   target="_blank" class="btn btn-primary pull-right"><span class="fa fa-file-pdf-o fa-lg"></span> @lang('buttons.download_pdf_button')</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <a id="backButton" href="{{ route('db.report.master') }}"
                   class="btn btn-primary pull-left"><span class="fa fa-arrow-left fa-lg"></span> @lang('buttons.back_button')</a>
            </div>
        </div>
    </div>
    <hr>
    <div class="well">
        <div class="row">
            <div class="col-md-12">
                <div id="pdf-viewer">
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom_js')
    <script type="application/javascript" src="{{ asset('adminlte/js/pdfobject.min.js') }}"></script>
    <script type="application/javascript">
        PDFObject.embed('{{ asset('storage/reports/' . $fileName . '.pdf') }}', "#pdf-viewer");
    </script>
@endsection