<?php
$start = STInput::get('start', date(TravelHelper::getDateFormat()));
$end = STInput::get('end', date(TravelHelper::getDateFormat(), strtotime("+ 1 day")));
$date = STInput::get('date', date('d/m/Y h:i a'). '-'. date('d/m/Y h:i a', strtotime('+1 day')));
$has_icon = (isset($has_icon))? $has_icon: false;

?>
<div class="form-group form-date-field form-date-search d-flex align-items-center" data-format="<?php echo TravelHelper::getDateFormatMoment() ?>">
    <div class="date-item-wrapper d-flex align-items-center checkin">
        <span class="stt-icon stt-icon-in"></span>
        <div class="item-inner">
            <label><?php echo esc_html__('Check in', 'traveler'); ?></label>
            <div class="render check-in-render">
                <?php
                    if(!empty($start)){
                        echo esc_html($start);
                    } else {
                        echo esc_html__('Add date', 'traveler');
                    }
                ?>
            </div>
        </div>
    </div>
    <span class="stt-icon stt-icon-arrow-right-1 date-item-arrow"></span>
    <div class="date-item-wrapper d-flex align-items-center checkout">
        <span class="stt-icon stt-icon-out"></span>
        <div class="item-inner">
            <label><?php echo esc_html__('Check out', 'traveler'); ?></label>
            <div class="render check-out-render">
                <?php
                    if(!empty($end)){
                        echo esc_html($end);
                    } else {
                        echo esc_html__('Add date', 'traveler');
                    }
                ?>
            </div>
        </div>
    </div>
    <input type="hidden" class="check-in-input" value="<?php echo esc_attr($start) ?>" name="start">
    <input type="hidden" class="check-out-input" value="<?php echo esc_attr($end) ?>" name="end">
    <input type="text" readonly class="check-in-out" value="<?php echo esc_attr($date); ?>" name="date">
</div>