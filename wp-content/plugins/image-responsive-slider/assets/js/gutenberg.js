(function (blocks, i18n, element, components) {
    var SelectControl = components.SelectControl;
    var el = element.createElement; // The wp.element.createElement() function to create elements.

    blocks.registerBlockType('corefortress/slider', {
        title: 'CoreFortress Slider',
        icon: 'slides',
        category: 'corefortress',
        attributes: {
            slider_id: {type: 'string'}
        },
        edit: function (props) {
            var focus = props.focus;
            props.attributes.slider_id =  props.attributes.slider_id &&  props.attributes.slider_id != '0' ?  props.attributes.slider_id : false;
            return [
                !focus && el(
                    SelectControl,
                    {
                        label: 'Select Slider',
                        value: props.attributes.slider_id ? parseInt(props.attributes.slider_id) : 0,
                        instanceId: 'corefortress-slider-selector',
                        onChange: function (value) {
                            props.setAttributes({slider_id: value});
                        },
                        options: corefortressSliderBlockI10n.sliders,
                    }
                ),
                el('div',{}, props.attributes.slider_id ? 'Slider: ' + corefortressSliderBlockI10n.sliderMetas[props.attributes.slider_id] : 'Select Slider')
            ];
        },
        save: function (props) {
            if(typeof props.attributes.slider_id != 'undefined' && props.attributes.slider_id != 0){
                return el('p', {}, '[corefortress_slider id="'+props.attributes.slider_id+'"]');
            } else {
                return el('p', {}, 'Slider not selected');
            }

        },
    });
})(
    window.wp.blocks,
    window.wp.i18n,
    window.wp.element,
    window.wp.components
);