<?php

use App\Enums\Categorias;
use App\Http\Controllers\PerfilController;
use App\Models\Perfil;
use App\Models\User;
use App\Notifications\Contato;
use App\Providers\RouteServiceProvider;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('', function () {
    $perfis = [];
    foreach (Categorias::cases() as $categoria)
        $perfis[$categoria->name] = Perfil::orderBy('nome')->where('categoria', $categoria)->get();
    return view('home', compact('perfis'));
})->name('home');

Route::get("categorias/{slug}", function (Request $request, string $slug) {
    foreach (Categorias::cases() as $case)
        if ($case->slug() == $slug)
            $categoria = $case;

    if (!isset($categoria))
        return abort(404);

    $filtro = null;
    extract($request->validate([
        'filtro' => [
            'nullable',
            'string',
            'max:255',
        ],
    ]));

    $perfis = Perfil::orderBy('nome')->where('categoria', $categoria);
    if (isset($filtro))
        $perfis->where(function (Builder $builder) use ($filtro) {
            $builder
                ->where('nome', 'like', "%$filtro%")
                ->orWhere('descricao', 'like', "%$filtro%");
        });
    $perfis = $perfis->paginate()->withQueryString();

    return view('categorias.show', compact('categoria', 'perfis', 'filtro'));
})->name("categorias.show");

Route::name('perfis.advanced-search')
    ->prefix('pesquisa-avancada')
    ->group(function () {
        Route::get('', PerfilController::class . '@advancedSearch');
        Route::get('sobre', function () {
            return '
                TODO: Página explicando a pesquisa avançada. 
                Baseada em: 
                <a href="https://www.elastic.co/guide/en/elasticsearch/reference/current/query-dsl-simple-query-string-query.html">
                    https://www.elastic.co/guide/en/elasticsearch/reference/current/query-dsl-simple-query-string-query.html
                </a>
            ';
        })->name('.about');
    });

Route::resource('perfis', PerfilController::class)
    ->parameters(['perfis' => 'perfil'])
    ->except('index');

Route::name('contato.')
    ->group(function () {
        Route::view('contato', 'contato.show')->name('show');

        Route::post('contato', function (Request $request) {
            Notification::send(User::all(), new Contato($request->validate([
                'nome' => [
                    'required',
                    'string',
                    'max:255',
                ],
                'email' => [
                    'required',
                    'string',
                    'max:255',
                    'email',
                ],
                'assunto' => [
                    'required',
                    'string',
                    'max:255',
                ],
                'mensagem' => [
                    'required',
                    'string',
                    'max:1000',
                ],
            ])));
            return redirect(RouteServiceProvider::HOME)->with('success', 'Mensagem Enviada.');
        })->name('send');
    });
