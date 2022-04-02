<?php

namespace App\Services\Product;

use App\Facades\Helpers\Geocoder;
use App\Facades\Helpers\ProductPreprocessor;
use App\Repositories\PharmacyRepository;
use App\Repositories\ProductRepository;

class ProductService
{
    public function __construct(
        private ProductRepository $productRepository,
        private PharmacyRepository $pharmacyRepository,
    ) {}

    public function list(array $filters = []) {
        $products   = $this->productRepository->list($filters);
        $processed  = ProductPreprocessor::process($products->getCollection(), $filters['city_id']);
        $products   = $products->setCollection($processed);

        return $products;
    }

    public function search(string $keyword)
    {
        $products   = $this->productRepository->search($keyword);
        $processed  = ProductPreprocessor::process($products->getCollection(), 1);
        $products   = $products->setCollection($processed);

        return $products;
    }

    public function getPickupPharmacies(int $cityId, $lat, $lng, array $products)
    {
        $pharmacies = $this->pharmacyRepository->getBy('city_id', $cityId);
        $pharmacies = $pharmacies->whereNotNull('lat')->whereNotNull('lng');
        $products   = $this->productRepository->getBy('id', $products);
        foreach ($pharmacies as $pharmacy) {
            $pharmacy->distance = Geocoder::distanceBetween($lat, $lng, $pharmacy->lat, $pharmacy->lng);
            $pharmacy->products = ProductPreprocessor::getExistingInPharmacy($products, $pharmacy);
        }
        $pharmacies = $pharmacies->sortBy('distance');

        return $pharmacies->where('distance', '<', 50);
    }

}
