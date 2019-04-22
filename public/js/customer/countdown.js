
var isPhone = 1;
function getCode(e){
    checkPhone(); //验证手机号码
    if(isPhone){
        var phoneno = $('#phone').val();

        $.ajax({
            type:'POST',
            url:'/common/mobile.reg',
            data: {pno: phoneno },
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success:function(data){
                $("#msg").html(data.msg);
            }
        });

        resetCode(); //倒计时
    }else{
        $('#phone').focus();
    }

}
//验证手机号码
function checkPhone(){
    var phone = $('#phone').val();
    var pattern = /^1[0-9]{10}$/;
    isPhone = 1;
    if(phone == '') {
        alert('请输入手机号码');
        isPhone = 0;
        return;
    }
    if(!pattern.test(phone)){
        alert('请输入正确的手机号码');
        isPhone = 0;
        return;
    }
}
//倒计时
function resetCode(){
    $('#J_getCode').hide();
    $('#J_second').html('5');
    $('#J_resetCode').show();
    var second = 5;
    var timer = null;
    timer = setInterval(function(){
        second -= 1;
        if(second >0 ){
            $('#J_second').html(second);
        }else{
            clearInterval(timer);
            $('#J_getCode').show();
            $('#J_resetCode').hide();
        }
    },1000);
}