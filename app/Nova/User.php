<?php

namespace App\Nova;

use Illuminate\Validation\Rules;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use App\Nova\Resource;
use Laravel\Nova\Fields\Avatar;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\PasswordConfirmation;

class User extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\User>
     */
    public static $model = \App\Models\User::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    protected $gravatar = 'gravatar';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'name', 'email',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            Avatar::make('Avatar')
                ->rules('required')
                ->disk('public')
                ->path('avatars')
                ->maxWidth(60)
                ->rounded()
                ->disableDownload(),

            Text::make('Name')
                ->sortable()
                ->rules('required', 'max:255'),
                
            Text::make('Email')
                ->sortable()
                ->rules('required', 'email', 'max:254')
                ->creationRules('unique:users,email')
                ->updateRules('unique:users,email,{{resourceId}}'),

            Password::make('Password')
                ->creationRules('required', Rules\Password::defaults(), 'confirmed')
                ->updateRules('nullable', Rules\Password::defaults(), 'confirmed')
                ->onlyOnForms(),

            PasswordConfirmation::make('Password Confirmation')
                ->updateRules('nullable'),

            BelongsTo::make('Profession', 'profession', Profession::class)
                ->display('name')
                ->sortable(),

            HasMany::make('Tasks'),

            BelongsToMany::make('Roles', 'roles', Role::class)
                ->display('name')
                ->sortable(),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [
            new Filters\UserType,
        ];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [];
    }
}
