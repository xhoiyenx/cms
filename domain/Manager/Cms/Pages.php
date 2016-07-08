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
 * Product page
 */
namespace Domain\Manager\Cms;

use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;

use Domain\Manager\BaseController;

use Library\Model\Page;
use Library\Repository\Page as PageRepo;

class Pages extends BaseController
{
  /**
   * @param  Request
   * @return View
   */
  public function index( Request $request )
  {
    # handle delete all
    if ($request->isMethod('post') && $request->has('delete')) {
      if ( Page::destroy($request->delete) > 0 ) {
        return redirect()->back()->with('message', 'Selected pages deleted');
      }
    }

    $this->setPage('Pages');

    $view = [
      'list' => PageRepo::all($request),
      'breadcrumb' => $this->breadcrumb( $request->get('parent', 0) )
    ];

    return view('cms.pages.list', $view);
  }


  /**
   * @param  Page ID
   * @return Form
   */
  public function form( Request $request, $id = null )
  {
    $this->setPage('Add / Edit Page');

    $data = Page::findOrNew($id);

    if ( $request->has('parent') ) {
      $data->parent = $request->parent;
    }

    $view = [
      'form' => $data
    ];

    return view('cms.pages.form', $view);
  }

  public function save(Request $request)
  {

    # validate
    $this->validate($request, [
      'name' => 'required'
    ]);

    # validation passed
    $data = Page::findOrNew($request->id);
    $data->type = 'page';
    $data->name = $request->name;

    if ( $request->has('slug') ) {
      $data->slug = PageRepo::slug($request->slug, $data->id);
    }
    else {
      $data->slug = PageRepo::slug($data->name);
    }

    $data->description = $request->description;
    $data->status = 'published';
    $data->parent = $request->parent;
    $data->save();

    # redirect back to list
    return redirect()->route('manager.cms.page')->with('message', 'Data updated');

  }

  public function delete( $id )
  {
    try {
      $data = Page::findOrFail( $id );
    }
    catch ( \Exception $e ) {
      return redirect()->back()->with('errors', new MessageBag(['No data found']));
    }
  }

  private function breadcrumb( $id = null)
  {
    if ( empty($id) )
      return;

    $page = Page::find( $id );

    $breadcrumb[] = $page;

    $i = 1;
    while ( $page = $page->par ) {
      if ($i >= 5) {
        break;
      }
      
      $breadcrumb[] = $page;
      $i++;
    }

    krsort($breadcrumb);
    $breadcrumb = array_values($breadcrumb);

    return $breadcrumb;
  }

}
