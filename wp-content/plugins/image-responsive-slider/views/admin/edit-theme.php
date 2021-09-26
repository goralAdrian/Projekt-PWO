<?php
/**
 * @var $themeSettings array
 * @var $theme Object
 */
?>
<div class="wrap corefortress-admin">
    <h1 class="wp-heading-inline">Edit Theme</h1>
    <a href="#" onclick="alert('This Feature is available in Premium Version.'); return false;"
       class="page-title-action">Add New<span class="corefortress-pro-icon">PRO</span></a>

    <?php require COREFORTRESS_SLIDER_PATH . 'views'.DIRECTORY_SEPARATOR.'admin'.DIRECTORY_SEPARATOR.'pro-notice.php'; ?>

    <form id="corefortress-theme-form" action="<?php echo admin_url('admin.php?page=corefortress_slider_themes&action=update') ?>" method="post">
        <?php wp_nonce_field('corefortress_slider_theme_update'); ?>
        <input type="submit" class="corefortress-theme-submit button button-primary" name="corefortress-theme-submit" value="Submit" />
        <input type="hidden" name="id" value="<?php echo $theme->id; ?>" />
        <div class="corefortress-theme-editor-wrap">
            <div class="corefortress-theme-editor-section">
                <h2>Main</h2>

                <div class="corefortress-theme-editor-field">
                    <label><span class="corefortress-theme-field-label">Theme Name</span>
                        <input type="text" name="theme_name"
                               value="<?php echo $theme->name; ?>"/>
                    </label>
                </div>

                <div class="corefortress-theme-editor-field">
                    <label><span class="corefortress-theme-field-label">Slider Background Color</span>
                        <span class="corefortress-color-field-wrap">
                            <input type="text" name="theme_settings[background]" class="corefortress-color-field"
                                   value="<?php echo $themeSettings['background']; ?>"/>
                        </span>
                    </label>
                </div>
                <div class="corefortress-theme-editor-field">
                    <label>
                        <span class="corefortress-theme-field-label">Slider Background Opacity</span>
                        <span class="corefortress-slidefieldcontainer">
                            <input type="range" min="0" max="100" step="1" class="corefortress-field-slider"
                                   name="theme_settings[background_opacity]"
                                   value="<?php echo $themeSettings['background_opacity']; ?>"/>
                            <span class="corefortress-field-slider-val"><?php echo $themeSettings['background_opacity']; ?></span>%
                        </span>
                    </label>
                </div>
                <div class="corefortress-theme-editor-field">
                    <label><span class="corefortress-theme-field-label">Slider Border Color</span>
                        <span class="corefortress-color-field-wrap">
                            <input type="text" name="theme_settings[border_color]" class="corefortress-color-field"
                                   value="<?php echo $themeSettings['border_color']; ?>"/>
                        </span>
                    </label>
                </div>
                <div class="corefortress-theme-editor-field">
                    <label><span class="corefortress-theme-field-label">Slider Border Size</span>
                        <input type="number" min="0" name="theme_settings[border_size]" value="<?php echo $themeSettings['border_size']; ?>" />
                    </label>
                </div>
                <div class="corefortress-theme-editor-field">
                    <label><span class="corefortress-theme-field-label">Slider Border Color</span>
                        <select name="theme_settings[border_style]">
                            <option value="dotted" <?php if ($themeSettings['border_style'] === 'dotted') {
                                echo 'selected="selected"';
                            } ?> >Dotted
                            </option>
                            <option value="dashed" <?php if ($themeSettings['border_style'] === 'dashed') {
                                echo 'selected="selected"';
                            } ?> >Dashed
                            </option>
                            <option value="solid" <?php if ($themeSettings['border_style'] === 'solid') {
                                echo 'selected="selected"';
                            } ?> >Solid
                            </option>
                            <option value="double" <?php if ($themeSettings['border_style'] === 'double') {
                                echo 'selected="selected"';
                            } ?> >Double
                            </option>
                            <option value="groove" <?php if ($themeSettings['border_style'] === 'groove') {
                                echo 'selected="selected"';
                            } ?> >Groove
                            </option>
                            <option value="ridge" <?php if ($themeSettings['border_style'] === 'ridge') {
                                echo 'selected="selected"';
                            } ?> >Ridge
                            </option>
                            <option value="inset" <?php if ($themeSettings['border_style'] === 'inset') {
                                echo 'selected="selected"';
                            } ?> >Inset
                            </option>
                            <option value="outset" <?php if ($themeSettings['border_style'] === 'outset') {
                                echo 'selected="selected"';
                            } ?> >Outset
                            </option>
                        </select>
                    </label>
                </div>
                <div class="corefortress-theme-editor-field">
                    <label><span class="corefortress-theme-field-label">Fixed Width Slider</span>
                        <input type="hidden" name="theme_settings[use_fixed_width]" value="0"/>
                        <input type="checkbox" name="theme_settings[use_fixed_width]"
                               onchange="if(this.checked) {
                                   document.getElementById('corefortress_slider_fixed_width').style.display='block';
                                   document.getElementById('corefortress_slider_percent_width').style.display='none';
                               }else{
                                   document.getElementById('corefortress_slider_fixed_width').style.display='none';
                                   document.getElementById('corefortress_slider_percent_width').style.display='block';
                               }"
                               value="1" <?php if ($themeSettings['use_fixed_width'] == 1) {
                            echo 'checked="checked"';
                        } ?> />
                    </label>
                </div>
                <div class="corefortress-theme-editor-field" id="corefortress_slider_percent_width"
                     style="<?php if ($themeSettings['use_fixed_width'] == 1) {
                         echo 'display: none;';
                     } ?>">
                    <label><span class="corefortress-theme-field-label">Width(%)</span>
                        <input type="text" name="theme_settings[percent_width]"
                               value="<?php echo $themeSettings['percent_width']; ?>"/>

                    </label>
                </div>
                <div class="corefortress-theme-editor-field" id="corefortress_slider_fixed_width"
                     style="<?php if ($themeSettings['use_fixed_width'] != 1) {
                         echo 'display: none;';
                     } ?>">
                    <label><span class="corefortress-theme-field-label">Width(px)</span>
                        <input type="text" name="theme_settings[fixed_width]"
                               value="<?php echo $themeSettings['fixed_width']; ?>"/>

                    </label>
                </div>
                <div class="corefortress-theme-editor-field">
                    <label><span class="corefortress-theme-field-label">Fixed Height</span>
                        <select name="theme_settings[use_fixed_height]"
                                onchange="if(this.value == 1) {
                                   document.getElementById('corefortress_slider_fixed_height').style.display='block';
                               }else{
                                   document.getElementById('corefortress_slider_fixed_height').style.display='none';
                               }; window.themeEditorMasonry.masonry('layout');">
                            <option value="1" <?php if ($themeSettings['use_fixed_height'] === true) {
                                echo 'selected="selected"';
                            } ?> >Yes
                            </option>
                            <option value="0" <?php if ($themeSettings['use_fixed_height'] === false) {
                                echo 'selected="selected"';
                            } ?> >No, Auto Height
                            </option>
                        </select>
                    </label>
                </div>

                <div class="corefortress-theme-editor-field" id="corefortress_slider_fixed_height"
                     style="<?php if ($themeSettings['use_fixed_height'] != 1) {
                         echo 'display: none;';
                     } ?>">
                    <label><span class="corefortress-theme-field-label">Height(px)</span>
                        <input type="number" name="theme_settings[fixed_height]"
                               value="<?php echo $themeSettings['fixed_height']; ?>"/>
                    </label>
                </div>

                <div class="corefortress-theme-editor-field">
                    <label><span class="corefortress-theme-field-label">Margin Top(px)</span>
                        <input type="number" min="0" name="theme_settings[margin_top]"
                               value="<?php echo $themeSettings['margin_top']; ?>"/>
                    </label>
                </div>

                <div class="corefortress-theme-editor-field">
                    <label><span class="corefortress-theme-field-label">Margin Right(px)</span>
                        <input type="number" min="0" name="theme_settings[margin_right]"
                               value="<?php echo $themeSettings['margin_right']; ?>"/>
                    </label>
                </div>

                <div class="corefortress-theme-editor-field">
                    <label><span class="corefortress-theme-field-label">Margin Bottom(px)</span>
                        <input type="number" min="0" name="theme_settings[margin_bottom]"
                               value="<?php echo $themeSettings['margin_bottom']; ?>"/>
                    </label>
                </div>

                <div class="corefortress-theme-editor-field">
                    <label><span class="corefortress-theme-field-label">Margin Left(px)</span>
                        <input type="number" min="0" name="theme_settings[margin_left]"
                               value="<?php echo $themeSettings['margin_left']; ?>"/>
                    </label>
                </div>

                <div class="corefortress-theme-editor-field">
                    <label><span class="corefortress-theme-field-label">Lazy Loading</span>
                        <input type="hidden" name="theme_settings[lazy_loading]" value="0"/>
                        <input type="checkbox" name="theme_settings[lazy_loading]"
                               value="1" <?php if ($themeSettings['lazy_loading'] == 1) {
                            echo 'checked="checked"';
                        } ?> />
                    </label>
                </div>
            </div>

            <div class="corefortress-theme-editor-section">
                <h2>Content (including Title, Description & CTA Button)</h2>
                <div class="corefortress-theme-editor-field">
                    <label><span class="corefortress-theme-field-label">Content Vertical Position</span>
                        <select name="theme_settings[content_pos_vertical]">
                            <option value="top" <?php if ($themeSettings['content_pos_vertical'] === 'top') {
                                echo 'selected="selected"';
                            } ?> >Top
                            </option>
                            <option value="center" <?php if ($themeSettings['content_pos_vertical'] === 'center') {
                                echo 'selected="selected"';
                            } ?> >Center
                            </option>
                            <option value="bottom" <?php if ($themeSettings['content_pos_vertical'] === 'bottom') {
                                echo 'selected="selected"';
                            } ?> >Bottom
                            </option>
                        </select>
                    </label>
                </div>

                <div class="corefortress-theme-editor-field">
                    <label><span class="corefortress-theme-field-label">Content Horizontal Position</span>
                        <select name="theme_settings[content_pos_horizontal]">
                            <option value="left" <?php if ($themeSettings['content_pos_horizontal'] === 'left') {
                                echo 'selected="selected"';
                            } ?> >Left
                            </option>
                            <option value="center" <?php if ($themeSettings['content_pos_horizontal'] === 'center') {
                                echo 'selected="selected"';
                            } ?> >Center
                            </option>
                            <option value="right" <?php if ($themeSettings['content_pos_horizontal'] === 'right') {
                                echo 'selected="selected"';
                            } ?> >Right
                            </option>
                        </select>
                    </label>
                </div>

                <div class="corefortress-theme-editor-field">
                    <label><span class="corefortress-theme-field-label">Content Background Color</span>
                        <span class="corefortress-color-field-wrap">
                            <input type="text" name="theme_settings[content_background_color]"
                                   class="corefortress-color-field"
                                   value="<?php echo $themeSettings['content_background_color']; ?>"/>
                        </span>
                    </label>
                </div>

                <div class="corefortress-theme-editor-field">
                    <label>
                        <span class="corefortress-theme-field-label">Content Background Opacity</span>
                        <span class="corefortress-slidefieldcontainer">
                            <input type="range" min="0" max="100" step="1" class="corefortress-field-slider"
                                   name="theme_settings[content_background_opacity]"
                                   value="<?php echo $themeSettings['content_background_opacity']; ?>"/>
                            <span class="corefortress-field-slider-val"><?php echo $themeSettings['content_background_opacity']; ?></span>%
                        </span>
                    </label>
                </div>

                <div class="corefortress-theme-editor-field">
                    <label>
                        <span class="corefortress-theme-field-label">Content Width(%)</span>
                        <span class="corefortress-slidefieldcontainer">
                            <input type="range" min="1" max="100" step="1" class="corefortress-field-slider"
                                   name="theme_settings[content_width_percent]"
                                   value="<?php echo $themeSettings['content_width_percent']; ?>"/>
                            <span class="corefortress-field-slider-val"><?php echo $themeSettings['content_width_percent']; ?></span>%
                        </span>
                    </label>
                </div>

                <div class="corefortress-theme-editor-field">
                    <label><span class="corefortress-theme-field-label">Content Margin Top(px)</span>
                        <input type="number" min="0" name="theme_settings[content_margin_top]"
                               value="<?php echo $themeSettings['content_margin_top']; ?>"/>
                    </label>
                </div>

                <div class="corefortress-theme-editor-field">
                    <label><span class="corefortress-theme-field-label">Content Margin Right(px)</span>
                        <input type="number" min="0" name="theme_settings[content_margin_right]"
                               value="<?php echo $themeSettings['content_margin_right']; ?>"/>
                    </label>
                </div>

                <div class="corefortress-theme-editor-field">
                    <label><span class="corefortress-theme-field-label">Content Margin Bottom(px)</span>
                        <input type="number" min="0" name="theme_settings[content_margin_bottom]"
                               value="<?php echo $themeSettings['content_margin_bottom']; ?>"/>
                    </label>
                </div>

                <div class="corefortress-theme-editor-field">
                    <label><span class="corefortress-theme-field-label">Content Margin Left(px)</span>
                        <input type="number" min="0" name="theme_settings[content_margin_left]"
                               value="<?php echo $themeSettings['content_margin_left']; ?>"/>
                    </label>
                </div>


            </div>

            <div class="corefortress-theme-editor-section">
                <h2>Navigation Arrows</h2>
                <div class="corefortress-theme-editor-field">
                    <label><span class="corefortress-theme-field-label">Use Navigation Arrows</span>
                        <input type="hidden" name="theme_settings[navigation_arrows]" value="0"/>
                        <input type="checkbox" name="theme_settings[navigation_arrows]"
                               value="1" <?php if ($themeSettings['navigation_arrows'] == 1) {
                            echo 'checked="checked"';
                        } ?> />
                    </label>
                </div>
                <div class="corefortress-theme-editor-field corefortress-theme-radio">
                    <span class="corefortress-theme-field-label ">Navigation Arrow Style</span>
                    <span class="corefortress-theme-radio-items-wrap">
                        <?php for ($i = 1; $i < 14; $i++): ?>
                            <span class="corefortress-theme-radio-item">
                                <input type="radio" id="corefortress-theme-arrow-<?php echo $i; ?>"
                                       name="theme_settings[navigation_arrows_style]"
                                       value="<?php echo $i; ?>" <?php if ($themeSettings['navigation_arrows_style'] === $i) {
                                    echo 'checked="checked"';
                                } ?> />
                                <label for="corefortress-theme-arrow-<?php echo $i; ?>">
                                    <img src="<?php echo COREFORTRESS_SLIDER_URL . 'assets/img/arrows/' . $i . 'left.svg'; ?>"
                                         alt="arrow_left"/>
                                    <img src="<?php echo COREFORTRESS_SLIDER_URL . 'assets/img/arrows/' . $i . 'right.svg'; ?>"
                                         alt="arrow_right"/>
                                </label>
                            </span>

                        <?php endfor; ?>
                    </span>
                </div>
            </div>

            <div class="corefortress-theme-editor-section">
                <h2>Title</h2>
                <div class="corefortress-theme-editor-field">
                    <label><span class="corefortress-theme-field-label">Title Font Size</span>
                        <input type="number" name="theme_settings[title_font_size]"
                               value="<?php echo $themeSettings['title_font_size'] ?>">
                    </label>
                </div>

                <div class="corefortress-theme-editor-field">
                    <label><span class="corefortress-theme-field-label">Title Font Color</span>
                        <span class="corefortress-color-field-wrap">
                            <input type="text" name="theme_settings[title_font_color]" class="corefortress-color-field"
                                   value="<?php echo $themeSettings['title_font_color']; ?>"/>
                        </span>
                    </label>
                </div>

                <div class="corefortress-theme-editor-field">
                    <label><span class="corefortress-theme-field-label">Title Margin Top(px)</span>
                        <input type="number" min="0" name="theme_settings[title_margin_top]"
                               value="<?php echo $themeSettings['title_margin_top']; ?>"/>
                    </label>
                </div>

                <div class="corefortress-theme-editor-field">
                    <label><span class="corefortress-theme-field-label">Title Margin Right(px)</span>
                        <input type="number" min="0" name="theme_settings[title_margin_right]"
                               value="<?php echo $themeSettings['title_margin_right']; ?>"/>
                    </label>
                </div>

                <div class="corefortress-theme-editor-field">
                    <label><span class="corefortress-theme-field-label">Title Margin Bottom(px)</span>
                        <input type="number" min="0" name="theme_settings[title_margin_bottom]"
                               value="<?php echo $themeSettings['title_margin_bottom']; ?>"/>
                    </label>
                </div>

                <div class="corefortress-theme-editor-field">
                    <label><span class="corefortress-theme-field-label">Title Margin Left(px)</span>
                        <input type="number" min="0" name="theme_settings[title_margin_left]"
                               value="<?php echo $themeSettings['title_margin_left']; ?>"/>
                    </label>
                </div>

                <div class="corefortress-theme-editor-field">
                    <label><span class="corefortress-theme-field-label">Title Border Size</span>
                        <input type="number" min="0" name="theme_settings[title_border_size]"
                               value="<?php echo $themeSettings['title_border_size'] ?>"/>
                    </label>
                </div>

                <div class="corefortress-theme-editor-field">
                    <label><span class="corefortress-theme-field-label">Title Border Color</span>
                        <span class="corefortress-color-field-wrap">
                            <input type="text" name="theme_settings[title_border_color]"
                                   class="corefortress-color-field"
                                   value="<?php echo $themeSettings['title_border_color']; ?>"/>
                        </span>
                    </label>
                </div>

                <div class="corefortress-theme-editor-field">
                    <label><span class="corefortress-theme-field-label">Title Border Color</span>
                        <select name="theme_settings[title_border_style]">
                            <option value="dotted" <?php if ($themeSettings['title_border_style'] === 'dotted') {
                                echo 'selected="selected"';
                            } ?> >Dotted
                            </option>
                            <option value="dashed" <?php if ($themeSettings['title_border_style'] === 'dashed') {
                                echo 'selected="selected"';
                            } ?> >Dashed
                            </option>
                            <option value="solid" <?php if ($themeSettings['title_border_style'] === 'solid') {
                                echo 'selected="selected"';
                            } ?> >Solid
                            </option>
                            <option value="double" <?php if ($themeSettings['title_border_style'] === 'double') {
                                echo 'selected="selected"';
                            } ?> >Double
                            </option>
                            <option value="groove" <?php if ($themeSettings['title_border_style'] === 'groove') {
                                echo 'selected="selected"';
                            } ?> >Groove
                            </option>
                            <option value="ridge" <?php if ($themeSettings['title_border_style'] === 'ridge') {
                                echo 'selected="selected"';
                            } ?> >Ridge
                            </option>
                            <option value="inset" <?php if ($themeSettings['title_border_style'] === 'inset') {
                                echo 'selected="selected"';
                            } ?> >Inset
                            </option>
                            <option value="outset" <?php if ($themeSettings['title_border_style'] === 'outset') {
                                echo 'selected="selected"';
                            } ?> >Outset
                            </option>
                        </select>
                    </label>
                </div>

                <div class="corefortress-theme-editor-field">
                    <label><span class="corefortress-theme-field-label">Title Border Radius(px)</span>
                        <input type="number" min="0" name="theme_settings[title_border_radius]"
                               value="<?php echo $themeSettings['title_border_radius'] ?>"/>
                    </label>
                </div>

            </div>

            <div class="corefortress-theme-editor-section">
                <h2>Description</h2>
                <div class="corefortress-theme-editor-field">
                    <label><span class="corefortress-theme-field-label">Description Font Size</span>
                        <input type="number" name="theme_settings[description_font_size]"
                               value="<?php echo $themeSettings['description_font_size'] ?>">
                    </label>
                </div>

                <div class="corefortress-theme-editor-field">
                    <label><span class="corefortress-theme-field-label">Description Font Color</span>
                        <span class="corefortress-color-field-wrap">
                            <input type="text" name="theme_settings[description_font_color]"
                                   class="corefortress-color-field"
                                   value="<?php echo $themeSettings['description_font_color']; ?>"/>
                        </span>
                    </label>
                </div>


                <div class="corefortress-theme-editor-field">
                    <label><span class="corefortress-theme-field-label">Description Margin Top(px)</span>
                        <input type="number" min="0" name="theme_settings[description_margin_top]"
                               value="<?php echo $themeSettings['description_margin_top']; ?>"/>
                    </label>
                </div>

                <div class="corefortress-theme-editor-field">
                    <label><span class="corefortress-theme-field-label">Description Margin Right(px)</span>
                        <input type="number" min="0" name="theme_settings[description_margin_right]"
                               value="<?php echo $themeSettings['description_margin_right']; ?>"/>
                    </label>
                </div>

                <div class="corefortress-theme-editor-field">
                    <label><span class="corefortress-theme-field-label">Description Margin Bottom(px)</span>
                        <input type="number" min="0" name="theme_settings[description_margin_bottom]"
                               value="<?php echo $themeSettings['description_margin_bottom']; ?>"/>
                    </label>
                </div>

                <div class="corefortress-theme-editor-field">
                    <label><span class="corefortress-theme-field-label">Description Margin Left(px)</span>
                        <input type="number" min="0" name="theme_settings[description_margin_left]"
                               value="<?php echo $themeSettings['description_margin_left']; ?>"/>
                    </label>
                </div>


                <div class="corefortress-theme-editor-field">
                    <label><span class="corefortress-theme-field-label">Description Border Size</span>
                        <input type="number" min="0" name="theme_settings[description_border_size]"
                               value="<?php echo $themeSettings['description_border_size'] ?>"/>
                    </label>
                </div>

                <div class="corefortress-theme-editor-field">
                    <label><span class="corefortress-theme-field-label">Description Border Color</span>
                        <span class="corefortress-color-field-wrap">
                            <input type="text" name="theme_settings[description_border_color]"
                                   class="corefortress-color-field"
                                   value="<?php echo $themeSettings['description_border_color']; ?>"/>
                        </span>
                    </label>
                </div>

                <div class="corefortress-theme-editor-field">
                    <label><span class="corefortress-theme-field-label">Description Border Color</span>
                        <select name="theme_settings[description_border_style]">
                            <option value="dotted" <?php if ($themeSettings['description_border_style'] === 'dotted') {
                                echo 'selected="selected"';
                            } ?> >Dotted
                            </option>
                            <option value="dashed" <?php if ($themeSettings['description_border_style'] === 'dashed') {
                                echo 'selected="selected"';
                            } ?> >Dashed
                            </option>
                            <option value="solid" <?php if ($themeSettings['description_border_style'] === 'solid') {
                                echo 'selected="selected"';
                            } ?> >Solid
                            </option>
                            <option value="double" <?php if ($themeSettings['description_border_style'] === 'double') {
                                echo 'selected="selected"';
                            } ?> >Double
                            </option>
                            <option value="groove" <?php if ($themeSettings['description_border_style'] === 'groove') {
                                echo 'selected="selected"';
                            } ?> >Groove
                            </option>
                            <option value="ridge" <?php if ($themeSettings['description_border_style'] === 'ridge') {
                                echo 'selected="selected"';
                            } ?> >Ridge
                            </option>
                            <option value="inset" <?php if ($themeSettings['description_border_style'] === 'inset') {
                                echo 'selected="selected"';
                            } ?> >Inset
                            </option>
                            <option value="outset" <?php if ($themeSettings['description_border_style'] === 'outset') {
                                echo 'selected="selected"';
                            } ?> >Outset
                            </option>
                        </select>
                    </label>
                </div>

                <div class="corefortress-theme-editor-field">
                    <label><span class="corefortress-theme-field-label">Description Border Radius(px)</span>
                        <input type="number" min="0" name="theme_settings[description_border_radius]"
                               value="<?php echo $themeSettings['description_border_radius'] ?>"/>
                    </label>
                </div>

            </div>

            <div class="corefortress-theme-editor-section">
                <h2>CTA Button</h2>
                <div class="corefortress-theme-editor-field">
                    <label><span class="corefortress-theme-field-label">CTA Button Background Color</span>
                        <span class="corefortress-color-field-wrap">
                            <input type="text" name="theme_settings[cta_button_background_color]"
                                   class="corefortress-color-field"
                                   value="<?php echo $themeSettings['cta_button_background_color']; ?>"/>
                        </span>
                    </label>
                </div>

                <div class="corefortress-theme-editor-field">
                    <label><span class="corefortress-theme-field-label">CTA Button Text Color</span>
                        <span class="corefortress-color-field-wrap">
                            <input type="text" name="theme_settings[cta_button_font_color]"
                                   class="corefortress-color-field"
                                   value="<?php echo $themeSettings['cta_button_font_color']; ?>"/>
                        </span>
                    </label>
                </div>

                <div class="corefortress-theme-editor-field">
                    <label><span class="corefortress-theme-field-label">CTA Button Text Size</span>
                        <input type="number" min="1" name="theme_settings[cta_button_font_size]"
                               value="<?php echo $themeSettings['cta_button_font_size']; ?>"/>
                    </label>
                </div>

                <div class="corefortress-theme-editor-field">
                    <label><span class="corefortress-theme-field-label">CTA Button Height(px)</span>
                        <input type="number" min="1" name="theme_settings[cta_button_height]"
                               value="<?php echo $themeSettings['cta_button_height']; ?>"/>
                    </label>
                </div>

                <div class="corefortress-theme-editor-field">
                    <label><span class="corefortress-theme-field-label">CTA Button Padding Horizontal(px)</span>
                        <input type="number" min="1" name="theme_settings[cta_button_padding_horizontal]"
                               value="<?php echo $themeSettings['cta_button_padding_horizontal']; ?>"/>
                    </label>
                </div>
                <div class="corefortress-theme-editor-field">
                    <label><span class="corefortress-theme-field-label">CTA Button Border Radius(px)</span>
                        <input type="number" min="0" name="theme_settings[cta_button_border_radius]"
                               value="<?php echo $themeSettings['cta_button_border_radius']; ?>"/>
                    </label>
                </div>

                <div class="corefortress-theme-editor-field">
                    <label><span class="corefortress-theme-field-label">CTA Button Margin Top(px)</span>
                        <input type="number" min="0" name="theme_settings[cta_button_margin_top]"
                               value="<?php echo $themeSettings['cta_button_margin_top']; ?>"/>
                    </label>
                </div>

                <div class="corefortress-theme-editor-field">
                    <label><span class="corefortress-theme-field-label">CTA Button Margin Right(px)</span>
                        <input type="number" min="0" name="theme_settings[cta_button_margin_right]"
                               value="<?php echo $themeSettings['cta_button_margin_right']; ?>"/>
                    </label>
                </div>

                <div class="corefortress-theme-editor-field">
                    <label><span class="corefortress-theme-field-label">CTA Button Margin Bottom(px)</span>
                        <input type="number" min="0" name="theme_settings[cta_button_margin_bottom]"
                               value="<?php echo $themeSettings['cta_button_margin_bottom']; ?>"/>
                    </label>
                </div>

                <div class="corefortress-theme-editor-field">
                    <label><span class="corefortress-theme-field-label">CTA Button Margin Left(px)</span>
                        <input type="number" min="0" name="theme_settings[cta_button_margin_left]"
                               value="<?php echo $themeSettings['cta_button_margin_left']; ?>"/>
                    </label>
                </div>
            </div>

            <div class="corefortress-theme-editor-section">
                <h2>Slide Background Overlay</h2>
                <div class="corefortress-theme-editor-field">
                    <label><span class="corefortress-theme-field-label">Use Background Overlay</span>
                        <input type="hidden" name="theme_settings[background_overlay]" value="0"/>
                        <input type="checkbox" name="theme_settings[background_overlay]"
                               value="1" <?php if ($themeSettings['background_overlay'] == 1) {
                            echo 'checked="checked"';
                        } ?> />
                    </label>
                </div>
                <div class="corefortress-theme-editor-field">
                    <label><span class="corefortress-theme-field-label">Slide Background Overlay Color</span>
                        <span class="corefortress-color-field-wrap">
                            <input type="text" name="theme_settings[background_overlay_color]"
                                   class="corefortress-color-field"
                                   value="<?php echo $themeSettings['background_overlay_color']; ?>"/>
                        </span>
                    </label>
                </div>
                <div class="corefortress-theme-editor-field">
                    <label>
                        <span class="corefortress-theme-field-label">Slide Background Overlay Opacity</span>
                        <span class="corefortress-slidefieldcontainer">
                            <input type="range" min="0" max="100" step="1" class="corefortress-field-slider"
                                   name="theme_settings[background_overlay_opacity]"
                                   value="<?php echo $themeSettings['background_overlay_opacity']; ?>"/>
                            <span class="corefortress-field-slider-val"><?php echo $themeSettings['background_overlay_opacity']; ?></span>%
                        </span>
                    </label>
                </div>
            </div>

            <div class="corefortress-theme-editor-section">
                <h2>Pagination</h2>

                <div class="corefortress-theme-editor-field">
                    <label><span class="corefortress-theme-field-label">Use Pagination</span>
                        <input type="hidden" name="theme_settings[use_pagination]" value="0"/>
                        <input type="checkbox" name="theme_settings[use_pagination]"
                               value="1" <?php if ($themeSettings['use_pagination'] == 1) {
                            echo 'checked="checked"';
                        } ?> />
                    </label>
                </div>

                <div class="corefortress-theme-editor-field">
                    <label><span class="corefortress-theme-field-label">Pagination Type</span>
                        <select name="theme_settings[pagination_type]">
                            <option value="bullets" <?php if ($themeSettings['pagination_type'] === 'bullets') {
                                echo 'selected="selected"';
                            } ?> >Dots
                            </option>
                            <option value="fraction" <?php if ($themeSettings['pagination_type'] === 'fraction') {
                                echo 'selected="selected"';
                            } ?> >Fraction
                            </option>
                            <option value="progressbar" <?php if ($themeSettings['pagination_type'] === 'progressbar') {
                                echo 'selected="selected"';
                            } ?> >Progressbar
                            </option>
                        </select>
                    </label>
                </div>

                <div class="corefortress-theme-editor-field">
                    <label><span class="corefortress-theme-field-label">Pagination Position</span>
                        <select name="theme_settings[pagination_pos]">
                            <option value="top" <?php if ($themeSettings['pagination_pos'] === 'top') {
                                echo 'selected="selected"';
                            } ?> >Top
                            </option>
                            <option value="bottom" <?php if ($themeSettings['pagination_pos'] === 'bottom') {
                                echo 'selected="selected"';
                            } ?> >Bottom
                            </option>
                        </select>
                    </label>
                </div>

                <div class="corefortress-theme-editor-field">
                    <label><span class="corefortress-theme-field-label">Pagination Items Color</span>
                        <span class="corefortress-color-field-wrap">
                            <input type="text" name="theme_settings[pagination_background_color]"
                                   class="corefortress-color-field"
                                   value="<?php echo $themeSettings['pagination_background_color']; ?>"/>
                        </span>
                    </label>
                </div>

                <div class="corefortress-theme-editor-field">
                    <label>
                        <span class="corefortress-theme-field-label">Pagination Items Opacity</span>
                        <span class="corefortress-slidefieldcontainer">
                            <input type="range" min="0" max="100" step="1" class="corefortress-field-slider"
                                   name="theme_settings[pagination_background_opacity]"
                                   value="<?php echo $themeSettings['pagination_background_opacity']; ?>"/>
                            <span class="corefortress-field-slider-val"><?php echo $themeSettings['pagination_background_opacity']; ?></span>%
                        </span>
                    </label>
                </div>

                <div class="corefortress-theme-editor-field">
                    <label><span class="corefortress-theme-field-label">Pagination Active Item Color</span>
                        <span class="corefortress-color-field-wrap">
                            <input type="text" name="theme_settings[pagination_active_background]"
                                   class="corefortress-color-field"
                                   value="<?php echo $themeSettings['pagination_active_background']; ?>"/>
                        </span>
                    </label>
                </div>

                <div class="corefortress-theme-editor-field">
                    <label>
                        <span class="corefortress-theme-field-label">Pagination Active Item Opacity</span>
                        <span class="corefortress-slidefieldcontainer">
                            <input type="range" min="0" max="100" step="1" class="corefortress-field-slider"
                                   name="theme_settings[pagination_active_background_opacity]"
                                   value="<?php echo $themeSettings['pagination_active_background_opacity']; ?>"/>
                            <span class="corefortress-field-slider-val"><?php echo $themeSettings['pagination_active_background_opacity']; ?></span>%
                        </span>
                    </label>
                </div>
            </div>

            <div class="corefortress-theme-editor-section">
                <h2>Thumbnails</h2>
                <div class="corefortress-theme-editor-field">
                    <label><span class="corefortress-theme-field-label">Use Thumbnails</span>
                        <input type="hidden" name="theme_settings[use_thumbnails]" value="0"/>
                        <input type="checkbox" name="theme_settings[use_thumbnails]"
                               value="1" <?php if ($themeSettings['use_thumbnails'] == 1) {
                            echo 'checked="checked"';
                        } ?> />
                    </label>
                </div>

                <div class="corefortress-theme-editor-field">
                    <label><span class="corefortress-theme-field-label">Thumbnails Per View</span>
                        <input type="number" min="1" name="theme_settings[thumbs_per_view]"
                               value="<?php echo $themeSettings['thumbs_per_view'] ?>"/>
                    </label>
                </div>

                <div class="corefortress-theme-editor-field">
                    <label><span class="corefortress-theme-field-label">Thumbnails Position</span>
                        <select name="theme_settings[thumbs_position]">
                            <option value="top" <?php if ($themeSettings['thumbs_position'] === 'top') {
                                echo 'selected="selected"';
                            } ?> >Top
                            </option>
                            <option value="bottom" <?php if ($themeSettings['thumbs_position'] === 'bottom') {
                                echo 'selected="selected"';
                            } ?> >Bottom
                            </option>
                        </select>
                    </label>
                </div>

                <div class="corefortress-theme-editor-field">
                    <label><span class="corefortress-theme-field-label">Thumbnails Height(px)</span>
                        <input type="number" min="1" name="theme_settings[thumbs_height]"
                               value="<?php echo $themeSettings['thumbs_height'] ?>"/>
                    </label>
                </div>
            </div>

        </div>
        <input type="submit" class="corefortress-theme-submit button button-primary" name="corefortress-theme-submit" value="Submit" />
    </form>
</div>