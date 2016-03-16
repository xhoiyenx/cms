<?php
/**
 * HONAKO APPLICATION
 * By: Hoiyen
 * Ver: 0.0.1
 * Last Update: 28/02/2016
 *
 * Domain: 
 * Manager
 * 
 * Description:
 * Upload handler action
 */

namespace Domain\Manager;

class MediaUpload extends BaseController
{
  public function product()
  {
    /*
    if ( $post->ajax() ) {

      if ( $post->get('action') == 'update' ) {
        $view['model'] = ContentMedia::find( $post->get('content') );
      }

      if ( $post->get('action') == 'delete' ) {
        $delete = ContentMedia::find( $post->get('content') );
        @unlink( $delete->path );
        app('honako')->clearResize( $delete->path );
        $delete->delete();
        return 2;
      }

      # save initiated
      if ( $post->has('save') ) {

        # when saving, if current request is update
        if ( $post->get('action') == 'update' ) {

          #if user upload a file, process it
          if ( $post->hasFile('media') ) {
            $uploaded_image = app('honako')->uploadImage( $post->file('media') );
            if ( ! $uploaded_image ) {
              $errors[] = 'Error when uploading image';
            }
          }

        }
        else {
          # check if any file uploaded
          if ( ! $post->hasFile('media') ) {
            $errors[] = 'Please upload image';
          }
          else {
            # upload first
            $uploaded_image = app('honako')->uploadImage( $post->file('media') );
            if ( ! $uploaded_image ) {
              $errors[] = 'Error when uploading image';
            }
          }
        }

        # no errors
        if ( empty( $errors ) ) {

          if ( $post->get('action') == 'update' ) {
            $media = ContentMedia::find( $post->get('content') );   

            # when updating, user also uploading new image, delete old image
            if ( isset($uploaded_image) AND is_array($uploaded_image) ) {
              @unlink( $media->path );
              app('honako')->clearResize( $media->path );
            }
          }
          else {
            # saving data
            $media = new ContentMedia;
            $media->content_id = $content_id;
          }

          # updating, but user don't upload new image, only save name and sort
          if ( $media->exists !== false AND !isset($uploaded_image) ) {
            $media->name = $post->get('name');
            $media->sort_order = $post->get('sort_order', 0);
            $media->save();
          }
          else {
            $media->name = $post->get('name', $uploaded_image["name"]);
            $media->mime = $post->file('media')->getClientMimeType();
            $media->path = $uploaded_image["path"];
            $media->link = $uploaded_image["link"];
            $media->sort_order = $post->get('sort_order', 0);
            $media->save();
          }
          return 1;

        }
        else {

          # has errors but image already uploaded. clear it
          if ( isset($uploaded_image) AND is_array($uploaded_image) ) {
            @unlink( $uploaded_image['path'] );
            app('honako')->clearResize( $uploaded_image['path'] );
          }

        }

      }

    }
    */

    return view()->make('catalog.media.upload');
  }
}
