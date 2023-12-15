@extends('include.master')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="container-fluid">
                        <br>
                        <form action="{{ route('daterange') }}" method="POST" id="daterange">
                            @csrf
                            <div class="col-md-12">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">Report:</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4" id="date">
                                                <div class="form-group" style="margin-right: 20px;">
                                                    <label>Date range button:</label>
                                                    <input name="dateRangehid" type="hidden" id="dateRangehid">
                                                    <div class="input-group">
                                                        <button type="button" class="btn btn-default float-right" id="reportrange">
                                                            <i class="far fa-calendar-alt"></i> <span></span>
                                                            <i class="fas fa-caret-down"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="category">Category<span class="text-danger">*</span></label>
                                                    <select class="form-control select2bs4" style="width: 100%;" name="category" id="category">
                                                        <option value="">Select Category</option>
                                                        {!! generateCategoryOptions() !!}
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-2" id="search">
                                                <div class="form-group" style="margin-top: 27px;">
                                                    <button onclick="" name="search" type="submit" class="btn btn-primary">Search <i class='fas fa-search'></i></button>
                                                </div>
                                            </div>
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

    <script type="text/javascript">
        $(function() {
            var start = moment().subtract(0, 'days');
            var end = moment();

            function cb(start, end) {
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                $('#dateRangehid').val(start.format('YYYY-MM-DD') + '@' + end.format('YYYY-MM-DD'));
            }
            $('#reportrange').daterangepicker({
                startDate: start,
                endDate: end,
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                        'month').endOf('month')]
                }
            }, cb);
            cb(start, end);
        });
    </script>
    <script>
        $(function() {
            $('#date').hide();
            $('#search').hide();
            $('#category').on('change', function() {
                var category = $(this).val();
                if (category == "croma") {
                    $('#date').show();
                    $('#search').show();
                } else if (category == "generic") {
                    $('#date').show();
                    $('#search').show();
                } else {
                    $('#date').hide();
                    $('#search').hide();
                }
            });
        });
    </script>
@endsection
