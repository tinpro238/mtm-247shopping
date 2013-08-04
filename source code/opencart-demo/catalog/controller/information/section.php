<?php 
class ControllerInformationSection extends Controller {  
	public function index() { 
		$this->language->load('information/section');
		
		$this->load->model('catalog/section');
		
		$this->load->model('catalog/news');
		
		$this->load->model('tool/image'); 
		
		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else { 
			$page = 1;
		}
		
		if (isset($this->request->get['limit'])) {
			$limit = $this->request->get['limit'];
		} else {
			$limit = $this->config->get('config_catalog_limit');
		}
					
		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home'),
       		'separator' => false
   		);	
			
		if (isset($this->request->get['newspath'])) {
			$newspath = '';
		
			$parts = explode('_', (string)$this->request->get['newspath']);
		
			foreach ($parts as $newspath_id) {
				if (!$newspath) {
					$newspath = $newspath_id;
				} else {
					$newspath .= '_' . $newspath_id;
				}
									
				$section_info = $this->model_catalog_section->getSection($newspath_id);
				
				if ($section_info) {
	       			$this->data['breadcrumbs'][] = array(
   	    				'text'      => $section_info['name'],
						'href'      => $this->url->link('information/section', 'newspath=' . $newspath),
        				'separator' => $this->language->get('text_separator')
        			);
				}
			}		
		
			$section_id = array_pop($parts);
		} else {
			$section_id = 0;
		}
		
		$section_info = $this->model_catalog_section->getSection($section_id);
	
		if ($section_info) {
	  		$this->document->setTitle($section_info['name'] . ' - ' . $this->config->get('config_title'));
			$this->document->setDescription($section_info['meta_description']);
			$this->document->setKeywords($section_info['meta_keyword']);
			
			$this->data['heading_title'] = $section_info['name'];
			
			$this->data['text_empty'] = $this->language->get('text_empty');
			$this->data['button_continue'] = $this->language->get('button_continue');
			
			$url = '';
					
			if ($section_info['image']) {
				$this->data['thumb'] = $this->model_tool_image->resize($section_info['image'], $this->config->get('config_image_category_width'), $this->config->get('config_image_category_height'));
			} else {
				$this->data['thumb'] = '';
			}
									
			$this->data['description'] = html_entity_decode($section_info['description'], ENT_QUOTES, 'UTF-8');
			
			$this->data['newss'] = array();
			
			$data = array(
				'filter_section_id'  => $section_id, 
				'sort'               => 'n.news_id',
				'order'              => 'DESC',
				'start'              => ($page - 1) * $limit,
				'limit'              => $limit
			);
					
			$news_total = $this->model_catalog_news->getTotalNewss($data); 
			
			$results = $this->model_catalog_news->getNewss($data);
			
			foreach ($results as $result) {
				if ($result['image']) {
					$image = $this->model_tool_image->resize($result['image'], $this->config->get('config_image_news_width'), $this->config->get('config_image_news_height'));
				} else {
					$image = false;
				}
					
				$this->data['newss'][] = array(
					'news_id'  => $result['news_id'],
					'thumb'       => $image,
					'title'       => $result['title'],
					'date_added'  => date('d/m/Y' , strtotime($result['date_added'])),
					'description' => mb_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, 400) . '..',
					'href'        => $this->url->link('information/news', 'newspath=' . $this->request->get['newspath'] . '&news_id=' . $result['news_id'])
				);
			}
					
			$pagination = new Pagination();
			$pagination->total = $news_total;
			$pagination->page = $page;
			$pagination->limit = $limit;
			$pagination->text = $this->language->get('text_pagination');
			$pagination->url = $this->url->link('information/section', 'newspath=' . $this->request->get['newspath'] . $url . '&page={page}');
		
			$this->data['pagination'] = $pagination->render();
		
			$this->data['continue'] = $this->url->link('common/home');

			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/information/section.tpl')) {
				$this->template = $this->config->get('config_template') . '/template/information/section.tpl';
			} else {
				$this->template = 'default/template/information/section.tpl';
			}
			
			$this->children = array(
				'common/column_left',
				'common/column_right',
				'common/content_top',
				'common/content_bottom',
				'common/footer',
				'common/header'
			);
				
			$this->response->setOutput($this->render());										
    	} else {
			$url = '';
			
			if (isset($this->request->get['newspath'])) {
				$url .= '&newspath=' . $this->request->get['newspath'];
			}
				
			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}
						
			$this->data['breadcrumbs'][] = array(
				'text'      => $this->language->get('text_error'),
				'href'      => $this->url->link('information/section', $url),
				'separator' => $this->language->get('text_separator')
			);
				
			$this->document->setTitle($this->language->get('text_error'));

      		$this->data['heading_title'] = $this->language->get('text_error');

      		$this->data['text_error'] = $this->language->get('text_error');

      		$this->data['button_continue'] = $this->language->get('button_continue');

      		$this->data['continue'] = $this->url->link('common/home');

			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/error/not_found.tpl')) {
				$this->template = $this->config->get('config_template') . '/template/error/not_found.tpl';
			} else {
				$this->template = 'default/template/error/not_found.tpl';
			}
			
			$this->children = array(
				'common/column_left',
				'common/column_right',
				'common/content_top',
				'common/content_bottom',
				'common/footer',
				'common/header'
			);
					
			$this->response->setOutput($this->render());
		}
  	}
}
?>