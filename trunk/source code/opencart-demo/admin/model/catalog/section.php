<?php
class ModelCatalogSection extends Model {
	public function addSection($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "section SET parent_id = '" . (int)$data['parent_id'] . "', `top` = '" . (isset($data['top']) ? (int)$data['top'] : 0) . "', `column` = '" . (int)$data['column'] . "', sort_order = '" . (int)$data['sort_order'] . "', status = '" . (int)$data['status'] . "', date_modified = NOW(), date_added = NOW()");
	
		$section_id = $this->db->getLastId();
		
		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "section SET image = '" . $this->db->escape($data['image']) . "' WHERE section_id = '" . (int)$section_id . "'");
		}
		
		foreach ($data['section_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "section_description SET section_id = '" . (int)$section_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', description = '" . $this->db->escape($value['description']) . "'");
		}
		
		if (isset($data['section_store'])) {
			foreach ($data['section_store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "section_to_store SET section_id = '" . (int)$section_id . "', store_id = '" . (int)$store_id . "'");
			}
		}

		if (isset($data['section_layout'])) {
			foreach ($data['section_layout'] as $store_id => $layout) {
				if ($layout['layout_id']) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "section_to_layout SET section_id = '" . (int)$section_id . "', store_id = '" . (int)$store_id . "', layout_id = '" . (int)$layout['layout_id'] . "'");
				}
			}
		}
						
		if ($data['keyword']) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'section_id=" . (int)$section_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		}
		
		$this->cache->delete('section');
	}
	
	public function editSection($section_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "section SET parent_id = '" . (int)$data['parent_id'] . "', `top` = '" . (isset($data['top']) ? (int)$data['top'] : 0) . "', `column` = '" . (int)$data['column'] . "', sort_order = '" . (int)$data['sort_order'] . "', status = '" . (int)$data['status'] . "', date_modified = NOW() WHERE section_id = '" . (int)$section_id . "'");

		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "section SET image = '" . $this->db->escape($data['image']) . "' WHERE section_id = '" . (int)$section_id . "'");
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "section_description WHERE section_id = '" . (int)$section_id . "'");

		foreach ($data['section_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "section_description SET section_id = '" . (int)$section_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', description = '" . $this->db->escape($value['description']) . "'");
		}
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "section_to_store WHERE section_id = '" . (int)$section_id . "'");
		
		if (isset($data['section_store'])) {		
			foreach ($data['section_store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "section_to_store SET section_id = '" . (int)$section_id . "', store_id = '" . (int)$store_id . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "section_to_layout WHERE section_id = '" . (int)$section_id . "'");

		if (isset($data['section_layout'])) {
			foreach ($data['section_layout'] as $store_id => $layout) {
				if ($layout['layout_id']) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "section_to_layout SET section_id = '" . (int)$section_id . "', store_id = '" . (int)$store_id . "', layout_id = '" . (int)$layout['layout_id'] . "'");
				}
			}
		}
						
		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'section_id=" . (int)$section_id. "'");
		
		if ($data['keyword']) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'section_id=" . (int)$section_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		}
		
		$this->cache->delete('section');
	}
	
	public function deleteSection($section_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "section WHERE section_id = '" . (int)$section_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "section_description WHERE section_id = '" . (int)$section_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "section_to_store WHERE section_id = '" . (int)$section_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "section_to_layout WHERE section_id = '" . (int)$section_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'section_id=" . (int)$section_id . "'");
		
		$query = $this->db->query("SELECT section_id FROM " . DB_PREFIX . "section WHERE parent_id = '" . (int)$section_id . "'");

		foreach ($query->rows as $result) {
			$this->deleteSection($result['section_id']);
		}
		
		$this->cache->delete('section');
	} 

	public function getSection($section_id) {
		$query = $this->db->query("SELECT DISTINCT *, (SELECT keyword FROM " . DB_PREFIX . "url_alias WHERE query = 'section_id=" . (int)$section_id . "') AS keyword FROM " . DB_PREFIX . "section WHERE section_id = '" . (int)$section_id . "'");
		
		return $query->row;
	} 
	
	public function getSections($parent_id = 0) {
		$section_data = $this->cache->get('section.' . (int)$this->config->get('config_language_id') . '.' . (int)$parent_id);
	
		if (!$section_data) {
			$section_data = array();
		
			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "section s LEFT JOIN " . DB_PREFIX . "section_description sd ON (s.section_id = sd.section_id) WHERE s.parent_id = '" . (int)$parent_id . "' AND sd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY s.sort_order, sd.name ASC");
		
			foreach ($query->rows as $result) {
				$section_data[] = array(
					'section_id' => $result['section_id'],
					'name'        => $this->getPath($result['section_id'], $this->config->get('config_language_id')),
					'status'  	  => $result['status'],
					'sort_order'  => $result['sort_order']
				);
			
				$section_data = array_merge($section_data, $this->getSections($result['section_id']));
			}	
	
			$this->cache->set('section.' . (int)$this->config->get('config_language_id') . '.' . (int)$parent_id, $section_data);
		}
		
		return $section_data;
	}
	
	public function getPath($section_id) {
		$query = $this->db->query("SELECT name, parent_id FROM " . DB_PREFIX . "section s LEFT JOIN " . DB_PREFIX . "section_description sd ON (s.section_id = sd.section_id) WHERE s.section_id = '" . (int)$section_id . "' AND sd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY s.sort_order, sd.name ASC");
		
		if ($query->row['parent_id']) {
			return $this->getPath($query->row['parent_id'], $this->config->get('config_language_id')) . $this->language->get('text_separator') . $query->row['name'];
		} else {
			return $query->row['name'];
		}
	}
	
	public function getSectionDescriptions($section_id) {
		$section_description_data = array();
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "section_description WHERE section_id = '" . (int)$section_id . "'");
		
		foreach ($query->rows as $result) {
			$section_description_data[$result['language_id']] = array(
				'name'             => $result['name'],
				'meta_keyword'     => $result['meta_keyword'],
				'meta_description' => $result['meta_description'],
				'description'      => $result['description']
			);
		}
		
		return $section_description_data;
	}	
	
	public function getSectionStores($section_id) {
		$section_store_data = array();
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "section_to_store WHERE section_id = '" . (int)$section_id . "'");

		foreach ($query->rows as $result) {
			$section_store_data[] = $result['store_id'];
		}
		
		return $section_store_data;
	}

	public function getSectionLayouts($section_id) {
		$section_layout_data = array();
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "section_to_layout WHERE section_id = '" . (int)$section_id . "'");
		
		foreach ($query->rows as $result) {
			$section_layout_data[$result['store_id']] = $result['layout_id'];
		}
		
		return $section_layout_data;
	}
		
	public function getTotalSections() {
      	$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "section");
		
		return $query->row['total'];
	}	
		
	public function getTotalSectionsByImageId($image_id) {
      	$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "section WHERE image_id = '" . (int)$image_id . "'");
		
		return $query->row['total'];
	}

	public function getTotalSectionsByLayoutId($layout_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "section_to_layout WHERE layout_id = '" . (int)$layout_id . "'");

		return $query->row['total'];
	}		
}
?>