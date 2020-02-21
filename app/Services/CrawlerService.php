<?php

namespace App\Services;

use Goutte\Client;

/**
 * Class CrawlerService
 * @package App\Services
 */
class CrawlerService
{
    /**
     * @var string
     */
    private $crawlerUrl = 'https://seminovos.com.br/';

    /**
     * @var array
     */
    private $responseArray = [];

    /**
     * @var \Symfony\Component\DomCrawler\Crawler
     */
    private $crawler;

    /**
     * @var array
     */
    private $availableFilters = [
        'marca'     => '%s/',
        'modelo'    => '%s/',
        'ano_min'    => 'ano-%s',
        'ano_max'    => '-%s/',
        'preco_min'  => 'preco-%s',
        'preco_max'  => '-%s/',
        'km_min'     => 'km-%s',
        'km_max'     => '-%s/',
        'page'      => '?page=%s'
    ];

    /**
     * CrawlerService constructor.
     * @param array $filters
     */
    public function __construct(array $filters = [])
    {
        $this->setFilters($filters);
    }

    /**
     * Set Filters.
     * @param string $crawlerUrl
     */
    private function createClient(string $crawlerUrl)
    {
        $client = new Client();
        $this->crawler = $client->request('GET', $crawlerUrl);
    }

    /**
     * Get all cars from page.
     * @return array
     */
    public function getCars(): array
    {
        $this->createClient($this->crawlerUrl . 'carro');

        $this->crawler->filter('.list-of-cards .item')->each(function ($node) {
            $this->responseArray[] = [
                'title'     => $node->filter('.card-title')->text(),
                'price'     => $node->filter('.card-price')->text(),
                'subtitle'  => $node->filter('.card-subtitle')->text(),
                'image'     => $node->filter('figure img')->image()->getUri(),
            ];
        });

        return $this->responseArray;
    }

    /**
     * Get detail of a car page.
     * @param int $id
     * @return array
     */
    public function getCarDetail(int $id): array
    {
        $this->createClient($this->crawlerUrl. $id);

        $detailDiv = $this->crawler->filter('.item-info');

        if (is_null($detailDiv->getNode(0))) {
            return [];
        }

        $this->responseArray[] = [
            'title'         => $detailDiv->filter('h1')->text(),
            'subtitle'      => $detailDiv->filter('.desc')->text(),
            'price'         => $detailDiv->filter('span.price')->text(),
            'model_date'    => $detailDiv->filter('.item-info span[itemProp=modelDate]')->text(),
            'mileage'       => $detailDiv->filter('.item-info span[itemProp=mileageFromOdometer]')->text(),
            'transmission'  => $detailDiv->filter('.item-info span[title="Tipo de transmissão"]')->text(),
            'ports'         => $detailDiv->filter('.item-info span[title=Portas]')->text(),
            'fuel_type'     => $detailDiv->filter('.item-info span[itemProp=fuelType]')->text(),
            'obs'           => $this->crawler->filter('.full-content .description-print')->text(),
            'images'        => $this->crawler->filter('.gallery-thumbs img:not(.unavailable)')->each(function ($node) {
                return str_replace('mini_', '', str_replace('tcarros', 'carros', $node->image()->getUri()));
            })
        ];

        return $this->responseArray;
    }

    /**
     * Set Filters.
     * @param array $filters
     */
    private function setFilters(array $filters)
    {
        foreach ($this->availableFilters as $filter => $value) {
            if (array_key_exists($filter, $filters)) {
                $this->crawlerUrl .= sprintf($value, $filters[$filter]);
            }
        }
    }
}
