<?php
class ModelCatalogNewsReview extends Model {
	public function addNewsReview($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "news_review SET author = '" . $this->db->escape($data['author']) . "', news_id = '" . $this->db->escape($data['news_id']) . "', text = '" . $this->db->escape(strip_tags($data['text'])) . "', rating = '" . (int)$data['rating'] . "', status = '" . (int)$data['status'] . "', date_added = NOW()");
	}
	
	public function editNewsReview($news_review_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "news_review SET author = '" . $this->db->escape($data['author']) . "', news_id = '" . $this->db->escape($data['news_id']) . "', text = '" . $this->db->escape(strip_tags($data['text'])) . "', rating = '" . (int)$data['rating'] . "', status = '" . (int)$data['status'] . "', date_added = NOW() WHERE news_review_id = '" . (int)$news_review_id . "'");
	}
	
	public function deleteNewsReview($news_review_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "news_review WHERE news_review_id = '" . (int)$news_review_id . "'");
	}
	
	public function getNewsReview($news_review_id) {
		$query = $this->db->query("SELECT DISTINCT *, (SELECT nd.title FROM " . DB_PREFIX . "news_description nd WHERE nd.news_id = r.news_id AND nd.language_id = '" . (int)$this->config->get('config_language_id') . "') AS news FROM " . DB_PREFIX . "news_review r WHERE r.news_review_id = '" . (int)$news_review_id . "'");
		
		return $query->row;
	}

	public function getNewsReviews($data = array()) {
		$sql = "SELECT r.news_review_id, nd.title, r.author, r.rating, r.status, r.date_added FROM " . DB_PREFIX . "news_review r LEFT JOIN " . DB_PREFIX . "news_description nd ON (r.news_id = nd.news_id) WHERE nd.language_id = '" . (int)$this->config->get('config_language_id') . "'";																																					  
		
		$sort_data = array(
			'nd.title',
			'r.author',
			'r.rating',
			'r.status',
			'r.date_added'
		);	
			
		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];	
		} else {
			$sql .= " ORDER BY r.date_added";	
		}
			
		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
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
	}
	
	public function getTotalNewsReviews() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "news_review");
		
		return $query->row['total'];
	}
	
	public function getTotalNewsReviewsAwaitingApproval() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "news_review WHERE status = '0'");
		
		return $query->row['total'];
	}	
}
?>