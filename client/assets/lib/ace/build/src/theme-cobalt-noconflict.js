ace.define("ace/theme/cobalt",["require","exports","module","ace/lib/dom"],function(a,b,c){b.isDark=!0,b.cssClass="ace-cobalt",b.cssText=".ace-cobalt .ace_editor {  border: 2px solid rgb(159, 159, 159);}.ace-cobalt .ace_editor.ace_focus {  border: 2px solid #327fbd;}.ace-cobalt .ace_gutter {  background: #e8e8e8;  color: #333;}.ace-cobalt .ace_print_margin {  width: 1px;  background: #e8e8e8;}.ace-cobalt .ace_scroller {  background-color: #002240;}.ace-cobalt .ace_text-layer {  cursor: text;  color: #FFFFFF;}.ace-cobalt .ace_cursor {  border-left: 1px solid #FFFFFF;}.ace-cobalt .ace_cursor.ace_overwrite {  border-left: 0px;  border-bottom: 1px solid #FFFFFF;}.ace-cobalt .ace_marker-layer .ace_selection {  background: rgba(179, 101, 57, 0.75);}.ace-cobalt .ace_marker-layer .ace_step {  background: rgb(198, 219, 174);}.ace-cobalt .ace_marker-layer .ace_bracket {  margin: -1px 0 0 -1px;  border: 1px solid rgba(255, 255, 255, 0.15);}.ace-cobalt .ace_marker-layer .ace_active_line {  background: rgba(0, 0, 0, 0.35);}.ace-cobalt .ace_marker-layer .ace_selected_word {  border: 1px solid rgba(179, 101, 57, 0.75);}.ace-cobalt .ace_invisible {  color: rgba(255, 255, 255, 0.15);}.ace-cobalt .ace_keyword, .ace-cobalt .ace_meta {  color:#FF9D00;}.ace-cobalt .ace_constant, .ace-cobalt .ace_constant.ace_other {  color:#FF628C;}.ace-cobalt .ace_constant.ace_character,  {  color:#FF628C;}.ace-cobalt .ace_constant.ace_character.ace_escape,  {  color:#FF628C;}.ace-cobalt .ace_invalid {  color:#F8F8F8;background-color:#800F00;}.ace-cobalt .ace_support {  color:#80FFBB;}.ace-cobalt .ace_support.ace_constant {  color:#EB939A;}.ace-cobalt .ace_fold {    background-color: #FF9D00;    border-color: #FFFFFF;}.ace-cobalt .ace_support.ace_function {  color:#FFB054;}.ace-cobalt .ace_storage {  color:#FFEE80;}.ace-cobalt .ace_string.ace_regexp {  color:#80FFC2;}.ace-cobalt .ace_comment {  font-style:italic;color:#0088FF;}.ace-cobalt .ace_variable {  color:#CCCCCC;}.ace-cobalt .ace_variable.ace_language {  color:#FF80E1;}.ace-cobalt .ace_meta.ace_tag {  color:#9EFFFF;}.ace-cobalt .ace_markup.ace_underline {    text-decoration:underline;}.ace-cobalt .ace_markup.ace_heading {  color:#C8E4FD;background-color:#001221;}.ace-cobalt .ace_markup.ace_list {  background-color:#130D26;}";var d=a("../lib/dom");d.importCssString(b.cssText,b.cssClass)})