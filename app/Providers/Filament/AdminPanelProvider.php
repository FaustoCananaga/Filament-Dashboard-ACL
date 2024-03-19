<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\MenuItem;
use Filament\Navigation\NavigationItem;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use League\CommonMark\Extension\Mention\Mention;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('dashboard')
            ->path('dashboard')
            ->login()
            //->registration()
            //->passwordReset()
            ->emailVerification()
            ->brandName('Gestão de Stock')
            ->brandLogo(asset('images/Logo-white.png'))
            ->darkModeBrandLogo(asset('images/Logo-black.png'))
            ->brandLogoHeight(fn ()=> auth()->check() ? '2.2rem' : '3.2rem')
            ->favicon(asset('images/favicon.png'))
            ->profile()
            ->colors([
                'primary' => 'rgb(103, 76, 196)',
            ])

            ->font('Poppins')
           // ->sidebarCollapsibleOnDesktop()
           // ->fevicon('user_default.jpg')
           //->breadcrumbs('false')
           ->userMenuItems([
            MenuItem::make()
            ->label('Configurações')
            ->url('')
            ->icon('heroicon-o-cog-6-tooth'),

            'logout'=> MenuItem::make()->label('Terminar Sessão')
           ])
           ->navigationItems(
            [
             NavigationItem::make('Blog')
             ->icon('heroicon-o-pencil-square')
             ->group('External')   
             ->sort(2)
            ]
           )
           ->sidebarFullyCollapsibleOnDesktop()

            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
