<?php
namespace App\Interfaces;

interface ProductRatingRepositoryInterface
{

    public function getAll();

    public function getById($id);

    public function updateById($id, $input);

    public function deleteById($id);

    public function save($input);

    public function getReviewById($input);

    public function getApprovedReview($product_id);

    public function getApprovedRating($product_id);

}