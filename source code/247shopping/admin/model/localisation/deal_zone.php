<?php
class ModelLocalisationDealZone extends Model {
	
	private function AutoFixGoogleSeo(&$data, $zone_id = 0){		
    	//huydang1920
		$tempname = "";
    	
		$tempname = utf8_to_ascii($data['name']);
		if(!strstr($data['meta_keyword'], $tempname)){
			$data['meta_keyword'] = $tempname . ' , ' . $data['meta_keyword'];				
		}
    	
    	if(TrimAll($data['keyword']) == ""){
    		$data['keyword'] = getSEOstr($tempname);
    	}		
		else{
			$data['keyword'] = getSEOstr($data['keyword']);
		}
    	$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'zone_id=" . (int)$zone_id. "'");
		
    	$tempquery = $this->db->query("Select COUNT(*) as total FROM " . DB_PREFIX . "url_alias WHERE keyword = '" . $data['keyword'] . "'")->row['total'];
		while($tempquery > 0){
			$data['keyword'] .= $tempquery;
			$tempquery = $this->db->query("Select COUNT(*) as total FROM " . DB_PREFIX . "url_alias WHERE keyword = '" . $data['keyword'] . "'")->row['total'];
		}
    }	
	
	public function addDealZone($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "deal_zone SET status = '" . (int)$data['status'] . "', sort_order = '" . (int)$data['sort_order'] . "', name = '" . $this->db->escape($data['name']) . "', meta_description = '" . $this->db->escape($data['meta_description']) . "', meta_keyword = '" . $this->db->escape($data['meta_keyword']) . "', code = '" . $this->db->escape($data['code']) . "', country_id = '" . (int)$data['country_id'] . "'");
		
		$zone_id = $this->db->getLastId();
		
		$this->AutoFixGoogleSeo($data, $zone_id);
		
		if ($data['keyword']) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'zone_id=" . (int)$zone_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		}
			
		$this->cache->delete('deal_zone');
	}
	
	public function editDealZone($zone_id, $data) {
		$this->AutoFixGoogleSeo($data, $zone_id);
		$this->db->query("UPDATE " . DB_PREFIX . "deal_zone SET status = '" . (int)$data['status'] . "', sort_order = '" . (int)$data['sort_order'] . "', name = '" . $this->db->escape($data['name']) . "', meta_description = '" . $this->db->escape($data['meta_description']) . "', meta_keyword = '" . $this->db->escape($data['meta_keyword']) . "', code = '" . $this->db->escape($data['code']) . "', country_id = '" . (int)$data['country_id'] . "' WHERE zone_id = '" . (int)$zone_id . "'");

		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'zone_id=" . (int)$zone_id. "'");
		
		if ($data['keyword']) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'zone_id=" . (int)$zone_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		}
		
		$this->cache->delete('deal_zone');
	}
	
	public function deleteDealZone($zone_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "deal_zone WHERE zone_id = '" . (int)$zone_id . "'");

		$this->cache->delete('deal_zone');	
	}
	
	public function getDealZone($zone_id) {
		$query = $this->db->query("SELECT DISTINCT *, (SELECT keyword FROM " . DB_PREFIX . "url_alias WHERE query = 'zone_id=" . (int)$zone_id . "') AS keyword FROM " . DB_PREFIX . "deal_zone WHERE zone_id = '" . (int)$zone_id . "'");
		
		return $query->row;
	}
	
	public function getDealZones($data = array()) {
		$sql = "SELECT *, z.status, z.name, c.name AS country FROM " . DB_PREFIX . "deal_zone z LEFT JOIN " . DB_PREFIX . "country c ON (z.country_id = c.country_id)";
			
		$sort_data = array(
			'c.name',
			'z.name',
			'z.sort_order',
			'z.status',
			'z.code'
		);	
			
		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];	
		} else {
			$sql .= " ORDER BY c.name";	
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
	
	public function getDealZonesByCountryId($country_id) {
		$zone_data = $this->cache->get('deal_zone.' . (int)$country_id);
	
		if (!$zone_data) {
			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "deal_zone WHERE country_id = '" . (int)$country_id . "' ORDER BY name");
	
			$zone_data = $query->rows;
			
			$this->cache->set('deal_zone.' . (int)$country_id, $zone_data);
		}
	
		return $zone_data;
	}
	
	public function getTotalDealZones() {
      	$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "deal_zone");
		
		return $query->row['total'];
	}
				
	public function getTotalDealZonesByCountryId($country_id) {
		$query = $this->db->query("SELECT count(*) AS total FROM " . DB_PREFIX . "deal_zone WHERE country_id = '" . (int)$country_id . "'");
	
		return $query->row['total'];
	}
}
?>