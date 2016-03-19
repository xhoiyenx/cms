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
 * Trait
 * 
 * Description:
 * Trait helpers for media
 */
namespace Library\Classes\Traits;
use File;

trait MediaTraits
{

  /**
   * Detecting type image from mime data
   * @param  string  $mime
   * @return boolean
   */
  public function isImage( $mime )
  {
    $type = [
      'image/gif',
      'image/jpeg',
      'image/png'
    ];

    if ( in_array($mime, $type) ) {
      return true;
    }
    else {
      return false;
    }
  }

  /**
   * When i decide what kind of file name should be uploaded
   * @param  string $filename
   * @return string
   */
  public function setFilename( $filename, $specs = array() )
  {
    $filename = $this->sanitize( $filename );

    $basename = File::name($filename);
    $ext      = File::extension($filename);

    # we have specific specification
    if ( ! empty($specs) ) {
      # only process if we have width and height data;
      # the filename will be formatted as [name]-[width]x[height].[ext]
      if ( isset($specs['width']) && isset($specs['height']) ) {
        $filename = $basename . '-' . $specs['width'] . 'x' . $specs['height'] . '.' . $ext;
      }
    }
    else {
      # I want the filename will be formatted as [name]-[timestamp].[ext]
      $filename = $basename . '-' . time() . '.' . $ext;
    }

    return $filename;
  }

  /**
   * Sanitize uploaded filename, remove all char except alphanumeric, dot, dash, and underscore
   * @param  string $filename
   * @return string sanitized filename
   */
  public function sanitize( $filename )
  {
    $filename = preg_replace('/[^a-z0-9\.\-\_\/]/', '', strtolower($filename));
    return str_replace('_', '-', $filename);
  }

  public function getFileinfo( $filepath )
  {
    $filename = File::basename($filepath);

    return [
      'name'  => File::name($filename),
      'ext'   => File::extension($filename),
      'path'  => $filepath,
      'link'  => $filename,
      'mime'  => File::mimeType( $filepath )
    ];    
  }

}