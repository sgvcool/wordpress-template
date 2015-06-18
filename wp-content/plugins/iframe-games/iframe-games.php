<?php
/**
 * Plugin Name: Iframe games plugin
 * Plugin URI: 
 * Description: Iframe games plugin allow to change custom fields at single page
 * Version: 0.2
 * Author: Svyat (edit:sasha_kost)
 * Author URI: 
 * License: GPL2
 */

class iframeGames {

	protected $pluginName = 'iframe-games';
	protected $pluginUrl;
	protected $pluginPath;
	public $custom_field_name = '';
	public $posts_per_page;
    public $custom_cat;
    public $custom_complete = 0;
    public $result = false;

	public function __construct() {

		$this->custom_field_name = get_option('iframe_custom_field');
        $this->custom_complete = get_option('iframe_complete');
        $this->custom_cat = (get_option('iframe_cat')) ? get_option('iframe_cat') : 0;
		$this->posts_per_page    = (get_option('iframe_posts_per_page')) ? get_option('iframe_posts_per_page') : 100 ;

		$this->pluginPath = dirname(__FILE__);		
		$this->pluginUrl  = WP_PLUGIN_URL . '/'.$this->pluginName;

		if($_POST['update'] == true) {
            $this->result = $this->update_data($_POST);

        }

		add_action( 'admin_menu', array($this, 'add_menu'));
	}

	function add_menu() {	
		add_menu_page('Iframe games', 'Iframe games', 'administrator', 'iframe-games', array($this, 'iframe_page'));
	}

	function iframe_page() {
		if ( !current_user_can( 'manage_options' ) )  {
			wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
		}

        if ($this->result) { ?>
            <div class="updated" style="margin: 10px 0"><p>Произвольные поля обновлены!</p></div>
        <?php } ?>

        <link rel="stylesheet" href="//cdn.datatables.net/1.10.0/css/jquery.dataTables.css"/>
        <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
        <script src="//cdn.datatables.net/1.10.0/js/jquery.dataTables.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
              //datatable init
                table = $(".widefat").dataTable({
                    "paging":   false,
                    "info":     false
                });

                //category list
                $("#iframe_cat:first").prepend("<option value='0' selected='selected'>Все рубрики</option>");
            });
        </script>
        <style>
            .dataTables_filter {
                margin-bottom: 10px;
                float: left!important;
            }
            .widefat th,
            table.dataTable.no-footer {
                border-bottom: 1px solid #dcdcdc!important;
            }
            .widefat tfoot th {
                padding: 10px 18px 15px 18px!important;
            }
            table.dataTable tfoot th {
                border-top: 1px solid #dcdcdc!important;
            }
            #wpbody-content {
                min-width: 98%;
                padding: 10px 10px 65px 10px!important;
                width: auto!important;
            }
            select {
                width: 200px;
            }
            .item {
                float:left;
                width:100%;
                margin-bottom:10px;
                padding-bottom: 10px;
                border-bottom: 1px solid #dcdcdc;
            }
            .item span {
                margin: 0 10px;
                min-width: 200px;
                text-align: center;
                display: inline-block;
                background: #fff;
                padding: 4px 20px;
                border: 1px solid #dcdcdc;
            }
            .item select {
                vertical-align: baseline;
            }
        </style>

        <!-- Filter -->
	<form action="options.php" method="post" name="options">
		<?php wp_nonce_field('update-options'); ?>

        <div class="item">
            <p><strong>Произвольное поле</strong></p>
            <select name="iframe_custom_field">
                <?php foreach (get_meta_keys() as $item=>$key ) {
                    if ($key == "_additional_settings") break;
                    echo "<option value=".$key.">".$key."</option>";
                } ?>
            </select>
            <span><?php echo $this->custom_field_name; ?></span>
        </div>

        <div class="item">
            <p><strong>Название рубрики</strong></p>
            <?php $args = array('name' => 'iframe_cat'); ?>
            <?php wp_dropdown_categories( $args ); ?>
            <span><?php if ($this->custom_cat == 0) { echo "Все рубрики"; } else { echo get_cat_name($this->custom_cat); } ?></span>
        </div>

        <div class="item">
            <p><strong>Заполнение произвольного поля</strong></p>
            <select name="iframe_complete">
                <option value="0">Все поля</option>
                <option value="1">Только заполненные</option>
                <option value="2">Только пустые</option>
            </select>
            <span><?php switch ($this->custom_complete) {
                    case 0:
                        echo "Все поля";break;
                    case 1:
                        echo "Только заполненные";break;
                    case 2:
                        echo "Только пустые";break;
                } ?></span>
        </div>

        <div class="item">
            <p><strong>Записей на страницу</strong></p>
            <select name="iframe_posts_per_page">
                <option value="10">10</option>
                <option value="20">20</option>
                <option value="50">50</option>
                <option value="100">100</option>
                <option value="200">200</option>
                <option value="500">500</option>
            </select>
            <span><?php echo $this->posts_per_page; ?></span>
        </div>

        <input type="hidden" name="action" value="update" />
 		<input type="hidden" name="page_options" value="iframe_custom_field, iframe_posts_per_page, iframe_cat, iframe_complete" /><br><br/>
		<input type="submit" name="Submit" class="button-primary" value="Сохранить" />
	</form>


	<?php
		if(empty($this->custom_field_name))	wp_die( __( 'Необходимо заполнить название поля с iframe' ) );

		global $post;				
		$paged = ($_GET['post_paged']) ? $_GET['post_paged'] : 1;
        $cat_name = $this->custom_cat;
        $complete_field = $this->custom_complete;

        $args = array(
			'posts_per_page' => $this->posts_per_page,
			'post_type'      => 'post',
			'paged'          => $paged,
            'cat'  => $cat_name
		);
		$all_posts = new WP_query($args);

		if($all_posts->have_posts()):
			echo $this->get_pagination($all_posts);

			echo '<form action="" method="POST">';
			echo '<table class="widefat" cellspacing="0">
				<thead><tr>
					<th scope="col" class="su-titles-actions su-actions">Действие</th>
					<th scope="col" class="su-titles-id su-id">ID</th>
					<th scope="col" class="su-titles-name su-name">Запись</th>
					<th scope="col" class="su-titles-cat su-cat" style="width: 300px">Рубрика</th>
					<th scope="col" class="su-titles-title su-title">Значение произвольного поля</th>
				</tr></thead>
				<tbody>';
			
			while ( $all_posts->have_posts() ) : $all_posts->the_post();
				$iframe_url = htmlspecialchars(get_post_meta($post->ID, $this->custom_field_name, true));
               switch ($complete_field) {
                   case 1: ?>
                       <?php if ($iframe_url != '') { ?>
                       <tr id="su-titles-<?php echo $post->ID; ?>" class="su-titles-post">
                        <td class="su-actions"><a href="<?php the_permalink(); ?>">View</a> | <a href="/wp-admin/post.php?post=<?php echo $post->ID; ?>&amp;action=edit">Edit</a></td>
                        <td class="su-id"><?php echo $post->ID; ?></td>
                        <td class="su-name"><?php the_title(); ?></td>
                        <td class="su-cat"><?php the_category(); ?></td>
                        <td class="su-title" style="width:700px"><div style="text-indent: -99999px"><?php echo $iframe_url; ?></div><input name="post_<?php echo $post->ID; ?>_iframe" id="post_<?php echo $post->ID; ?>_iframe" style="width:100%" value="<?php echo $iframe_url; ?>" type="text" class="textbox regular-text"></td>
                    </tr>
                       <?php } break; ?>
               <?php case 2: ?>
                   <?php if ($iframe_url == '') { ?>
                       <tr id="su-titles-<?php echo $post->ID; ?>" class="su-titles-post">
                           <td class="su-actions"><a href="<?php the_permalink(); ?>">View</a> | <a href="/wp-admin/post.php?post=<?php echo $post->ID; ?>&amp;action=edit">Edit</a></td>
                           <td class="su-id"><?php echo $post->ID; ?></td>
                           <td class="su-name"><?php the_title(); ?></td>
                           <td class="su-cat"><?php the_category(); ?></td>
                           <td class="su-title" style="width:700px"><div style="text-indent: -99999px"><?php echo $iframe_url; ?></div><input name="post_<?php echo $post->ID; ?>_iframe" id="post_<?php echo $post->ID; ?>_iframe" style="width:100%" value="<?php echo $iframe_url; ?>" type="text" class="textbox regular-text"></td>
                       </tr>
                   <?php } break; ?>
               <?php default: ?>
                   <tr id="su-titles-<?php echo $post->ID; ?>" class="su-titles-post">
                       <td class="su-actions"><a href="<?php the_permalink(); ?>">View</a> | <a href="/wp-admin/post.php?post=<?php echo $post->ID; ?>&amp;action=edit">Edit</a></td>
                       <td class="su-id"><?php echo $post->ID; ?></td>
                       <td class="su-name"><?php the_title(); ?></td>
                       <td class="su-cat"><?php the_category(); ?></td>
                       <td class="su-title" style="width:700px"><div style="text-indent: -99999px"><?php echo $iframe_url; ?></div><input name="post_<?php echo $post->ID; ?>_iframe" id="post_<?php echo $post->ID; ?>_iframe" style="width:100%" value="<?php echo $iframe_url; ?>" type="text" class="textbox regular-text"></td>
                   </tr>
               <?php } ?>

			<?php endwhile; 
			
			echo '</tbody>';
            echo '<tfoot><tr><th>Действие</th><th>ID</th><th>Запись</th><th>Рубрика</th><th>Значение произвольного поля</th></tr></tfoot>';
            echo '</table><br>';
			echo '<input type="hidden" name="update" value="true">';
			echo '<input type="submit" class="button-primary" value="Обновить">';
			echo $this->get_pagination($all_posts);
			echo '</form>'; ?>


            <!--export & import-->
            <hr/>
            <?php
            if($_POST['export']) {
                $file = $this->export_data($_POST['custom_field']);
            }
            if($_POST['import']) {
                $this->import_data($_POST['custom_field_import']);
            }
            ?>
            <form enctype="multipart/form-data" action="" method="POST">
                <h2>Экспорт</h2>
                <p>Выберите название произвольного поля для экспорта</p>
                <select name="custom_field" style="width:300px;margin-top: -3px;">
                    <?php foreach (get_meta_keys() as $item=>$key ) {
                        if ($key == "_additional_settings") break;
                        echo "<option value=".$key.">".$key."</option>";
                    } ?>
                </select><br/><br/>
                <input class="button-primary" type="submit" name="export" value="Экспорт"/>
                <?php if ($file) {echo "<a style='margin:0 20px' href='".$file."'>Скачать CSV</a>"; } ?>
                <br/><br/>
                <hr/>
                <h2>Импорт</h2>
                <p>Выберите название произвольного поля и для импорта</p>
                <select name="custom_field_import" style="width:300px;margin-top: -3px;">
                    <?php foreach (get_meta_keys() as $item=>$key ) {
                        if ($key == "_additional_settings") break;
                        echo "<option value=".$key.">".$key."</option>";
                    } ?>
                </select>
                <p>Выберите файл для импорта</p>
                <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
                <input type="file" name="file"/><br/><br/>
                <input class="button-primary" type="submit" name="import" value="Импорт"/>
            </form>

        <?php

		endif;
	}

	function get_pagination($query) { 
		$PAGE_URL = $this->pluginName;
		
		$before = (($query->query_vars['paged'] - 1) ? ($query->query_vars['paged'] - 1) : 1);
		$after  = ((($query->query_vars['paged']+1) >= $query->max_num_pages) ? $query->max_num_pages : ($query->max_num_pages - 1));
		$url = '/wp-admin/admin.php?page='.$PAGE_URL.'&post_paged=';

	 	$html  = '<div class="tablenav"><div class="tablenav-pages">';
	 	$html .= '<span class="displaying-num">Страница '.$query->query_vars['paged'].' из '.$query->max_num_pages.'</span> '; 
	 	$html .= '<a class="prev page-numbers" href="'.$url.''.$before.'">←</a> ';
			for($i = 1; $i <= $query->max_num_pages; $i++) { 
				if($i != $query->query_vars['paged']) {
					$html .= '<a class="page-numbers" href="'.$url.''.$i.'">'.$i.'</a> ';
				} else {
					$html .= '<span class="page-numbers current">'.$i.'</span> ';
				}
			
			}

		$html .= '<a class="next page-numbers" href="'.$url.''.$after.'">→</a> ';
		$html .= '</div></div>';
		return $html;

	}

	function update_data($data) {
		foreach($data as $elem=>$key) {
			$ID = preg_replace("/[^0-9]/", "", $elem);
			$value = $key;

			if($ID > 0) {
				$update[$ID] = $value;
			}		
		}
		
		$field = $this->custom_field_name;

		foreach($update as $ID=>$value) {
			update_post_meta($ID, $field, html_entity_decode($value)); 
		}
        return true;
	}

    function export_data($custom_field){
        ini_set("max_execution_time", "1000");
        ini_set("memory_limit", "500M");
        ini_set('display_startup_errors', 1);
        ini_set('display_errors', 1);
       global $post;
        $args = array('post_type'=>'post',"posts_per_page"=> -1);
        $posts = new WP_query($args);
        $csv = fopen('../wp-content/uploads/'.$custom_field.'.csv', 'w+');
        while ( $posts->have_posts() ) : $posts->the_post();
            fwrite($csv, $post->ID.";");
            fwrite($csv, get_the_title().";");
            fwrite($csv, htmlspecialchars(get_post_meta($post->ID, $custom_field, true)).";\n");
        endwhile;
        $file = '/wp-content/uploads/'.$custom_field.'.csv';
        echo "<div class='updated' style='padding:10px'>Экпорт поля <strong>".$custom_field."</strong> успешно завершен. Теперь Вы можете скачать файл CSV.</div>";
        return $file;
    }

    function import_data($custom_field_import) {
        $file = fopen($_FILES["file"]["tmp_name"], 'r');
        while (($line = fgetcsv($file)) !== FALSE) {
            foreach ($line as $key=>$value) {
                $temp = explode(";", $value);
                update_post_meta($temp[0], $custom_field_import, html_entity_decode($temp[2]));
            }
        }
        echo "<div class='updated' style='padding:10px'>Импорт поля <strong>".$custom_field_import."</strong> успешно завершен.</div>";
        fclose($file);
    }
} 
	
	$new_frame = new iframeGames();
?>
