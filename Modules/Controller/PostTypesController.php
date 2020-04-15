<?php 

    namespace Modules\Controller;

    use Modules\AuthError;

    class PostTypesController extends AuthError {	

    	private $data, $slug, $plural_name, $singular_name;

    	public function __construct($data = false, $slug = false, $plural_name = false, $singular_name = false)
    	{  
            $data1 = str_replace(" ","",$data);
            if ($data && $data1 != "null") {
                $this->data = $data;
            }
    		if ( $slug && $plural_name && $singular_name) {
                $this->slug = $slug;                
    			$this->plural_name = $plural_name;
    			$this->singular_name = $singular_name;

    		}
    	}

        public function get($data = false, $old_slug = false)
        {
            // $data1 = str_replace(" ","",$data);
            // if(!$data1) return;
            $input = [ "slugs" => [],
                        "slug" => null,
                        "plural_name" => null,
                        "singular_name"=> null,
            ];
           
            $post_types = json_decode($data);
            foreach ($post_types as $post_type) {
                foreach ($post_type as $key => $label) {
                    $key = ($key) ? $key : "no_name" ;
                    $input["slugs"][] = $key;
                    if($old_slug){
                        if ($old_slug == $key) {
                        $input['slug'] =  $key;
                        $input['plural_name'] = $label->plural_name;
                        $input['singular_name'] = $label->singular_name;
                        }
                    }  
                }                         
            }
               
            return json_encode($input);
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
                'plural_name' =>  $this->plural_name,
                'singular_name' => $this->singular_name, // админ панель Добавить->Функцию
            ]];  
            file_put_contents(CPT_PLUGIN_DIR . "/data.php", "<?php return '". json_encode($post_types) ."';");        
        }

        public function view($data = false)
        {   
            $data1 = str_replace(" ","",$data);;
            if( !$data1 || $data1 == 'null') return;

            $post_types = json_decode($data);
            foreach ($post_types as $post_type) {
                foreach ($post_type as $key => $labels) {
                    $label = [
                        'name' =>  $labels->plural_name,
                        'singular_name' =>  $labels->singular_name, // админ панель Добавить->Функцию
                        'add_new' => 'Добавить '. $labels->singular_name,
                        'add_new_item' => 'Добавить новый '. $labels->singular_name, // заголовок тега <title>
                        'edit_item' => 'Редактировать '. $labels->singular_name,
                        'new_item' => 'Новый ' . $labels->singular_name,
                        'all_items' => 'Все ' .  $labels->plural_name,
                        'view_item' => 'Просмотр на сайте',
                        'search_items' => 'Искать ' .  $labels->plural_name,
                        'not_found' =>  $labels->singular_name . ' не найдено.',
                        'not_found_in_trash' => 'В корзине нет ' . $labels->singular_name,
                        'menu_name' => $labels->plural_name,// ссылка в меню в админке                 
                    ];
                    $args = array(
                        'labels' => $label,
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

        public function delete($old_slug = false, $data = false)
        {   
            // if( !$data && $this->data ) $data = $this->data;
            // if(!$data) return "no_date";
            // $data = $this->data;
            $post_types = json_decode($data);

            foreach ($post_types as $key => $post_type) {
                foreach ($post_type as $ke => $labels) {
                    if ($ke == $old_slug) {
                        unset($post_types[$key]);
                    }
                }  
            }    
            if(is_array($post_types)){
                foreach ($post_types as $value) {
                    $poste[] = $value;
                }          
            } 
            $poste = ($poste) ? json_encode($poste) : "" ;
                  
            file_put_contents(CPT_PLUGIN_DIR . "/data.php", "<?php return '". $poste ."';");
        }

        public function edit($old_slug = false)
        {
            if( !$this->data && !$old_slug ) return;

            $post_types = json_decode($this->data);

            foreach ($post_types as $key => $post_type) {
                foreach ($post_type as $ke => $label) {
                    if ($ke == $old_slug) {
                        $update_post_type = [ $this->slug => [
                            'plural_name' =>  $this->plural_name,
                            'singular_name' => $this->singular_name, // админ панель Добавить->Функцию
                        ]];                        
                       $new_post_types = array_replace($post_types ,[$key => $post_type], [$key => $update_post_type]);
                    }
                }  
            }    
            // return json_encode($new_post_types) ;
            if($new_post_types) file_put_contents(CPT_PLUGIN_DIR . "/data.php", "<?php return '". json_encode($new_post_types) ."';");                        
        }

    }
