<form action="{{ route('updatepassword')}}" method="post" id="updatepassword" name="updatepassword" enctype="multipart/form-data">
    @csrf

    <div class="card-body">
       

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="">Old Password<span class="text-danger">*</span></label>
                    <input name="opassword" type="password" class="form-control" id="opassword" placeholder="Enter Your Old Password">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <input type="hidden" name="id" id="id" value="">
                    <label for=""> New Password<span class="text-danger">*</span></label>
                    <input name="npassword" type="password" class="form-control" id="npassword" placeholder="Enter Your New Password">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="">Confirm Password<span class="text-danger">*</span></label>
                    <input name="cpassword" type="password" class="form-control" id="cpassword" placeholder="Re enter Your New Password">
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="col-md-6">
                <button onclick="validate()" name="submit" id="submit-edit" type="submit" class="btn btn-block bg-gradient-primary">Update Password</button>
            </div>
</form>

<script>
  jQuery('#updatepassword').validate({
    rules: {
      opassword: {
        required: true,
        minlength: 5,
      },
      npassword: {
        required: true,
        minlength: 5,
      },
      cpassword: {
        required: true,
        minlength: 5,
        equalTo: "#npassword"
      }
    },
    messages: {
      opassword: {
        required: "Please enter your old password"
      },
      npassword: {
        required: "Please enter your new password"
      },

      cpassword: {
        required: "Please re enter your new password"
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
</script>