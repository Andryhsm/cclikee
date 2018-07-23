<?php

namespace App\Interfaces;


interface BlogPostInterface
{

	public function getAll();

	public function save($input);

	public function updateByUpdate($blog_post_id, $input);

	public function deleteById($blog_post_id);

	public function getById($blog_post_id);

	public function getAllPostWithPagination($param=null);

	public function byIdWithDetail($blog_post_id);

	public function getPopularPost();

	public function getHomePagePost();
}