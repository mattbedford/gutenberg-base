(()=>{"use strict";const e=window.wp.blocks,l=window.wp.components,i=window.wp.blockEditor,o=JSON.parse('{"UU":"noob/noob-block"}'),s=window.ReactJSXRuntime;(0,e.registerBlockType)(o.UU,{edit:e=>{const{attributes:o,setAttributes:r}=e,t=(0,i.useBlockProps)().id.replace(/[_\-]/g,"");return r({uniqueId:t}),console.log("Your unique ID is: "+t),(0,s.jsxs)(s.Fragment,{children:[(0,s.jsx)(i.InspectorControls,{children:(0,s.jsxs)(l.PanelBody,{title:"Slider settings",children:[(0,s.jsx)(l.TextControl,{label:"Number of slides to show",type:"number",value:o.numberSlides,onChange:e=>r({numberSlides:parseInt(e)})}),(0,s.jsx)(l.ToggleControl,{checked:!!o.directionVertical,label:"Display slider vertically",onChange:()=>r({directionVertical:!o.directionVertical})}),(0,s.jsx)(l.SelectControl,{label:"Choose your slider type",value:[o.sliderType],options:[{label:"All projects",value:"all"},{label:"Featured projects",value:"featured"},{label:"Custom",value:"custom"}],onChange:e=>r({sliderType:e})})]})}),(0,s.jsxs)("div",{...(0,i.useBlockProps)(),children:[(0,s.jsx)("div",{children:o.directionVertical?"Vertical display":"Horizontal display"}),(0,s.jsx)("div",{children:o.sliderType?"Slider type: "+o.sliderType:""}),(0,s.jsx)("div",{children:"number of slides to show: "+o.numberSlides})]})]})},save:()=>null})})();