import { registerBlockType } from '@wordpress/blocks';
import { ToggleControl, SelectControl, PanelBody, TextControl  } from '@wordpress/components';
import { InspectorControls, useBlockProps } from '@wordpress/block-editor';
import metadata from './block.json';

registerBlockType( metadata.name, {

    edit: (props) => {
        // Destructure your attributes from block.json here so you can call them by name
        const { attributes, setAttributes } = props;

        const blockProps = useBlockProps();
        const formattedUniquesId = blockProps.id.replace(/[_\-]/g, "");
        setAttributes({ uniqueId: formattedUniquesId});
        console.log("Your unique ID is: " + formattedUniquesId);

        return (
            <>
                <InspectorControls>
                    <PanelBody title={"Slider settings"}>
                        <TextControl
                            label={"Number of slides to show"}
                            type="number"
                            value={attributes.numberSlides}
                            onChange={(num) => setAttributes({ numberSlides: parseInt(num) })}
                        />
                        <ToggleControl
                            checked={!!attributes.directionVertical}
                            label={"Display slider vertically"}
                            onChange={() =>
                                setAttributes({
                                    directionVertical: !attributes.directionVertical,
                                })
                            }
                        />
                        <SelectControl
                            label="Choose your slider type"
                            value={[attributes.sliderType]}
                            options={[
                                {label: 'Speakers', value: 'speakers'},
                                {label: 'Sponsors', value: 'sponsors'},
                                {label: 'Custom', value: 'custom'},
                            ]}
                            onChange={(newType) => setAttributes({sliderType: newType})}
                        />
                    </PanelBody>
                </InspectorControls>
                <div {...useBlockProps()}>
                   <div>{ attributes.directionVertical ? "Vertical display" : "Horizontal display"}</div>
                    <div>{ attributes.sliderType ? "Slider type: " + attributes.sliderType : ""}</div>
                    <div>{ "number of slides to show: " + attributes.numberSlides }</div>
                </div>
            </>
        );
    },

    save: () => {
        return null;
    },
});