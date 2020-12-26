<div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                      <i class="fa fa-plus"></i> Add Role
                    </h3>
                </div>
                <form wire:submit.prevent="store">
                <div class="card-body">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                          <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                          </ul>
                    </div>
                @endif
                    <div class="form-group">
                        <label for="my-input">Name</label>
                        <input id="my-input" class="form-control @error('name') is-invalid @enderror" type="text" name="" wire:model="name" placeholder="Name...">
                        @error('name')
                            <span class="invalid-feedback">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="my-input">Permission</label>
                        <table class="table table-light">
                            <thead class="thead-light">
                                <tr>
                                    <th><input type="checkbox" wire:model="checkbox_all"  value=""></th>
                                    <th>Permission</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($permissions as $key => $value)
                                <tr>
                                    <td>
                                        <input type="checkbox" class="@error('checkbox_values') is-invalid @enderror" wire:model="checkbox_values" value="{{ $value->{$checkbox_attribute} }}">
                                    </td>
                                    <td>{{ $value->name }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                      
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('roles.index') }}" class="btn btn-outline-secondary"><i class="fa fa-arrow-left"></i> Back</a>
                    <button type="submit" class="btn btn-primary"> 
                        <span wire:loading wire:target="store" class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                            Add Role
                    </button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

