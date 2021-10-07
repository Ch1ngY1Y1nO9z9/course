$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(function() {
        $('.summernote').summernote({
            toolbar: [
                ['style', ['style']],
                ['fontsize', ['fontsize']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['insert', ['link', 'hr']],
            ],
            height: 400,
            lang: 'zh-TW',
            fontNames: [
                'sourcehansans-tc','Microsoft JhengHei', 'Heiti TC', 'LiHei Pro', 'Gotham', 'Helvetica Neue', 'Helvetica', 'Arial', 'sans-serif'
            ]
        });
    });

    $('#class_id').hide();
    $('#account_id').hide();
    $('#email_content').hide();
    $('#submit_btn').hide();
    $('#title').hide();

    $('#filter').change(function(){
        if($('#filter').val() == 'class'){
            $('#class_id').show();
            $('#account_id').hide();
            $('input[name="account_id"]').val('')
            $('small').text('');
            $('#submit_btn').show();

        }else if($('#filter').val() == 'student'){
            $('#class_id').hide();
            $('#account_id').show();
            $('#submit_btn').hide();

        }else{
            $('#class_id').hide();
            $('#account_id').hide();
            $('input[name="account_id"]').val('')
            $('small').text('');
            $('#submit_btn').show();

        }

        $('#email_content').show()
        $('#title').show();

    })

    $('input[name="account_id"]').keyup(function() {
        current_value = getvalue();
        check_account(current_value);
    });

    function getvalue(){
        val = $('input[name="account_id"]').val()
        $('input[name="account_id"]').val(val)

        return val
    }

    function check_account(val){
        data = new FormData();
        data.append("account_id", val);
        $.ajax({
            data: data,
            type: "POST",
            url: "/micro-course/mail/check_account",
            cache: false,
            contentType: false,
            processData: false,
            success: function(result) {
                if(result == 'false'){
                    $('small').text('未找到該帳號');
                    $('#submit_btn').hide();
                }else{
                    $('small').text('姓名: '+result.name+' / Email: '+result.email);
                    $('#submit_btn').show();
                }
            }
        });
    }


    $('#submit_btn').click(function(){
        $('form').submit();
    })
} );