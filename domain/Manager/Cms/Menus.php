<?php
/**
 * HONAKO APPLICATION
 * By: Hoiyen
 * Ver: 0.0.1
 * Last Update: 09/03/2016
 *
 * Domain: 
 * Manager
 * 
 * Type: 
 * Controller
 * 
 * Description:
 * CMS Menus page
 */
namespace Domain\Manager\Cms;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;

use Domain\Manager\BaseController;
use Library\Model\Menu;
use Library\Model\Page;
use Library\Repository\Menu as MenuRepo;
use Library\Repository\Page as PageRepo;


class Menus extends BaseController
{

  public function index(Request $request)
  {
    # handle delete all
    if ($request->isMethod('post') && $request->has('delete')) {
      if ( Menu::destroy($request->delete) > 0 ) {
        return redirect()->back()->with('message', 'Selected menu/s is deleted');
      }
    }

    $this->setPage('Menu');

    $view = [
      'list' => MenuRepo::all($request),
      'breadcrumb' => $this->breadcrumb( $request->get('sub', 0) ),
    ];

    return view('cms.menus.list', $view);
  }

  public function form(Request $request, Menu $menu = null)
  {
    $this->setPage('Create Menu');



    if ( !$menu->exists ) {
      $menu->menu_parent = $request->sub;
    }
    else {
      $this->setPage('Edit Menu');
    }

    # assign default menu
    if ( !$request->has('menu') ) {
      $menu->menu_type = MenuRepo::getDefaultMenu();
    }

    $view = [
      'form'        => $menu,
      'menu_type'   => MenuRepo::getLinkType(),
      'page_list'   => new PageRepo,
    ];


    return view('cms.menus.form', $view);

  }

  public function save(Request $request)
  {
    # validate
    $this->validate($request, [
      'menu_name' => 'required'
    ]);

    # validation passed
    $data = Menu::findOrNew($request->id);
    $data->menu_type    = $request->menu_type;
    $data->menu_name    = $request->menu_name;
    $data->status       = 'active';
    $data->menu_parent  = (int) $request->menu_parent;

    $data->menu_link    = $request->menu_link;
    $data->link_type    = $request->link_type;
    $data->new_tab      = $request->get('new_tab', 0);
    $data->sort         = $request->sort;
    $data->status       = $request->status;
    $data->save();

    # save menu metadata
    foreach ( $request->meta as $meta_key => $meta_val )
    {
      $meta = DB::table('menus_meta')->where('meta_key', $meta_key)->where('menu_id', $data->id)->first();
      if ( ! $meta ) {
        DB::table('menus_meta')->insert([
          'meta_key'  => $meta_key,
          'menu_id'   => $data->id,
          'meta_val'  => $meta_val
        ]);
      }
      else {
        DB::table('menus_meta')->where('meta_key', $meta_key)->where('menu_id', $data->id)->update([
          'meta_val'  => $meta_val
        ]);
      }
    }
    
    # redirect back to list
    return redirect()->route('manager.cms.menu', ['sub' => $request->menu_parent])->with('message', 'Data updated');
  }

  /**
   * Handle ajax requests
   * @param  Request $request [description]
   * @return void
   */
  public function ajax(Request $request)
  {
    if ( ! $request->ajax() ) {
      abort(402);
    }

    switch ($request->action) {
      case 'page':
        $page = Page::find($request->id);
        return $page->getLink();
        break;
      
      default:
        # code...
        break;
    }

  }  

  /**
   * Generate breadcrumb for sub-menu
   * @param  int $id current menu ID
   * @return array
   */
  private function breadcrumb( $id = null )
  {
    if ( empty($id) )
      return;

    $menu = Menu::find( $id );

    $breadcrumb[] = $menu;

    $i = 1;
    while ( $menu = $menu->parent ) {
      if ($i >= 5) {
        break;
      }
      
      $breadcrumb[] = $menu;
      $i++;
    }

    krsort($breadcrumb);
    $breadcrumb = array_values($breadcrumb);

    return $breadcrumb;
  }

}