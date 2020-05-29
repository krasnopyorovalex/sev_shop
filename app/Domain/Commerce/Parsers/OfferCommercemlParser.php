<?php

declare(strict_types=1);

namespace Domain\Commerce\Parsers;

use App\CatalogProduct;
use Zenwalker\CommerceML\CommerceML;

class OfferCommercemlParser extends CommercemlParser
{
    public function parse(): void
    {
        $commerce = new CommerceML();
        $commerce->loadImportXml(storage_path("app/public/1c_catalog/{$this->filename}"));

        $offers = $commerce->importXml->ПакетПредложений->Предложения->Предложение;

        if ($offers) {
            foreach ($offers as $offer) {
                $uuid = $offer->Ид;
                $price = (float)$offer->Цены->Цена->ЦенаЗаЕдиницу;
                $inStore = (int)$offer->Количество;

                if ($price) {
                    $catalogProduct = CatalogProduct::whereUuid($uuid)->first();
                    if ($catalogProduct) {
                        $catalogProduct->update([
                            'price' => $price,
                            'in_store' => $inStore > 0 ? '1' : '0'
                        ]);
                    }
                }
            }
        }
    }
}
