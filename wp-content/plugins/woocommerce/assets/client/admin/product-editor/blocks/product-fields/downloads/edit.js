"use strict";Object.defineProperty(exports,"__esModule",{value:!0}),exports.Edit=void 0;const i18n_1=require("@wordpress/i18n"),components_1=require("@wordpress/components"),data_1=require("@wordpress/data"),element_1=require("@wordpress/element"),icons_1=require("@wordpress/icons"),block_templates_1=require("@woocommerce/block-templates"),components_2=require("@woocommerce/components"),core_data_1=require("@wordpress/core-data"),downloads_menu_1=require("./downloads-menu"),manage_download_limits_modal_1=require("../../../components/manage-download-limits-modal"),edit_downloads_modal_1=require("./edit-downloads-modal");function getFileName(e){var o;const[t]=null!==(o=null==e?void 0:e.split("/").reverse())&&void 0!==o?o:[];return t}function stringifyId(e){return e?String(e):""}function stringifyEntityId(e){return{...e,id:stringifyId(e.id)}}function Edit({attributes:e,context:{postType:o}}){const t=(0,block_templates_1.useWooBlockProps)(e),[,n]=(0,core_data_1.useEntityProp)("postType",o,"downloadable"),[l,i]=(0,core_data_1.useEntityProp)("postType",o,"downloads"),[r,a]=(0,core_data_1.useEntityProp)("postType",o,"download_limit"),[d,c]=(0,core_data_1.useEntityProp)("postType",o,"download_expiry"),[m,s]=(0,element_1.useState)(),{allowedMimeTypes:_}=(0,data_1.useSelect)((e=>{const{getEditorSettings:o}=e("core/editor");return o()})),p=_?Object.values(_):[],{createErrorNotice:u}=(0,data_1.useDispatch)("core/notices"),[w,f]=(0,element_1.useState)(!1);function y(e){const o=l.reduce((function(o,t){return t.file===e.file?o:[...o,stringifyEntityId(t)]}),[]);o.length||n(!1),i(o)}function E(e){return function(){y(e)}}function g(e){return function(){s(stringifyEntityId(e))}}function b(e){u("string"==typeof e?e:(0,i18n_1.__)("There was an error uploading files","woocommerce"))}return(0,element_1.createElement)("div",{...t},(0,element_1.createElement)("div",{className:"wp-block-woocommerce-product-downloads-field__header"},Boolean(l.length)&&(0,element_1.createElement)(components_1.Button,{variant:"tertiary",onClick:function(){f(!0)}},(0,i18n_1.__)("Manage limits","woocommerce")),(0,element_1.createElement)(downloads_menu_1.DownloadsMenu,{allowedTypes:p,onUploadSuccess:function(e){if(!Array.isArray(e))return;const o=e.filter((e=>!l.some((o=>o.file===e.url))));if(o.length!==e.length&&u(1===e.length?(0,i18n_1.__)("This file has already been added","woocommerce"):(0,i18n_1.__)("Some of these files have already been added","woocommerce")),o.length){l.length||n(!0);const e=o.map((e=>({id:stringifyId(e.id),file:e.url,name:e.title||e.alt||e.caption||getFileName(e.url)}))),t=l.map(stringifyEntityId);t.push(...e),i(t)}},onUploadError:b})),(0,element_1.createElement)("div",{className:"wp-block-woocommerce-product-downloads-field__body"},!Boolean(l.length)&&(0,element_1.createElement)("div",{className:"wp-block-woocommerce-product-downloads-field__drop-zone-content"},(0,element_1.createElement)("p",{className:"wp-block-woocommerce-product-downloads-field__drop-zone-label"},(0,element_1.createInterpolateElement)((0,i18n_1.__)("Supported file types: <Types /> and more. <link>View all</link>","woocommerce"),{Types:(0,element_1.createElement)(element_1.Fragment,null,"PNG, JPG, PDF, PPT, DOC, MP3, MP4"),link:(0,element_1.createElement)("a",{href:"https://codex.wordpress.org/Uploading_Files",target:"_blank",rel:"noreferrer",onClick:e=>e.stopPropagation()})}))),Boolean(l.length)&&(0,element_1.createElement)(components_2.Sortable,{className:"wp-block-woocommerce-product-downloads-field__table"},l.map((e=>{const o=getFileName(e.file),t=e.file.startsWith("blob");return(0,element_1.createElement)(components_2.ListItem,{key:e.file},(0,element_1.createElement)("div",{className:"wp-block-woocommerce-product-downloads-field__table-filename"},(0,element_1.createElement)("span",null,e.name),e.name!==o&&(0,element_1.createElement)("span",{className:"wp-block-woocommerce-product-downloads-field__table-filename-description"},o)),(0,element_1.createElement)("div",{className:"wp-block-woocommerce-product-downloads-field__table-actions"},t&&(0,element_1.createElement)(components_1.Spinner,{"aria-label":(0,i18n_1.__)("Uploading file","woocommerce")}),!t&&(0,element_1.createElement)(components_1.Button,{onClick:g(e),variant:"tertiary"},(0,i18n_1.__)("Edit","woocommerce")),(0,element_1.createElement)(components_1.Button,{icon:icons_1.closeSmall,label:(0,i18n_1.__)("Remove file","woocommerce"),disabled:t,onClick:E(e)})))})))),w&&(0,element_1.createElement)(manage_download_limits_modal_1.ManageDownloadLimitsModal,{initialValue:{downloadLimit:r,downloadExpiry:d},onSubmit:function(e){a(e.downloadLimit),c(e.downloadExpiry),f(!1)},onClose:function(){f(!1)}}),m&&(0,element_1.createElement)(edit_downloads_modal_1.EditDownloadsModal,{downloableItem:{...m},onCancel:()=>s(null),onRemove:()=>{y(m),s(null)},onChange:e=>{s({...m,name:e})},onSave:(v=m,function(){const e=l.map(stringifyEntityId).map((e=>e.id===v.id?v:e));i(e),s(null)}),onUploadSuccess:function(e){var o;if(!Array.isArray(e)||!(null==e?void 0:e.length)||void 0===(null===(o=e[0])||void 0===o?void 0:o.id))return;l.length||n(!0);const t={id:stringifyId(e[0].id),file:e[0].url,name:e[0].title||e[0].alt||e[0].caption||getFileName(e[0].url)},r=l.map((e=>e.file===(null==m?void 0:m.file)?stringifyEntityId(t):stringifyEntityId(e)));i(r),s(t)},onUploadError:b}));var v}exports.Edit=Edit;