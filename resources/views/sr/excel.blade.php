@extends('include.master')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Upload Excel</h3>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('import') }}" method="post" id="excel"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="card card-primary card-outline">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="password">Category<span
                                                                class="text-danger">*</span></label>
                                                        <select class="form-control select2bs4" style="width: 100%;"
                                                            name="category" id="category">
                                                            <option value="">Select Category</option>
                                                            {!! generateCategoryOptions() !!}
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group" id="data_box" style="margin-top: 26px;">
                                                        <input name="file" type="file" class="form-control"
                                                            id="file" placeholder="Upload File">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group" id="data" style="margin-top: 26px;">
                                                        <button onclick="" name="submit" type="submit"
                                                            class="btn btn-primary toastrDefaultSuccess">Upload
                                                            File</button>
                                                    </div>
                                                </div>
                                                <div class="col-md-2" id="format" style="margin-top: 26px;">
                                                    <a id="downloadLink" download>
                                                        <i class="fa fa-download" style="color: black"
                                                            aria-hidden="true"></i> Download Format
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    
    <script>
        $(function() {
            $('#excel').validate({
                rules: {
                    file: {
                        required: true,
                        extension: "csv",
                    },
                },
                messages: {
                    file: {
                        extension: "Please select a valid CSV file.",
                    }
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>

    <script>
        $(function() {
            $('#data').hide();
            $('#data_box').hide();
            $('#format').hide();
            $('#category').on('change', function() {
                var category = $(this).val();
                var downloadLink = document.getElementById("downloadLink");
                downloadLink.setAttribute("href", "{{ url('table-export/?name=') }}" + category);
                if (category == "croma") {
                    $('#data').show();
                    $('#data_box').show();
                    $('#format').show();

                } else if (category == "generic") {
                    $('#data').show();
                    $('#data_box').show();
                    $('#format').show();
                } else {
                    $('#data').hide();
                    $('#data_box').hide();
                    $('#format').hide();
                }
            });
        });
    </script>
@endsection
