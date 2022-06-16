<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostController extends Controller
{

    public function list()
    {
        $posts = Post::query()->orderBy('created_at', 'DESC')->get();

        return view('posts.list', [
            'postList' => $posts
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
}
