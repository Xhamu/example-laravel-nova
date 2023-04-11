<?php

namespace App\Nova\Dashboards;

use App\Nova\Metrics\PrecioMedioTareas;
use App\Nova\Metrics\PrecioTotalTareas;
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
            new UsuariosRegistrados,
            new UsuariosPorDia,
            new PrecioTotalTareas
        ];
    }

    public function name()
    {
        return 'Pantalla de Inicio';
    }
}
