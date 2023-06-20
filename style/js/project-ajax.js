jQuery(document).ready(function ($) {
    $('#projectForm').on('submit',function (event) {
         event.preventDefault();

         let project_id=$('#projectId').val();
         let name=$('#Name').val();
         let phone=$('#Phone').val();
         let value=$('#Value').val();
        $.ajax({
            url:'/sina/wp-admin/admin-ajax.php',
            type:'post',
            dataType:'json',
            data:{
                action:'project_pay',
                name:name,
                phone:phone,
                value:value,
                trans_id:1,
                project_id:project_id,
                status:1,
            },
            success:function (response) {
            },
            error:function (error) {
                if(error){

                }
            }
        });
    });
});
    
