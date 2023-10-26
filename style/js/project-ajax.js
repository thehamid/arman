jQuery(document).ready(function ($) {




    $('#projectForm').on('submit',function (event) {
         event.preventDefault();
         let project_id=$('#projectId').val();
         let name=$('#name').val();
         let phone=$('#phone').val();
         let value=$('#input_number').val();
        $.ajax({
            url:'/wp1/wp-admin/admin-ajax.php',
            type:'post',
            dataType:'json',
            data:{
                action:'project_pay',
                name:name,
                phone:phone,
                value:value,
                trans_id:0,
                project_id:project_id,
                status:-2,
            },
            success:function (data) {
                console.log(data);
                if(data.success) {
                    $('#projectForm').css('display', 'none');
                    $('#alert').css('display', 'block');
                    $('#alert').addClass('alert-success');
                    $('#alert').append('<p> پرداخت با موفقیت انجام شد </p>');
                    // if(response.success){
                    //     setTimeout(function(){
                    //         window.location.href='/wp1/';
                    //                          },2000);
                    // }
                }
            },
            error:function (error) {
                console.log(error);
                if(error) {
                    $('#projectForm').css('display', 'none');
                    $('#alert').css('display', 'block');
                    $('#alert').addClass('alert-danger');
                    $('#alert').append('<p> پرداخت موفق نبود، خطایی رخ داده است </p>');
                }

            }
        });
    });
});
    
