$(document).ready(function() {
    var last_div_id = "";
    last_div_id = $("input[name=last_div]").val();
    if (last_div_id != "") {
        $('.diet').hide();
        $(last_div_id).show();
    }


    $('.multiselecopt').change(function() {
        $('.continue-btn').show();
    });
    // get gender div value
    $('.gender-option').on("change", function() {
        var id = $(this).parent('div').attr('id');
        var gender_val = $(this).val();
        var dataString = 'gender=' + gender_val;
        var show_div = '.activity-div';
        var hide_div = '.gender-div';
        runAjax(dataString, show_div, hide_div, id);
    });
    // get activity value
    $('.activity-option').on("change", function() {
        var id = $(this).parent('div').attr('id');
        var activity_val = $(this).val();
        var gender_val = $("select[name=gender]").val();
        var dataString = 'gender=' + gender_val + '&activity=' + activity_val;
        var show_div = '.meat-div';
        var hide_div = '.activity-div';
        runAjax(dataString, show_div, hide_div, id);
    });
    // get meat value
    $('.meat-option').on("change", function() {
        var meat_val = $(this).val();
        var gender_val = $("select[name=gender]").val();
        var activity_val = $("select[name=activity]").val();
        var dataString = 'gender=' + gender_val + '&activity=' + activity_val + '&meat=' + meat_val;

        $('.continue-btn').one("click", function() {
            var show_div = '.veggies-div';
            var hide_div = '.meat-div';
            runAjax(dataString, show_div, hide_div);
        });
    });
    // get veggie value
    $('.veggie-option').on("change", function() {
        var veggie_val = $(this).val();
        var gender_val = $("select[name=gender]").val();
        var activity_val = $("select[name=activity]").val();
        var meat_val = $("select[name=meat]").val();
        var dataString = 'gender=' + gender_val + '&activity=' + activity_val + '&meat=' + meat_val + '&veggie=' + veggie_val;

        $('.continue-btn').one("click", function() {
            var show_div = '.product-div';
            var hide_div = '.veggies-div';
            runAjax(dataString, show_div, hide_div);
        });
    });
    // get product value
    $('.products-option').on("change", function() {
        var product_val = $(this).val();
        var gender_val = $("select[name=gender]").val();
        var activity_val = $("select[name=activity]").val();
        var meat_val = $("select[name=meat]").val();
        var veggie_val = $("select[name=veggies]").val();
        var dataString = 'gender=' + gender_val + '&activity=' + activity_val + '&meat=' + meat_val + '&veggie=' + veggie_val + '&product=' + product_val;

        $('.continue-btn').one("click", function() {
            var show_div = '.day-div';
            var hide_div = '.product-div';
            $('.continue-btn').hide();
            runAjax(dataString, show_div, hide_div);
        });
    });
    // get day value
    $('.day-option').change(function() {
        var day_val = $(this).val();
        var gender_val = $("select[name=gender]").val();
        var activity_val = $("select[name=activity]").val();
        var meat_val = $("select[name=meat]").val();
        var veggie_val = $("select[name=veggies]").val();
        var product_val = $("select[name=product]").val();
        var dataString = 'gender=' + gender_val + '&activity=' + activity_val + '&meat=' + meat_val + '&veggie=' + veggie_val + '&product=' + product_val + '&day=' + day_val;
        var show_div = '.true-div';
        var hide_div = '.day-div';
        runAjax(dataString, show_div, hide_div);
    });
    $('.true-option').on("change", function() {
        var true_val = $(this).val();
        var gender_val = $("select[name=gender]").val();
        var activity_val = $("select[name=activity]").val();
        var meat_val = $("select[name=meat]").val();
        var veggie_val = $("select[name=veggies]").val();
        var product_val = $("select[name=product]").val();
        var day_val = $("select[name=day]").val();
        var dataString = 'gender=' + gender_val + '&activity=' + activity_val + '&meat=' + meat_val + '&veggie=' + veggie_val + '&product=' + product_val + '&day=' + day_val + '&true=' + true_val;
        $('.continue-btn').one("click", function() {
            var show_div = '.measurement-div';
            var hide_div = '.true-div';
            runAjax(dataString, show_div, hide_div);
            $('.continue-btn').hide();
            $('.final').show();

        });
    });
    // get metric value
    $('.metric-btn').click(function() {
        $('.metric-div').show();
        $('.imperial-div').hide();
        $('.final').click(function() {
            var gender_val = $("select[name=gender]").val();
            var activity_val = $("select[name=activity]").val();
            var meat_val = $("select[name=meat]").val();
            var veggie_val = $("select[name=veggies]").val();
            var product_val = $("select[name=product]").val();
            var day_val = $("select[name=day]").val();
            var true_val = $("select[name=true_for_you]").val();
            var metric_age_val = $("input[name=age]").val();
            var metric_height_val = $("input[name=height]").val();
            var metric_weight_val = $("input[name=weight]").val();
            var metric_target_weight_val = $("input[name=target_weight]").val();
            var type=1;
            if (metric_age_val.length == 0) {
                $("#head").text("* All fields are mandatory *");
                return false;
            } else if (metric_age_val.length == 0) {
                $("#p2").text("* Age field is required *");
                $("#age").focus();
                return false;
            } else if (metric_age_val < 14) {
                $("#p2").text("* Please enter value greater than or equal to 14 *");
                $("#age").focus();
                return false;
            } else if (metric_height_val.length == 0) {
                $("#p3").text("* Height field is required *");
                $("#height").focus();
                return false;
            } else if (metric_height_val < 135) {
                $("#p3").text("* Please enter value greater than or equal to 135 *");
                $("#height").focus();
                return false;
            } else if (metric_weight_val.length == 0) {
                $("#p4").text("* Weight field is required *");
                $("#weight").focus();
                return false;
            } else if (metric_weight_val < 40) {
                $("#p4").text("* Please enter value greater than or equal to 40 *");
                $("#weight").focus();
                return false;
            } else if (metric_target_weight_val.length == 0) {
                $("#p5").text("*Target Weight field is required *");
                $("#target_weight").focus();
                return false;
            } else if (metric_target_weight_val < 40) {
                $("#p5").text("* Please enter value greater than or equal to 40 *");
                $("#target_weight").focus();
                return false;
            }
            var dataString = 'gender=' + gender_val + '&activity=' + activity_val + '&meat=' + meat_val + '&veggie=' + veggie_val + '&product=' + product_val + '&day=' + day_val + '&true=' + true_val + '&metric_age_val=' + metric_age_val + '&metric_height_val=' + metric_height_val + '&metric_weight_val=' + metric_weight_val + '&metric_target_weight_val=' + metric_target_weight_val + '&type=' + type;
            var hide_div = '';
            var show_div = $("input[name=new_url]").val();
            runAjax(dataString, show_div, hide_div);
            $('.final').hide();

        });
    });
    $('.imperial-btn').click(function() {
        $('.imperial-div').show();
        $('.metric-div').hide();

        $('.final').click(function() {
            var gender_val = $("select[name=gender]").val();
            var activity_val = $("select[name=activity]").val();
            var meat_val = $("select[name=meat]").val();
            var veggie_val = $("select[name=veggies]").val();
            var product_val = $("select[name=product]").val();
            var day_val = $("select[name=day]").val();
            var true_val = $("select[name=true_for_you]").val();
            var imperial_age_val = $("input[name=imperial_age]").val();
            var imperial_feet_val = $("input[name=feet]").val();
            var imperial_inch_val = $("input[name=inch]").val();
            var imperial_weight_val = $("input[name=imperial_weight]").val();
            var imperial_target_weight_val = $("input[name=imperial_target_weight]").val();

            if (imperial_age_val.length == 0) {
                $("#head").text("* All fields are mandatory *");
                return false;
            } else if (imperial_age_val.length == 0) {
                $("#p6").text("* Age field is required *");
                $("#imperial_age").focus();
                return false;
            } else if (imperial_age_val < 14) {
                $("#p6").text("* Please enter value greater than or equal to 14 *");
                $("#imperial_age").focus();
                return false;
            } else if (imperial_feet_val.length == 0) {
                $("#p7").text("* Feet field is required *");
                $("#imperial_feet").focus();
                return false;
            } else if (imperial_feet_val < 4) {
                $("#p7").text("* Please enter value greater than or equal to 4 *");
                $("#imperial_feet").focus();
                return false;
            } else if (imperial_inch_val.length == 0) {
                $("#p8").text("* Inch field is required *");
                $("#imperial_inch").focus();
                return false;
            } else if (imperial_weight_val.length == 0) {
                $("#p9").text("*Weight field is required *");
                $("#imperial_weight").focus();
                return false;
            } else if (imperial_weight_val < 90) {
                $("#p9").text("* Please enter value greater than or equal to 90 *");
                $("#imperial_weight").focus();
                return false;
            } else if (imperial_target_weight_val.length == 0) {
                $("#p10").text("* Target Weight field is required *");
                $("#imperial_target_weight").focus();
                return false;
            } else if (imperial_target_weight_val < 90) {
                $("#p10").text("* Please enter value greater than or equal to 90 *");
                $("#imperial_target_weight").focus();
                return false;
            }
            var dataString = 'gender=' + gender_val + '&activity=' + activity_val + '&meat=' + meat_val + '&veggie=' + veggie_val + '&product=' + product_val + '&day=' + day_val + '&true=' + true_val + '&imperial_age=' + imperial_age_val + '&imperial_feet=' + imperial_feet_val + '&imperial_inch=' + imperial_inch_val + '&imperial_weight=' + imperial_weight_val + '&imperial_target_weight=' + imperial_target_weight_val;
            var hide_div = '';
            var show_div = $("input[name=new_url]").val();
            runAjax(dataString, show_div, hide_div);
            $('.final').hide();
            // alert(show_div);
        });
    });


    function runAjax(data1, show_div, hide_div, id) {
        event.preventDefault();
        var url1 = $("input[name=url]").val();
        $.ajax({
            type: 'POST',
            url: url1 + '&dc=' + id + '&last_div=' + show_div,
            data: data1,
            success: function(data) {
                if(hide_div == '')
                {
                  window.location = show_div;
                }
                else{
                  $(hide_div).hide();
                  $(show_div).show();
                }
            }

        });

    }
});
function newProduct(){
  var selected_values = [],iteration;
  $("select.product_div option").show();
  // alert('inside second');
  $("select.product_div").each(function(){
    // alert('inside third');
        iteration = $(this).find('option:selected').val();
        // alert(iteration);
        if ( iteration !== "" ) {
           selected_values.push( iteration );
         }
       });
       for ( var i = 0; i < selected_values.length; i++ ) {
            $(".product_div option[value='"+ selected_values[i] +"']").hide();
          }
}
