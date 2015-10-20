<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Requests\PageRequest;
use App\Http\Controllers\Controller;
use App\Page;


/*
 * This controller is for managing Website's pages / subpages (Admin only)
 */

class PagesController extends Controller
{
    
    /**
     * 
     * @return type
     */
    public function index()
    {
      //$pages = Page::latest()->visible()->get();
      $pages = Page::latest()->get();
      
      return view('admin.pages.index', compact('pages'));
    }
    
    /**
     * 
     * @param Page $page
     * @return type
     */
    public function show(Page $page)
    {  
      return view('admin.pages.show', compact('page'));
    }
    
    /**
     * 
     * @param Page $page
     * @return type
     */
    public function edit(Page $page)
    {  
      return view('admin.pages.edit', compact('page'));
    }
    
    /**
     * 
     * @param Page $page
     * @return type
     */
    public function update(Page $page, PageRequest $request)
    {  
      $page->update($request->all());
      
      return redirect('/admin/page')->with([
        'flash_message' => 'Page updated'
      ]);
    }
    
    /**
     * 
     * @return type
     */
    public function create()
    {
      return view('admin.pages.create');
    }
    
    /**
     * 
     * @return type
     */
    public function store(PageRequest $request) 
    {
      $page = new Page($request->all());
      
      \Auth::user()->pages()->save($page);
      
      return redirect('/admin/page')->with([
        'flash_message' => 'Created new page'
      ]);
    }
    

}
