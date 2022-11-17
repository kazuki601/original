<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;

class ItemController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * ホーム画面
     */
    public function homeIndex(Request $request)
    {
            $items = Item::where('status', 'active')->orderBy('created_at', 'desc')->take(3)->get();
            $type = Item::TYPE;
            return view('/home')->with([
                'items' => $items,
                'type' => $type,
            ]);
    }

    /**
     * 商品一覧
     */
    public function index()
    {
        // 商品一覧取得
        $items = Item::paginate(10)->where('status', '=', 'active');
        $type = Item::TYPE;
        return view('item.index', compact('items', 'type'));
    }

    /**
     * 商品登録
     */
    public function add(Request $request)
    {
        // POSTリクエストのとき
        if ($request->isMethod('post')) {
            // バリデーション
            $this->validate($request, [
                'name' => 'required|max:100',
                'type' => 'required',
                'detail' => 'required|max:500',
            ],
            [
                'name.required' => '名前は必須です',
                'type.required'  => '種別は必須です',
                'detail.required'  => '詳細は必須です',
            ]);

            // 商品登録
            Item::create([
                'user_id' => Auth::user()->id,
                'name' => $request->name,
                'type' => $request->type,
                'detail' => $request->detail,
            ]);

            return redirect('/item');
        }
        $type = Item::TYPE;
        return view('item.add', compact('type'));
    }

    /**
     * 商品編集画面
     */
    public function edit(Request $request)
    {
        $items = Item::where('id', '=', $request->id)->first();
        $type = Item::TYPE;
        return view('item.edit', compact('items', 'type'));
    }

     /**
     * 商品編集
     */
    public function itemEdit(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
            'type' => 'required',
            'detail' => 'required|max:500',
        ],
        [
                'name.required' => '名前は必須です',
                'type.required'  => '種別は必須です',
                'detail.required'  => '詳細は必須です',
        ]);

        $items = Item::where('id', '=', $request->id)->first();
        $type = Item::TYPE;
        $typer = array_flip($type);
        $items->name = $request->name;
        $items->type = $typer[$request->type];
        $items->detail = $request->detail;
        $items->save();
        

        return redirect('/item');
    }

     /**
     * 商品削除
     */
    public function itemDelete(Request $request)
    {
        $items = Item::where('id', '=', $request->id)->first();
        $items->delete();

        return redirect('/item');
    }

     /**
     * 商品検索機能
     */
    public function getIndex(Request $rq)
    {
        $keyword = $rq->input('keyword');
        $type = Item::TYPE;
        $query = Item::query();
        $select = $rq->select;
        //dd($rq);
        $query->where('status', '=', 'active');
        if(!empty($keyword))
        {
            $query->where('name','like','%'.$keyword.'%');
        }
        if(!empty($select))
        {
            $query->Where('type',$select);
        }
        $items = $query->orderBy('id','asc')->paginate(10, ["*"], 'data-page');
        return view('item.index')->with([
            'items' => $items,
            'keyword' => $keyword,
            'type' => $type,
        ]);
    }
}
