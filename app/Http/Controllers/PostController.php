<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostController extends Controller
{

    public function read()
    {
        $posts = Post::query()->orderBy('updated_at', 'DESC')->get();

        return view('posts.list', [
            'postList' => $posts
        ]);
    }

    public function detail($id)
    {
        $post = Post::query()->findOrFail($id);

        return view('posts.detail', [
            'title' => "Xem chi tiết bài viết",
            'postController' => $post
        ]);
    }

    public function create()
    {
        return view('posts.create', [
            'title' => "Thêm mới bài viết"
        ]);
    }

    public function store(CreatePostRequest $request)
    {
        $params = $request->only(['title', 'status', 'content']);
        // C1: Khởi tạo class và gán dữ liệu cho property
        $post = new Post();
        $post->title = $params['title'];
        $post->slug = Str::slug($params['title']);
        $post->status = $params['status'] ?? 0;
        $post->content = $params['content'];
        $post->created_at = now();
        $post->updated_at = now();
        $save = $post->save();

        // C2: Khởi tạo class fill data vào
        $params['slug'] = Str::slug($params['title']);
        $params['status'] = $params['status'] ?? 0;
        $params['created_at'] = now();
        $params['updated_at'] = now();
        $post = new Post();
        $post->fill($params);
        $post->save();

        // C3: sử dụng eloquent để insert
        $params['slug'] = Str::slug($params['title']);
        $params['status'] = $params['status'] ?? 0;
        $params['created_at'] = now();
        $params['updated_at'] = now();
        // chỉ cho phép insert 1 lần 1 bản ghi
        // insert thành công thì sẽ trả về data đã được insert vào db
        Post::query()->create($params);

        // C4
        $params['slug'] = Str::slug($params['title']);
        $params['status'] = $params['status'] ?? 0;
        $params['created_at'] = now();
        $params['updated_at'] = now();
        // nó cho phép insert nhiều bản ghi 1 lúc
        // Bulk Insert sẽ giúp chúng ta dễ dàng thêm dữ liệu với số lượng lớn
        // response trả về chỉ dưới dang boolean
        Post::query()->insert($params);

        // C5 query builder
        DB::table('posts')->insert($params);

        $result = [
            "status" => true,
            "message" => "Thành công"
        ];
        if (!$save) {
            $result['status'] = false;
            $result['message'] = "Thất bại";
            return view('post.create', array_merge([
                'title' => "Thêm mới bài viết"
            ], $result));
        }
        return redirect()->route('post.list')->with($result);
    }

    public function edit($id)
    {
        // tìm xem nó có dữ liệu theo id xem có hay không
        // TH 1
//        $post = Post::query()->where('id', $id)->first();
//        $post = Post::query()->find($id);
//        if (is_null($post)){
//        if (!$post instanceof Post){
//            // không có dữ liệu chạy vào đây
//           abort(404);
//        }
        // có dữ liệu chạy xuống đây

//        dump(!'');
//        dump(!0);
//        dump(!false);
//        dump(!null);
//        die;

        //TH 2
        $post = Post::query()->findOrFail($id);

        return view('posts.edit', [
            'title' => "Sửa bài viết",
            'postController' => $post
        ]);
    }

    public function update(Request $request)
    {
//        DB::enableQueryLog();
        $params = $request->only(['id', 'title', 'status', 'content']);
        // select * from post where id = 1 limit 1
        // cũ lấy từ trong database
        // query hit: số lần request vào db
        $post = Post::query()->findOrFail($params['id']);
        //C1
//        dump($post);
        // xss
        $params['title'] = strip_tags($params['title']);
        $params['slug'] = Str::slug($params['title']);
        $post->fill($params);
//        dump($post);
//        die;
//        $post->save();

//        dd(DB::getQueryLog());
        // vẫn dữ nguyên về mặt model thay đổi property
        // C2
        // update post set ...
        // update dữ liệu mới từ client gửi lên của post id = 1
        // response trả về nó là dạng true false
//        $updated = $post->update($params);

        $result = [
            "status" => true,
            "message" => "Thành công"
        ];
        if (!$post->save()) {
            // select * from post where id = 1 limit 1
//            $post->refresh();
//            dd(DB::getQueryLog());
            $result['status'] = false;
            $result['message'] = "Thất bại";
            return redirect()->route('post.edit', [
                'id' => $params['id']
            ])->with($result);
        }
        return redirect()->route('post.list')->with($result);


    }

    public function delete($id)
    {
        $post = Post::query()->findOrFail($id);
        $result = [
            "status" => true,
            "message" => "Thành công"
        ];
        if (!$post->delete()) {
            $result['status'] = false;
            $result['message'] = "Thất bại";
        }
        return redirect()->route('post.list')->with($result);
    }
}
