<?php

namespace App\Http\Controllers;

use App\Notice;
use App\Traits\MetaTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class NoticeController extends Controller
{
    use MetaTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->meta['title'] = 'Notices';
        $notice = Notice::with('creator')->get();

        return view('admin.notice.index', $this->metaResponse())->with('notices', $notice);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->meta['title'] = 'Create Notice';

        return view('admin.notice.create', $this->metaResponse())->with('notices', Notice::select(['id', 'title', 'description', 'image'])->with('creator')->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title'          => 'required',
            'description' => 'required'
        ]);
        if ($request->image != '') {
            $picture = time().'_'.$request->image->getClientOriginalName();
            $request->image->move('storage/notice/image/', $picture);
            $image = 'storage/notice/image/'.$picture;
        }
        Notice::create([
            'title'          => $request->title,
            'description'  => $request->description,
            'image' => $image ?? null,
            'created_by' => Auth::user()->id,
            'updated_by' => Auth::user()->id,
        ]);

        Session::flash('success', 'Notice is created successfully');

        return redirect()->route('notices.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Notice  $notice
     * @return \Illuminate\Http\Response
     */
    public function show(Notice $notice)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  integer  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->meta['title'] = 'Update Notice';
        $notice = Notice::find($id);

        return view('admin.notice.edit', $this->metaResponse())->with('notice', $notice);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  integer $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->image != '') {
            $picture = time().'_'.$request->image->getClientOriginalName();
            $request->image->move('storage/notice/image/', $picture);
            $image = 'storage/notice/image/'.$picture;
        }
        
        $notice = Notice::find($id);
        $notice->title = $request->title;
        $notice->description = $request->description;
        $notice->image = $image ?? null;
        $notice->updated_by = Auth::user()->id;
        $notice->save();
        Session::flash('success', 'Notice is updated successfully');

        return redirect()->route('notices.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  integer  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $notice = Notice::where('id', $id)->first();
        if (($notice->created_by == Auth::user()->id) || Auth::user()->hasRole('admin')) {
            $notice->delete();
            Session::flash('success', 'Notice is deleted successsfuly');
        } else {
            Session::flash('error', 'You are not the creator of this notice. Please ask admin to delete the notice ');
        }
        return redirect()->back();
    }
}