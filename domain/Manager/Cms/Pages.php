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
 * CMS Pages page
 */
namespace Domain\Manager\Cms;

use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;

use Domain\Manager\BaseController;

use Library\Model\Page;
use Library\Repository\Page as PageRepo;

class Pages extends BaseController
{
  protected $page_type = 'page';

  /**
   * Show list
   * @param  Request
   * @return View
   */
  public function index( Request $request )
  {
    # handle delete all
    if ($request->isMethod('post') && $request->has('delete')) {
      if ( Page::destroy($request->delete) > 0 ) {
        return redirect()->back()->with('message', 'Selected pages is deleted');
      }
    }

    $this->setPage('Pages');

    $view = [
      'list' => PageRepo::all($request, $this->page_type),
      'breadcrumb' => $this->breadcrumb( $request->get('sub', 0) )
    ];

    return view('cms.pages.list', $view);
  }


  /**
   * Show form
   * @param  Library\Model\Page
   * @return View
   */
  public function form( Request $request, Page $page = null )
  {
    $this->setPage('Create Page');

    if ( $page->exists ) {
      $this->setPage('Edit Page');
    }
    else {
      if ( $request->has('sub') ) {
        $page->page_parent = $request->sub;
      }
      else {
        $page->page_parent = 0;
      }
    }

    $view = [
      'form' => $page
    ];

    return view('cms.pages.form', $view);
  }

  public function save(Request $request)
  {
    # validate
    $this->validate($request, [
      'page_name' => 'required'
    ]);

    # validation passed
    $data = Page::findOrNew($request->id);
    $data->page_type    = $this->page_type;
    $data->page_name    = $request->page_name;
    $data->page_desc    = $request->page_desc;
    $data->page_status  = 'published';
    $data->page_parent  = $request->page_parent;

    # process slug generation
    if ( $request->has('page_slug') ) {
      $data->page_slug = PageRepo::slug($request->page_slug, $data->id);
    }
    else {
      $data->page_slug = PageRepo::slug($data->page_name);
    }

    $data->save();

    # redirect back to list
    return redirect()->route('manager.cms.page', ['sub' => $request->page_parent])->with('message', 'Data updated');

  }

  /**
   * Generate breadcrumb for page with sub-page
   * @param  int $id current page ID
   * @return array
   */
  private function breadcrumb( $id = null )
  {
    if ( empty($id) )
      return;

    $page = Page::find( $id );

    $breadcrumb[] = $page;

    $i = 1;
    while ( $page = $page->parent ) {
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
