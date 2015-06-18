<?php
/*
Plugin Name: Add category secondary fields
Plugin URI:
Description: Add category secondary fields
Version: 1.0.1
Author: Sergey Gerasimenko <sgvcool@gmail.com>
Author URI:
*/
add_action('admin_init', 'styles_init');
add_action('admin_init', 'category_custom_fields');

function styles_init(){
    /*
     * Сначала регистрируем стили
     * файл CSS должен находиться в папке с выполняемым файлов плагина
     */
    wp_register_style('categoryplugin', plugins_url('styles/style.css', __FILE__));
}

/*function category_plugin_menu()
{
    /*
     * Создаем страницу настроек плагина, она будет находиться в разделе Параметры
     */
     //$page_suffix = add_menu_page('Category secondary fields creator', 'Category creator', 'manage_options', __FILE__, 'category_plugin_html');
    
    /*
     * Создаем хук, содержащий суффикс созданной страницы настроек $page_suffix
     */
    //add_action('admin_print_styles-' . $page_suffix, 'category_plugin_styles');
//}
//add_action('admin_menu', 'category_plugin_menu');

function category_plugin_styles()
{
    /*
     * Ставим в очередь на вывод
     */
    wp_enqueue_style('categoryplugin');
}

function category_plugin_html(){
    /*
     * Собственно содержимое страницы настроек
     */
    echo '<h2> Category fields creator</h2>';
}

// функция расширения функционала административного раздела
function category_custom_fields(){
    // добавления действия после отображения формы ввода параметров категории
    add_action('edit_category_form_fields', 'category_custom_fields_form');
    
    // добавления действия при сохранении формы ввода параметров категории
    add_action('edited_category', 'category_custom_fields_save');
}

function category_custom_fields_form($tag){
    $t_id = $tag->term_id;
    $cat_meta = get_option("category_$t_id");?>
	<table class="form-table">
        <tbody>
            <tr></tr>
            <tr>
				<th scope="row" valign="top">
                    <label for="category-name"><?php _e('Название категории'); ?></label>
                </th>
				<td>
                    <span class="description"><?php _e('Дополнительное название категории'); ?></span></br>
					<input style='width: 100%' class='cat-name' type='text' id='category-name' name="Cat_meta[cat_name]" value="<?php echo $cat_meta['cat_name'] ? $cat_meta['cat_name'] : '';?>" />
                </td>
			</tr>
			
            <tr class="form-field">
                <th scope="row" valign="top">
                    <label for="Cat_meta[cat_editor]"><?php _e('Редактор'); ?></label>
                </th>
                <td>
                    <span class="description"><?php _e('Дополнительный редактор категории'); ?></span>
                    <textarea id="description2" name="Cat_meta[cat_editor]" aria-hidden="true" class="mceEditor mceContentBody" rows="15" autocomplete="off" cols="40"><?php echo $cat_meta['cat_editor'] ? $cat_meta['cat_editor'] : '';?></textarea>
                </td>
            </tr>
            <tr></tr>
        </tbody>
    </table>
	<script type="text/javascript">
		jQuery(document).ready(function(){
			tinymce.init({
				selector: "textarea#description2",
				theme: "modern",
				skin: "wordpress",
				toolbar1: "newdocument fullpage | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | styleselect formatselect fontselect fontsizeselect",
				toolbar2: "cut copy paste | searchreplace | bullist numlist | outdent indent blockquote | undo redo | link unlink anchor image media code | insertdatetime preview | forecolor backcolor",
				toolbar3: "link,table | hr removeformat | subscript superscript | charmap emoticons | print fullscreen | ltr rtl | spellchecker | visualchars visualblocks nonbreaking template pagebreak restoredraft",
				menubar: true,
				options:"importcss,textpattern,no_autop,paste_images,fontsize_formats, advlist,contextmenu,menubar",
				plugins: "link,colorpicker,textpattern,paste,textcolor,emoticons,textcolor,table,contextmenu,directionality,insertdatetime,media,nonbreaking,code,fullscreen,visualchars,visualblocks,searchreplace,anchor,hr,charmap,lists,image,advlist, code, insertdatetime, nonbreaking, print,searchreplace,table,visualblocks,visualchars,emoticons,advlist,importcss,contextmenu,textpattern,textcolor,paste",
				admin_settings:{"options":"importcss,textpattern,no_autop,paste_images,fontsize_formats","disabled_plugins":""},
				content_css : "<?=WP_PLUGIN_URL?>/add-category-secondary-fields/styles/style.css",
			})
		});
	</script>

<?php
}

function category_custom_fields_save($term_id){
    if (isset($_POST['Cat_meta'])) {
        $t_id = $term_id;
        $cat_meta = get_option("category_$t_id");
        $cat_keys = array_keys($_POST['Cat_meta']);
       
	    foreach ($cat_keys as $key) {
            if (isset($_POST['Cat_meta'][$key])) {
                $cat_meta[$key] = stripcslashes($_POST['Cat_meta'][$key]);
            }
        }
		
        update_option("category_$t_id", $cat_meta);
    }
}

/**
 * settings for tynyMCE advanced
 *{"settings":{"toolbar_1":"bold,italic,underline,blockquote,bullist,numlist,alignleft,aligncenter,alignright,link,unlink,table,fullscreen,undo,redo,wp_adv,styleselect,fontsizeselect,fontselect,code,backcolor,anchor,insertdatetime,hr,subscript,superscript,ltr,rtl,wp_page,visualblocks","toolbar_2":"formatselect,alignjustify,strikethrough,outdent,indent,pastetext,removeformat,charmap,wp_more,emoticons,forecolor,wp_help","toolbar_3":"","toolbar_4":"","options":"advlist,contextmenu,advlink,menubar","plugins":"anchor,code,insertdatetime,nonbreaking,print,searchreplace,table,visualblocks,visualchars,emoticons,advlist,link,importcss,contextmenu,textpattern"},"admin_settings":{"options":"importcss,textpattern,no_autop,paste_images","disabled_plugins":""}}
 *
 */