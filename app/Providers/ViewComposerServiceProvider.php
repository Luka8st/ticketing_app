<?php

namespace App\Providers;

use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('components.agents.sidebar', function ($view) {
            $closedTicketsCount = 0;
            $openTicketsCount = 0;

            if (Auth::check()) {
                $agentId = Auth::user()->id;
                $closedTicketsCount = Ticket::where('status', 'closed')
                    ->where('agent_id', $agentId)
                    ->count();
                
                $openTicketsCount = Ticket::where('status', 'open')
                    ->where('agent_id', $agentId)
                    ->count();

                $departmentId = Auth::user()->department_id;
                $newTicketsCount = Ticket::where('status', 'new')
                    ->where('department_id', $departmentId)
                    ->count();
            }

            $view->with([
                'closedTicketsCount' => $closedTicketsCount,
                'openTicketsCount' => $openTicketsCount,
                'newTicketsCount' => $newTicketsCount,
            ]);
        });
    }
}
