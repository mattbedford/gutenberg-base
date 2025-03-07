import { registerBlockType } from '@wordpress/blocks';
import { ToggleControl, SelectControl } from '@wordpress/components';
import metadata from './block.json';

registerBlockType( metadata.name, {

    edit: (props) => {
        // Destructure your attributes from block.json here so you can call them by name
        const { attributes, setAttributes } = props;

        console.log(attributes);
        return (
            <>
                <ToggleControl
                    checked={ !! attributes.directionVertical }
                    label={"Display slider vertically"}
                    onChange={ () =>
                        setAttributes( {
                            directionVertical : ! attributes.directionVertical,
                        } )
                    }
                />
                <SelectControl
                    label="Choose your slider type"
                    value={ [attributes.sliderType] }
                    options={ [
                        { label: 'Speakers', value: 'speakers' },
                        { label: 'Sponsors', value: 'sponsors' },
                        { label: 'Custom', value: 'custom' },
                    ] }
                    onChange={ ( newType ) => setAttributes( { sliderType: newType } ) }
                />
            </>
        );
    },

    save: () => { return null; },
} );