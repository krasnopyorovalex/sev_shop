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
     * @param null $parentId
     */
    private function parseCatalog(SimpleXMLElement $groups, $parentId = null)
    {
        foreach ($groups as $group) {

            $uuid = $group->Ид;

            if ($parentId) {
                $parentCatalog = Catalog::whereId($parentId)->first();
                $parentId = $parentCatalog->id;
            }

            $alias = Str::slug($group->Наименование);
            while (Catalog::where('alias', $alias)->exists()) {
                $alias .= '-' . random_int(1,350);
            }

            $catalog = Catalog::updateOrCreate(['uuid' => $uuid], [
                'name' => $group->Наименование,
                'parent_id' => $parentId,
                'uuid' => $uuid,
                'alias' => $alias
            ]);

            if ($group->Группы->Группа) {
                $this->parseCatalog($group->Группы->Группа, $catalog->id);
            }
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

                    $alias = Str::slug($catalogProduct->Наименование);
                    while (CatalogProduct::where('alias', $alias)->exists()) {
                        $alias .= '-' . random_int(1,350);
                    }

                    $catalogProductNew = CatalogProduct::updateOrCreate(['uuid' => $catalogProduct->Ид], [
                        'catalog_id' => $catalog->id,
                        'uuid' => $catalogProduct->Ид,
                        'name' => $catalogProduct->Наименование,
                        'alias' => $alias,
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
