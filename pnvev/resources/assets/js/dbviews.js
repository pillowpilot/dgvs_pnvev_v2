import ace from 'ace-builds/src-noconflict/ace';
import theme from 'ace-builds/src-noconflict/theme-solarized_dark';
// import workerJavascript from 'file-loader?outputPath=js_v2!ace-builds/src-noconflict/worker-javascript.js'; // See https://v4.webpack.js.org/loaders/file-loader/
import mode from 'ace-builds/src-noconflict/mode-mysql';
import { format } from 'sql-formatter';

ace.config.setModuleUrl('ace/theme/solarized_dark', theme);
ace.config.setModuleUrl('ace/mode/mysql', mode);

var editor = ace.edit(VIEW_EDITOR_CONTAINER_ID);
editor.setTheme("ace/theme/solarized_dark");
editor.session.setMode("ace/mode/mysql");
editor.setShowPrintMargin(false);
const formattedViewDefinition = format(VIEW_DEFINITION);
editor.setValue(formattedViewDefinition);

const form = document.getElementById(VIEW_EDITOR_FORM_ID);
const editorValueField = document.getElementById(VIEW_EDITOR_VALUE_FIELD);

form.onsubmit = (e) => {
    
    console.log(e);
    console.log(editor.getValue());

    editorValueField.setAttribute('value', editor.getValue());
    
    return true; // Continue 
};
