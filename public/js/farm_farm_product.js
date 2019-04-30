$(document).ready(function() {

    $('select[name="cate1"]').on('change', function(){
        var cate1 = $(this).val();

        if(cate1) {
            $.ajax({
                url: '/common/farm_prod_cate.cate2/'+cate1,
                type:"GET",
                dataType:"json",
                beforeSend: function(){
                    $('#loader').css("visibility", "visible");
                },
                success:function(data) {

                    $('select[name="cate2"]').empty();

                    $.each(data, function(key, value){

                        $('select[name="cate2"]').append('<option value="'+ value['id'] +'">' + value['goods_category'] + '</option>');

                    });
                },
                complete: function(){
                    $('#loader').css("visibility", "hidden");
                }
            });
        } else {
            $('select[name="cate1"]').empty();
        }

    });



});