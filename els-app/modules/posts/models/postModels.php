<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PostModels extends CI_Model{

	/*
	| Get All Post Lists
	*/
	public function postsList()
	{

		$query = $this->db->get('ep_posts');
		return $query->result();
	}

	/*
	| Post permalink check
	*/
	public function permalinkCkh($permalink)
	{
		$args = array(
			'post_permalink'  =>  $permalink,
		);
		$query = $this->db->get_where('ep_posts', $args);
		return $query->num_rows();
	}

	/*
	| Category history
	*/
	public function getPostCatHistory()
	{
		$query = $this->db->get('ep_post_category');
		return $query->result();
	}

	/*
	| Tag history
	*/
	public function getPostTagHistory()
	{
		$query = $this->db->get('ep_post_tag');
		return $query->result();
	}

	/*
	| Submit new post
	*/
	public function submitPost()
	{
		$catSet = $this->input->post('postCategory[]', TRUE);
		$tagSet = $this->input->post('postTag[]', TRUE);
		$pStatus = $this->input->post('postStatus', TRUE);
		$pStatus = ( $pStatus == 1 ) ? "publish" : "disable";
		$pParent = $this->input->post('postParent', TRUE);
		$pParent = ( $pParent == -1 ) ? 0 : $pParent;
		//$tag = implode(',', $tagSet);
		$cat = $this->CatTagFilter($catSet, 'ep_post_category', 'cat_permalink');
		$tag = $this->CatTagFilter($tagSet, 'ep_post_tag', 'tag_permalink');

		$attr = array(
			'post_title'		=> $this->input->post('postTitle', TRUE),
			'post_permalink'  	=> $this->input->post('postPermalink', TRUE),
			'post_content'  	=> $this->input->post('postDescription', TRUE),
			'post_excerpt'  	=> $this->input->post('postExcerpt', TRUE),
			'post_categories'  	=> $cat,
			'post_tag'  		=> $tag,
			'post_status'  		=> $pStatus,
			'post_parent'  		=> $pParent,
			'menu_order'  		=> $this->input->post('postOrder', TRUE),
			'post_modified'  	=> $this->input->post('postDate', TRUE),
			'post_author' 		=> $this->session->userdata('user_name'),
		);

		try {
			return $this->db->insert('ep_posts', $attr);
		} catch (Exception $e) {
			return false;
		}

	}

	/*
	| Cat and tag filter
	*/
	private function CatTagFilter($items, $table, $select)
	{
		if( !empty($items) )
		{
			$this->db->select($select);
			$this->db->where_in('ID', $items);
			$catQuery = $this->db->get($table);
			$results = $catQuery->result();
			$data = array();
			foreach ($results as $key => $result) {
				array_push($data, $result->$select);
			}

			$results = implode(',', $data);

			return $results;
		}
		else{	
			return '';
		}
	}



}