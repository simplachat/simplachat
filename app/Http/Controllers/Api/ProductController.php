<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Resources\Json\ResourceCollection;
use LogicException;

/**
 * Contrôleur de ressources pour les produits.
 * Permet de récupérer, créer, mettre à jour et supprimer des produits.
 *
 * @author Quentin Boitel <quentin.boitel@simplachat.fr>
 * @package API\Controllers
 * @since 2023-05-21
 * @version 1.0.0
 * @license MIT
 * @see Product
 */
class ProductController extends Controller
{
    /**
     * Renvoie la liste des produits correspondant aux critères de recherche.
     *
     * @return ResourceCollection La collection de ressources ProductResource contenant les produits correspondant aux critères de recherche.
     *
     * @author Quentin Boitel <quentin.boitel@simplachat.fr>
     * @since 2023-05-21
     * @version 1.0.0
     */
    public function index(): ResourceCollection
    {
        $products = Product::query()
            /**
             * Randomize the results if parameter "random" is set
             */
            ->when(request()->has('random'), function ($query) {
                $query->inRandomOrder()->take(request('random'));
            })
            /**
             * Filter by category if parameter "categories" is set
             */
            ->when(request()->has('categories'), function ($query) {
                $query->whereHas('category', function ($query) {
                    $query->whereIn('category_id', request('categories'));
                });
            })
            /**
             * Filter by shop if parameter "shops" is set
             */
            ->when(request()->has('shops'), function ($query) {
                $query->whereHas('shop', function ($query) {
                    $query->whereIn('shop_id', request('shops'));
                });
            })
            /**
             * Filter by discounted products if parameter "discount" is set
             * We filter based on discount_price for prices
             */
            ->when(request()->has('discount'), function ($query) {
                /**
                 * Filter by min_price if parameter "min_price" is set
                 */
                $query->when(request()->has('min_price'), function ($query) {
                    $query->when(request()->has('max_price'), function ($query) {
                        /**
                         * Filter by price between min_price and max_price if parameter "max_price" is set and "min_price" is set
                         */
                        $query->whereBetween('discount_price', [request('min_price'), request('max_price')]);
                    }, function ($query) {
                        $query->where('discount_price', '>=', request('min_price'));
                    });
                });
                /**
                 * Filter by max_price if parameter "max_price" is set
                 */
                $query->when(request()->has('max_price'), function ($query) {
                    $query->where('discount_price', '<=', request('max_price'));
                });
            }, function ($query) {
                /**
                 * If discount parameter is not set, we filter based on unit_price for prices
                 *
                 * Filter by min_price if parameter "min_price" is set
                 */
                $query->when(request()->has('min_price'), function ($query) {
                    $query->when(request()->has('max_price'), function ($query) {
                        /**
                         * Filter by price between min_price and max_price if parameter "max_price" is set and "min_price" is set
                         */
                        $query->whereBetween('unit_price', [request('min_price'), request('max_price')]);
                    }, function ($query) {
                        $query->where('unit_price', '>=', request('min_price'));
                    });
                });
                /**
                 * Filter by max_price if parameter "max_price" is set
                 */
                $query->when(request()->has('max_price'), function ($query) {
                    $query->where('unit_price', '<=', request('max_price'));
                });
            })
            /**
             * Filter by name if parameter "search" is set
             */
            ->when(request()->has('search'), function ($query) {
                $query->where('name', 'like', '%' . request('search') . '%');
            })
            /**
             * Sort by parameter "sort" if set and "order" if set
             */
            ->when(request()->has('sort'), function ($query) {
                $query->orderBy(request('sort'), request('order', 'asc'));
            });
        /**
         * Paginate the results if parameter "paginate" is set
         */
        if (request()->has('paginate')) {
            return ProductResource::collection($products->paginate(request('paginate')));
        }
        return ProductResource::collection($products->get());
    }

    /**
     * Renvoie le produit créé à partir des données de la requête.
     *
     * @param StoreProductRequest $request La requête de validation de produit
     * @return Product Le produit créé
     *
     * @author Quentin Boitel <quentin.boitel@simplachat.fr>
     * @since 2023-05-21
     * @version 1.0.0
     * @see StoreProductRequest
     * @see Product
     */
    public function store(StoreProductRequest $request): Product
    {
        return Product::create(['shop_id' => auth()->user()->id, ...$request->validated()]);
    }

    /**
     * Renvoie le produit correspondant à l'identifiant.
     *
     * @param Product $product Le produit à afficher
     * @return ProductResource La ressource ProductResource contenant le produit demandé
     *
     * @author Quentin Boitel <quentin.boitel@simplachat.fr>
     * @since 2023-05-21
     * @version 1.0.0
     * @see Product
     * @see ProductResource
     */
    public function show(Product $product): ProductResource
    {
        return ProductResource::make($product);
    }

    /**
     * Met à jour le produit correspondant à l'identifiant avec les données de la requête.
     *
     * @param UpdateProductRequest $request La requête de mise à jour du produit
     * @param Product $product Le produit à mettre à jour
     * @return bool true si la mise à jour a réussi, false sinon
     *
     * @author Quentin Boitel <quentin.boitel@simplachat.fr>
     * @since 2023-05-21
     * @version 1.0.0
     * @see UpdateProductRequest
     * @see Product
     */
    public function update(UpdateProductRequest $request, Product $product): bool
    {
        return $product->update(['shop_id' => auth()->user()->id, ...$request->validated()]);
    }

    /**
     * Supprime le produit correspondant à l'identifiant.
     *
     * @param Product $product Le produit à supprimer
     * @return bool|null true si la suppression a réussi, false sinon ou null si le produit n'existe pas
     *
     * @throws LogicException Si l'utilisateur n'est pas le propriétaire du produit
     *
     * @author Quentin Boitel <quentin.boitel@simplachat.fr>
     * @since 2023-05-21
     * @version 1.0.0
     * @see Product
     */
    public function destroy(Product $product): bool|null
    {
        return $product->delete();
    }
}
