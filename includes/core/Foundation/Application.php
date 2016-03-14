<?php
namespace Core\Foundation;

use Illuminate\Foundation\Application as BaseApplication;

class Application extends BaseApplication
{
  /**
   * Bind all of the application paths in the container.
   *
   * @return void
   */
  protected function bindPathsInContainer()
  {
    $this->instance('path', $this->path());

    foreach (['base', 'config', 'database', 'domain', 'lang', 'public', 'storage'] as $path) {
      $this->instance('path.'.$path, $this->{$path.'Path'}());
    }
  }


  /**
   * Get the path to the application "app" directory.
   *
   * @return string
   */
  public function path()
  {
    return $this->basePath.DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'library';
  }

  /**
   * Get the path to the application configuration files.
   *
   * @return string
   */
  public function configPath()
  {
    return $this->basePath.DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR.'config';
  }

  /**
   * Get the path to the application domain controller files.
   *
   * @return string
   */
  public function domainPath()
  {
    return $this->basePath.DIRECTORY_SEPARATOR.'domain';
  }  

  /**
   * Get the path to the routes cache file.
   *
   * @return string
   */
  public function getCachedRoutesPath()
  {
    return $this->basePath().'/resources/cache/routes.php';
  }

  /**
   * Get the path to the cached "compiled.php" file.
   *
   * @return string
   */
  public function getCachedCompilePath()
  {
    return $this->basePath().'/resources/cache/compiled.php';
  }

  /**
   * Get the path to the cached services.php file.
   *
   * @return string
   */
  public function getCachedServicesPath()
  {
    return $this->basePath().'/resources/cache/services.php';
  }

  /**
   * Get the path to the configuration cache file.
   *
   * @return string
   */
  public function getCachedConfigPath()
  {
    return $this->basePath().'/includes/config.php';
  }  

  /**
   * Run the given array of bootstrap classes.
   *
   * @param  array  $bootstrappers
   * @return void
   */
  public function bootstrapWith(array $bootstrappers)
  {
    $this->hasBeenBootstrapped = true;
    foreach ($bootstrappers as $bootstrapper) {
      $this->make($bootstrapper)->bootstrap($this);
    }
  }

}