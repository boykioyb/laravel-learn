<form action="{{ $action }}" method="POST">
    {{ csrf_field() }}
    <input type="hidden" name="id" value="{{$postView->id ?? ''}}">
    <input type="hidden" name="acccc" value="123123123">
    <div class="card-body">
        <div class="form-group">
            <label>Tiêu đề</label>
            <input type="text" class="form-control"
                   name="title"
                   required
                   placeholder="Nhập tiêu đề"
                   value="{{$postView->title ?? ''}}">
            @error('title')
            <div class="mt-2 mb-2 text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label>Trạng thái</label>
            <select name="status" class="form-control">
                <option value="">---Chọn trạng thái---</option>
                <option value="0" {{ isset($postView->status) && $postView->status == 0 ? 'selected' : '' }}>Chưa hoạt
                    động
                </option>
                <option value="1" {{ isset($postView->status) && $postView->status == 1 ? 'selected' : '' }}>Hoạt động
                </option>
                <option value="2" {{ isset($postView->status) && $postView->status == 2 ? 'selected' : '' }}>Xóa</option>
            </select>
        </div>
        <div class="form-group">
            <label for="">Nội dung</label>
            <textarea name="content" cols="30" rows="10" class="form-control">{{ $postView->content ?? '' }}</textarea>
        </div>
    </div>

    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>
