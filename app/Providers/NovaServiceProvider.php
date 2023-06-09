<?php

namespace App\Providers;

use App\Nova\Dashboards\Main;
use App\Nova\Task;
use App\Nova\Profession;
use App\Nova\Role;
use App\Nova\User;
use App\Nova\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Menu\MenuItem;
use Laravel\Nova\Menu\MenuSection;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        Nova::mainMenu(function (Request $request) {
            return [
                MenuSection::dashboard(Main::class)->icon('chart-bar'),

                MenuSection::make('Usuarios', [
                    MenuItem::make('Usuarios', '/resources/users'),
                    MenuItem::make('Tareas', '/resources/tasks'),
                    MenuItem::make('Profesiones', 'resources/professions'),
                ])->icon('user')->collapsable(),

                MenuSection::make('Roles', [
                    MenuItem::make('Roles', 'resources/roles'),
                    MenuItem::make('Permisos', 'resources/permissions'),
                ])->icon('shield-check')->collapsable(),
            ];
        });

        Nova::footer(function ($request) {
            return Blade::render('<div class="text-center">
            <p>
                Proyecto de Ejemplo con Laravel Nova creado por
                <a target="_blank" href="https://github.com/Xhamu" class="text-yellow-800 hover:text-yellow-500 transition-all font-bold">
                    Samuel R.
                </a>
            </p>
        </div>
        ');
        });

        Nova::withBreadcrumbs();
    }

    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes()
    {
        Nova::routes()
            ->withAuthenticationRoutes()
            ->withPasswordResetRoutes()
            ->register();
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewNova', function ($user) {
            return in_array($user->email, [
                'admin@test.com'
            ]);
        });
    }

    /**
     * Get the dashboards that should be listed in the Nova sidebar.
     *
     * @return array
     */
    protected function dashboards()
    {
        return [
            new \App\Nova\Dashboards\Main,
        ];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools()
    {
        return [];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Nova::initialPath('/dashboards/main');
    }
}
