<form action="{{route('manageuser.update')}}" method="post" id="editUser" enctype="multipart/form-data">
    @csrf
    <div class="card card-primary card-outline">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <input name="id_edit" type="hidden" value="{{$data->id}}" class="form-control" id="id_edit">

                        <label for="email">Email<span class="text-danger">*</span></label>
                        <input name="email" type="email" class="form-control" value="{{$data->email}}" id="email" placeholder="Enter Email">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Name<span class="text-danger">*</span></label>
                        <input name="name" type="name" class="form-control" value="{{$data->name}}" id="name" placeholder="Enter Name">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="password">Password<span class="text-danger">*</span></label>
                        <input name="password" type="password" class="form-control" id="password" placeholder="Leave Blank For Old Password">
                    </div>
                </div>
               
               
            </div>
            <div class="card-footer">
                <button onclick="" name="submit" type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div>
</form>
<script>
    $(function() {
        $('#editUser').validate({
            rules: {
                email: {
                    required: true
                },
                name: {
                    required: true
                },
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
