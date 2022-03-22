<?php

namespace App\Http\Controllers;

use App\Asset;
use App\Employee;
use App\HandOverAsset;
use App\ReturnedAsset;
use App\Traits\MetaTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AssetController extends Controller
{
    use MetaTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->meta['title'] = 'Assets';
        $asset = Asset::all();

        return view('admin.asset.index', $this->metaResponse())->with('assets', $asset);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $datetime = Carbon::now();
        $date = $datetime->toDateString();
        $this->meta['title'] = 'Create Asset';

        return view('admin.asset.create', $this->metaResponse())->with('current_date', $date);
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
            'name'          => 'required',
            'condition' => 'required',
            'entry_date'      => 'required',
        ]);
        Asset::create([
            'type'          => $request->type ?? '',
            'name'          => $request->name,
            'brand'      => $request->brand ?? '',
            'condition'  => $request->condition,
            'location'  => $request->location ?? '',
            'entry_date' => $request->entry_date,
            'active' => $request->active,
            'allocated' => 0
        ]);

        Session::flash('success', 'Asset is created successfully');

        return redirect()->route('asset.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Asset  $asset
     * @return \Illuminate\Http\Response
     */
    public function show(Asset $asset)
    {
        //
    }

    /**
     * Display the filter by not allocated resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function available()
    {
        $this->meta['title'] = 'Available Assets';
        $asset = Asset::where(['allocated' => 0, 'active' => 1])->get();
        return view('admin.asset.available', $this->metaResponse())->with('assets', $asset)->with('employees', Employee::select(['id', 'firstname', 'lastname'])->get());
    }

    /**
     * Display the hand overed resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function handOver()
    {
        $this->meta['title'] = 'Handed Over Assets';
        $asset = HandOverAsset::with(['asset', 'employee'])->orderByDesc('asset_id')->get();

        return view('admin.asset.handover', $this->metaResponse())->with('handOverAssets', $asset);
    }

    /**
    * Display the hand overed resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function handOvered(Request $request)
    {
        // get employee id and asset id.
        // first check if asset already allocated or not
        // then insert handover and update allocated column in assets
        if (Asset::isAsetAvailable($request->asset_id)) {
            $datetime = Carbon::now();
            HandOverAsset::create(
                [
                    'asset_id' => $request->asset_id,
                    'employee_id' => $request->employee_id,
                    'handover_date' => $datetime->format('Y-m-d')
                ]
            );
            $asset = Asset::find($request->asset_id);
            $asset->allocated = 1;
            $asset->save();
            Session::flash('success', "Asset is successfully handover");
        } else {
            Session::flash('error', 'Asset is already allocated');
        }
        

        return redirect()->back();
    }

    /**
     * Display the returned resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function returned()
    {
        $this->meta['title'] = 'Returned Assets';
        $asset = ReturnedAsset::with(['asset', 'employee'])->get();

        return view('admin.asset.returned', $this->metaResponse())->with('returnedAssets', $asset);
    }
    /**
    * Display the returned resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function returnedAsset(Request $request)
    {
        // get employee id and asset id.
        // first check if asset already allocated or not
        // then insert handover and update allocated column in assets
        if (!Asset::isAsetAvailable($request->asset_id)) {
            $datetime = Carbon::now();
            ReturnedAsset::create(
                [
                    'asset_id' => $request->asset_id,
                    'employee_id' => $request->employee_id,
                    'returned_date' => $datetime->format('Y-m-d')
                ]
            );
            $asset = Asset::find($request->asset_id);
            $asset->allocated = 0;
            $asset->save();
            Session::flash('success', "Asset is successfully returned");
        } else {
            Session::flash('error', 'Asset not yet allocated');
        }
        

        return redirect()->back();
    }

    /**
     * Display the inactive or not functional resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function inactive()
    {
        $this->meta['title'] = 'Unavialable Assets';
        $asset = Asset::where('active', 0)->get();

        return view('admin.asset.inactive', $this->metaResponse())->with('assets', $asset);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  integer  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $this->meta['title'] = 'Update Asset';
        $asset = Asset::find($id);

        return view('admin.asset.edit', $this->metaResponse())->with('asset', $asset);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  integer  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $asset = Asset::find($id);
        $asset->type = $request->type;
        $asset->name = $request->name;
        $asset->brand = $request->brand;
        $asset->location = $request->location;
        $asset->condition = $request->condition;
        $asset->active = $request->active;
        $asset->save();
        Session::flash('success', 'Asset is updated successfully');

        return redirect()->route('asset.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  integer $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $asset = Asset::where('id', $id)->first();
        $asset->active = 0;
        $asset->save();
        Session::flash('success', 'Asset is inactive successsfuly');

        return redirect()->back();
    }
}