<form action="{{ route('categories.destroy', $Category->id) }}" method="post">
    @csrf
    <input type="hidden" name="_method" value="DELETE">
    <div class="btn-group" role="group" aria-label="Button group">
        <a href="{{ route('categories.show', $Category->id) }}" class="btn btn-sm btn-info" style="color: #fff"><i class="fa fa-eye"></i></a>
        <a href="{{ route('categories.edit', $Category->id) }}" class="btn btn-sm btn-success" style="color: #fff"><i class="fa fa-edit"></i></a>
        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin mau hapus data?')" style="color: #fff"><i class="fa fa-trash"></i></button>
    </div>
</form>