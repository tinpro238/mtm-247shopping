<?php
class ModelCatalogNews extends Model {
	private function AutoFixGoogleSeo(&$data, $news_id = 0){		
    	//huydang1920
		$tempname = "";
    	foreach ($data['news_description'] as $language_id => &$value) {
			$tempname = utf8_to_ascii($value['title']);
			if(!strstr($value['meta_keyword'], $tempname)){
				$value['meta_keyword'] = $tempname . ' , ' . $value['meta_keyword'];				
			}
    	}
    	if(TrimAll($data['keyword']) == ""){
    		$data['keyword'] = getSEOstr($tempname);
    	}		
		else{
			$data['keyword'] = getSEOstr($data['keyword']);
		}
    	$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'news_id=" . (int)$news_id. "'");
		
    	$tempquery = $this->db->query("Select COUNT(*) as total FROM " . DB_PREFIX . "url_alias WHERE keyword = '" . $data['keyword'] . "'")->row['total'];
		while($tempquery > 0){
			$data['keyword'] .= $tempquery;
			$tempquery = $this->db->query("Select COUNT(*) as total FROM " . DB_PREFIX . "url_alias WHERE keyword = '" . $data['keyword'] . "'")->row['total'];
		}
    }
	
	public function addNews($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "news SET status = '" . (int)$data['status'] . "', sort_order = '" . (int)$data['sort_order'] . "', date_added = NOW()");
		
		$news_id = $this->db->getLastId();
		
		$this->AutoFixGoogleSeo($data, $news_id);
		
		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "news SET image = '" . $this->db->escape($data['image']) . "' WHERE news_id = '" . (int)$news_id . "'");
		}
		
		foreach ($data['news_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "news_description SET news_id = '" . (int)$news_id . "', language_id = '" . (int)$language_id . "', title = '" . $this->db->escape($value['title']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', description = '" . $this->db->escape($value['description']) . "'");
		}
		
		if (isset($data['news_store'])) {
			foreach ($data['news_store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "news_to_store SET news_id = '" . (int)$news_id . "', store_id = '" . (int)$store_id . "'");
			}
		}
		
		if (isset($data['news_section'])) {
			foreach ($data['news_section'] as $section_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "news_to_section SET news_id = '" . (int)$news_id . "', section_id = '" . (int)$section_id . "'");
			}
		}
		
		if (isset($data['news_layout'])) {
			foreach ($data['news_layout'] as $store_id => $layout) {
				if ($layout['layout_id']) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "news_to_layout SET news_id = '" . (int)$news_id . "', store_id = '" . (int)$store_id . "', layout_id = '" . (int)$layout['layout_id'] . "'");
				}
			}
		}
		
		foreach ($data['news_tag'] as $language_id => $value) {
			if ($value) {
				$tags = explode(',', $value);
				
				foreach ($tags as $tag) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "news_tag SET news_id = '" . (int)$news_id . "', language_id = '" . (int)$language_id . "', tag = '" . $this->db->escape(trim($tag)) . "'");
				}
			}
		}
						
		if ($data['keyword']) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'news_id=" . (int)$news_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		}
						
		$this->cache->delete('news');
	}
	
	public function editNews($news_id, $data) {
		$this->AutoFixGoogleSeo($data,$news_id);
		
		$this->db->query("UPDATE " . DB_PREFIX . "news SET status = '" . (int)$data['status'] . "', sort_order = '" . (int)$data['sort_order'] . "', date_modified = NOW() WHERE news_id = '" . (int)$news_id . "'");

		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "news SET image = '" . $this->db->escape($data['image']) . "' WHERE news_id = '" . (int)$news_id . "'");
		}
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "news_description WHERE news_id = '" . (int)$news_id . "'");
		
		foreach ($data['news_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "news_description SET news_id = '" . (int)$news_id . "', language_id = '" . (int)$language_id . "', title = '" . $this->db->escape($value['title']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', description = '" . $this->db->escape($value['description']) . "'");
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "news_to_store WHERE news_id = '" . (int)$news_id . "'");

		if (isset($data['news_store'])) {
			foreach ($data['news_store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "news_to_store SET news_id = '" . (int)$news_id . "', store_id = '" . (int)$store_id . "'");
			}
		}
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "news_to_section WHERE news_id = '" . (int)$news_id . "'");
		
		if (isset($data['news_section'])) {
			foreach ($data['news_section'] as $section_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "news_to_section SET news_id = '" . (int)$news_id . "', section_id = '" . (int)$section_id . "'");
			}		
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "news_to_layout WHERE news_id = '" . (int)$news_id . "'");

		if (isset($data['news_layout'])) {
			foreach ($data['news_layout'] as $store_id => $layout) {
				if ($layout['layout_id']) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "news_to_layout SET news_id = '" . (int)$news_id . "', store_id = '" . (int)$store_id . "', layout_id = '" . (int)$layout['layout_id'] . "'");
				}
			}
		}
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "news_tag WHERE news_id = '" . (int)$news_id. "'");
		
		foreach ($data['news_tag'] as $language_id => $value) {
			if ($value) {
				$tags = explode(',', $value);
			
				foreach ($tags as $tag) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "news_tag SET news_id = '" . (int)$news_id . "', language_id = '" . (int)$language_id . "', tag = '" . $this->db->escape(trim($tag)) . "'");
				}
			}
		}
						
		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'news_id=" . (int)$news_id. "'");
		
		if ($data['keyword']) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'news_id=" . (int)$news_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		}
						
		$this->cache->delete('news');
	}
	
	public function copyNews($news_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "news n LEFT JOIN " . DB_PREFIX . "news_description nd ON (n.news_id = nd.news_id) WHERE n.news_id = '" . (int)$news_id . "' AND nd.language_id = '" . (int)$this->config->get('config_language_id') . "'");
		
		if ($query->num_rows) {
			$data = array();
			
			$data = $query->row;
			
			$data['keyword'] = '';

			$data['status'] = '0';
						
			$data = array_merge($data, array('news_description' => $this->getNewsDescriptions($news_id)));
			
			$data = array_merge($data, array('news_tag' => $this->getNewsTags($news_id)));
			$data = array_merge($data, array('news_section' => $this->getNewsSections($news_id)));
			$data = array_merge($data, array('news_layout' => $this->getNewsLayouts($news_id)));
			$data = array_merge($data, array('news_store' => $this->getNewsStores($news_id)));
			
			$this->addNews($data);
		}
	}
	
	public function deleteNews($news_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "news WHERE news_id = '" . (int)$news_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "news_description WHERE news_id = '" . (int)$news_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "news_tag WHERE news_id='" . (int)$news_id. "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "news_to_section WHERE news_id = '" . (int)$news_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "news_to_layout WHERE news_id = '" . (int)$news_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "news_to_store WHERE news_id = '" . (int)$news_id . "'");
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'news_id=" . (int)$news_id. "'");
		
		$this->cache->delete('news');
	}
	
	public function getNews($news_id) {
		$query = $this->db->query("SELECT DISTINCT *, (SELECT keyword FROM " . DB_PREFIX . "url_alias WHERE query = 'news_id=" . (int)$news_id . "') AS keyword FROM " . DB_PREFIX . "news n LEFT JOIN " . DB_PREFIX . "news_description nd ON (n.news_id = nd.news_id) WHERE n.news_id = '" . (int)$news_id . "' AND nd.language_id = '" . (int)$this->config->get('config_language_id') . "'");
				
		return $query->row;
	}
	
	public function getNewss($data = array()) {
		if ($data) {
			$sql = "SELECT * FROM " . DB_PREFIX . "news n LEFT JOIN " . DB_PREFIX . "news_description nd ON (n.news_id = nd.news_id)";
			
			if (!empty($data['filter_section_id'])) {
				$sql .= " LEFT JOIN " . DB_PREFIX . "news_to_section n2s ON (n.news_id = n2s.news_id)";			
			}
					
			$sql .= " WHERE nd.language_id = '" . (int)$this->config->get('config_language_id') . "'"; 
			
			if (!empty($data['filter_title'])) {
				$sql .= " AND LCASE(nd.title) LIKE '" . $this->db->escape(utf8_strtolower($data['filter_title'])) . "%'";
			}
			
			if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
				$sql .= " AND n.status = '" . (int)$data['filter_status'] . "'";
			}
					
			if (!empty($data['filter_section_id'])) {
				if (!empty($data['filter_sub_section'])) {
					$implode_data = array();
					
					$implode_data[] = "section_id = '" . (int)$data['filter_section_id'] . "'";
					
					$this->load->model('catalog/section');
					
					$sections = $this->model_catalog_section->getSections($data['filter_section_id']);
					
					foreach ($sections as $section) {
						$implode_data[] = "n2s.section_id = '" . (int)$section['section_id'] . "'";
					}
					
					$sql .= " AND (" . implode(' OR ', $implode_data) . ")";			
				} else {
					$sql .= " AND n2s.section_id = '" . (int)$data['filter_section_id'] . "'";
				}
			}
			
			$sql .= " GROUP BY n.news_id";
						
			$sort_data = array(
				'n.news_id',
				'nd.title',
				'n.status',
				'n.sort_order'
			);	
			
			if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
				$sql .= " ORDER BY " . $data['sort'];	
			} else {
				$sql .= " ORDER BY n.news_id";	
			}
			
			if (isset($data['order']) && ($data['order'] == 'ASC')) {
				$sql .= " ASC";
			} else {
				$sql .= " DESC";
			}
		
			if (isset($data['start']) || isset($data['limit'])) {
				if ($data['start'] < 0) {
					$data['start'] = 0;
				}				

				if ($data['limit'] < 1) {
					$data['limit'] = 20;
				}	
			
				$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
			}	
			
			$query = $this->db->query($sql);
		
			return $query->rows;
		} else {
			$news_data = $this->cache->get('news.' . (int)$this->config->get('config_language_id'));
		
			if (!$news_data) {
				$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "news n LEFT JOIN " . DB_PREFIX . "news_description nd ON (n.news_id = nd.news_id) WHERE nd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY nd.title ASC");
	
				$news_data = $query->rows;
			
				$this->cache->set('news.' . (int)$this->config->get('config_language_id'), $news_data);
			}	
	
			return $news_data;
		}
	}
	
	public function getNewssBySectionId($section_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "news n LEFT JOIN " . DB_PREFIX . "news_description nd ON (n.news_id = nd.news_id) LEFT JOIN " . DB_PREFIX . "news_to_section n2s ON (n.news_id = n2s.news_id) WHERE nd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND n2s.section_id = '" . (int)$section_id . "' ORDER BY nd.title ASC");
								  
		return $query->rows;
	} 
	
	public function getNewsDescriptions($news_id) {
		$news_description_data = array();
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "news_description WHERE news_id = '" . (int)$news_id . "'");
		
		foreach ($query->rows as $result) {
			$news_description_data[$result['language_id']] = array(
				'title'             => $result['title'],
				'description'      => $result['description'],
				'meta_keyword'     => $result['meta_keyword'],
				'meta_description' => $result['meta_description']
			);
		}
		
		return $news_description_data;
	}

	public function getNewsStores($news_id) {
		$news_store_data = array();
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "news_to_store WHERE news_id = '" . (int)$news_id . "'");

		foreach ($query->rows as $result) {
			$news_store_data[] = $result['store_id'];
		}
		
		return $news_store_data;
	}

	public function getNewsLayouts($news_id) {
		$news_layout_data = array();
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "news_to_layout WHERE news_id = '" . (int)$news_id . "'");
		
		foreach ($query->rows as $result) {
			$news_layout_data[$result['store_id']] = $result['layout_id'];
		}
		
		return $news_layout_data;
	}
		
	public function getNewsSections($news_id) {
		$news_section_data = array();
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "news_to_section WHERE news_id = '" . (int)$news_id . "'");
		
		foreach ($query->rows as $result) {
			$news_section_data[] = $result['section_id'];
		}

		return $news_section_data;
	}

	public function getNewsTags($news_id) {
		$news_tag_data = array();
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "news_tag WHERE news_id = '" . (int)$news_id . "'");
		
		$tag_data = array();
		
		foreach ($query->rows as $result) {
			$tag_data[$result['language_id']][] = $result['tag'];
		}
		
		foreach ($tag_data as $language => $tags) {
			$news_tag_data[$language] = implode(',', $tags);
		}
		
		return $news_tag_data;
	}
	
	public function getTotalNewss($data = array()) {
		$sql = "SELECT COUNT(DISTINCT n.news_id) AS total FROM " . DB_PREFIX . "news n LEFT JOIN " . DB_PREFIX . "news_description nd ON (n.news_id = nd.news_id)";

		if (!empty($data['filter_section_id'])) {
			$sql .= " LEFT JOIN " . DB_PREFIX . "news_to_section n2s ON (n.news_id = n2s.news_id)";			
		}
		 
		$sql .= " WHERE nd.language_id = '" . (int)$this->config->get('config_language_id') . "'";
		 			
		if (!empty($data['filter_title'])) {
			$sql .= " AND LCASE(nd.title) LIKE '" . $this->db->escape(utf8_strtolower($data['filter_title'])) . "%'";
		}
		
		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$sql .= " AND n.status = '" . (int)$data['filter_status'] . "'";
		}

		if (!empty($data['filter_section_id'])) {
			if (!empty($data['filter_sub_section'])) {
				$implode_data = array();
				
				$implode_data[] = "n2s.section_id = '" . (int)$data['filter_section_id'] . "'";
				
				$this->load->model('catalog/section');
				
				$sections = $this->model_catalog_section->getSections($data['filter_section_id']);
				
				foreach ($sections as $section) {
					$implode_data[] = "n2s.section_id = '" . (int)$section['section_id'] . "'";
				}
				
				$sql .= " AND (" . implode(' OR ', $implode_data) . ")";			
			} else {
				$sql .= " AND n2s.section_id = '" . (int)$data['filter_section_id'] . "'";
			}
		}
		
		$query = $this->db->query($sql);
		
		return $query->row['total'];
	}
	
	public function getTotalNewssByLayoutId($layout_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "news_to_layout WHERE layout_id = '" . (int)$layout_id . "'");

		return $query->row['total'];
	}			
}
?>