<?php
/**
 * HONAKO APPLICATION
 * By: Hoiyen
 * Ver: 0.0.1
 * Last Update: 06/03/2016
 *
 * Domain: 
 * Global
 * 
 * Type: 
 * Class
 * 
 * Description:
 * File uploader and handler
 */
namespace Library\Classes;
use File;
use abeautifulsite\SimpleImage;
use Core\Foundation\Application;
use Illuminate\Http\UploadedFile;

class Media
{
  use \Library\Classes\Traits\MediaTraits;

  /**
   * Application
   * @var Core\Foundation\Application
   */
  public $app;

  /**
   * List of defined image sizes
   * @var array
   */
  protected $image_sizes = array();

  /**
   * File upload path
   * @var string
   */
  protected $upload_path = '';

  protected $image_path;

  protected $files_path;


  public function __construct( Application $app, $path )
  {
    $this->app = $app;
    $this->upload_path = $path;

    $this->image_path = $this->upload_path . '\\images';
    $this->files_path = $this->upload_path . '\\files';
    $this->setImageSizes();
  }

  protected function setImageSizes()
  {
    $this->image_sizes = [
      'thumb'   => [
        'width'   => 250,
        'height'  => 250,
        'crop'    => true      
      ],
      'medium'  => [
        'width'   => 300,
        'height'  => 350,
        'crop'    => true
      ],
      'large'   => [
        'width'   => 800,
        'height'  => 450,
        'crop'    => false
      ]
    ];
  }

  public function handle( UploadedFile $file )
  {
    $filepath = '';
    # this is an image?
    if ( $this->isImage( $file->getClientMimeType() ) ) {
      $filepath = $this->image_path . '\\' . $this->setFilename( $file->getClientOriginalName() );

      $image = new SimpleImage( $file->getPathname() );
      $image->save( $filepath );
    }
    # this is not an image
    else {
      $filepath = $this->files_path . '\\' . $this->sanitize( $file->getClientOriginalName() );
      
      $file->move( $this->files_path, $this->sanitize( $file->getClientOriginalName() ) );
    }

    return $this->getFileinfo( $filepath );
  }

  public function getMedia( $filename, $mime, $size = 'thumb' )
  {
    # filename empty? return empty
    if ( empty($filename) )
      return '';

    # size not found? return empty
    if ( ! isset($this->image_sizes[$size]) )
      return '';

    # what is this, image or regular file
    if ( $this->isImage( $mime ) ) {
      $size = $this->image_sizes[$size];
      $name = $this->setFilename( $filename, $size );

      # where is the file location
      $orig_path = $this->mediaPath( $filename, $mime );
      $file_path = $this->mediaPath( $name, $mime );

      # resized file not found, need to resize
      if ( ! File::exists($file_path) ) {
        $this->resize( $orig_path, $file_path, $size );
      }
      return asset('public/uploads/images/' . $name );
    }
  }

  public function mediaPath( $filename, $mime )
  {
    if ( $this->isImage( $mime ) ) {
      return $this->image_path . '\\' . $filename;
    }
    else {
      return $this->files_path . '\\' . $filename;
    }
  }

  public function resize( $filepath, $target, $size = array() )
  {
    $image = new SimpleImage($filepath);

    // check if request is crop
    if ( $size["crop"] == true ) {
      $image->thumbnail($size["width"], $size["height"]);
    }
    // resize as ratio
    else {
      $image->best_fit($size["width"], $size["height"]);
    }

    $image->save( $target );
  }

  public function delete( $filename )
  {
    if ( empty($filename) )
      return;

    # get file path
    if ( File::exists( $filepath = $this->image_path . '/' . $filename ) ) {
      # this is image
      # clear all resized image
      $this->clearResize($filename);

      # delete image
      return File::delete($filepath);
    }
    # non image
    elseif ( File::exists( $filepath = $this->files_path . '/' . $filename ) ) {
      # delete file
      return File::delete($filepath);
    }
  }

  public function clearResize( $filename )
  {
    foreach ( $this->image_sizes as $size ) {
      $name = $this->setFilename( $filename, $size );
      $path = $this->image_path . '/' . $name;
      if ( File::exists($path) ) {
        File::delete($path);
      }
    }
  }

  /*
  public function clearResize( $image_path )
  {
    $filesystem = app('files');

    // get image sizes from config
    $image_sizes = $this->sizes;

    // get resized file path
    $resize_path = $this->resize_path;

    $name = $filesystem->name($image_path);
    $ext  = $filesystem->extension($image_path);

    foreach ( $image_sizes as $size )
    {
      // define result image path
      $path = $resize_path . '/' . $name . '_' . $size["width"] . 'x' . $size["height"] . '.' . $ext;

      if ( $filesystem->exists($path) ) {
        @unlink( $path );
      }
    }
  }
  */

}
