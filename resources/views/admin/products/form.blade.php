@extends('admin.layouts.app')

@section('content')
@if(isset($productsData))
    <form action="{{ route('admin.products.update', $productsData->id) }}" method="post" id="product-form" enctype="multipart/form-data">
    <input type="hidden" name="_method" value="PUT">
@else
    <form action="{{ route('admin.products.store') }}" method="post" id="product-form" enctype="multipart/form-data">
@endif
    @csrf
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <ol class="breadcrumb float-sm-right">
                            <a href="{{ route('admin.products.index') }}" class="btn btn-sm btn-primary">{{ __('Back') }}</a>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <div class="col-12">
            <div class="row">
                <div class="col-12">
                    @if (session('message'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('message') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @elseif (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                </div>
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Product Details</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Product Name</label>
                                <input type="text" class="form-control" id="name" placeholder="Enter Product Name" name="name" @if(isset($productsData) && isset($productsData->name)) value="{{$productsData->name}}" @else @endif>
                                @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="image">Prduct Image</label>
                                <input type="file" class="form-control file-upload" id="image" name="image" data-urlForUploadFile="{{ route('admin.upload') }}" data-folder="/products" data-fileUrl="storageBaseUrl()">
                                @if ($errors->has('image'))
                                    <span class="text-danger">{{ $errors->first('image') }}</span>
                                @endif

                                <input type="hidden" name="hidden_image" id="hidden-image"  @if(isset($productsData) && isset($productsData->image)) value="{{$productsData->image}}" @else value="" @endif >
                                @if(isset($productsData) && isset($productsData->image))
                                    <img height="60" width="60" src="{{env('STORAGE_URL')}}{{$productsData->image}}">
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="price">Product Price</label>
                                <input type="number" class="form-control" id="price" placeholder="Enter Product Price" name="price" @if(isset($productsData) && isset($productsData->price)) value="{{$productsData->price}}" @else @endif>
                                @if ($errors->has('price'))
                                    <span class="text-danger">{{ $errors->first('price') }}</span>
                                @endif
                            </div>
                            
                            <div class="form-group">
                                <label for="discount-percentage">Product Discount Percentage</label>
                                <input type="number" class="form-control" id="discount-percentage" placeholder="Enter Product Discount Percentage" name="discount_percentage" @if(isset($productsData) && isset($productsData->discount_percentage)) value="{{$productsData->discount_percentage}}" @else @endif>
                                @if ($errors->has('discount_percentage'))
                                    <span class="text-danger">{{ $errors->first('discount_percentage') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="description">Product Description</label>
                                <textarea class="form-control" id="description" placeholder="Enter Product Description" name="description" >@if(isset($productsData) && isset($productsData->description)) {!! $productsData->description !!} @else @endif</textarea>
                                @if ($errors->has('description'))
                                    <span class="text-danger">{{ $errors->first('description') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </form>
    <br>
    <br>
@endsection

@push('js')	
<script type="text/javascript">
    var baseUrl = "{{env('APP_URL')}}";
    
    $(document).ready(function() {
       $('.summernote').summernote({height: 100});
    });
    
    // (function ($, global) {
    //     if($('input[name=hidden_image]').val()){
    //             urlForStorage = baseUrl+$('input[name=hidden_image]').val();
    //             // $('.hidden-image').attr('href', urlForStorage );
    //             // $('.hidden-image').show();
    //     }

    //     //Setup the ajax request
    //     $.ajaxSetup({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         },
    //         error: function (xhr) {
    //             $('#loader-image-overlay').addClass('hidden');
    //             try {
    //                 switch (xhr.status) {
    //                     case 403:
    //                         addAffixAlert(JSON.parse(xhr.responseText).message, 'danger');
    //                         break;

    //                     case 422:
    //                         if ('function' == typeof this.showValidationError)
    //                             this.showValidationError(xhr);
    //                         else
    //                             showValidationError(xhr);
    //                         break;

    //                     default:
    //                         this.displayError ? this.displayError(xhr) : addAffixAlert('Oops! Something went wrong.', 'danger');
    //                 }

    //                 this.onError ? this.onError() : '';
    //             } catch (e) {
    //                 global.console.log('Exception occured in error handler.');
    //                 addAffixAlert('Oops! Something went wrong. Please try again.', 'danger');
    //                 throw e;
    //             }
    //         }
    //     });
        
    //     global.addAffixAlert = function (message, type = 'success', timelimit = 5000) {
    //         if($("#affixAlertWrapper").length == 0) {
    //             $(document.body).append("<div id='affixAlertWrapper' class='affix-alert-wrapper'></div>");
    //         }

    //         $('#affixAlertWrapper').append(
    //             '<div class="alert alert-' + type + ' alert-dismissible alert-affix fade show" role="alert"> ' +
    //             message +
    //             '<button type="button" class="close" data-dismiss="alert" aria-label="Close"> ' +
    //             '<span aria-hidden="true">&times;</span> ' +
    //             '</button> ' +
    //             '</div>'
    //         );
    //         affixAlertTimeout(timelimit);
    //     };

    //     global.affixAlertTimeout = function (wait){
    //         setTimeout(function(){
    //             if($("#affixAlertWrapper").length != 0) {
    //                 $('#affixAlertWrapper').children('.alert:first-child').slideUp("normal", function() {
    //                     $(this).remove();
    //                     if ($("#affixAlertWrapper").html().length <= 0) {
    //                         $("#affixAlertWrapper").remove();
    //                     }
    //                 });
    //             }
    //         }, wait);
    //     }
    //     /* File upload */
    //     $('.file-upload').on('change', function(){

    //         // if($('.file-upload').valid())
    //         // {
    //             file = this.files[0];
    //             fileFolder = $(this).attr('data-folder');
    //             fileShow = fileFolder.split('/');
    //             fileShow = fileShow[fileShow.length-1];
    //             urlForUploadFile = $(this).attr('data-urlForUploadFile');
    //             fileUrl = $(this).attr('data-fileUrl');
    //             $('.disable-on-file-upload').attr('disabled', true);
    //             $('.disable-on-file-upload').attr('title', 'File is uploading');
    //             uploadFile(file, fileFolder, urlForUploadFile, $('.disable-on-file-upload'), fileUrl, fileShow);
    //         // }
    //     });

    //     /* File upload function */
    //     global.uploadFile = function (file, fileFolder, url, submitButton, fileUrl, fileShow){
    //         var myFormData = new FormData();
    //         myFormData.append('file', file);
    //         myFormData.append('fileFolder', fileFolder);
    //         $.ajax({
    //             url: url,
    //             type: 'POST',
    //             cache : false,
    //             data: myFormData,
    //             enctype: "multipart/form-data",
    //             processData: false,
    //             contentType: false,
    //             success: function (response) {
    //                 if(response.error){
    //                     addAffixAlert(response.error, 'danger');

    //                 } else{
    //                     addAffixAlert(response.message);
    //                     $('.'+fileShow).show();
    //                 }
    //                 submitButton.attr('disabled', false);
    //                 submitButton.attr('title', '');
    //                 if(fileFolder == '/products/'){
    //                     $('#hidden-image').val(response.file);
    //                 }
                    
    //                 // $('.'+fileShow).attr('href', fileUrl+response.file);
    //                 // $('.hidden_image'+fileShow).attr('src', fileUrl+response.file);
    //             },
    //             displayError: function (xhr) {
    //                 addAffixAlert(xhr.responseText, 'danger');
    //             }
    //         });
    //     }
        
    // })(jQuery, window);
</script>
@endpush