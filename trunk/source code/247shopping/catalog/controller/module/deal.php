<?php

class ControllerModuleDeal extends Controller {

    protected function index($setting) {
        $this->language->load('module/deal');

        $this->data['heading_title'] = $this->language->get('heading_title');

        $this->data['text_tax'] = $this->language->get('text_tax');
        $this->data['button_cart'] = $this->language->get('button_cart');
        $this->data['button_wishlist'] = $this->language->get('button_wishlist');
        $this->data['button_compare'] = $this->language->get('button_compare');
        $this->data['button_continue'] = $this->language->get('button_continue');

        $this->load->model('catalog/deal');

        $this->load->model('tool/image');

        $this->data['deals'] = array();

        $data = array(
            'sort' => 'p.date_added',
            'order' => 'DESC',
            'start' => 0,
            'limit' => $setting['limit']
        );

        $this->data['width'] = $setting['image_width'];
        $this->data['height'] = $setting['image_height'];

        $results = $this->model_catalog_deal->getProducts($data);

        foreach ($results as $result) {
            if ($result['image'] && file_exists(DIR_IMAGE . $result['image'])) {
                $image = $this->model_tool_image->resize($result['image'], $setting['image_width'], $setting['image_height']);  
                //$image = HTTP_IMAGE . $result['image'];
            } else {
                $image = $this->model_tool_image->resize('no_image.jpg', 240, 160);
                //$image = HTTP_IMAGE . 'no_image.jpg';
            }

            if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
                $price = $this->currency->format($this->tax->calculate($result['price'], $result['tax_class_id'], $this->config->get('config_tax')));
            } else {
                $price = false;
            }

            if ((float) $result['special']) {
                $special = $this->currency->format($this->tax->calculate($result['special'], $result['tax_class_id'], $this->config->get('config_tax')));
            } else {
                $special = false;
            }

            if ((float) $result['price'] && (float) $result['special']) {
                $sale = round((((float) $result['price'] - (float) $result['special']) / (float) $result['price']) * 100);
                $saving = $this->currency->format($this->tax->calculate((float) $result['price'] - (float) $result['special'], 0, 0));
            } else {
                $sale = false;
                $saving = 0;
            }

            if ($this->config->get('config_tax')) {
                $tax = $this->currency->format((float) $result['special'] ? $result['special'] : $result['price']);
            } else {
                $tax = false;
            }

            if (strtotime($result['date_end']) >= strtotime(date('Y-m-d H:i:s'))) {
                $buy = true;
            } else {
                $buy = false;
            }

            if ($this->config->get('config_review_status')) {
                $rating = $result['rating'];
            } else {
                $rating = false;
            }

            $this->data['deals'][] = array(
                'product_id' => $result['product_id'],
                'thumb' => $image,
                'name' => $result['name'],
                'description' => mb_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, 100) . '..',
                'manufacturer' => $result['manufacturer'],
                'price' => $price,
                'special' => $special,
                'saving' => $saving,
                'sale' => $sale,
                'tax' => $tax,
                'date_end' => date('F d, Y H:i:s', strtotime($result['date_end'])),
                'buy' => $buy,
                'rating' => $rating,
                'reviews' => sprintf($this->language->get('text_reviews'), (int) $result['reviews']),
                'href' => $this->url->link('product/product', 'product_id=' . $result['product_id']),
            );
        }

        if (($setting['position'] == 'content_top') || ($setting['position'] == 'content_bottom')) {
            if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/deal_content.tpl')) {
                $this->template = $this->config->get('config_template') . '/template/module/deal_content.tpl';
            } else {
                $this->template = 'default/template/module/deal_content.tpl';
            }
        } else {
            if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/deal.tpl')) {
                $this->template = $this->config->get('config_template') . '/template/module/deal.tpl';
            } else {
                $this->template = 'default/template/module/deal.tpl';
            }
        }

        $this->render();
    }

}

?>