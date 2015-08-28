/*
 * admin.js
 * admin jQuery
 * author : Heshan (heshan at nexva dot com)
 * package : neXva V 2.0
 */

// document ready function
$(document).ready(function(){
    // hide all dev ul
    $(".radio_all_ul").hide();
    //hide attributes ul
    $(".radio_attrib_ul").hide();
    // hide the manuas select ul
    $(".radio_manual_ul").hide();
    //hide the display counter
    $(".display_count").hide();
    
    // select all devices
    $(".radio_all").change(function() {
        $(".radio_attrib_ul").hide("slow");
        $(".radio_manual_ul").hide("slow");
        $(".radio_all_ul").show("slow");
        // set the product count
        get_app_count('all', '');
        // disply count
        show_count();
        // remove showed phones and all
        $('.phones div').remove();
    // query devices
    //        query_devices('all', '');
    });
    // check other attributes
    $(".radio_attrib").change(function() {
        $(".radio_attrib_ul").show("slow");
        $(".display_count").hide("slow");
        $(".radio_manual_ul").hide("slow");
        $(".radio_all_ul").hide("slow");
        $('.phones div').remove();
    });

    // mp3 compatible
    //    $(".mp3_playback").change(function() {
    //        //        $(".radio_attrib_ul").show("slow");
    //        if($(".mp3_playback").attr('checked')){
    //            change_app_count(1, 250);
    //            show_count();
    //            query_devices('mp3_playback');
    //        }
    //        else {
    //            //      $(".display_count").hide("slow");
    //            change_app_count(2, 250);
    //            show_count();
    //            $('.mp3_playback_div').remove();
    //        }
    //    });
    //  // Java Compatible
    //  $(".support_java").change(function() {
    //    if($(".support_java").attr('checked')){
    //      //check other checkboxes
    //      $('.java_midp_1').attr('checked', true);
    //      $('.java_midp_2').attr('checked', true);
    //      change_app_count(1, 250);
    //      show_count();
    //    }
    //    else {
    //      //      $(".display_count").hide("slow");
    //      $('.java_midp_1').attr('checked', false);
    //      $('.java_midp_2').attr('checked', false);
    //      change_app_count(2, 250);
    //      show_count();
    //    }
    //  });
    // Java MIDP1 support
    //    $(".java_midp_1").change(function() {
    //        if($(".java_midp_1").attr('checked')){
    //            change_app_count(1, 350);
    //            show_count();
    //            query_devices('java_midp_1');
    //        }
    //        else {
    //            //      $(".display_count").hide("slow");
    //            change_app_count(2, 350);
    //            show_count();
    //            $('.java_midp_1_div').remove();
    //        }
    //    });
    // Java Compatible
    //    $(".java_midp_2").change(function() {
    //        if($(".java_midp_2").attr('checked')){
    //            change_app_count(1, 550);
    //            show_count();
    //            query_devices('java_midp_2');
    //        }
    //        else {
    //            //      $(".display_count").hide("slow");
    //            change_app_count(2, 550);
    //            show_count();
    //            $('.java_midp_2_div').remove();
    //        }
    //    });

    // show currently selected devices




    // Device width validate
    $(".device_width").keypress(function(e) {
        if( e.which!=8 && e.which!=0 && (e.which<48 || e.which>57))
        {
            //display error message
            //            alert('Allowed Numbers Only!!.');
            return false;
        }
    });
    //device height
    $(".device_height").keypress(function(e) {
        if( e.which!=8 && e.which!=0 && (e.which<48 || e.which>57))
        {
            //display error message
            //            alert('Allowed Numbers Only!!.');
            return false;
        }
    });

    //    // Deivce width
    //    $(".device_width").change(function() {
    //        $('.device_width_div').remove();
    //        if($(".device_width").val() > 0) {
    //            change_app_count(1, 350);
    //            show_count();
    //            query_devices('device_width');
    //        }
    //    });
    //    // Deivce height
    //    $(".device_height").change(function() {
    //        $('.device_height_div').remove();
    //        if($(".device_width").val() > 0) {
    //            change_app_count(1, 350);
    //            show_count();
    //            query_devices('device_height');
    //        }
    //    });
    //    // Deivce height
    //    $(".device_pointing_method").change(function() {
    //        $('.device_pointing_method_div').remove();
    //        change_app_count(1, 350);
    //        show_count();
    //        query_devices('device_pointing_method');
    //    });

    //    $(".stripeMe tr:even").addClass("alt");

    // Button Click Show All devices
    $(".showall").click(function() {
        //remove showing phones
        $('.phones div').remove();
        show_count();
        query_devices('all');

    });

    // Button Click
    $(".attributes").click(function() {
        //remove showing phones
        $('.phones div').remove();
        // validate for check boxes
        if(check_attrib_fields()){
            show_count();
            query_devices('device_height');
        }
        else {
            alert ('You need to select atleast one attribute option.');
        }
    // validate empty fields
    });

    //manually select devices
    // check all devices
    $(".manually_select").change(function() {
        //        alert('checked');
        $(".radio_attrib_ul").hide("slow");
        $(".radio_manual_ul").show("slow");
        $(".radio_all_ul").hide("slow");
        $(".display_count").hide("slow");
        // remove showed phones and all
        $('.phones div').remove();
    // query devices
    //        query_devices('all');
    });
    // Device width validate
    $(".suggest_devices").keyup(function() {
        var keyword = this.value;
        if(keyword.length > 2){
            // set the product count
            get_app_count('manual', keyword);
            // disply count
            show_count();
            $('.phones div').remove();
            query_devices('search', keyword);
        }
        else {
            $('.phones div').remove();
        }
    });
});

function check_attrib_fields(){
    // get all the inputs into an array.
    var $inputs = $('.radio_attrib_ul :input');

    // get an associative array of just the values.
    //        var values = {};
    var selected = false;
    $inputs.each(function() {
        //        alert(this.type + ' - ' + this.name);
        switch(this.type){
            case 'checkbox':
                if(this.checked)
                    selected = true;
                break;
            case 'text':
                if(this.value > 0)
                    selected = true;
                break;
            case 'select-one':
                if(this.value != 'Any')
                    selected = true;
                break;
        }
    //            alert(selected);
    //            values[this.name] = $(this).val();
    });
    //    alert('final value is ' + selected);
    return selected;
}

function query_devices(switcher, query){
    //    alert(other + ' --- ' + query );
    $.getJSON('admin.php', {
        q:switcher,
        search:query
    }, parse_info);

}

/**
 * AHAH callback
 */
function parse_info(data, textStatus) {
    //    alert(textStatus);
    var html = '';
    html = '<div class="operations" id="operations"><a class="select_none_all" href="#">Select None</a></div>';
    for(var i in data){
        var device_info = data[i].info.join('<br/>')
        html += '<div class="phone ' + data[i].id + ' ' + data[i].css + '"><table class = "phone_tbl"><tr><td><img src="' + data[i].img + '"/></td><td><input type="checkbox" value="' + data[i].id + '" name="devices[]" checked></input><label>' + data[i].phone + '</label>' + device_info + '</td></tr></table></div>';
    }
    $('.phones').append(html);
    select_all_none();
}

/* Adding another JSON call for search
 *
 */

function search_devices(switcher, query){
    //    alert(other + ' --- ' + query );
    $.getJSON('admin.php', {
        q:switcher,
        search:query
    }, parse_info_search);

}

/**
 * AHAH callback
 */
function parse_info_search(data, textStatus) {
    //    alert(textStatus);
    var html = '';
    html = '<div class="operations" id="operations"><a class="select_none_all" href="#">Select None</a></div>';
    for(var i in data){
        var device_info = data[i].info.join('<br/>')
        html += '<div class="phone ' + data[i].id + ' ' + data[i].css + '"><table class = "phone_tbl"><tr><td><img src="' + data[i].img + '"/></td><td><input type="checkbox" value="' + data[i].id + '" name="devices[]" checked></input><label>' + data[i].phone + '</label>' + device_info + '</td></tr></table></div>';
    }
    $('.phones').append(html);
    select_all_none();
}

function select_all_none(){
    // Select All and Select None links
    $(".select_none_all").click(function() {
        if($(".phones div input").attr('checked')){
            $('.phones div input').attr('checked', false);
            $('.select_none_all').html('Select All');
        }
        else {
            $('.phones div input').attr('checked', true);
            $('.select_none_all').html('Select None');
        }
    });
}


/**
 * chage the device count
 */
function change_app_count(switcher, amount) {
    var current = $(".display_count_hid").val();
    var amount = get_app_count();
    if(switcher == 1)
        var total = parseInt(current) + parseInt(amount);
    else
        var total = parseInt(current) - parseInt(amount);
  
    $(".display_count_hid").val(total);
}

/**
 * show the device count
 */
function show_count(){
    $(".display_count").css('float', 'right');
    $(".display_count").show("slow");
    var current = $(".display_count_hid").val();
    $(".display_count").html(current + " <small>devices has been added.</small>");
}

/**
 * get the application count
 */
function get_app_count(switcher, query){
    // TODO : add AHAH call to the php and query the App count
    var devices = 0;
    switch(switcher){
        case 'all':
            devices = 5430;
            break;
        case 'manual':
            devices = 250;
            break;
    }
    // set app count to a hidden variable
    $(".display_count_hid").val(devices);
    return devices;
}

/**
 * Reset the display counter
 */
function reset_counter(){
    $(".display_count_hid").val(0);
}