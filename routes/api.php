<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\LivreurController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CommandeController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
// require 'vendor/autoload.php';

// use Psr\Http\Message\ResponseInterface as Response;
// use Psr\Http\Message\ServerRequestInterface as PsrRequest;

// use Slim\Factory\AppFactory;
// $app = AppFactory::create();

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/produits', [ProductController::class, 'index1']);
Route::post('/commandes', [CommandeController::class, 'store']);
Route::post('/users/register', [LivreurController::class, 'registerDriver']);
Route::post('/users/login', [LivreurController::class, 'loginDriver']);
Route::get('/clients/{id}', [ClientController::class, 'show']);
Route::post('/set-postion', [ClientController::class, 'set_postion']);


// $app->post('/api/cart/add', function (Request $request, Response $response) {
//     // Récupérer les données du produit depuis la requête
//     $productData = $request->getParsedBody();


//     $productId = $request->getParam('productId'); // ID du produit à ajouter

//     // Vérifier si le produit existe dans la base de données
//     $product = getProductById($productId);

//     if ($product) {
//         // Ajouter le produit au panier
//         $cart->addToCart($product);
//         return $response->withJson(['message' => 'Produit ajouté au panier.']);
//     } else {
//         return $response->withStatus(404)->withJson(['message' => 'Produit non trouvé.']);
//     }
// });

// $app->post('/api/cart/remove', function (Request $request, Response $response) {
//     // Récupérer les données du produit depuis la requête
//     $productData = $request->getParsedBody(); // ID du produit à supprimer

//     // Rechercher le produit dans le panier
//     $product = $cart->getProductById($productId);

//     if ($product) {
//         // Supprimer le produit du panier
//         $cart->removeFromCart($product);
//         return $response->withJson(['message' => 'Produit supprimé du panier.']);
//     } else {
//         return $response->withStatus(404)->withJson(['message' => 'Produit non trouvé dans le panier.']);
//     }
// });
// $app->run();



