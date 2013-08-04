<?php  
class ControllerInformationNews extends Controller {
	private $error = array(); 
	
	public function index() { 
		$this->language->load('information/news');
	
		$this->data['breadcrumbs'] = array();

		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home'),			
			'separator' => false
		);
		
		$this->load->model('catalog/section');	
		
		if (isset($this->request->get['newspath'])) {
			$newspath = '';
				
			foreach (explode('_', $this->request->get['newspath']) as $newspath_id) {
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
		}
		
		if (isset($this->request->get['filter_title']) || isset($this->request->get['filter_tag'])) {
			$url = '';
			
			if (isset($this->request->get['filter_title'])) {
				$url .= '&filter_title=' . $this->request->get['filter_title'];
			}
						
			if (isset($this->request->get['filter_tag'])) {
				$url .= '&filter_tag=' . $this->request->get['filter_tag'];
			}
						
			if (isset($this->request->get['filter_description'])) {
				$url .= '&filter_description=' . $this->request->get['filter_description'];
			}
			
			if (isset($this->request->get['filter_section_id'])) {
				$url .= '&filter_section_id=' . $this->request->get['filter_section_id'];
			}	
						
			$this->data['breadcrumbs'][] = array(
				'text'      => $this->language->get('text_search'),
				'href'      => $this->url->link('news/search', $url),
				'separator' => $this->language->get('text_separator')
			);	
		}
		
		if (isset($this->request->get['news_id'])) {
			$news_id = $this->request->get['news_id'];
		} else {
			$news_id = 0;
		}
		
		$this->load->model('catalog/news');
		
		$news_info = $this->model_catalog_news->getNews($news_id);
		
		$this->data['news_info'] = $news_info;
		
		if ($news_info) {
			$url = '';
			
			if (isset($this->request->get['newspath'])) {
				$url .= '&newspath=' . $this->request->get['newspath'];
			}

			if (isset($this->request->get['filter_title'])) {
				$url .= '&filter_title=' . $this->request->get['filter_title'];
			}
						
			if (isset($this->request->get['filter_tag'])) {
				$url .= '&filter_tag=' . $this->request->get['filter_tag'];
			}
			
			if (isset($this->request->get['filter_description'])) {
				$url .= '&filter_description=' . $this->request->get['filter_description'];
			}	
						
			if (isset($this->request->get['filter_section_id'])) {
				$url .= '&filter_section_id=' . $this->request->get['filter_section_id'];
			}
												
			$this->data['breadcrumbs'][] = array(
				'text'      => $news_info['title'],
				'href'      => $this->url->link('information/news', $url . '&news_id=' . $this->request->get['news_id']),
				'separator' => $this->language->get('text_separator')
			);			
			
			$this->document->setTitle($news_info['title']);
			$this->document->setDescription($news_info['meta_description']);
			$this->document->setKeywords($news_info['meta_keyword']);
			$this->document->addLink($this->url->link('information/news', 'news_id=' . $this->request->get['news_id']), 'canonical');
			
			$this->data['href'] = $this->url->link('information/news', 'news_id=' . $this->request->get['news_id']);
			
			$this->data['heading_title'] = $news_info['title'];
			
			$this->data['text_write'] = $this->language->get('text_write');
			$this->data['text_note'] = $this->language->get('text_note');
			$this->data['text_share'] = $this->language->get('text_share');
			$this->data['text_wait'] = $this->language->get('text_wait');
			$this->data['text_tags'] = $this->language->get('text_tags');
			
			$this->data['entry_name'] = $this->language->get('entry_name');
			$this->data['entry_review'] = $this->language->get('entry_review');
			$this->data['entry_rating'] = $this->language->get('entry_rating');
			$this->data['entry_good'] = $this->language->get('entry_good');
			$this->data['entry_bad'] = $this->language->get('entry_bad');
			$this->data['entry_captcha'] = $this->language->get('entry_captcha');
			
			
			$this->data['button_continue'] = $this->language->get('button_continue');
			
			$this->load->model('catalog/news_review');
			
			$this->data['news_id'] = $this->request->get['news_id'];
			
			$this->data['review_status'] = $this->config->get('config_review_status');
			$this->data['reviews'] = sprintf($this->language->get('text_reviews'), (int)$news_info['reviews']);
			$this->data['rating'] = (int)$news_info['rating'];
			
			$this->load->model('tool/image');
			
			if ($news_info['image']) {
				$this->data['thumb'] = $this->model_tool_image->resize($news_info['image'], $this->config->get('config_image_news_width'), $this->config->get('config_image_news_height'));
			} else {
				$this->data['thumb'] = '';
			}
			
			$this->data['description'] = html_entity_decode($news_info['description'], ENT_QUOTES, 'UTF-8');
	
			
			$this->data['tags'] = array();
					
			$results = $this->model_catalog_news->getNewsTags($this->request->get['news_id']);
			
			foreach ($results as $result) {
				$this->data['tags'][] = array(
					'tag'  => $result['tag'],
					'href' => '#'//$this->url->link('news/search', 'filter_tag=' . $result['tag'])
				);
			}
			
			$this->model_catalog_news->updateViewed($this->request->get['news_id']);
			
			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/information/news.tpl')) {
				$this->template = $this->config->get('config_template') . '/template/information/news.tpl';
			} else {
				$this->template = 'default/template/information/news.tpl';
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
			
			if (isset($this->request->get['filter_title'])) {
				$url .= '&filter_title=' . $this->request->get['filter_title'];
			}	
					
			if (isset($this->request->get['filter_tag'])) {
				$url .= '&filter_tag=' . $this->request->get['filter_tag'];
			}
							
			if (isset($this->request->get['filter_description'])) {
				$url .= '&filter_description=' . $this->request->get['filter_description'];
			}
					
			if (isset($this->request->get['filter_section_id'])) {
				$url .= '&filter_section_id=' . $this->request->get['filter_section_id'];
			}
								
      		$this->data['breadcrumbs'][] = array(
        		'text'      => $this->language->get('text_error'),
				'href'      => $this->url->link('information/news', $url . '&news_id=' . $news_id),
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
	
	public function review() {
    	$this->language->load('information/news');
		
		$this->load->model('catalog/news_review');

		$this->data['text_no_reviews'] = $this->language->get('text_no_reviews');

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}  
		
		$this->data['reviews'] = array();
		
		$review_total = $this->model_catalog_news_review->getTotalNewsReviewsByNewsId($this->request->get['news_id']);
			
		$results = $this->model_catalog_news_review->getNewsReviewsByNewsId($this->request->get['news_id'], ($page - 1) * 5, 5);
      		
		foreach ($results as $result) {
        	$this->data['reviews'][] = array(
        		'author'     => $result['author'],
				'text'       => strip_tags($result['text']),
				'rating'     => (int)$result['rating'],
        		'reviews'    => sprintf($this->language->get('text_reviews'), (int)$review_total),
        		'date_added' => date($this->language->get('date_format_short'), strtotime($result['date_added']))
        	);
      	}			
			
		$pagination = new Pagination();
		$pagination->total = $review_total;
		$pagination->page = $page;
		$pagination->limit = 5; 
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = $this->url->link('information/news/review', 'news_id=' . $this->request->get['news_id'] . '&page={page}');
			
		$this->data['pagination'] = $pagination->render();
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/information/news_review.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/information/news_review.tpl';
		} else {
			$this->template = 'default/template/information/news_review.tpl';
		}
		
		$this->response->setOutput($this->render());
	}
	
	public function write() {
		$this->language->load('information/news');
		
		$this->load->model('catalog/news_review');
		
		$json = array();
		
		if ((utf8_strlen($this->request->post['name']) < 3) || (utf8_strlen($this->request->post['name']) > 25)) {
			$json['error'] = $this->language->get('error_name');
		}
		
		if ((utf8_strlen($this->request->post['text']) < 25) || (utf8_strlen($this->request->post['text']) > 1000)) {
			$json['error'] = $this->language->get('error_text');
		}

		if (!$this->request->post['rating']) {
			$json['error'] = $this->language->get('error_rating');
		}

		if (!isset($this->session->data['captcha']) || ($this->session->data['captcha'] != $this->request->post['captcha'])) {
			$json['error'] = $this->language->get('error_captcha');
		}
				
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && !isset($json['error'])) {
			$this->model_catalog_news_review->addNewsReview($this->request->get['news_id'], $this->request->post);
			
			$json['success'] = $this->language->get('text_success');
		}
		
		$this->response->setOutput(json_encode($json));
	}
	
	public function captcha() {
		$this->load->library('captcha');
		
		$captcha = new Captcha();
		
		$this->session->data['captcha'] = $captcha->getCode();
		
		$captcha->showImage();
	}
}
?>