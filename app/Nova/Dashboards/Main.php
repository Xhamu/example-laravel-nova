<?php

namespace App\Nova\Dashboards;

use App\Nova\Metrics\AverageTaskPrice;
use App\Nova\Metrics\UsuariosPorDia;
use App\Nova\Metrics\UsuariosRegistrados;
use Laravel\Nova\Cards\Help;
use Laravel\Nova\Dashboards\Main as Dashboard;

class Main extends Dashboard
{
    /**
     * Get the cards for the dashboard.
     *
     * @return array
     */
    public function cards()
    {
        return [
            new AverageTaskPrice,
            new UsuariosRegistrados,
            new UsuariosPorDia
        ];
    }

    public function name()
    {
        return 'Pantalla de Inicio';
    }
}
