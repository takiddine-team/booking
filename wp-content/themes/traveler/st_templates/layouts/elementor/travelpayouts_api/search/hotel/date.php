<?php
$start = STInput::get('start',"");
$end = STInput::get('end',"");
$date = STInput::get('date', date('d/m/Y h:i a'). '-'. date('d/m/Y h:i a', strtotime('+1 day')));
$has_icon = (isset($has_icon))? $has_icon: false;
if(!empty($start)){
    $starttext = $start;
    $start = $start;
} else {
    $starttext = TravelHelper::getDateFormatMoment();
    $start = "";
}

if(!empty($end)){
    $endtext = $end;
    $end = $end;
} else {
    $endtext = TravelHelper::getDateFormatMoment();
    $end = "";
}
?>
<div class="form-group form-date-field d-flex align-items-center form-date-search form-date-travelpayout clearfix <?php if($has_icon) echo ' has-icon '; ?>" data-format="<?php echo TravelHelper::getDateFormatMoment() ?>">
    <?php
        if($has_icon){
            echo TravelHelper::getNewIcon('ico_calendar_search_box');
        }
    ?>
    <div class="st-form-dropdown-icon" >
        <div class="date-wrapper clearfix">
            <div class="check-in-wrapper">
                <label><?php echo __('Check In - Out', 'traveler'); ?></label>
                <div class="render check-in-render"><?php echo esc_html($starttext); ?></div><span> - </span><div class="render check-out-render"><?php echo esc_html($endtext); ?></div>
            </div>
        </div>
        <input type="hidden" class="check-in-input" value="<?php echo esc_attr($start) ?>" name="checkIn">
        <input type="hidden" class="check-out-input" value="<?php echo esc_attr($end) ?>" name="checkOut">
        <input type="text" class="check-in-out" value="<?php echo esc_attr($date); ?>" name="date">
    </div>

</div>