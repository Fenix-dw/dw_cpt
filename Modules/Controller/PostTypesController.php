<?php 

    namespace Modules\Controller;

    use Modules\AuthError;

    class PostTypesController extends AuthError {	

        public $slugs;

    	private $data, $slug, $plural_name, $singular_name;

    	public function __construct($data = false, $slug = false, $plural_name = false, $singular_name = false)
    	{  
            if ($data)
            {   
                $this->data = $data;
            		if ( $slug && $plural_name && $singular_name) {
                        $this->slug = $slug;                
            			$this->plural_name = $plural_name;
            			$this->singular_name = $singular_name;

            		}
            }
    	}

        public function get_slugs($data = false)
        {
            if(!$data) return;

            $post_types = json_decode($data);
            foreach ($post_types as $post_type) {
                foreach ($post_type as $key => $labels) {
                    $key = ($key) ? $key : "no_name" ;
                    $slugs[] = $key;
                }
            } 
            return json_encode($slugs);
            $this->slugs = $slugs;

        }

        public function save()
        {
            // if(!$data) return;
            $post_types = json_decode($this->data);            
            // if (!$post_types) {
            //     echo $this->sendError("No Content", [], 204);
            //     wp_die();                
            // }
            $post_types[] = [ $this->slug => [
                'name' =>  $this->plural_name,
                'singular_name' => $this->singular_name, // админ панель Добавить->Функцию
                'add_new' => 'Добавить '. $this->singular_name ,
                'add_new_item' => 'Добавить новый '. $this->singular_name, // заголовок тега <title>
                'edit_item' => 'Редактировать '. $this->singular_name,
                'new_item' => 'Новый ' . $this->singular_name,
                'all_items' => 'Все ' .  $this->plural_name,
                'view_item' => 'Просмотр на сайте',
                'search_items' => 'Искать товары',
                'not_found' =>  $this->singular_name . ' не найдено.',
                'not_found_in_trash' => 'В корзине нет ' . $this->singular_name,
                'menu_name' => $this->plural_name,// ссылка в меню в админке                 
            ]];  
            file_put_contents(CPT_PLUGIN_DIR . "/data.php", "<?php return '". json_encode($post_types) ." ';");        
        }

        public function view($data = false)
        {   

            if(!$data) return;

            $post_types = json_decode($data);
            foreach ($post_types as $post_type) {
                foreach ($post_type as $key => $labels) {
                    $args = array(
                        'labels' => $labels,
                        'public' => true, // благодаря этому некоторые параметры можно пропустить
                        'show_ui' => true, // показывать интерфейс в админке
                        'menu_icon' => 'dashicons-admin-post', 
                        'menu_position' => 25,
                        'has_archive' => true,
                        'exclude_from_search' => true,
                        'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail'),
                        'taxonomies' => array('category')
                    );
                    register_post_type($key ,$args);
                }
            }            
        }

        public function delete($data = false, $slug = false)
        {   
            if(!$data) return;

            $post_types = json_decode($data);

            foreach ($post_types as $key => $post_type) {
                foreach ($post_type as $ke => $labels) {
                    if ($ke == $slug) {
                        unset($post_types[$key]);
                    }
                }  
            }    
            file_put_contents(CPT_PLUGIN_DIR . "/data.php", "<?php return '". json_encode($post_types) ." ';");
        }

    }
