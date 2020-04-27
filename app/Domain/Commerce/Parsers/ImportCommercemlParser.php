<?php

declare(strict_types=1);

namespace Domain\Commerce\Parsers;

use App\Catalog;
use App\CatalogProduct;
use App\Image;
use Illuminate\Support\Str;
use SimpleXMLElement;
use Zenwalker\CommerceML\CommerceML;

class ImportCommercemlParser extends CommercemlParser
{
    public function parse(): void
    {
        $commerce = new CommerceML();
        $commerce->loadImportXml(storage_path("app/public/1c_catalog/{$this->filename}"));

        $groups = $commerce->classifier->xml->Группы->Группа;
        if ($groups) {
            $this->parseCatalog($groups);
        }

        $catalogProducts = $commerce->catalog->xml->Товары->Товар;
        if ($catalogProducts) {
            $this->parseCatalogProducts($catalogProducts);
        }
    }

    /**
     * @param SimpleXMLElement $groups
     */
    private function parseCatalog(SimpleXMLElement $groups)
    {
        foreach ($groups as $group) {

            $uuid = $group->Ид;

            Catalog::updateOrCreate(['uuid' => $uuid], [
                'name' => $group->Наименование,
                'uuid' => $uuid,
                'title' => "Магазин Севастополь {$group->Наименование}",
                'description' => "Магазин Севастополь {$group->Наименование}. Выгодные цены, звоните по телефону +7(978) 852-79-33",
                'alias' => Str::slug($group->Наименование)
            ]);
        }
    }

    /**
     * @param SimpleXMLElement $catalogProducts
     */
    private function parseCatalogProducts(SimpleXMLElement $catalogProducts)
    {
        foreach ($catalogProducts as $catalogProduct) {

            if ($catalogProduct->Группы[0]) {
                $groupUuid = $catalogProduct->Группы[0]->Ид;
                $catalog = Catalog::where('uuid', $groupUuid)->first();

                if ($catalog) {
                    $catalogProductNew = CatalogProduct::updateOrCreate(['uuid' => $catalogProduct->Ид], [
                        'catalog_id' => $catalog->id,
                        'uuid' => $catalogProduct->Ид,
                        'name' => $catalogProduct->Наименование,
                        'alias' => Str::slug($catalogProduct->Наименование),
                        'text' => $catalogProduct->Описание ? "<p>{$catalogProduct->Описание}</p>" : null,
                        'in_store' => 1
                    ]);

                    if (isset($catalogProduct->Картинка)) {
                        $image = is_array($catalogProduct->Картинка)
                            ? $catalogProduct->Картинка[0]
                            : $catalogProduct->Картинка;

                        Image::updateOrCreate([
                            'imageable_id' => $catalogProductNew->id,
                            'imageable_type' => CatalogProduct::class
                        ],[
                            'path' => $image,
                            'title' => $catalogProductNew->name,
                            'alt' => $catalogProductNew->name,
                            'imageable_id' => $catalogProductNew->id,
                            'imageable_type' => CatalogProduct::class
                        ]);
                    }
                }
            }
        }
    }
}