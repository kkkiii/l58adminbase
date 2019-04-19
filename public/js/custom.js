$(document).ready(function() {

    $('select[name="province"]').on('change', function(){
        var provinceId = $(this).val();



        if(provinceId) {
            $.ajax({
                url: '/common/area.get_cities/'+provinceId,
                type:"GET",
                dataType:"json",
                beforeSend: function(){
                    $('#loader').css("visibility", "visible");
                },
                success:function(data) {

                    $('select[name="city"]').empty();

                    $.each(data, function(key, value){

                        $('select[name="city"]').append('<option value="'+ value['code'] +'">' + value['name'] + '</option>');

                    });
                },
                complete: function(){
                    $('#loader').css("visibility", "hidden");
                }
            });
        } else {
            $('select[name="state"]').empty();
        }

    });

    $('select[name="city"]').on('change', function(){
        var cityId = $(this).val();



        if(cityId) {
            $.ajax({
                url: '/common/area.get_district/'+cityId,
                type:"GET",
                dataType:"json",
                beforeSend: function(){
                    $('#loader').css("visibility", "visible");
                },
                success:function(data) {

                    $('select[name="district"]').empty();

                    $.each(data, function(key, value){

                        $('select[name="district"]').append('<option value="'+ value['code'] +'">' + value['name'] + '</option>');

                    });
                },
                complete: function(){
                    $('#loader').css("visibility", "hidden");
                }
            });
        } else {
            $('select[name="state"]').empty();
        }

    });

});