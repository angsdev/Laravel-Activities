<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider {

  /**
   * The policy mappings for the application.
   *
   * @var array
   */
  protected $policies = [
    // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    'App\Models\Activity\Activity' => 'App\Policies\Activity\ActivityPolicy',
    'App\Models\Activity\Attention' => 'App\Policies\Activity\AttentionPolicy',
    'App\Models\Activity\Identifier' => 'App\Policies\Activity\IdentifierPolicy',
    'App\Models\Activity\Process' => 'App\Policies\Activity\ProcessPolicy',
    'App\Models\Activity\Source' => 'App\Policies\Activity\SourcePolicy',
    'App\Models\Activity\Type' => 'App\Policies\Activity\TypePolicy',
  ];

  /**
   * Register any authentication / authorization services.
   *
   * @return void
   */
  public function boot(){

    $this->registerPolicies();
    Gate::before(fn($user) => $user->isAdmin() ?: null);
  }
}
