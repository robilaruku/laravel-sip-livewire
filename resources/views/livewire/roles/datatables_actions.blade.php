
<div class="btn-group" role="group" aria-label="Button group">
    <a href="{{ route('roles.show', $Role->id) }}" class="btn btn-sm btn-info" style="color: #fff"><i class="fa fa-eye"></i></a>
    <a href="{{ route('roles.edit', $Role->id) }}" class="btn btn-sm btn-success" style="color: #fff"><i class="fa fa-edit"></i></a>
    <button type="button" wire:click="destroy({{ $Role->id }})" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')" style="color: #fff"><i class="fa fa-trash"></i></button>
</div>