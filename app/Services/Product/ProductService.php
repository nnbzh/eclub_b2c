<?php

namespace App\Services\Product;

use App\Repositories\PharmacyRepository;
use App\Repositories\ProductRepository;

class ProductService
{
    public function __construct(
        private ProductRepository $productRepository,
        private PharmacyRepository $pharmacyRepository,
    ) {}

    public function list(array $filters = []) {
        $products   = $this->productRepository->list($filters, [
            'image',
            'brand',
            'category',
            'ratings'
        ]);
        $processed  = \ProductPreprocessor::process($products->getCollection(), $filters['city_id']);
        $products   = $products->setCollection($processed);

        return $products;
    }

    public function search(string $keyword, int $cityId)
    {
        $products   = $this->productRepository->search($keyword);
        $processed  = \ProductPreprocessor::process($products->getCollection(), $cityId);
        $products   = $products->setCollection($processed);

        return $products;
    }

    public function getPickupPharmacies(int $cityId, $lat, $lng, array $products)
    {
        $pharmacies = $this->pharmacyRepository->getBy('city_id', $cityId);
        $pharmacies = $pharmacies->whereNotNull('lat')->whereNotNull('lng');
        $products   = $this->productRepository->getBy('id', $products);
        foreach ($pharmacies as $pharmacy) {
            $availableProducts          = \ProductPreprocessor::getExistingInPharmacy($products, $pharmacy);
            $pharmacy->distance         = \Geocoder::distanceBetween($lat, $lng, $pharmacy->lat, $pharmacy->lng);
            $pharmacy->products         = $this->mapWithAvailableProducts($products, $availableProducts);
            $pharmacy->ratio            = count($availableProducts) . "/" . count($products);
        }
        $pharmacies = $pharmacies->sortBy('distance');

        return $pharmacies->where('distance', '<', 50);
    }

    private function mapWithAvailableProducts($products, $availableProducts) {
        $products = $products->whereNotIn('id', $availableProducts->pluck('id'));

        return $availableProducts->merge($products);
    }

}
