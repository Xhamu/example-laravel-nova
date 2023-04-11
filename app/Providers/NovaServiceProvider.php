<?php

namespace App\Providers;

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
                MenuSection::make('Usuarios', [
                    MenuItem::resource(User::class),
                    MenuItem::resource(Task::class),
                    MenuItem::resource(Profession::class),
                ])->icon('user')->collapsable(),

                MenuSection::make('Roles', [
                    MenuItem::resource(Role::class),
                    MenuItem::resource(Permission::class),
                ])->icon('shield-check')->collapsable(),
            ];
        });

        Nova::resources([
            User::class,
            Role::class,
            Permission::class,
            Profession::class,
        ]);

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
