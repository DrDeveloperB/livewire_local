require('./bootstrap');

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// // toast ui editor
// import "@toast-ui/editor/dist/toastui-editor.css";
// // toast ui editor - dark theme
// import '@toast-ui/editor/dist/theme/toastui-editor-dark.css';
// // toast ui editor - chart
// import '@toast-ui/chart/dist/toastui-chart.css';
// // toast ui editor - code syntax highlight
// import 'prismjs/themes/prism.css';
// import '@toast-ui/editor-plugin-code-syntax-highlight/dist/toastui-editor-plugin-code-syntax-highlight.css';
// // toast ui editor - color syntax
// import 'tui-color-picker/dist/tui-color-picker.css';
// import '@toast-ui/editor-plugin-color-syntax/dist/toastui-editor-plugin-color-syntax.css';
// // toast ui editor - table merged cell
// import '@toast-ui/editor-plugin-table-merged-cell/dist/toastui-editor-plugin-table-merged-cell.css';

// toast ui editor - scripts
// import toastui from '@toast-ui/editor'
// import chart from '@toast-ui/editor-plugin-chart';
// import codeSyntaxHighlight from '@toast-ui/editor-plugin-code-syntax-highlight';
// import colorSyntax from '@toast-ui/editor-plugin-color-syntax';
// import tableMergedCell from '@toast-ui/editor-plugin-table-merged-cell';

// window.ToastEditor = toastui;
// window.ToastChart = chart;
// window.ToastHighlight = codeSyntaxHighlight;
// window.ToastColor = colorSyntax;
// window.ToastMergedCell = tableMergedCell;

try {
    // window.$ = window.jQuery = require('jquery');
    window.$ = window.jQuery = require('admin-lte/plugins/jquery/jquery.min');

    // window.createPopper = require('@popperjs/core');
    // window.Popper = require('admin-lte/plugins/popper/popper');

    // require('bootstrap');
    // require('admin-lte/node_modules/bootstrap');
    // require('admin-lte/plugins/bootstrap/js/bootstrap.bundle');
    // window.bootstrap = require('admin-lte/plugins/bootstrap/js/bootstrap');
    // window.Popper = Popper();
    // Popper.start();

    // window.$.summernote = require('admin-lte/plugins/summernote/summernote-bs4');
        // window.summernote = require('admin-lte/plugins/summernote/summernote-bs4');

    require('admin-lte');
} catch (e) {}
