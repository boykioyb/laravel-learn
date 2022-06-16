<form action="{{ $action }}" method="POST">
    {{ csrf_field() }}
    <div class="card-body">
        <div class="form-group">
            <label>Tiêu đề</label>
            <input type="text" class="form-control"
                   name="title"
                   required
                   placeholder="Nhập tiêu đề">

            @error('title')
            <div class="mt-2 mb-2 text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label>Trạng thái</label>
            <select name="status" class="form-control">
                <option value="">---Chọn trạng thái---</option>
                <option value="0">Chưa hoạt động</option>
                <option value="1">Hoạt động</option>
                <option value="2">Xóa</option>
            </select>
        </div>
        <div class="form-group">
            <label for="">Nội dung</label>
            <textarea name="content" cols="30" rows="10" class="form-control"></textarea>
        </div>
    </div>

    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>
