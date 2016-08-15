<?php
/**
 * HONAKO APPLICATION
 * By: Hoiyen
 * Ver: 0.0.1
 * Last Update: 15/03/2016
 *
 * Domain: 
 * Library
 *
 * Type:
 * Service Provider
 * 
 * Description:
 * Authorization service provider
 */
namespace Library\Providers;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
  public function boot(GateContract $gate)
  {
    $this->registerPolicies($gate);
  }
}
