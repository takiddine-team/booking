<?php
/**
 * Created by PhpStorm.
 * User: HanhDo
 * Date: 2/25/2019
 * Time: 4:24 PM
 */

$room_alone_search_page = get_permalink(st()->get_option('st_hotel_alone_room_search_page'));
$enable_tree = st()->get_option( 'bc_show_location_tree', 'off' );
$location_id = STInput::get( 'location_id', '' );
$location_name = STInput::get( 'location_name', '' );
if(empty($location_name)){
    if(!empty($location_id)){
        $location_name = get_the_title($location_id);
    }
}
$has_icon = ( isset( $has_icon ) ) ? $has_icon : false;
if(is_singular('location')){
    $location_id = get_the_ID();
}
$location = TravelHelper::getListFullNameLocationHotel();


?>
<?php if(!empty($attr['style'])){
    if($attr['style'] == 'style1'){ ?>
        <div class="sts-check-available-form">
            <?php
            if(!empty($attr['title']))
                echo '<div class="title-section">'. esc_html($attr['title']) .'</div>';
            ?>
            <form action="<?php echo esc_url($room_alone_search_page); ?>" class="st-room-check-available" method="get">
                <div class="sts-form-wrapper">
                    <?php
                    $picker_style = ( isset( $picker_style ) ) ? $picker_style : '';
                    $date_now     = current_time( 'timestamp' );
                    $date_next    = strtotime( '+1 day', $date_now );
                    $check_in     = STInput::get( 'checkin_y' ) . "-" . STInput::get( 'checkin_m' ) . "-" . STInput::get( 'checkin_d' );
                    if ( $check_in == '--' ) $check_in = ''; else$check_in = date( TravelHelper::getDateFormat(), strtotime( $check_in ) );
                    if ( empty( $check_in ) ) {
                        $check_in = date( TravelHelper::getDateFormat() );
                    }

                    $check_out = STInput::get( 'checkout_y' ) . "-" . STInput::get( 'checkout_m' ) . "-" . STInput::get( 'checkout_d' );
                    if ( $check_out == '--' ) $check_out = ''; else$check_out = date( TravelHelper::getDateFormat(), strtotime( $check_out ) );
                    if ( empty( $check_out ) ) {
                        $check_out = date( TravelHelper::getDateFormat(), strtotime( '+1 day', strtotime( date( 'Y-m-d' ) ) ) );
                    }
                    $check_in_out = current_time( TravelHelper::getDateFormat() ) . '-' . date( TravelHelper::getDateFormat(), strtotime( '+1 day', current_time( 'timestamp' ) ) );

                    $id = 'check-in-out_' . rand( 0, time() );
                    ?>
                    <div class="item sts-time">
                        <label><?php echo __('Check In', 'traveler'); ?></label>
                        <div class="value">
                            <?php echo STInput::get( 'checkin_d', date( 'j', $date_now ) ) ?>
                        </div>
                        <div class="sub-label">
                            <?php
                            $check_in_my = STInput::get( 'check_in');
                            if(!empty($check_in_my)){
                                $check_in_my = strtotime(TravelHelper::convertDateFormat($check_in_my));
                            }else{
                                $check_in_my = $date_next;
                            }
                            $check_in_my = date( 'M, Y', $check_in_my);
                            echo esc_html($check_in_my);
                            ?>
                        </div>
                        <input type="hidden" class="checkin_d" name="checkin_d" value="<?php echo STInput::get( 'checkin_d', date( 'j', $date_now ) ) ?>"/>
                        <input type="hidden" class="checkin_m" name="checkin_m" value="<?php echo STInput::get( 'checkin_m', date( 'n', $date_now ) ) ?>"/>
                        <input type="hidden" class="checkin_y" name="checkin_y" value="<?php echo STInput::get( 'checkin_y', date( 'Y', $date_now ) ) ?>"/>
                        <input type="hidden" name="check_in" class="sts-date-start" readonly value="<?php echo esc_html( $check_in ) ?>">
                        <input class="sts-check-in-out" type="text" name="check_in_out" value="<?php echo esc_html( STInput::get( 'check_in_out', $check_in_out ) ); ?>">
                    </div>

                    <div class="item sts-time">
                        <label><?php echo __('Check Out', 'traveler'); ?></label>
                        <div class="value">
                            <?php echo STInput::get( 'checkout_d', date( 'j', $date_next ) ) ?>
                        </div>
                        <div class="sub-label">
                            <?php
                            $check_out_my = STInput::get( 'check_out');
                            if(!empty($check_out_my)){
                                $check_out_my = strtotime(TravelHelper::convertDateFormat($check_out_my));
                            }else{
                                $check_out_my = $date_next;
                            }
                            $check_out_my = date( 'M, Y', $check_out_my);
                            echo esc_html($check_out_my);
                            ?>
                        </div>
                        <input type="hidden" class="checkout_d" name="checkout_d" value="<?php echo STInput::get( 'checkout_d', date( 'j', $date_next ) ) ?>"/>
                        <input type="hidden" class="checkout_m" name="checkout_m" value="<?php echo STInput::get( 'checkout_m', date( 'n', $date_next ) ) ?>"/>
                        <input type="hidden" class="checkout_y" name="checkout_y" value="<?php echo STInput::get( 'checkout_y', date( 'Y', $date_next ) ) ?>"/>
                        <input type="hidden" name="check_out" class="sts-date-end" readonly value="<?php echo esc_html( $check_out ) ?>">
                    </div>

                    <div class="item">
                        <label><?php echo __('Number', 'traveler'); ?></label>
                        <div class="item-search-content">
                            <div class="st-number">
                                <div class="adult minplus">
                                    <span class="minus"><?php echo TravelHelper::getNewIcon('ico_subtract', '#fff', '16px', '16px', true); ?></span>
                                    <?php
                                    $adult_num_search = STInput::get('adult_num_search', 1);
                                    $max_adult = ST_Single_Hotel::inst()->getMaxPeopleSearchForm();

                                    if($adult_num_search > $max_adult)
                                        $adult_num_search = $max_adult;

                                    if($adult_num_search < 1)
                                        $adult_num_search = 1;

                                    ?>
                                    <strong class="num"><?php echo esc_html($adult_num_search); ?></strong>
                                    <input type="hidden" name="adult_num_search" value="<?php echo esc_html($adult_num_search); ?>" class="form-control st-input-number" autocomplete="off" readonly="" data-min="1" data-max="<?php echo esc_attr($max_adult); ?>">
                                    <span class="plus"><?php echo TravelHelper::getNewIcon('ico_add', '#fff', '16px', '16px', true); ?></span>
                                </div>
                                <div class="type-person">
                                    <span><?php echo __('Adults', 'traveler'); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="item">
                        <label><?php echo __('Number', 'traveler'); ?></label>
                        <div class="item-search-content">
                            <div class="st-number">
                                <div class="adult minplus">
                                    <span class="minus"><?php echo TravelHelper::getNewIcon('ico_subtract', '#fff', '16px', '16px', true); ?></span>
                                    <?php
                                    $children_num_search = STInput::get('children_num_search', 0);
                                    $max_child = ST_Single_Hotel::inst()->getMaxPeopleSearchForm('child');
                                    if($children_num_search > $max_child)
                                        $children_num_search = $max_child;

                                    if($children_num_search < 0)
                                        $children_num_search = 0;
                                    ?>
                                    <strong class="num"><?php echo esc_html($children_num_search); ?></strong>
                                    <input type="hidden" name="children_num_search" value="<?php echo esc_html($children_num_search); ?>" class="form-control st-input-number" autocomplete="off" readonly="" data-min="0" data-max="<?php echo esc_attr($max_child); ?>">
                                    <span class="plus"><?php echo TravelHelper::getNewIcon('ico_add', '#fff', '16px', '16px', true); ?></span>
                                </div>
                                <div class="type-person">
                                    <span><?php echo __('Children', 'traveler'); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <button class="btn btn-primary sts-btn-white"><span><?php echo __('CHECK AVAILABILITY', 'traveler'); ?></span></button>
            </form>
        </div>
    <?php }elseif ($attr['style'] == 'style2'){ ?>
        <div class="sts-check-available-form-style2">
            <?php
            if(!empty($attr['title']))
                echo '<div class="title-section">'. esc_html($attr['title']) .'</div>';
            ?>
            <form action="<?php echo esc_url($room_alone_search_page); ?>" class="st-room-check-available" method="get">
                <div class="sts-form-wrapper">
                    <?php
                    $picker_style = ( isset( $picker_style ) ) ? $picker_style : '';
                    $date_now     = current_time( 'timestamp' );
                    $date_next    = strtotime( '+1 day', $date_now );
                    $check_in     = STInput::get( 'checkin_y' ) . "-" . STInput::get( 'checkin_m' ) . "-" . STInput::get( 'checkin_d' );
                    if ( $check_in == '--' ) $check_in = ''; else$check_in = date( TravelHelper::getDateFormat(), strtotime( $check_in ) );
                    if ( empty( $check_in ) ) {
                        $check_in = date( TravelHelper::getDateFormat() );
                    }

                    $check_out = STInput::get( 'checkout_y' ) . "-" . STInput::get( 'checkout_m' ) . "-" . STInput::get( 'checkout_d' );
                    if ( $check_out == '--' ) $check_out = ''; else$check_out = date( TravelHelper::getDateFormat(), strtotime( $check_out ) );
                    if ( empty( $check_out ) ) {
                        $check_out = date( TravelHelper::getDateFormat(), strtotime( '+1 day', strtotime( date( 'Y-m-d' ) ) ) );
                    }
                    $check_in_out = current_time( TravelHelper::getDateFormat() ) . '-' . date( TravelHelper::getDateFormat(), strtotime( '+1 day', current_time( 'timestamp' ) ) );

                    $id = 'check-in-out_' . rand( 0, time() );
                    ?>
                    <div class=" item field-detination">
                        <label> <?php echo __( 'location', 'traveler' ); ?></label>
                        <div class="dropdown" data-toggle="dropdown" id="dropdown-location">
                            <div class="render">
                                <?php  echo TravelHelper::getNewIcon('ico_maps_search_box','','15px','15px') ; ?>
                                <span class="destination">
                                    <?php
                                    if(empty($location_name)) {
                                        echo  esc_html($location[0]->location_name);
                                    }else{
                                        echo esc_html($location_name);
                                    }
                                    ?>
                                </span>
                            </div>
                            <input type="hidden" name="location_name" value="<?php
                            if(empty($location_name)){
                                echo  esc_html($location[0]->location_name);
                            }else{
                                echo esc_attr($location_name);
                            }
                             ?>"/>
                            <input type="hidden" name="location_id" value="<?php
                            if(empty($location_id)){
                                echo  esc_html($location[0]->ID);
                            }else{
                                echo esc_attr($location_id);
                            }
                            ?>"/>
                        </div>
                        <ul class="dropdown-menu" aria-labelledby="dropdown-location">
                            <?php
                            foreach ( $location as $key => $value ) {
                                ?>
                                <li class="item" data-value="<?php echo esc_attr($value->ID); ?>">
                                    <?php echo TravelHelper::getNewIcon('ico_maps_search_box','','17px','17px'); ?>
                                    <span><?php echo esc_attr($value->location_name); ?></span></li>
                                <?php
                            }
                            ?>
                        </ul>
                    </div>
                    <div class="item sts-time">
                        <label><?php echo __('Check In', 'traveler'); ?></label>
                        <div class="value">
                            <?php  echo TravelHelper::getNewIcon('ico_calendar_search_box','','17px','17px') ; ?>
                            <?php echo esc_html($check_in); ?>
                        </div>

                        <input type="hidden" class="checkin_d" name="checkin_d" value="<?php echo STInput::get( 'checkin_d', date( 'j', $date_now ) ) ?>"/>
                        <input type="hidden" class="checkin_m" name="checkin_m" value="<?php echo STInput::get( 'checkin_m', date( 'n', $date_now ) ) ?>"/>
                        <input type="hidden" class="checkin_y" name="checkin_y" value="<?php echo STInput::get( 'checkin_y', date( 'Y', $date_now ) ) ?>"/>
                        <input type="hidden" name="check_in" class="sts-date-start" readonly value="<?php echo esc_html( $check_in ) ?>">
                        <input class="sts-check-in-out" type="text" name="check_in_out" value="<?php echo esc_html( STInput::get( 'check_in_out', $check_in_out ) ); ?>">
                    </div>

                    <div class="item sts-time">
                        <label><?php echo __('Check Out', 'traveler'); ?></label>
                        <div class="value">
                            <?php  echo TravelHelper::getNewIcon('ico_calendar_search_box','','17px','17px') ; ?>
                            <?php echo esc_html($check_out); ?>
                        </div>
                        <input type="hidden" class="checkout_d" name="checkout_d" value="<?php echo STInput::get( 'checkout_d', date( 'j', $date_next ) ) ?>"/>
                        <input type="hidden" class="checkout_m" name="checkout_m" value="<?php echo STInput::get( 'checkout_m', date( 'n', $date_next ) ) ?>"/>
                        <input type="hidden" class="checkout_y" name="checkout_y" value="<?php echo STInput::get( 'checkout_y', date( 'Y', $date_next ) ) ?>"/>
                        <input type="hidden" name="check_out" class="sts-date-end" readonly value="<?php echo esc_html( $check_out ) ?>">
                    </div>
                    <div class="item field-guest-new">
                        <?php
                        $adult_num_search = STInput::get('adult_num_search', 1);
                        $max_adult = ST_Single_Hotel::inst()->getMaxPeopleSearchForm();

                        if($adult_num_search > $max_adult)
                            $adult_num_search = $max_adult;

                        if($adult_num_search < 1)
                            $adult_num_search = 1;
                        $children_num_search = STInput::get('children_num_search', 0);
                        $max_child = ST_Single_Hotel::inst()->getMaxPeopleSearchForm('child');
                        if($children_num_search > $max_child)
                            $children_num_search = $max_child;

                        if($children_num_search < 0)
                            $children_num_search = 0;

                        ?>
                        <label><?php echo __( 'Guests', 'traveler' ); ?></label>
                        <div class="dropdown" data-toggle="dropdown">
                            <div class="render">
                                <?php  echo TravelHelper::getNewIcon('ico_guest_search_box','','17px','17px') ; ?>
                                <span class="adult" data-text="<?php echo __( 'Adult', 'traveler' ); ?>" data-text-multi="<?php echo __( 'Adults', 'traveler' ); ?>"><?php echo sprintf( _n( '%s Adult', '%s Adults', esc_attr($adult_num_search), 'traveler' ), esc_attr($adult_num_search) ) ?></span>
                                <span class="line"><?php echo esc_html__(" - ",'traveler') ?></span>
                                <span class="children" data-text="<?php echo __( 'Child', 'traveler' ); ?>"
                                      data-text-multi="<?php echo __( 'Children', 'traveler' ); ?>"><?php echo sprintf( _n( '%s Child', '%s Children', esc_attr($children_num_search), 'traveler' ), esc_attr($children_num_search) ); ?></span>
                            </div>
                        </div>
                        <ul class="dropdown-menu">

                            <li class="item-search-content">
                                <div class="st-number">
                                    <div class="type-person">
                                        <span><?php echo __('Adults', 'traveler'); ?></span>
                                    </div>
                                    <div class="adult minplus">
                                        <span class="minus"><?php echo TravelHelper::getNewIcon('ico_subtract', '#5E6D77', '16px', '16px', true); ?></span>
                                        <strong class="num"><?php echo esc_html($adult_num_search); ?></strong>
                                        <input type="hidden" name="adult_num_search" value="<?php echo esc_html($adult_num_search); ?>" class="form-control st-input-number" autocomplete="off" readonly="" data-min="1" data-max="<?php echo esc_attr($max_adult); ?>">
                                        <span class="plus"><?php echo TravelHelper::getNewIcon('ico_add', '#5E6D77', '16px', '16px', true); ?></span>
                                    </div>

                                </div>
                            </li>
                            <li class="item-search-content">
                                <div class="st-number">
                                    <div class="type-person">
                                        <span><?php echo __('Children', 'traveler'); ?></span>
                                    </div>
                                    <div class="adult minplus">
                                        <span class="minus"><?php echo TravelHelper::getNewIcon('ico_subtract', '#5E6D77', '16px', '16px', true); ?></span>
                                        <strong class="num"><?php echo esc_html($children_num_search); ?></strong>
                                        <input type="hidden" name="children_num_search" value="<?php echo esc_html($children_num_search); ?>" class="form-control st-input-number" autocomplete="off" readonly="" data-min="0" data-max="<?php echo esc_attr($max_child); ?>">
                                        <span class="plus"><?php echo TravelHelper::getNewIcon('ico_add', '#5E6D77', '16px', '16px', true); ?></span>
                                    </div>

                                </div>
                            </li>

                        </ul>
                    </div>

                    <button class="btn btn-primary sts-btn-white"><span><?php echo __('SEARCH', 'traveler'); ?></span></button>
                </div>
            </form>
        </div>
   <?php }
} ?>
