$(document).ready(function() {
  var last_div_id ="";

  last_div_id = "<?php echo(Session::get('user.last_div'));?>";
  if(last_div_id!=""){
    $('.diet').hide();
    $(last_div_id).show();
  }

     $('.multiselecopt').change(function() {
            $('.continue-btn').show();
        });
        // get gender div value
        $('.gender-option').on( "change",function() {
            var id = $(this).parent('div').attr('id');
            var gender_val = $(this).val();
            var dataString = 'gender=' + gender_val;
            var show_div = '.activity-div';
            var hide_div = '.gender-div';
           runAjax(dataString, show_div, hide_div,id);
        });
        // get activity value
        $('.activity-option').on( "change",function() {
            var id = $(this).parent('div').attr('id');
            var activity_val = $(this).val();
            var gender_val = $("select[name=gender]").val();
            var dataString = 'gender=' + gender_val + '&activity=' + activity_val;
            var show_div = '.meat-div';
            var hide_div = '.activity-div';
            runAjax(dataString, show_div, hide_div,id);
        });
        // get meat value
        $('.meat-option').on( "change",function() {
            var meat_val = $(this).val();
            var gender_val = $("select[name=gender]").val();
            var activity_val = $("select[name=activity]").val();
            var dataString = 'gender=' + gender_val + '&activity=' + activity_val + '&meat=' + meat_val;

            $('.continue-btn').one( "click",function() {
                var show_div = '.veggies-div';
                var hide_div = '.meat-div';
                runAjax(dataString, show_div, hide_div);
            });
        });
        // get veggie value
        $('.veggie-option').on( "change",function() {
            var veggie_val = $(this).val();
            var gender_val = $("select[name=gender]").val();
            var activity_val = $("select[name=activity]").val();
            var meat_val = $("select[name=meat]").val();
            var dataString = 'gender=' + gender_val + '&activity=' + activity_val + '&meat=' + meat_val + '&veggie=' + veggie_val;

            $('.continue-btn').one( "click",function() {
                var show_div = '.product-div';
                var hide_div = '.veggies-div';
                runAjax(dataString, show_div, hide_div);
              });
          });
        // get product value
        $('.products-option').on( "change",function() {
            var product_val = $(this).val();
            var gender_val = $("select[name=gender]").val();
            var activity_val = $("select[name=activity]").val();
            var meat_val = $("select[name=meat]").val();
            var veggie_val = $("select[name=veggies]").val();
            var dataString = 'gender=' + gender_val + '&activity=' + activity_val + '&meat=' + meat_val + '&veggie=' + veggie_val + '&product=' + product_val;

            $('.continue-btn').one( "click",function() {
                var show_div = '.day-div';
                var hide_div = '.product-div';
                $('.continue-btn').hide();
                runAjax(dataString,show_div, hide_div);
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
        $('.true-option').on( "change",function() {
            var true_val = $(this).val();
            var gender_val = $("select[name=gender]").val();
            var activity_val = $("select[name=activity]").val();
            var meat_val = $("select[name=meat]").val();
            var veggie_val = $("select[name=veggies]").val();
            var product_val = $("select[name=product]").val();
            var day_val = $("select[name=day]").val();
            var dataString = 'gender=' + gender_val + '&activity=' + activity_val + '&meat=' + meat_val + '&veggie=' + veggie_val + '&product=' + product_val + '&day=' + day_val + '&true=' + true_val;
            $('.continue-btn').one( "click",function() {
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
              var dataString = 'gender=' + gender_val + '&activity=' + activity_val + '&meat=' + meat_val + '&veggie=' + veggie_val + '&product=' + product_val + '&day=' + day_val + '&true=' + true_val + '&metric_age_val=' + metric_age_val + '&metric_height_val=' + metric_height_val + '&metric_weight_val=' + metric_weight_val + '&metric_target_weight_val=' + metric_target_weight_val;
               var show_div = 'thanks-div';
               var hide_div = 'measurement-div';
            runAjax(dataString, show_div, hide_div);
            // alert(dataString);
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
              var dataString = 'gender=' + gender_val + '&activity=' + activity_val + '&meat=' + meat_val + '&veggie=' + veggie_val + '&product=' + product_val + '&day=' + day_val + '&true=' + true_val + '&imperial_age=' + imperial_age_val + '&imperial_feet=' + imperial_feet_val + '&imperial_inch=' + imperial_inch_val + '&imperial_weight=' + imperial_weight_val + '&imperial_target_weight=' + imperial_target_weight_val;
              var show_div = 'thanks-div';
              var hide_div = 'measurement-div';
              runAjax(dataString, show_div, hide_div);
            });
          });

        function runAjax(data1, show_div, hide_div,id) {
             event.preventDefault();
             $.ajax({
                type:'POST',
                url:'{{URL::route('create_user_information')}}'+'?_token='+'{{ csrf_token() }}'+'&dc='+id+'&last_div='+show_div,
                data: data1,
                success: function(data) {
                    $(hide_div).hide();
                    $(show_div).show();
                }

            });

         }
});
