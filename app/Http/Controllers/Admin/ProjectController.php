<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use Illuminate\Support\Facades\Storage;
use App\Models\Admin\Category;
use App\Models\Admin\Technology;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index(){
        $project = Project::all();
        return view('pages.index', compact('project'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $categories = Category::all();
        $technologies = Technology::all(); 
        return view('pages.create', compact('categories', 'technologies'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {
        $form_data = $request->validated();

        $slug = Project::generateSlug($request->title);

        $form_data['slug'] = $slug;

        if($request->hasFile('cover_image')){
            $path = Storage::disk('public')->put('project_images', $request->cover_image);
            $form_data['cover_image'] = $path;
        }

        $new_project = Project::create($form_data);
        
        if($request->has('technologies')){
            $new_project->technologies()->attach($request->technologies);
        }
        

        return redirect()->route('pages.index'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        $project = Project::findOrFail($id);
        return view('pages.show', compact('project'));
    }

        /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = Project::findOrFail($id);
        $categories = Category::all();
        $technologies = Technology::all();
        return view('pages.edit', compact('project', 'categories', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $Project
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, $id)
    {
        $form_data = $request->validated();

            $slug = Project::generateSlug($request->title);

            $form_data['slug'] = $slug;

            $project = Project::findOrFail($id);

            $project->update($form_data);

            if($request->has('technologies')){
                $project->technologies()->sync($request->technologies);
            }

            return redirect()->route('pages.index')->with('success', 'modifica avvenuta con successo');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $Project
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        $project->technologies()->sync([]);
        if($project->cover_image){
            Storage::delete($project->cover_image);
        }
        $project->delete();
        return redirect()-> route('pages.index');
    }
}